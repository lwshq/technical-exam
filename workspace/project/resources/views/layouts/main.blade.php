<!doctype html>
<html >
<head>
	<title>@yield('title','') | {{env('APP_NAME','Technical Exam')}}</title>
	<!-- initiate head with meta tags, css and script -->
	@include('include.head')

</head>
<body id="app" >
    <div class="wrapper">
    	<!-- initiate header-->
    	@include('include.header')
    	<div class="page-wrap">

	    	<div class="main-content">
	    		<!-- yeild contents here -->
	    		@yield('content')
	    	</div>

    	</div>
    </div>
    
	<!-- initiate modal menu section-->
</body>
</html>