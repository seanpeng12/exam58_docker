@extends('frontend.layouts.master')

@section('title', 'services')
@section('content')


<main role="main" class="probootstrap-main js-probootstrap-main">
    <div class="probootstrap-bar">
        <a href="#" class="probootstrap-toggle js-probootstrap-toggle"><span class="oi oi-menu"></span></a>
        <div class="probootstrap-main-site-logo"><a href="index.html">Aside</a></a></div>
    </div>

    
    {{-- test --}}
    {{-- googlemap(search) --}}
       <div id="map" style="width: 800px; height: 500px;"></div>
          <div>
            <input id="address" type="textbox" value="台北, 台灣">
            <input type="button" value="sure"" onclick="codeAddress()">
      </div>

   
        @include('frontend.layouts.googlemap')


    
    
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-12">
               {{-- 放distance matrix api --}}
               
 
   

            </div>
        </div>
        <!-- END row -->

        
        <!-- END section -->

    </div>

    <div class="container-fluid d-md-none">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-unstyled d-flex probootstrap-aside-social">
                    <li><a href="#" class="p-2"><span class="icon-twitter"></span></a></li>
                    <li><a href="#" class="p-2"><span class="icon-instagram"></span></a></li>
                    <li><a href="#" class="p-2"><span class="icon-dribbble"></span></a></li>
                </ul>
                <p>&copy; 2017 <a href="https://uicookies.com/" target="_blank">uiCookies:Aside</a>. <br> All Rights
                    Reserved. Designed by <a href="https://uicookies.com/" target="_blank">uicookies.com</a></p>
            </div>
        </div>
    </div>

</main>



@endsection