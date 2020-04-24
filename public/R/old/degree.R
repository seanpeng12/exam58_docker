library('RMySQL', warn.conflicts = FALSE)
library('visNetwork', warn.conflicts = FALSE)
library('igraph', warn.conflicts = FALSE)

con <- dbConnect(MySQL(), 
                 db = "homestead",
                 username = "root", 
                 password = "sightseeing",
                 host = "140.136.155.116")
dbSendQuery(con,"SET NAMES big5")

#????????id
args <- commandArgs(TRUE)
sname <- args
# sname <- '?H?s???M?B?D'
id_sql <- paste("SELECT id FROM site_data WHERE name = '",sname,"'", sep="")
sid <- dbGetQuery(con, id_sql)

#????c?n??(green)????degree???j??
b_sql <- paste("SELECT s.id, s.segment, s.color, s.site_id, sd.name, `degree.g.`  
                FROM segment_data s, segment_degree d, site_data sd 
                WHERE (s.id = d.id AND sd.id = d.site_id) 
                AND sd.id = '",sid,"'
                AND s.color = 'green'", sep="")
good <- dbGetQuery(con, b_sql)
DegreeMax <- max(good$degree.g.)
# print(DegreeMax)

# ????maxdegree???W??
g <- paste0("SELECT d.id, segment, color, `degree.g.` 
            FROM segment_data s, segment_degree d 
            WHERE (s.id = d.id) AND s.color = 'green' 
            AND s.site_id = '",sid,"'
            AND `degree.g.` = '",DegreeMax,"'",sep="")
gname <- dbGetQuery(con, g)
#print(gname)

#?????Pmaxdegree?s?????I
gid = gname$id

# =============?H?W?O???F????gid(degree???????I)=============
#?Q?s?????h?????G?a
seg <- paste("SELECT s.id, s.segment, s.color, d.name
              FROM segment_data s, site_data d
              WHERE (d.id = s.site_id)
              AND d.id = '",sid,"'
              AND s.color='green'",sep="")
seg_relat <- paste("SELECT r.from_id, s1.segment, s1.color, r.to_id, s2.segment, s2.color, r.site_id, d.name
                FROM site_data d, segment_relationship r, segment_data s1, segment_data s2
                WHERE (d.id = r.site_id AND r.from_id = s1.id AND r.to_id = s2.id)
                AND d.id = '",sid,"'
                AND (s1.color = 'green' AND s2.color = 'green')",sep="")

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

visSave(ccout, file = "C://xampp/htdocs/SNA_sean/exam58/quasarapp/src/statics/good.html",selfcontained = TRUE, background = "white")
# dbDisconnect(con)
on.exit(dbDisconnect(con))

# ????db?s??
lapply(dbListConnections(MySQL()), dbDisconnect)