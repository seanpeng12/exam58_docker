@extends('frontend_sna.layouts.master');

@section('content');
<style>
    * {
        box-sizing: border-box;
    }

    /* Create four equal columns that floats next to each other */
    .column {
        margin-top: 50px;
        float: left;
        width: 25%;
        padding-left: 20px;
        padding-top: 0px;
        height: 100%;
        /* Should be removed. Only for demonstration */
    }

    .column1 {
        margin-top: 50px;
        float: left;
        width: 75%;
        padding: ;
        height: 100%;
        /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;


    }

    /* Style tab links */
    .tablink {
        background-color: #555;
        color: white;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        font-size: 17px;
        width: 25%;
    }

    .tablink:hover {
        background-color: #777;
    }

    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
        color: white;
        display: none;
        padding: 100px;
        height: 100%;
    }

    #Home {
        background-color: #ffcccc;
    }

    #News {
        background-color: #a2d0d0;
    }

    #Contact {
        background-color: #ccccff;
    }

    #About {
        background-color: #ffe0c1;
    }

        {
            {
            -- drag and sort --
        }
    }

    ul {
        margin: 0;
        padding: 0;
    }

    .a {
        margin: 5px 0;
        padding: 0 20px;
        height: 40px;
        line-height: 40px;
        border-radius: 3px;
        background: #136a8a;
        background: -webkit-linear-gradient(to right, #267871, #136a8a);
        background: linear-gradient(to right, #267871, #136a8a);
        color: #fff;
        list-style: none;
    }

    li.drag-sort-active {
        background: transparent;
        color: transparent;
        border: 1px solid #4ca1af;
    }

    span.drag-sort-active {
        background: transparent;
        color: transparent;
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
        background-color: #f1f1f1;
    }

</style>
<section class="probootstrap-section probootstrap-bg-gray">

    <div class="row">
        <div class="column" style="background-color:#ffffff;">
            <center>
                <h3>我的旅程</h3>
                <hr>
                <ul class="drag-sort-enable ">
                    <li class="a collapsible">Application</li>
                        <div class="content">你好</div>
                    <li class="a collapsible">Blank</li>
                        <div class="content">hola</div>
                    <li class="a collapsible">Class</li>
                    <li class="a collapsible">Data</li>
                    <li class="a collapsible">Element</li>
                </ul>
            </center>
        </div>
        <div class="column1" style="background-color:#bbb;">
            <button class="tablink" onclick="openPage('Home', this, 'red')">Home</button>
            <button class="tablink" onclick="openPage('News', this, 'green')" id="defaultOpen">News</button>
            <button class="tablink" onclick="openPage('Contact', this, 'blue')">Contact</button>
            <button class="tablink" onclick="openPage('About', this, 'orange')">About</button>

            <div id="Home" class="tabcontent">
                <h3>Home</h3>
                <p>Home is where the heart is..</p>
            </div>

            <div id="News" class="tabcontent">
                @yield('hola')
                <p>Some news this fine day!</p>
            </div>

            <div id="Contact" class="tabcontent">
                <h3>Contact</h3>
                <p>Get in touch, or swing by for a cup of coffee.</p>
            </div>

            <div id="About" class="tabcontent">
                <h3>About</h3>
                <p>Who we are and what we do.</p>
            </div>

            <script>
                function openPage(pageName, elmnt, color) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablink");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].style.backgroundColor = "";
                    }
                    document.getElementById(pageName).style.display = "block";
                    elmnt.style.backgroundColor = color;
                }

                // Get the element with id="defaultOpen" and click on it
                document.getElementById("defaultOpen").click();

                //drag and sort


                function enableDragSort(listClass) {
                    const sortableLists = document.getElementsByClassName(listClass);
                    Array.prototype.map.call(sortableLists, (list) => {
                        enableDragList(list)
                    });
                }

                function enableDragList(list) {
                    Array.prototype.map.call(list.children, (item) => {
                        enableDragItem(item)
                    });
                }

                function enableDragItem(item) {
                    item.setAttribute('draggable', true)
                    item.ondrag = handleDrag;
                    item.ondragend = handleDrop;
                }

                function handleDrag(item) {
                    const selectedItem = item.target,
                        list = selectedItem.parentNode,
                        x = event.clientX,
                        y = event.clientY;

                    selectedItem.classList.add('drag-sort-active');
                    let swapItem = document.elementFromPoint(x, y) === null ? selectedItem : document.elementFromPoint(
                        x, y);

                    if (list === swapItem.parentNode) {
                        swapItem = swapItem !== selectedItem.nextSibling ? swapItem : swapItem.nextSibling;
                        list.insertBefore(selectedItem, swapItem);
                    }
                }

                function handleDrop(item) {
                    item.target.classList.remove('drag-sort-active');
                }

                (() => {
                    enableDragSort('drag-sort-enable')
                })();


                //摺疊

                var coll = document.getElementsByClassName("collapsible");
                var i;

                for (i = 0; i < coll.length; i++) {
                    coll[i].addEventListener("click", function () {
                        this.classList.toggle("active");
                        var content = this.nextElementSibling;
                        if (content.style.maxHeight) {
                            content.style.maxHeight = null;
                        } else {
                            content.style.maxHeight = content.scrollHeight + "px";
                        }
                    });
                }

            </script>
        </div>

    </div>

</section>



@endsection
