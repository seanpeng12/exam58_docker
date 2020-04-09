library(RMySQL)
library('visNetwork')
library('igraph')

con <- dbConnect(MySQL(), 
                 db = "homestead",
                 username = "root", 
                 password = "sightseeing",
                 host = "140.136.155.116")
dbSendQuery(con,"SET NAMES big5")

#找到目標id
sname <- '象山自然步道'
id_sql <- paste("SELECT id FROM site_data WHERE name = '",sname,"'", sep="")
sid <- dbGetQuery(con, id_sql)

#找到好的(red)裡面degree最大的
b_sql <- paste("SELECT s.id, s.segment, s.color, s.site_id, sd.name, `degree.g.`  
                FROM segment_data s, segment_degree d, site_data sd 
                WHERE (s.id = d.id AND sd.id = d.site_id) 
                AND sd.id = '",sid,"'
                AND s.color = 'red'", sep="")
good <- dbGetQuery(con, b_sql)
DegreeMax <- max(good$degree.g.)
# print(DegreeMax)

# 找到maxdegree的名稱
g <- paste0("SELECT d.id, segment, color, `degree.g.` 
            FROM segment_data s, segment_degree d 
            WHERE (s.id = d.id) AND s.color = 'red' 
            AND s.site_id = '",sid,"'
            AND `degree.g.` = '",DegreeMax,"'",sep="")
gname <- dbGetQuery(con, g)
#print(gname)

#找到與maxdegree連接的點
gid = gname$id

# =============以上是為了找到gid(degree最高的點)=============
#被連到最多的圖亮吧
seg <- paste("SELECT s.id, s.segment, s.color, d.name
              FROM segment_data s, site_data d
              WHERE (d.id = s.site_id)
              AND d.id = '",sid,"'
              AND s.color='red'",sep="")
seg_relat <- paste("SELECT r.from_id, s1.segment, s1.color, r.to_id, s2.segment, s2.color, r.site_id, d.name
                FROM site_data d, segment_relationship r, segment_data s1, segment_data s2
                WHERE (d.id = r.site_id AND r.from_id = s1.id AND r.to_id = s2.id)
                AND d.id = '",sid,"'
                AND (s1.color = 'red' AND s2.color = 'red')",sep="")

segment <- dbGetQuery(con, seg)
relationship <- dbGetQuery(con, seg_relat)

x <- data.frame(segment)
y <- data.frame(relationship)
fsize <- good$degree.g.
nodes <- data.frame(id = c(x$id), label = c(x$segment), color = c(x$color), 
                    # title = paste("<p>", x$segment,"</p>"),
                    font.size = 30, value = fsize)
edges <- data.frame(from = c(y$from_id), to = c(y$to_id))

ccout <- visNetwork(nodes,edges, width = "100%",height = "1000px") %>%
  visIgraphLayout() %>%
  visOptions(highlightNearest = list(enabled = T, degree = 2, hover = T),
             nodesIdSelection = list(enabled = TRUE, selected = gid))


visSave(ccout, file = "C://xampp/htdocs/SNA_sean/exam58/public/R/bad.html",selfcontained = TRUE, background = "white")

# dbDisconnect(con)
on.exit(dbDisconnect(con))

# 測試db連接
lapply(dbListConnections(MySQL()), dbDisconnect)