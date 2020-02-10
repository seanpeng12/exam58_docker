# ?ï¿½ï¿½?ï¿½ï¿½?ï¿½ï¿½?ï¿½ï¿½?ï¿½ï¿½?ï¿½ï¿½é»žï¿½?ï¿½ï¿½?ï¿½ï¿½??
library(RMySQL)
library('visNetwork')
library('igraph')

args <- commandArgs(TRUE)
# args <- "ï¿½xï¿½_ ï¿½Õªï¿½ï¿½] ï¿½jï¿½ï¿½"
city <- strsplit(args,"[[:space:]]")[[1]][1]
opt1 <- strsplit(args,"[[:space:]]")[[1]][2]
opt2 <- strsplit(args,"[[:space:]]")[[1]][3]


connect <- dbConnect(MySQL(), 
                     db = "homestead",
                     username = "homestead", 
                     password = "secret",
                     host = "127.0.0.1")

# #homestead(?ï¿½ï¿½11?ï¿½ï¿½è¡?)
# dbListTables(connect)
# #site_data??ï¿½è¡¨?ï¿½ï¿½
# dbListFields(connect, "site_data")

#?ï¿½ï¿½?ï¿½ï¿½?ˆ°cityname
cname <- city
tag1 <- opt1
tag2 <- opt2
sn_sql <- paste("select DISTINCT d.id, d.name, d.city_name, d.type
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

dbSendQuery(connect,"SET NAMES big5")
sn <- dbGetQuery(connect , sn_sql)
sa <- dbGetQuery(connect ,sa_sql)
sr <- dbGetQuery(connect ,sr_sql)

x <- data.frame(sn)
# print(x$name)
y <- data.frame(sa)
y$shape <- "square"
y$color <- "red"

n <- merge(x, y, by.x = c("id","type"), by.y = c("id","type"), all = TRUE)
# print(n)
nodes <- data.frame(id = c(n$id), group = c(n$type),
                    label = c(n$tag), color = c(n$color),
                    title = paste("<p>", n$name,"</p>"),
                    shape = c(n$shape), font.size = 30)
edges <- data.frame(from = c(sr$from), to = c(sr$to))

ccout = visNetwork(nodes,edges, width = "100%",height = "100%") %>%
  visIgraphLayout() %>% #??ï¿½ï¿½??
  visOptions(highlightNearest = TRUE)

# g <- graph.data.frame(edges, directed=FALSE, vertices=nodes)
# graph <- betweenness(g, v = V(g), directed = FALSE, weights = NA)
# visIgraph(g) %>%
#   visOptions(highlightNearest = TRUE)

visSave(ccout, file = "C://xampp/htdocs/exam58/public/R/between2.html")

# dbDisconnect(connect)
on.exit(dbDisconnect(connect))

# æ¸¬è©¦db?ï¿???ï¿½ï¿½
# lapply(dbListConnections(MySQL()), dbDisconnect)