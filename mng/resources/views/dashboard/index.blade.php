
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ダッシュボード</title>
	
	
	<script src="{{ asset('/js/app.js') }}" defer></script>
	<script src="{{ CRUD_BASE_JS }}" defer></script>
	<script src="{{ asset('/js/Dashboard/index.js')  . '?v=1.0.0' }}" defer></script>
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ CRUD_BASE_CSS }}" rel="stylesheet">

	
</head>
<body>
@include('layouts.common_header')

<div class="container-fluid">

<div id="org_div" style="margin-top:20px;margin-bottom:60px;">
	<h3 class="text-primary">CrudBase 見本機能一覧</h3>
	<div class="row" style="margin-top:20px;">
		<div class="col-sm-4">
			<div class="card border-primary ">
				<div class="card-body" >
					<h5 class="card-title text-primary" style="font-weight:bold">見本管理画面</h5>
					<div class="card_msg">
						<p class="card-text">管理画面の見本です。このシステムを元に様々なWEBシステムを開発しています。</p>
					</div>
					<a href="{{url('/neko')}}" class="btn btn-primary">ページへ移動</a>
				</div>
			</div>
		</div>

	</div>
</div>


</div><!-- container-fluid -->
@include('layouts.common_footer')


</body>
</html>