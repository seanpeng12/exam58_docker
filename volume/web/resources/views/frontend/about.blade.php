@extends('frontend.layouts.master')
@section('title', 'about')
@section('content')



   <main role="main" class="probootstrap-main js-probootstrap-main">
      <div class="probootstrap-bar">
        <a href="#" class="probootstrap-toggle js-probootstrap-toggle"><span class="oi oi-menu"></span></a>
        <div class="probootstrap-main-site-logo"><a href="index.html">Aside</a></a></div>
      </div>
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-xl-8 col-lg-12">
            <p class="mb-5"><img src="images/IMG_3593.jpg" alt="Free Bootstrap 4 Template by uicookies.com" class="img-fluid"></p>

            <div class="row">
              <div class="col-xl-8 col-lg-12 mx-auto">
                <h1 class="mb-3">
                  {{-- 接資料庫的值 --}}
                {{-- @foreach ($datas as $data)
                  {{ $data->type}}<br>
                    
                @endforeach</h1> --}}
                
              </div>
            </div>
            
          </div>
        </div>
        <!-- END row -->

       

      </div>

      

    </main>

    

    
    @include('frontend.layouts.Place_Autocomplete_and_Directions')
  </body>
</html>