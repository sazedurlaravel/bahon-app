@extends('frontend/layouts/app')

@section("content")
<!--header start section-->
  <div class="main_header">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-sm-12 col-md-2 mt-2">
          <a href="{{route('frontend.home')}}">
            @if(!empty($information->logo))
                <img src="{{ Storage::url($information->logo) }}" class="img img-thumbnail mb-2" alt="logo"
                    style="width: 25px;">
            @else
              <img src="{{asset("assets/frontend")}}/images/logo-2.png" alt="logo">
            @endif
            <!-- <img src="{{asset('assets/frontend')}}/images/digital.png" alt="logo"></a> -->
        </div>
        <div class="col-lg-2 col-sm-12 col-md-2 mt-2">
           <!-- <img src="{{asset("assets/frontend")}}/images/logo-2.png" alt=""> -->

          @if(!empty($information->name))
              <a href="{{route('frontend.home')}}">{{$information->name}}</a>
          @else
            Digital Pourashava
          @endif
        </div>
        <div class="col-lg-3 col-sm-12 col-md-4 offset-lg-2 offset-md-2">
          <div class="row mt-2">
            <div class="col lg-4">
              <a href="#">Home</a>
            </div>
            <div class="col lg-4">
              <a href="#">Contact</a>
            </div>
            <div class="col lg-4">
              <a href="#">Login</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-12 col-md-4">
          <div class="row">
            <div class="col-lg-12">
              <i class="fa fa-envelope mr-2"></i>
              @if(!empty($information->service_email))
                    {{$information->service_email}}
              @else
                  admin@gmail.com
              @endif

            </div>
            <div class="col-lg-12">
              <i class="fa fa-phone mr-2"></i>
              @if(!empty($information->service_phone))
                    {{$information->service_phone}}
              @else
                  01701345698
              @endif
            </div>
          </div>
        </div>
    </div>
    </div>
  </div>
  <!--header end section-->

  <!--banner start section-->
  <div class="">
    <!-- <img src="{{asset('assets/frontend')}}/images/upsheba.jpg" alt="banner" class="img-fluid"> -->
    @if(!empty($information->banner))
    <img src="{{ Storage::url($information->banner) }}" class="mg-fluid" alt="banner"
        style="width: 100%;">

    @else
      <img src="{{asset('assets/frontend')}}/images/upsheba.jpg" alt="banner" class="img-fluid">
    @endif

  </div>

<!--banner end section-->

<!--পৌরসভা বাছাই section start-->
<div class="upservice">
    <h1 class="text-center pt-3">আপনার পৌরসভা বাছাই করুন</h1>
  <div class="row container text-center">
    <div class="col-sm-12 mb-3 col-md-6 col-lg-3">
      <div class="input-group">
        <select class="custom-select" id="inputGroupSelect04">
          <option selected>বিভাগ বাছাই করুন</option>
          <option value="1">বরিশাল</option>
          <option value="2">চট্টগ্রাম</option>
          <option value="5">রাজশাহী</option>
        </select>
      </div>
    </div>
    <div class="col-sm-12 mb-3 col-md-6 col-lg-3">
      <select class="custom-select" id="inputGroupSelect04">
        <option value="">জেলা বাছাই করুন</option>
        <option value="6" division-id="1">পিরোজপুর </option>
        <option value="9" division-id="2">চাঁদপুর</option>
        <option value="51" division-id="5">রাজশাহী </option>
      </select>

    </div>
    <div class="col-sm-12 mb-3 col-md-6 col-lg-3">
      <select class="custom-select" id="inputGroupSelect04">

        <option value="">পৌরসভা বাছাই করুন</option>

        <option value="36" district-id="9" office-id="1">চাঁদপুর পৌরসভা</option>
        <option value="249" district-id="6" office-id="3">মঠবাড়ীয়া পৌরসভা</option>
        <option value="253" district-id="51" office-id="2">বাঘা পৌরসভা</option>
      </select>
    </div>
    <div class="col-sm-12 mb-3 col-md-6 col-lg-3">
      <span class="btn btn-primary sub px-5">সাবমিট</span>
    </div>
  </div>
</div>
<!--পৌরসভা বাছাই section end-->

