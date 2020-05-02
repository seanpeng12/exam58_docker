library('RMySQL', warn.conflicts = FALSE)
library('visNetwork', warn.conflicts = FALSE)
library('igraph', warn.conflicts = FALSE)

con <- dbConnect(MySQL(), 
                 db = "homestead",
                 username = "root", 
                 password = "sightseeing",
                 host = "140.136.155.116")
dbSendQuery(con,"SET NAMES big5")

args <- commandArgs(TRUE)
sid <- args

g_sql <- paste("SELECT s.degree 
                FROM h_segment_data s, hotel_data hd 
                WHERE (s.hotel_id = hd.id) 
                AND s.hotel_id = '",sid,"' 
                AND s.evaluation = 'P'", sep="")
good <- dbGetQuery(con, g_sql)
DegreeMax <- max(good$degree)


g <- paste0("SELECT id, segment, color, degree
            FROM h_segment_data s
            WHERE evaluation = 'P' 
            AND hotel_id = '",sid,"'
            AND degree = '",DegreeMax,"'",sep="")
gname <- dbGetQuery(con, g)


gid = gname$id


seg <- paste("SELECT s.id, s.segment, s.color, s.hotel_id, hd.name  
              FROM h_segment_data s, hotel_data hd 
              WHERE (s.hotel_id = hd.id) 
              AND s.hotel_id = '",sid,"' 
              AND s.evaluation = 'P'", sep="")
seg_relat <- paste("SELECT from_id,to_id,weight,color 
                    FROM h_segment_relationship 
                    WHERE hotel_id = '",sid,"' 
                    AND from_id = ANY(SELECT id FROM h_segment_data WHERE hotel_id = '",sid,"' AND evaluation = 'P')", sep="")

segment <- dbGetQuery(con, seg)
relationship <- dbGetQuery(con, seg_relat)
x <- data.frame(segment)
y <- data.frame(relationship)
fsize <- (good$degree)
nodes <- data.frame(id = c(x$id), color = c(x$color),
                    # label = c(x$segment),
                    # title = paste("<p>", x$segment,"</p>")
                    font.size = 40, value = fsize)
edges <- data.frame(from = c(y$from_id), to = c(y$to_id),
                    value = c(y$weight),color = c(y$color))

ccout <- visNetwork(nodes,edges, width = "100%",height = "500px") %>%
  visIgraphLayout() %>%
  visOptions(highlightNearest = list(enabled = T, hover = T),
             nodesIdSelection = list(enabled = TRUE))

visSave(ccout, file = "C://xampp/htdocs/SNA_sean/exam58/quasarapp/src/statics/h_good.html",selfcontained = TRUE, background = "white")
# dbDisconnect(con)
on.exit(dbDisconnect(con))


lapply(dbListConnections(MySQL()), dbDisconnect)