<html>
<head>
    <title>LaravelAjax</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <script src={{asset("ajax/jquery-3.4.1.min")}}></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  --}}
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    
</head>


<body>
    {!! csrf_field() !!}
    {{-- @php
    //connection
    try {
        $dbh = new PDO(
            'mysql:host=140.136.155.116;dbname=homestead',
            'root',
            'sightseeing'
        );
        $dbh->exec("set names utf8");
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    } catch (PDOException $exception) {
    die("Something wrong: {$exception->getMessage()}");

    }
        // $conn = mysqli_connect(
        //     '140.136.155.116',
        //     'root',
        //     'sightseeing'
        // );
        // if (!$conn) {
        //     echo "資料庫連接失敗";
        // } else {
        //     echo "連接成功";
        // }
        // mysqli_query($conn, 'SET NAMES utf8;');
        // mysqli_select_db($conn, 'homestead');

    $result = $dbh->prepare("SELECT DISTINCT city_name FROM site_data;"); 
    $result->execute();
    $lst = $result->fetchAll(); //lst放入已查詢串列

    @endphp --}}


    {{-- {{asset("ajax/jquery-3.4.1.min")}} --}}
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

{{-- {{ route('storeProduct') }} --}}

    


    {{-- <select id="options_cat">
        <option value="none">請選擇</option>   
    </select> --}}


    <div class="container box"></div>
    <div class="form-group">
        
        <select name="country" id="country"  class="form-control input-lg dynamic" data-dependent="name">
            <option value="none">請選擇country</option>

            @foreach ($country_list as $country)
                <option value="{{$country->city_name}}">{{$country->city_name}}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        
        <select name="name" id="name" multiple="multiple class="form-control input-lg dynamic" data-dependent="tag2">
            <option value="none">請選擇tag</option>
        </select>
    </div>

    <div class="form-group">
        
        <select name="tag2" id="tag2" class="form-control input-lg">
            <option value="none">請選擇city</option>
        </select>
    </div>
    
    @php
        $dbh = null;
    @endphp
 
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    
    

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


</html>


