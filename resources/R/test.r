library(rjson)

args <-commandArgs(TRUE)
mylist<-strsplit(args," ")
myData<-function() {
  result<-list();
  result[["0892"]]<-57.56;
  result[["0992"]]<-59;
  result[["1149"]]<-56.05;
  result[["1294"]]<-55.67;
  result[["1394"]]<-54.92;
  result[["1446"]]<-53.25;
  result[["1461"]]<-65.02;
  result[["1481"]]<-54.35;
  result[["JOJO"]]<-99
  return(result) 
}


result<-myData()


cat(toJSON(result))