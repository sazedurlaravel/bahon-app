<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ডিজিটাল ইউনিয়ন</title>  
    <!-- fontawesome   -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
</head>
<body>
    
<div class="container">

    <!-- header Area-->
    <header>
         <div class="row" style="padding-bottom: 10px;">
             <div class="col-sm-1 logo">
                <img src="https://iconape.com/wp-content/files/wf/258445/svg/258445.svg" alt="" width="40" height="40">
                
            </div>
            <div class="col-sm-8 text-left logo_title" >
                <h2>গনপ্রজাতন্ত্রী বাংলাদেশ সরকার,স্থানীয় সরকার বিভাগ </h2>
            </div>
            <div class="col-sm-2 right_title text-right">
               <h2>ডিজিটাল ইউনিয়ন </h2>
            </div> 
    </div>
    </header>
   
    <!-- /header Area End-->


    <!-- Banner section start -->
    <div class="row">
        <div class="col">
             <!-- <img src="https://digitalunionbd.com/images/pic.jpg" alt="" width="100%" height="310"> -->
             <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-ride="carousel" >
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="https://digitalunionbd.com/images/pic.jpg" alt="First slide" height="300">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="https://digitalunionbd.com/images/pic2.jpg" alt="Second slide" height="300">
                  </div>
                 
                </div>
              </div>
        </div>
           
        
    </div><!--/row-->

    <!-- Content section End -->
    <div class="row">
        <div class="col-md-8">
            <div class="content_text">
                 <p>ডিজিটাল ইউনিয়ন একটি অনলাইন ভিত্তিক সেন্ট্রাল এবং পূর্ণাঙ্গ ইউনিয়ন ব্যবস্থাপনা সফটওয়্যার । ডিজিটাল ইউনিয়ন সফটওয়্যারটি শুধুমাত্র ইউনিয়ন পরিষদের সকল ধরণের কার্যক্রমের উপর ভিত্তি করে তৈরি করা হয়েছে । এই সফটওয়্যারটিতে ইউনিয়নের জন্য পৃথক প্যানেল এবং মনিটরিং করার জন্য রয়েছে পৃথক প্যানেল, যার মাধ্যমে জেলা প্রশাসন, উপজেলা প্রশাসন তাদের আওতাধীন সকল ইউনিয়নের কার্যক্রম মনিটরিং করতে পারবে।</p>
          
           
           
            <h2>কিছু বৈশিষ্ট্য সমূহ :</h2>
            <ul>
                <li>ইউনিয়ন ও মনিটরিং ইউজারদের জন্য রয়েছে আলাদা প্যানেল ।</li>
                <li>ইউনিয়ন ও মনিটরিং ইউজারদের জন্য রয়েছে আলাদা প্যানেল ।</li>
                <li>ইউনিয়ন ও মনিটরিং ইউজারদের জন্য রয়েছে আলাদা প্যানেল ।</li>
                <li>ইউনিয়ন ও মনিটরিং ইউজারদের জন্য রয়েছে আলাদা প্যানেল ।</li>
                <li>ইউনিয়ন ও মনিটরিং ইউজারদের জন্য রয়েছে আলাদা প্যানেল ।</li>
                <li>ইউনিয়ন ও মনিটরিং ইউজারদের জন্য রয়েছে আলাদা প্যানেল ।</li>
            </ul>

        </div>
    </div><!--/col-->

        <div class="col-md-4">
            <div class="button_right">
                <h2>ডিজিটাল ইউনিউন লগইন</h2>
                <a href="{{route('pourashava_frontend.user.login',$pourashava_slug)}}"><img src="{{asset('images/btn1.png')}}" alt="" width="100%"></a>
               <a href="{{route('admin.login')}}"><img src="{{asset('images/btn2.png')}}" alt="" width="100%"></a>
			
               
            </div>
        </div><!--/col-->

    </div><!--/row-->

    <!-- Footer Area Start -->
    <footer>
        <div class="footer text-center">
            <h2>Software Developed By: Astha Solution, Helpline: +88 01771-62 21 42</h2>
        </div>
        
    </footer>


</div>



<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>