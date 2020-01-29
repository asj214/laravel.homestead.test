<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
	<link href="{{ asset('css/lumino/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/lumino/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/lumino/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('css/lumino/styles.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('js/datetimepicker/jquery.datetimepicker.min.css') }}" />
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script src="{{ asset('js/lumino/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('js/lumino/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/lumino/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('js/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
</head>
<body>

<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
				<span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>{{ config('app.name', 'Laravel') }}</span>Admin</a>
        </div>
    </div><!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
            <div class="profile-usertitle-status">
				<span class="indicator label-success"></span>Online
			</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
        <li>
			<a href="index.html"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
		</li>
		<li {!! (Request::segment(2) == "users" ? 'class="active"': '') !!}>
			<a href="{{ route('adm.users.index') }}"><em class="fa fa-user">&nbsp;</em> User</a>
		</li>
        <li {!! (Request::segment(2) == "banners" ? 'class="active"': '') !!}>
			<a href="{{ route('adm.banners.index') }}"><em class="fa fa-film">&nbsp;</em> Banner</a>
		</li>
        <li>
			<a href="javascript:void(0);" id="btn-logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a>
		</li>
    </ul>
</div>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
				<a href="#">admin</a>
			</li>
            <li class="active">{{ Request::segment(2) }}</li>
        </ol>
    </div><!--/.row-->

	@yield('content')

</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	@csrf
</form>
<script type="text/javascript">
$(document).ready(function(){

	$('#btn-logout').click(function(){
		$('#logout-form').submit();
	});

	$('.datepicker').datepicker({
		format: 'yyyy-m-d'
	});
	/*
	$('.datetimepicker').datetimepicker({
		format: 'Y-m-d H:i',
		onSelectDate: function(ct, $i){
			console.log(ct);
			console.log($i);
		},
		onSelectTime: function(ct, $i){
			console.log(ct);
			console.log($i);
		}
	});
	*/
});
</script>
</body>
</html>
