<html>

<head>
    <title>LaravelAjax</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <script src={{asset("ajax/jquery-3.4.1.min")}}></script> --}}
    {{-- {{asset("ajax/jquery-3.4.1.min")}} --}}

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> --}}

</head>


<body>
    {!! csrf_field() !!}

    <div>&nbsp;</div>
    <form action="{{url('/deal/1')}}" method="post">
        @csrf
        <div class="container box"></div>
        <div class="form-group">

            <select name="country" id="country"
                class="form-control input-lg custom-select custom-select-lg mb-3 dynamic" data-dependent="tag" required>
                <option value="">請選擇城市</option>
                {{-- database country --}}
                @foreach ($country_list as $country)
                <option value="{{$country->city_name}}">{{$country->city_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">

            <select name="tag" id="tag" class="form-control input-lg custom-select custom-select-lg mb-3"
                data-dependent="tag2" required>
                {{-- Ajax --}}
                <option value="">請先選擇城市</option>
            </select>
        </div>

        <div class="form-group">

            <select name="tag2" id="tag2" class="form-control input-lg custom-select custom-select-lg mb-3" required>
                {{-- Ajax --}}
                <option value="">請先選擇城市</option>
            </select>
        </div>

        <div class="form-group">

            {{-- <select name="tag3[]" id="tag3" class="form-control input-lg" multiple="mutiple">
                <option value="none">請先選擇城市 測試傳送數值</option>
                <option value="1">1</option>
                <option value="33">33</option>
                <option value="5555">5555</option>
                <option value="12">12</option>
                <option value="24">24</option>
                <option value="48">48</option>
            </select> --}}
        </div>
        <div>

            <button class="btn btn-secondary btn-lg btn-block" type="submit">確認</button>
        </div>
    </form>
    {{-- <div class="form-group">
        <!-- 首先引入css, 和js, 唯一依赖: jQuery -->
        <link href="//raw.githack.com/hnzzmsf/layui-formSelects/master/dist/formSelects-v4.css" rel="stylesheet" />
        <script src="//unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
        <script src="//raw.githack.com/hnzzmsf/layui-formSelects/master/dist/formSelects-v4.min.js"></script>
        
        <select name="city2" id="city2" xm-select="search-local" xm-select-search>
            <option value=""></option>
            <option value="1">北京</option>
            <option value="2">上海</option>
            <option value="3">广州</option>
            <option value="4">深圳</option>
            <option value="5">天津</option>
        </select>
        
        <!-- 执行渲染, 把原始select美化~~ -->
        <script type="text/javascript">
            formSelects.render('search-local');
        </script>
    </div> --}}


    {{-- <div class="form-group">
        <!-- Build your select: -->
        <select id="example-getting-started" multiple="multiple">
            <option value="cheese">Cheese</option>
            <option value="tomatoes">Tomatoes</option>
            <option value="mozarella">Mozzarella</option>
            <option value="mushrooms">Mushrooms</option>
            <option value="pepperoni">Pepperoni</option>
            <option value="onions">Onions</option>
        </select>
    </div> --}}

    <!-- Initialize the plugin: -->
    {{-- <script type="text/javascript">
    
        $(document).ready(function() {
            $('#example-getting-started').multiselect();
        });
    </script> --}}




    <script type="text/javascript">
        $(document).ready(function(){
    
        $('.dynamic').change(function(){
            if($(this).val() != '')
            {
                var select = $(this).attr('id');   
                var value = $(this).val();
                var dependent = $(this).data('dependent');  
                var _token = $('input[name="_token"]').val();
                
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method:"POST",
                    url:'/ajax2/fetch',
                    dataType: "html",
                    data:{
                    select:select, value:value, dependent:dependent, '_token': $('meta[name="csrf-token"]').attr('content'), 
                    },
                    // 成功則填充到指定位置select box 
                    success: function(result){
                        $('#'+dependent).html(result);
                        $('#tag2').html(result);
                        
                        console.log("ajax 成功");
                        // console.log("結果為:");
                        // console.log(result);
                        // setTimeout(function(){
                        //     console.log(result);
                        // },10000);
                    },
                    error: function(result) {
                        console.log(result);
                        console.log("ajax 失敗：");
                    }
    
                });
            }
        })
    })
    </script>

</body>


<script>
    // $(function() {
	// 	$("#options_city").change(function() {
	// 		//alert($(this).children("option:selected").val());
	// 		var cityname = $(this).children("option:selected").val();

	// 		$.ajax({
    //             headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
	// 			type: "POST",
	// 			url: "/deal",
	// 			dataType: "html",
	// 			data: {
    //                 cityname: cityname,
    //                 '_token': $('meta[name="csrf-token"]').attr('content'),
                    
	// 			},
	// 			success: function(data) {
    //                 //alert(data);
    //                 console.log(data);
    //                 console.log("ajax success");
	// 				// $("#options_cat").html(data);
	// 			}
	// 		});
	// 	});
	// });
</script>

</html>