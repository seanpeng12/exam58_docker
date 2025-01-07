
    @extends('frontend_sna.layouts.master')

    {{-- @section('title', 'services') --}}





    @section('content')

    


    <section class="probootstrap-section probootstrap-bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-4 probootstrap-animate" data-animate-effect="fadeIn">

                    <form action="{{ url("/testform") }}" method="post" class="probootstrap-form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <select name="country" id="country" class="form-control input-lg dynamic"
                                data-dependent="name" style="height: 60px">
                                <option value="none">請選擇縣市</option>
                                @foreach ($country_list as $country)
                                <option value="{{$country->city_name}}">{{$country->city_name}}</option>
                                @endforeach
                            </select>

                        </div>
                        {{-- 還沒完成 --}}

                        {{-- <script>
                            $(document).ready(function() {
                            $('.mdb-select').materialSelect();
                            });
                        </script> --}}


                        <div class="form-group">
                            {{-- <select class="selectpicker" data-live-search="true" multiple=""> --}}
                            <select name="name[]" id="name" class=" form-control input-lg dropdown-primary md-form "
                                data-dependent="tag2" style="height: 200px" data-live-search="true" multiple="multiple">
                                <option value="none">請選擇景點</option>
                            </select>

                            {{-- <select name="name" id="name" class="form-control input-lg selectpicker"
                                data-dependent="tag2" data-live-search="true" multiple="" style="height: 200px">

                                <option value=" none">請選擇景點</option>
                                <option value="松菸">松山文創園區</option>
                                <option value="八">八個人特區</option>

                            </select> --}}


                        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
                    url:'/schedule/fetch',
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



                        <div class="form-group">


                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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

   