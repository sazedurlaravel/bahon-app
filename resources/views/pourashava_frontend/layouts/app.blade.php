
<!doctype html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<meta name="viewport"
		content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ডিজিটাল পৌরসভা</title>

	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="description" content="UP Automation LTD">
	<meta name="keywords" content="UP Automation LTD">

	<meta http-equiv="refresh" content="1000">
	<meta name="author" content="UP Automation LTD">

	<meta property="og:site_name" content="">
	<meta property="og:title" content="UP Automation LTD">
	<meta property="og:description" content="UP Automation LTD">
	<meta property="og:url" content="">
	<meta property="og:type" content="article">
	<meta property="og:locale" content="en_US">

    <link rel="icon" href="{{ asset("assets/paurashava_frontend")}}/imgAll/favicon.png" type="png" sizes="32x32">
    <link rel="canonical" href="">
    <link type="image/x-icon" rel="shortcut icon" href="{{ asset("assets/paurashava_frontend")}}/common/favicon.ico">
    <link rel="stylesheet" href="{{ asset("assets/paurashava_frontend")}}/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset("assets/paurashava_frontend")}}/font-awesome-4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset("assets/paurashava_frontend")}}/css/styles.css">
    <link rel="stylesheet" href="{{ asset("assets/paurashava_frontend")}}/css/pourosovaurl.css">
    <script type="text/javascript" src="{{ asset("assets/paurashava_frontend")}}/slider/js/jssor.slider-23.1.6.min.js"></script>
    <script type="text/javascript" src="{{ asset("assets/paurashava_frontend")}}/slider/js/js.js"></script>
    <link rel="stylesheet" href="{{ asset("assets/paurashava_frontend")}}/slider/css/style.css">
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">


    @yield('style')

</head>

<body>

