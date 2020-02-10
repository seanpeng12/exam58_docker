#??��??: 1.中�?��?�無法顯示在??��??
args <- commandArgs(TRUE)
# args = "?��?��"

library('RMySQL')
library('visNetwork')
library('igraph')

connect <- dbConnect(MySQL(), 
                    db = "homestead",
                    username = "homestead", 
                    password = "secret",
                    host = "127.0.0.1")

# #homestead(?��11?���?)
# dbListTables(connect)
# #site_data??�表?��
# dbListFields(connect, "site_data")

#?��?��?��cityname
cname <- args
# cname <- paste("'",args,"'",sep="")

sn_sql <- paste("select * from site_data where city_name ='", cname,"'",sep="")
sr_sql <- paste("select r.from_id,r.to_id FROM site_relationship r, site_data d WHERE r.from_id = d.id AND d.city_name ='", cname,"'",sep="")

dbSendQuery(connect,"SET NAMES big5")
sn <- dbGetQuery(connect , sn_sql)
# sn <- dbGetQuery(connect ,"select * from site_data where city_name = '?��???'")
sa <- dbGetQuery(connect ,"select * from site_attr")
sr <- dbGetQuery(connect ,sr_sql)

x <- data.frame(sn)
# print(x$name)
y <- data.frame(sa)
y$shape <- "square"
y$color <- "red"

n <- merge(x, y, by.x = c("id","type"), by.y = c("id","type"), all = TRUE)
# print(n)
nodes <- data.frame(id = c(n$id), group = c(n$type),
                    label = c(n$id), color = c(n$color), 
                    shape = c(n$shape), font.size = 30)
edges <- data.frame(from = c(sr$from), to = c(sr$to))

ccout = visNetwork(nodes,edges, width = "100%",height = "100%") %>%
  visIgraphLayout() %>% #??��??
  visOptions(highlightNearest = TRUE)

visSave(ccout, file = "C://xampp/htdocs/exam58/public/R/between.html"  , background = "white")

# g <- graph.data.frame(edges, directed=FALSE, vertices=nodes)
# graph <- betweenness(g, v = V(g), directed = FALSE, weights = NULL,
#                      nobigint = TRUE, normalized = FALSE)
# visIgraph(g) %>%
#   visOptions(highlightNearest = TRUE)