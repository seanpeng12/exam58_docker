# SightSeeing

### 服務描述

* 近年來大多數的旅客喜歡自由且客製化的行程安排，這是一套提供給自由行旅客旅程安排的整合系統，包含景點、飯店的優缺點特徵分析，google map標記景點找到最佳路徑，提供給用戶迅速且作為旅程安排的依據，不必再到各種不同網站爬文，節省旅程安排的時間。 

![1](https://user-images.githubusercontent.com/48153269/192665786-708d26d3-00da-4649-865e-9c0e86c7bacf.png)



### 功能簡介

* 排程: 註冊會員的使用者可以利用排程功能以流線型的方式完成旅程安排

![2](https://user-images.githubusercontent.com/48153269/192672072-15d27534-eef0-4805-855b-897d097939a6.png)
![step1](https://user-images.githubusercontent.com/48153269/192665763-3154446e-6768-466c-9083-dc756bcea426.png)

* 優缺點分析: 此分析包含景點與飯店兩個部分，在使用者在選取某一景點後，透過自建旅遊詞語庫與SNA分析法(點度中心度)，系統將呈現有關此景點的優點、缺點分析，使用者可清楚得知此景點的特色(優點)及在此景點可能遇到的問題(缺點)。 

![step2](https://user-images.githubusercontent.com/48153269/192665673-d0e40df3-168c-41ce-91e9-a0a95b90a10a.png)

* 路徑推薦分析: 使用者先輸入一個景點後點擊分析，系統會呈現出其他造訪者在造訪此景點後，也會造訪的其他景點、飯店或餐廳，使用者可以藉此了解熱門關聯景點並方便安排旅程。 

![路徑](https://user-images.githubusercontent.com/48153269/192665691-b37602a6-8fe9-49a5-8ebf-397a46dca03e.png)

 * Google路線安排: 使用者可透過此功能利用GoogleMap API找出以一天為基準的最短行車路線之景點順序。 
 
![googlenap](https://user-images.githubusercontent.com/48153269/192665749-f9547c32-3cf1-45c4-bf4a-f76407a3f556.png)

# 運用的技術 

* 資料庫:MySQL 5.8(儲存網路爬蟲下來的資料) 、Google Firebase(儲存user端資料) 

* 伺服器: XAMPP-Apache Server、 Node.js 

* 後端軟體： Laravel、R、Python 

* 前端軟體： Vue.js 2(Quasar Cli) 

# Docker
* 在根目錄執行以pull image並啟動服務
    `docker-compose up -d`

* php migration建立資料表
    `bash run.sh`
* 匯入MySQL資料
  


* MySQL phpmyadmin panel: http://localhost:8888
* 後端PHP Laravel API:  
  * 測試用GET  
  http://localhost:8080/api/site_dataCity
* 前端Vue Quasar:
  `cd volume/web/quasarapp/`
  `quasar dev`

  
