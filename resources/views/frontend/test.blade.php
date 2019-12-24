<!DOCTYPE html>
<html>
 <head>
     <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Ajax Dynamic Dependent Dropdown in Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Ajax Dynamic Dependent Dropdown in Laravel</h3><br />
  
  
   <div class="form-group">
    <select name="country" id="country" class="form-control input-lg dynamic" data-dependent="state">
     <option value="">Select Country</option>
     @foreach($country_list as $country)
     <option value="{{ $country->city_name}}">{{ $country->city_name }}</option>
     @endforeach
    </select>
   </div>


   <br />
   <div class="form-group">
    <select name="tag" id="tag" class="form-control input-lg dynamic" data-dependent="city">
     <option value="">Select State</option>
    </select>
   </div>


   <br />
   <div class="form-group">
    <select name="city" id="city" class="form-control input-lg">
     <option value="">Select City</option>
    </select>
   </div>


   {{ csrf_field() }}
   <br />
   <br />
  </div>
 </body>
</html>

{{-- <script>
$(document).ready(function(){

 $('.dynamic').change(function(){
  if($(this).val() != '')
  {
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ route('dynamicdependent.fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
    }

   })
  }
 });

 $('#country').change(function(){
  $('#state').val('');
  $('#city').val('');
 });

 $('#state').change(function(){
  $('#city').val('');
 });
 

});
</script> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js%22></script>

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

