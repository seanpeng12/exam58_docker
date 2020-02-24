<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,700">
    <link rel="stylesheet" href="css/ano/styles-merged.css">
    <link rel="stylesheet" href="css/ano/style.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <link href="//raw.githack.com/hnzzmsf/layui-formSelects/master/dist/formSelects-v4.css" rel="stylesheet" />
<script src="https://www.gstatic.com/firebasejs/6.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-firestore.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.2/chosen.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.2/chosen.jquery.min.js"></script>

  <!-- Chosen v1.8.2 -->
  @extends('frontend_sna.layouts.navbar')

  <!-- Chosen v1.8.2 -->
  <section class="probootstrap-section probootstrap-bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-4 probootstrap-animate" data-animate-effect="fadeIn">
                        <div class="form-group">

  <select class="example" multiple style="width: 300px">
  	<option>Tom</option>
  	  	<option>a</option>
  	<option>b</option>

  </select>
                        </div>
                </div>
                <div class="col-md-6 col-md-push-0 probootstrap-animate" data-animate-effect="fadeIn">
                </div>
            </div>
        </div>
    </section>


  

  {{-- <script type="text/javascript">
      var $j = jQuery.noConflict(); //自定義一個比較短快捷方式
      $j(function(){ //使用jQuery
      $j("p").click(function(){
      alert( $j(this).text() );
      });
      });
      $("pp").style.display = 'none'; //使用prototype
</script> --}}

<script type="text/javascript">
// var $jQ = jQuery.noConflict();

    
      $( ".example" ).chosen();
  
  </script>
  
  <script src="js/ano/scripts.min.js"></script>
  <script src="js/ano/custom.min.js"></script>
</body>
</html>