@extends('frontend.layouts.master')

@section('title', 'Home')
@section('content')
@section('nav_home', 'active');


  <section class="page-section clearfix">
    <div class="container">
      <div class="intro">
        {{-- <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="products-01.jpg" alt=""> --}}
        <div id="map" style="width: 800px; height: 500px;"></div>
          <div>
            <input id="address" type="textbox" value="Sydney, NSW">
            <input type="button" value="sure"" onclick="codeAddress()">
          </div>
        
         
        
      </div>
    </div>
  </section>

 

  @endsection

  

  
