
    @extends('frontend_sna.layouts.master')

    {{-- @section('title', 'services') --}}





    @section('content')

    


    <section class="probootstrap-section probootstrap-bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-4 probootstrap-animate" data-animate-effect="fadeIn">

                        <div class="form-group">
@foreach ($arr as $arrs)
{{$arrs}}
@endforeach

                        </div>
                     
                </div>
                <div class="col-md-6 col-md-push-1 probootstrap-animate" data-animate-effect="fadeIn">
                    <h2>Get in touch</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos
                        quibusdam soluta at.</p>

                    <h4>USA</h4>
                    <ul class="probootstrap-contact-info">
                        <li><i class="icon-pin"></i> <span>198 West 21th Street, Suite 721 New York NY 10016</span></li>
                        <li><i class="icon-email"></i><span>info@domain.com</span></li>
                        <li><i class="icon-phone"></i><span>+123 456 7890</span></li>
                    </ul>

                    <h4>Europe</h4>
                    <ul class="probootstrap-contact-info">
                        <li><i class="icon-pin"></i> <span>198 West 21th Street, Suite 721 New York NY 10016</span></li>
                        <li><i class="icon-email"></i><span>info@domain.com</span></li>
                        <li><i class="icon-phone"></i><span>+123 456 7890</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

   