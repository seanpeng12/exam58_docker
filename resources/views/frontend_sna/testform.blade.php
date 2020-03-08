<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<!-- CSS -->
<style type="text/css">
.bar {
    width: 100px;
    height: 20px;
    margin: 2px;
    border: 1px solid black;
    background-color: lightgreen;
    text-align: center;
    float: left;
    margin: 2px;
    padding: 2px;
    cursor: pointer;
    border-radius: 3px;
}

.list {
    background-color: lightblue;
    border: 1px solid gray;
}

.items .ui-selected {
    background: red;
    color: white;
    font-weight: bold;
}

.items {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 100px;
}

.items li {
    margin: 2px;
    padding: 2px;
    cursor: pointer;
    border-radius: 3px;
}

.weekday {
    float: left;
}

.availablelist {
    background-color: orange;
    display: inline;
}

//摺疊
.collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active,
.collapsible:hover {
  background-color: #555;
}

.collapsible:after {
  content: '\002B';
  color: white;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2212";
}

.content {
  padding: 0 18px;

  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #ffe1e1;
}

.a {
  margin: 5px 0;
  padding: 0 20px;
  height: 40px;
  line-height: 40px;
  border-radius: 3px;
  background: #408080;
  //background: -webkit-linear-gradient(to right, #267871, #136a8a);
  //background: linear-gradient(to right, #267871, #136a8a);
  color: #fff;
  text-align: left;
  font-family: NSimSun;
  list-style: none;
}
</style>
<body>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />


{{--    --}}

<div style="float:left;width:500px;">
    <div>可排班員工名稱</div>
    <ul id="available1" class="items">
        <li class="list availablelist">Jhonny</li>
    </ul>
    <ul id="available2" class="items">    
        <li class="list availablelist">Tim</li>
    </ul>
    <ul id="available3" class="items">    
        <li class="list availablelist">George</li>
    </ul>
    <ul id="available4" class="items">    
        <li class="list availablelist">Melissa</li>
    </ul>
    <ul id="available5" class="items">    
        <li class="list availablelist">Alice</li>
    </ul>
</div>
<div style="clear:both"></div>
<div id="timetable" style="float:left;width:700px;">
    <div style="text-align:center">排班表</div>
    
    <div class="weekday">星期二 
        <ul class="items">
            <li class="list">Jhonny</li>
            <li class="list">Tim</li>
            <li class="list">George</li>
            <li class="list">Melissa</li>
            <li class="list">Alice</li>
        </ul>
    </div>
    <div class="weekday">星期三 
        <ul class="items">
            <li class="list">Jhonny</li>
            <li class="list">Tim</li>
            <li class="list">George</li>
            <li class="list">Melissa</li>
            <li class="list">Alice</li>
        </ul>
    </div>
    <div class="weekday">星期四 
        <ul class="items">
            <li class="list">Jhonny</li>
            <li class="list">Tim</li>
            <li class="list">George</li>
            <li class="list">Melissa</li>
            <li class="list">Alice</li>
        </ul>
    </div>
    <div class="weekday">星期五
        <ul class="items">
            <li class="list">Jhonny</li>
            <li class="list">Tim</li>
            <li class="list">George</li>
            <li class="list">Melissa</li>
            <li class="list">Alice</li>
        </ul>
    </div>
    <div class="weekday">星期六
        <ul class="items">
            <li class="list">Jhonny</li>
            <li class="list">Tim</li>
            <li class="list">George</li>
            <li class="list">Melissa</li>
            <li class="list">Alice</li>
        </ul>
    </div>
    
</div>
  {{--  drag  --}}
  <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

<script type="text/javascript" src="http://www.pureexample.com/js/lib/jquery.ui.touch-punch.min.js">
  

    $(function () {
      $("#timetable .items").sortable({
        connectWith: "ul"   
      });
      
      $("ul[id^='available']").draggable({
          helper: "clone",
          connectToSortable: ".items"
      });
  });
</script>
  //摺疊
  <script>

  var coll = document.getElementsByClassName("collapsible");
  var i;

  for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function () {
          this.classList.toggle("active");
          var content = this.nextElementSibling;
          
          if (content.style.maxHeight) {
            console.log("if1:"+content.style.maxHeight);
              content.style.maxHeight = null;
              console.log("if2:"+content.style.maxHeight);

          } else {
              content.style.maxHeight = content.scrollHeight + "px";
              console.log("else:"+content.style.maxHeight+"---end");

          }
      });
  }
</script>


</body>
</html>