<!--সেবা start section-->
<div class="my-3 bg py-3">
  <div class=" row">
    <div class="col-md-4 col-sm-4 col-lg-4 text-center">
      <a href="" class="badge badge-primary font-weight-normal bn-font p-3">
       <i class="fa fa-certificate text-white"></i>সার্টিফিকেট যাচাই
   </a>

    </div>
    <div class="col-md-4 col-sm-4 col-lg-4 text-center">
      <a href="" class="badge badge-danger font-weight-normal text-white bn-font p-3">
      পৌরসভা ডিজিটাল করুন
  </a>
    </div>
    <div class="col-md-4 col-sm-4 col-lg-4 text-center">
      <a href="" class="badge badge-warning font-weight-normal text-white bn-font p-3">
       ইউনিয়ন ডিজিটাল করুন
     </a>
    </div>
  </div>
</div>
<!--সেবা end section-->

<!--আমাদের সেবাসমূহ start section-->
<div class="seba mt-3">
  <h2 class="text-center">আমাদের সেবাসমূহ</h2>
  <hr>
  <div class="row">
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box">
        <img src="{{asset('assets/frontend')}}/images/icon-1583320423.png">
        <div class="section-title">নাগরিক সনদের আবেদন
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1583321028.png">
        <div class="section-title">ওয়ারিশ সনদের আবেদন
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1583321143.png">
        <div class="section-title">ট্রেড লাইসেন্স সনদের আবেদন
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1583322336.png">
        <div class="section-title">চারিত্রিক সনদের আবেদন
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1583322631.png">
        <div class="section-title">ভূমিহীন সনদের আবেদন
          <hr/>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1583323065.png">
        <div class="section-title">একই নামের প্রত্যয়ন আবেদন
          <hr/>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1583322928.png">
        <div class="section-title">বার্ষিক/মাসিক আয়ের প্রত্যয়ন আবেদন
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1583323191.png">
        <div class="section-title">পারিবারিক সনদের আবেদন
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1583323324.png">
        <div class="section-title">অবিবাহিত সনদের আবেদন
          <hr/>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1583323468.png">
        <div class="section-title">পুনঃ বিবাহ না হওয়া সনদের আবেদন
          <hr/>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1583323560.png">
        <div class="section-title">অনুমতি পত্রের আবেদন
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1583323646.png">
        <div class="section-title">প্রতিবন্ধী সনদের আবেদন
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1606803158.png">
        <div class="section-title">প্রত্যয়নপত্র
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1606819163.png">
        <div class="section-title">নিঃসন্তান প্রত্যয়ন
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1607401311.png">
        <div class="section-title">জাতীয় পরিচয়পত্র সংশোধন প্রত্যয়ন
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1607942293.png">
        <div class="section-title">ব্যবসা/চাকুরী সংক্রান্ত প্রত্যয়ন
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1607945462.png">
        <div class="section-title">মৃত ব্যক্তির প্রত্যয়ন
          <hr>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-lg-3 text-center">
      <div class="service-box" id="1" data-url="citizens-certificate">
        <img src="{{asset('assets/frontend')}}/images/icon-1610859796.png">
        <div class="section-title">অবকাঠামো নির্মাণের অনুমতি পত্র
          <hr>
        </div>
      </div>
    </div>
  </div>
</div>
<!--আমাদের সেবাসমূহ end section-->


<!--footer start-->
<footer>
    <div class="footer">
      <div class="row">
        <div class="col-lg-6 col-md-6 offset-lg-3">
          <div class="row text-center">
            <div class="col-lg-3">
              <a href="#">প্রাইভেসী পলিসি</a>
            </div>
            <div class="col-lg-3">
              <a href="#"> রিফান্ড পলিসি </a>
            </div>
            <div class="col-lg-3">
              <a href="#">টার্মস এবং কনডিশন </a>
            </div>
            <div class="col-lg-3">
              <a href="#">আমাদের সম্পর্কে</a>
            </div>
          </div>
        </div>
      <div class="container mt-3 text-center">
        <div class="col-md-6 col-sm-12 col-lg-6   float-left">

          <a href="" target="_blank" class=" bn-font"><i class="fa fa-facebook-official mr-2 text-primary"></i>আমাদের হেল্পলাইন গ্রুপ</a>

        </div>

        <div class="col-md-6 col-sm-12 col-lg-6 float-right">
          Developed and design by: <a href="" target="_blank" class="font-weight-bold">azad<span class="text-orange">bd</span></a>
        </div>

      </div>
      </div>

    </div>
</footer>

<!--footer End-->

@endsection
