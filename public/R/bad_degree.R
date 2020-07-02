library('RMySQL')
library('visNetwork')
library('igraph')

con <- dbConnect(MySQL(), 
                 db = "homestead",
                 username = "root", 
                 password = "sightseeing",
                 host = "127.0.0.1")
dbSendQuery(con,"SET NAMES utf8mb4")

args <- commandArgs(trailingOnly = TRUE)
sid <- args
# sid <- 'S0102'

b_sql <- paste("SELECT s.degree 
                FROM segment_data s, site_data sd 
                WHERE (s.site_id = sd.id) 
                AND s.site_id = '",sid,"' 
                AND s.evaluation = 'N'", sep="")
bad <- dbGetQuery(con, b_sql)
DegreeMax <- max(bad$degree)


b <- paste0("SELECT id, segment, color, degree
            FROM segment_data s
            WHERE evaluation = 'N' 
            AND site_id = '",sid,"'
            AND degree = '",DegreeMax,"'",sep="")
bname <- dbGetQuery(con, b)


bid = bname$id


seg <- paste("SELECT s.id, s.segment, s.color, s.site_id, sd.name  
              FROM segment_data s, site_data sd 
              WHERE (s.site_id = sd.id) 
              AND s.site_id = '",sid,"' 
              AND s.evaluation = 'N'", sep="")
seg_relat <- paste("SELECT from_id,to_id,weight,color 
                    FROM segment_relationship 
                    WHERE site_id = '",sid,"' 
                    AND from_id = ANY(SELECT id FROM segment_data WHERE site_id = '",sid,"' AND evaluation = 'N')", sep="")

segment <- dbGetQuery(con, seg)
relationship <- dbGetQuery(con, seg_relat)
x <- data.frame(segment)
y <- data.frame(relationship)
fsize <- (bad$degree)
nodes <- data.frame(id = c(x$id), color = c(x$color),
                    label = c(x$segment), 
                    # title = paste("<p>", x$segment,"</p>")
                    font.size = 30, value = fsize)
edges <- data.frame(from = c(y$from_id), to = c(y$to_id),
                    value = c(y$weight),color = c(y$color))

ccout <- visNetwork(nodes,edges, width = "100%",height = "500px") %>%
  visIgraphLayout() %>%
  visOptions(highlightNearest = list(enabled = T, hover = T),
             nodesIdSelection = list(enabled = TRUE))

visSave(ccout, file = "/Applications/XAMPP/htdocs/exam58/quasarapp/src/statics/bad.html",selfcontained = FALSE, background = "white")

# dbDisconnect(con)
on.exit(dbDisconnect(con))


lapply(dbListConnections(MySQL()), dbDisconnect)