<header>

		<div class="UHeaderTop">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="UHelpLine">
							<p></p>
						</div>
					</div>
					<div class="col-sm-4">
					</div>
					<div class="col-sm-4 USocialLink text-left">
{{-- 
						<a href="{{$information->facebook_url}}"><i class="fa fa-facebook-square fa-2x"
							 aria-hidden="true"></i></a>
						<a href="{{$information->facebook_url}}"><i class="fa fa-youtube-square fa-2x" aria-hidden="true"></i></a> --}}
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="DHeaderBanner"
				style="background-image:url({{asset('assets/paurashava_frontend/images/common/header-bgR.jpg')}});background-repeat:no-repeat;width:100%;padding:10px 10px 10px 60px;margin-left:0px;">
				<div class="row">
					<div class="col-sm-12">
						<a href="javascript:void(0)">
							<!-- <ul class="SFooterLink-xs">
								<li><div class="logo">
									<img class="img-responsive lgd-logo lgd-head-logo" src="assets/paurashava_frontend/images/common/logo-en.png"
										align="left" alt="Tarabo Paurashava Logo" title="Tarabo Paurashava Logo">
									<img class="img-responsive lgd-logo-bn lgd-head-logo"
										src="assets/paurashava_frontend/images/common/logo-bn.png" align="left" alt="Tarabo Paurashava Logo"
										title="Tarabo Paurashava Logo">
								</div></li>
								<div class="logo">
									<img class="img-responsive lgd-logo lgd-head-logo" src="assets/paurashava_frontend/images/common/logo-en.png"
										align="left" alt="Tarabo Paurashava Logo" title="Tarabo Paurashava Logo">
									<img class="img-responsive lgd-logo-bn lgd-head-logo"
										src="assets/paurashava_frontend/images/common/logo-bn.png" align="left" alt="Tarabo Paurashava Logo"
										title="Tarabo Paurashava Logo">
								</div>
							</ul> -->
							<div class="logo">
								<!-- <img class="img-responsive lgd-logo lgd-head-logo" src="assets/paurashava_frontend/images/common/rounded.png"
									align="left" alt="Tarabo Paurashava Logo" title="Tarabo Paurashava Logo" style="float: left;
									width: 50%;"> -->
									<img class="img-responsive lgd-logo lgd-head-logo" src="{{asset('assets/paurashava_frontend/images/common/logo-en.png')}}"
									align="left" alt="Tarabo Paurashava Logo" title="Tarabo Paurashava Logo" style="float: left;
									width: 50%;">
								<!-- <img class="img-responsive lgd-logo-bn lgd-head-logo"
									src="assets/paurashava_frontend/images/common/rounded.png" align="left" alt="Tarabo Paurashava Logo"
									title="Tarabo Paurashava Logo" style="float: left;
									width: 50%;"> -->
									<img class="img-responsive lgd-logo-bn lgd-head-logo"
									src="{{asset('assets/paurashava_frontend/images/common/logo-bn.png')}}" align="left" alt="Tarabo Paurashava Logo"
									title="Tarabo Paurashava Logo" style="float: left;
									width: 50%;">
							</div>

						</a>
					</div>
				</div>
			</div>

			<div class="UHeaderNav">
				<div class="row">
					<div class="col-sm-12">
						<nav class="navbar navbar-default">
							<div class="container-fluid">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
										data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>

								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
									<ul class="nav navbar-nav">
										<li><a href="javascript:void(0)"><i class="fa fa-home"
													aria-hidden="true"></i></a></li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
												aria-haspopup="true" aria-expanded="false">পৌরসভা তথ্য<span
													class="caret"></span></a>
											<ul class="dropdown-menu dropdown-menus">
												<li><a href="javascript:void(0)">পৌরসভার সংক্ষিপ্ত বিবরন</a></li>
												<li><a href="javascript:void(0)">পৌরসভার সাংগঠনিক কাঠামো</a></li>
												<li><a href="javascript:void(0)">পৌরসভার মানচিত্র</a></li>
												<li><a href="javascript:void(0)">সম্মানিত মেয়রদের তালিকা</a></li>
												<li><a href="javascript:void(0)">পৌরসভার কর্মকর্তা ও কর্মচারী</a></li>
												<li><a href="javascript:void(0)">শিক্ষা বিষয়ক তথ্য</a></li>
											</ul>
										</li>
										<li><a href="javascript:void(0)">সিটিজেন চার্টার</a></li>
										<li><a href="javascript:void(0)">যোগাযোগ</a></li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
												aria-haspopup="true" aria-expanded="false">জরুরী যোগাযোগ<span
													class="caret"></span></a>
											<ul class="dropdown-menu dropdown-menus">
												<li><a href="javascript:void(0)">মেয়রের প্রোফাইল এবং সংযোগ</a></li>
												<li><a href="javascript:void(0)">কাউন্সিলরদের প্রোফাইল এবং সংযোগ</a>
												</li>
												<li><a href="javascript:void(0)">প্রধান নির্বাহী কর্মকর্তার প্রোফাইল এবং
														সংযোগ</a></li>
												<li><a href="javascript:void(0)">তথ্য পরিষেবা কেন্দ্র</a></li>
												<li><a href="javascript:void(0)">প্রশাসন বিভাগ</a></li>
												<li><a href="javascript:void(0)">প্রকৌশল বিভাগ</a></li>
												<li><a href="javascript:void(0)">স্বাস্থ্য বিভাগ</a></li>
											</ul>
										</li>
										<li><a href="javascript:void(0)">এক নজরে</a></li>
										<li><a href="javascript:void(0)">নোটিশ</a></li>
										<li><a href="javascript:void(0)">ডাউনলোড</a></li>
										<li><a href="{{route('pourashava_frontend.user.login', $pourashava_slug)}}">লগইন</a></li>
									</ul>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</div>

		</div>
	</header>

	@yield('content')

	<footer>
		{{-- <section>
			<div class="container">
				<div class="row UFTop">
					<div class="col-sm-12"><img src="{{asset('assets/paurashava_frontend/images/common/Footer_Image.png')}}" title="" alt=""
							class="img-responsive img100"></div>
				</div>
			</div>
		</section> --}}
		<section class="hidden-xs">
			<div class="container">
				<div class="row UFBottom SFooterBG">
					<div class="col-6 col-sm-4">
						<ul class="SFooterLink">
							<li><a href="#" title="Site Map">সাইটম্যাপ</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">যোগাযোগ</a></li>
						</ul>
					</div>
					<div class="col-6 col-sm-4">
						<ul class="SFooterLink">
							<li><a href="#" title="Site Map">পৌরসভা তথ্য</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">সিটিজেন চার্টার</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">মেয়রের প্রোফাইল</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">কাউন্সিলরদের প্রোফাইল</a></li>
						</ul>
					</div>
					<div class="col-6 col-sm-4">
						<ul class="SFooterLink">
							<li><a href="#" title="Site Map" class="ml-auto">নোটিশ</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">এক নজরে</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">ডাউনলোড</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">লগইন</a></li>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<section class="visible-xs">
			<div class="container">
				<div class="row UFBottom SFooterBG">
					<div class="col-6 col-sm-4">
						<ul class="SFooterLink-xs">
							<li><a href="#" title="Site Map">সাইটম্যাপ</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">যোগাযোগ</a></li>
							<li><a href="#" title="Site Map">পৌরসভা তথ্য</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">সিটিজেন চার্টার</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">মেয়রের প্রোফাইল</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">কাউন্সিলরদের প্রোফাইল</a></li>
							<li><a href="#" title="Site Map" class="ml-auto">নোটিশ</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">এক নজরে</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">ডাউনলোড</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">লগইন</a></li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="row UFBottom UFooterBG">
					<!-- <div class="col-sm-3">
						<ul class="UFooterLink">
							<li><a href="#" title="Site Map">Site Map</a></li>
							<li><a href="javascript:void(0)" title="Contract Us">Contract Us</a></li>
						</ul>
					</div> -->
					<div class="col-sm-12">
						<p>Copyright &copy; 2021 | All right &reg; reserved by <a href="javascript:void(0)">Digital
								Paurashava</a>. Developed by <a href="javascript:void(0)" target="_blank">UP Automation
								LTD</a></p>
						<p>Maintained by <a href="https://www.facebook.com/SirajulSalekinBhuiyan"> UP Automation LTD</a>
						</p>
					</div>
				</div>
			</div>
		</section>
	</footer>
    @include('pourashava_frontend.layouts.script')

</body>

</html>
