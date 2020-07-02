library('RMySQL')
library('visNetwork')
library('igraph')

connect <- dbConnect(MySQL(), 
                    db = "homestead",
                    username = "root", 
                    password = "sightseeing",
                    host = "127.0.0.1")
dbSendQuery(connect,"SET NAMES utf8mb4")

args <- commandArgs(trailingOnly = TRUE)

city <- strsplit(args,"[[:space:]]")[[1]][1]
a <- strsplit(args,"[[:space:]]")[[1]][2]
b <- strsplit(args,"[[:space:]]")[[1]][3]

cname <- city
tag1 <- a
tag2 <- b
sn_sql <- paste("select DISTINCT d.id,d.name, d.city_name, d.type, d.color 
                FROM site_relationship r, site_data d, site_attr a 
                WHERE (r.from_id = d.id AND r.to_id = a.id) 
                AND d.city_name ='", cname,"' 
                AND (a.tag ='", tag1,"' OR a.tag ='", tag2,"')",sep="")
sa_sql <- paste("select * from site_attr WHERE tag ='", tag1,"' OR tag ='", tag2,"'",sep="")
sr_sql <- paste("select r.from_id,d.name,r.to_id,a.tag 
                FROM site_relationship r, site_data d, site_attr a 
                WHERE (r.from_id = d.id AND r.to_id = a.id) 
                AND d.city_name ='", cname,"' 
                AND (a.tag ='", tag1,"' OR a.tag ='", tag2,"')",sep="")

sn <- dbGetQuery(connect , sn_sql)
sa <- dbGetQuery(connect ,sa_sql)
sr <- dbGetQuery(connect ,sr_sql)

nq <- nrow(sn)

x <- data.frame(sn)
# print(x$name)
y <- data.frame(sa)

n <- merge(x, y, by.x = c("id","type","name","color"), 
           by.y = c("id","type","tag","color"), all = TRUE)
# print(n)
nodes <- data.frame(id = c(n$id), group = c(n$type), 
                    label = c(n$name), color = c(n$color),
                    # title = paste("<p>", n$name,"</p>"),
                    shape = c(n$shape), font.size = 30)
edges <- data.frame(from = c(sr$from), to = c(sr$to))
ccout <- visNetwork(nodes,edges, width = "100%",height = "500px") %>%
  visIgraphLayout() %>% 
  visOptions(highlightNearest = TRUE,
             nodesIdSelection = TRUE)

visSave(ccout, file = "/Applications/XAMPP/htdocs/exam58/quasarapp/src/statics/between_relationship.html",selfcontained = FALSE, background = "white")

# g <- graph.data.frame(edges, directed=FALSE, vertices=nodes)
# graph <- betweenness(g, v = V(g), directed = FALSE, weights = NA)
# visIgraph(g) %>%
#   visOptions(highlightNearest = TRUE)

# dbDisconnect(connect)
on.exit(dbDisconnect(connect))


# lapply(dbListConnections(MySQL()), dbDisconnect)