{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body> --}}




@section('d')
@if (isset($A))
{{-- {{$A}}<br /> --}}
@endif

@if (isset($B))
{{-- {!! $B."<br />" !!} --}}
@endif

@if (isset($C))
{{-- {!! $C."<br />" !!} --}}
@endif

@if (isset($D))
{{-- @dump($C) --}}
@foreach ($D as $e)
{{-- {!! $e."<br />" !!} --}}
@endforeach
@endif




@php
//台北
$N = $A;

//"台北"
$n = '"'.$N.'"';

// 以外部指令的方式呼叫 R 進行繪圖->between.html
exec("Rscript R/site_Betweeness.R $n", $results);
print_r($results);
// // 產生亂數
$nocache = rand();

@endphp

@php

//台北
$city = $A;
$N2 = $B;
$N3 = $C;
//"台北"
$temp = "$city $N2 $N3";
$cc = '"'.$temp.'"';

// 以外部指令的方式呼叫 R 進行繪圖->between2.html
exec("Rscript R/new_Betweeness_2.R $cc");

$nocache_2 = rand();

@endphp
@endsection

{{-- 執行R語言讀取資料庫 (功能一\二)--}}
{{-- @yield('Rtest')
    @yield('R_between') --}}

@yield('d')
{{-- ajax後台 --}}
{{-- @yield('ajax_back') --}}

@php
//$name = public_path("between.html");
if(isset($nocache)){
// 功能一
$name = "R/between.html?$nocache";
}
if(isset($nocache_2)){
// 功能二
$name2 = "R/between2.html?$nocache_2";
}

@endphp



<div>
    <p>
        <h1>{{$A}}的景點關聯圖</h1>
    </p>
</div>
{{-- 讀取產生的網頁 --}}
<div>
    <iframe width="100%" height="600px" frameBorder="0" scrolling="no" src="{{url($name)}}"></iframe>
</div>

<div>
    <p>
        <h1>{{$A}}-{{$B}}&{{$C}}類別 景點關聯圖</h1>
    </p>
</div>
<div>
    <iframe width="100%" height="600px" frameBorder="0" scrolling="no" src="{{url($name2)}}"></iframe>
</div>

{{-- 

</body>

</html> --}}