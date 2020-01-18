
    @extends('frontend_sna.layouts.master')

    {{-- @section('title', 'services') --}}





    @section('content')




    <section class="probootstrap-section probootstrap-bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-4 probootstrap-animate" data-animate-effect="fadeIn">

                    <form action="{{ url("/deal") }}" method="post">
        @csrf
        <div class="container box"></div>
        <div class="form-group">

            <select name="country" id="country"
                class="form-control input-lg custom-select custom-select-lg mb-3 dynamic" data-dependent="tag" required>
                <option value="">請選擇城市</option>
                {{-- database country --}}
                @foreach ($country_list as $country)
                <option value="{{$country->city_name}}">{{$country->city_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">

            <select name="tag" id="tag" class="form-control input-lg custom-select custom-select-lg mb-3"
                data-dependent="tag2" required>
                {{-- Ajax --}}
                <option value="">請先選擇城市</option>
            </select>
        </div>

        <div class="form-group">

            <select name="tag2" id="tag2" class="form-control input-lg custom-select custom-select-lg mb-3" required>
                {{-- Ajax --}}
                <option value="">請先選擇城市</option>
            </select>
        </div>

        <div class="form-group">

            {{-- <select name="tag3[]" id="tag3" class="form-control input-lg" multiple="mutiple">
                <option value="none">請先選擇城市 測試傳送數值</option>
                <option value="1">1</option>
                <option value="33">33</option>
                <option value="5555">5555</option>
                <option value="12">12</option>
                <option value="24">24</option>
                <option value="48">48</option>
            </select> --}}
        </div>
        <div>

            <button class="btn btn-primary btn-lg btn-block" type="submit">確認</button>
        </div>
    </form>

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
                    url:'/ajax2/fetch',
                    dataType: "html",
                    data:{
                    select:select, value:value, dependent:dependent, '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    // 成功則填充到指定位置select box
                    success: function(result){
                        $('#'+dependent).html(result);
                        $('#tag2').html(result);

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

    