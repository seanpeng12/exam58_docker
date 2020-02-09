<div>
    <form name="form_name" id="form_name">
        <!--radio用法-->
        <label><input name="language" type="radio" value="繁中" checked>繁中</label>
        <label><input name="language" type="radio" value="韓文">韓文</label>
        <label><input name="language" type="radio" value="日文">日文</label>
        <br>
        <!--select用法-->

        <select name="country">
            <option value="台灣">台灣</option>
            <option value="韓國">韓國</option>
            <option value="日本">日本</option>
        </select>
        <button onclick="getCountry()">取得Radio和Select</button>
    </form>
</div>
<div id="screen">
</div>
    <input type="text" id="input">
    <button onclick="WriteOnScreen()">寫入內容到DIV中</button>
    <button onclick="WriteValue()">寫入內容到INPUT中</button>
    <button onclick="ShowOnScreen()">讀取DIV的內容</button>
    <button onclick="ShowValue()">讀取Input的內容</button>  

    <script>
        function getCountry(){
            //  讀取radio的值
            var form = document.getElementById("form_name");
            for(var i=0; i<form.language.length;i++){
                if(form.language[i].checked){
                    var language = form.language[i].value;
                    alert(language);
                }
            }
            //  讀取select的值
            var country = form.country.value;
            alert(country);
        }

    </script>