@extends('frontend_sna.layouts.master');
@section('content')
<section class="probootstrap-section">
    <div class="container">
        <div class="row">
            

            <div class="col-md-4 col-sm-6 col-xs-6 probootstrap-animate">
                <a href={{ route('create_itinerary')}} class="probootstrap-team">
                    <img src="images/DSC07401-2.jpg" alt="" class="img-responsive img-rounded">
                    <div class="card bg-secondary text-white" align="center">
                        <span class="font-size:100px">
                            <span style="font-family:NSimSun; font-size:20"><br>我的花蓮之旅</span>
                        </span>
                    </div>
                    <div class="probootstrap-team-info">
                        <h3>我的花蓮之旅</h3>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-6 probootstrap-animate">
                <a href="#" class="probootstrap-team">
                    <img src="images/IMG_3803.jpg" alt="" class="img-responsive img-rounded">
                    <div class="card bg-secondary text-white" align="center">
                        <span class="font-size:100px">
                            <span style="font-family:NSimSun; font-size:20"><br>我的花蓮之旅</span>
                        </span>
                    </div>
                    <div class="probootstrap-team-info">
                        <h3>我的花蓮之旅</h3>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-6 probootstrap-animate">
                <a href="#" class="probootstrap-team">
                    <img src="images/IMG_4533.jpg" alt="" class="img-responsive img-rounded">
                    <div class="card bg-secondary text-white" align="center">
                        <span class="font-size:100px">
                            {{-- <h3>我的花蓮之旅</h3> --}}
                            <span style="font-family:NSimSun; font-size:20"><br>我的花蓮之旅</span>
                        </span>
                    </div>
                    <div class="probootstrap-team-info">
                        <span style="font-family:NSimSun; font-size:20"><br>我的花蓮之旅</span>
                        
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>
@endsection
