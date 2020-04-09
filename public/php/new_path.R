library('visNetwork')
library('igraph')

n<-read.csv("path_node.csv", header=T, as.is=T, sep=',', fileEncoding = 'utf-8')
sr<-read.csv("path_edge.csv", header=T, as.is=T, sep=',', fileEncoding = 'utf-8')


s_name <- n[1,1]
nodes <- data.frame(id = c(n$sid), group = c(n$level),
                    # label = c(n$near_site), 
                    # title = paste("<p>", n$name,"</p>"),
                    font.size = 30)
edges <- data.frame(from = c(sr$from_id), to = c(sr$to_id),
                    value = c(sr$d_edge))

ccout <- visNetwork(nodes, edges, width = "100%")%>%
  visIgraphLayout() %>% #靜態
  visOptions(highlightNearest = TRUE, selectedBy= "group",
             nodesIdSelection = list(enabled = TRUE,  selected = s_name))

visSave(ccout, file = "C://xampp/htdocs/SNA_sean/exam58/public/R/path.html",selfcontained = TRUE, background = "white")