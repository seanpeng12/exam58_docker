library('RMySQL', warn.conflicts = FALSE)
library('visNetwork', warn.conflicts = FALSE)
library('igraph', warn.conflicts = FALSE)

connect <- dbConnect(MySQL(), 
                     db = "homestead",
                     username = "root", 
                     password = "sightseeing",
                     host = "140.136.155.116")


args <- commandArgs(TRUE)
city <- strsplit(args,"[[:space:]]")[[1]][1]
a <- strsplit(args,"[[:space:]]")[[1]][2]
b <- strsplit(args,"[[:space:]]")[[1]][3]

cname <- city
tag1 <- a
tag2 <- b
sn_sql <- paste("select DISTINCT d.id,d.name, d.city_name, d.color 
                FROM hotel_relationship r, hotel_data d, hotel_attr a 
                WHERE (r.from_id = d.id AND r.to_id = a.id) 
                AND d.city_name ='", cname,"' 
                AND (a.tag ='", tag1,"' OR a.tag ='", tag2,"')",sep="")
sa_sql <- paste("select * from hotel_attr WHERE tag ='", tag1,"' OR tag ='", tag2,"'",sep="")
sr_sql <- paste("select r.from_id,d.name,r.to_id,a.tag 
                FROM hotel_relationship r, hotel_data d, hotel_attr a 
                WHERE (r.from_id = d.id AND r.to_id = a.id) 
                AND d.city_name ='", cname,"' 
                AND (a.tag ='", tag1,"' OR a.tag ='", tag2,"')",sep="")

dbSendQuery(connect,"SET NAMES big5")
sn <- dbGetQuery(connect , sn_sql)
sa <- dbGetQuery(connect ,sa_sql)
sr <- dbGetQuery(connect ,sr_sql)

nq <- nrow(sn)

x <- data.frame(sn)
# print(x$name)
y <- data.frame(sa)

n <- merge(x, y, by.x = c("id","name","color"), 
           by.y = c("id","tag","color"), all = TRUE)
# print(n)
nodes <- data.frame(id = c(n$id), color = c(n$color),
                    # label = c(n$name),
                    # title = paste("<p>", n$name,"</p>"),
                    shape = c(n$shape), font.size = 30)
edges <- data.frame(from = c(sr$from), to = c(sr$to))

ccout <- visNetwork(nodes,edges, width = "100%",height = "500px") %>%
  visIgraphLayout() %>% 
  visOptions(highlightNearest = TRUE,
             nodesIdSelection = TRUE)

visSave(ccout, file = "C://xampp/htdocs/SNA_sean/exam58/quasarapp/src/statics/h_between_relationship.html", background = "white")
# dbDisconnect(connect)
on.exit(dbDisconnect(connect))


# lapply(dbListConnections(MySQL()), dbDisconnect)