@extends('frontend.layouts.master')

@section('title', 'Home')
@section('content')
@section('nav_home', 'active');


  <section class="page-section clearfix">
    <div class="container">
      <div class="intro">
        
        {{-- <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="intro.jpg" alt=""> --}}

        <div class="intro-text left-0 text-center bg-faded p-5 rounded">
          <h2 class="section-heading mb-4">
            <span class="section-heading-upper">Fresh Coffee</span>
            <span class="section-heading-lower">Worth Drinking</span>
          </h2>
          <p class="mb-3">Every cup of our quality artisan coffee starts with locally sourced, hand picked ingredients. Once you try it, our coffee will be a blissful addition to your everyday morning routine - we guarantee it!
          </p>
          <div class="intro-button mx-auto">
              {!! $map['html'] !!}

            <a class="btn btn-primary btn-xl" href="#">Visit Us Today!</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="page-section cta">
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <div class="cta-inner text-center rounded">
            <h2 class="section-heading mb-4">
              <span class="section-heading-upper">我們的承諾</span>
              <span class="section-heading-lower">只為你</span>
            </h2>
            <p class="mb-0">當你進入我們的店內，我們將全心全力的為您服務，100分的產品。
              當你進入我們的店內，我們將全心全力的為您服務，100分的產品。當你進入我們的店內，我們將全心全力的為您服務，100分的產品
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection

  

  
