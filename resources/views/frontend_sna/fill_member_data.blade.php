
@extends('frontend_sna.layouts.master')

{{-- @section('title', 'services') --}}
@section('content')
<section class="probootstrap-section probootstrap-bg-blue">
      <div class="container">
        <div class="row">
          <div class="col-md-5 probootstrap-animate" data-animate-effect="fadeIn">
            <h2>請填寫您的會員資料</h2>
          <form name="memberData" id="memberData">
              
              <div class="form-group">
                <label for="birthday">您的生日</label>
                <input type="date" class="form-control" id="birthday" name="birthday">
              </div>
              <div class="form-group">
                <label class="primary active">您的生理性別</label>
                <br>
                <input type="radio" name="sex" id="w" value="women" checked>
                    <span style="color:black;">女性</span>
                <input type="radio" name="sex" id="m" value="men" checked>
                    <span style="color:black;">男性</span>               
              </div>
              
              <div class="form-group">

                {{-- <input type="submit" class="btn btn-primary btn-lg" id="submit" name="submit" value="Submit Form"> --}}
              </div>

            </form>
                                          <button onclick="storeData()"> 送出表單</button>

          </div>
          <div class="col-md-6 col-md-push-1 probootstrap-animate" data-animate-effect="fadeIn">
            <h2>Get in touch</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
            
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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>
      
                // Step1新增第三方登入資料在firestore
            // window.onload = function(){
                  storeData = function (){

                    var check=0;
                    if(check==0){
                  var db = firebase.firestore();
                  var user = firebase.auth().currentUser;
                    var name, email, uid;
                    name = user.displayName;
                    email = user.email;
                    uid = user.uid;
            
                  // 取得memberData表單資料
                  //  讀取radio的值
                  // revealData = function (){
                  var form = document.getElementById("memberData");
                  var birthday = form.birthday.value;
                  // alert(birthday);
                  var sex, i;
                  for(i=0; i<form.sex.length;i++){
                      if(form.sex[i].checked){
                          sex = form.sex[i].value;                        
                      }
                  }
                      // 寫入資料庫
                      
                      
                      db.collection("sightseeingMember").doc(email).set({
                          name: name,
                          uid: uid,
                          email: email,
                          birthday: birthday,
                          sex: sex
                      });

                      check=1;
                      console.log(check);
                  }    

                    if(check==1){
                      firebase.auth().signOut().then(function() {
                              alert("註冊完成，請在重新登入");
                              window.location='/';    
                        });
                      
                    }  
                }
       

        
    </script>


    @endsection