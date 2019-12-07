@extends('frontend.layouts.master')

@section('title', 'services')
@section('content')

        @include('frontend.layouts.distance_matrix_API')

<main role="main" class="probootstrap-main js-probootstrap-main">
    <div class="probootstrap-bar">
        <a href="#" class="probootstrap-toggle js-probootstrap-toggle"><span class="oi oi-menu"></span></a>
        <div class="probootstrap-main-site-logo"><a href="index.html">Aside</a></a></div>
    </div>

    


    
    <div id="right-panel">
      <div id="inputs">
        <pre>
{{-- var origin1 = {lat: 55.930, lng: -3.118};
var origin2 = 'Greenwich, England';
var destinationA = 'Stockholm, Sweden';
var destinationB = {lat: 50.087, lng: 14.421}; --}}

        </pre>
      </div>
      <div>
      {{-- <p>{{ $website->title }}</p> --}}
        <strong>Results</strong>
      </div>
      <div id="output"></div>
    </div>
    <div id="map"></div>
   


    
    
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