
<?php 
    require_once 'crud_base_config.php';
    
    require_once 'controller/HomeController.php';
    $homeCon = new HomeController();
    $box = $homeCon->indexAction();
    $data = $box['data'];
    $carousels = $box['carousels'];

    if(strpos($_SERVER['SERVER_NAME'], 'localhost') !== false){
	   define('URL_BASE', '/coralpaint/');
    }else{
	   define('URL_BASE', '/');
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="google" content="notranslate" />
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>コーラルペイント</title>
	<link rel='shortcut icon' href='/home/images/favicon.ico' />
	
	<link href="<?php echo URL_BASE; ?>css/bootstrap-4.3.1-dist/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo URL_BASE; ?>css/common2.css" rel="stylesheet">
	<link href="<?php echo URL_BASE; ?>js/slick/slick.css" rel="stylesheet">
	<link href="<?php echo URL_BASE; ?>js/slick/slick-theme.css" rel="stylesheet" />
	<link href="<?php echo URL_BASE; ?>css/index.css" rel="stylesheet">
	
	<script src="<?php echo URL_BASE; ?>js/jquery.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/bootstrap-4.3.1-dist/bootstrap.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/vue.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/livipage.js"></script>
	<script src="<?php echo URL_BASE; ?>js/ImgCompactK.js"></script>
	<script src="<?php echo URL_BASE; ?>js/slick/slick.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/index.js"></script>
</head>
<body>

<div id="fixed_title" style="width:40%;max-width:320px"><img src="<?php echo URL_BASE; ?>img/fixed_title.png" style="width:100%" /></div>

<div class="bannar">
	<h1 class="bannar_text">
		コーラルペイント
	</h1>
</div>


<div id="header2" >
	<img src="<?php echo URL_BASE; ?>img/header2.png" alt="Let's fix the house before it breaks"  style="width:70%" />
</div>
	
<div class="container-fluid" style="padding:0px">


<div class="row" style="margin-top:40px">
	<div class="col-12 col-md-6">
		<div >
			<img src="<?php  echo $data[4]['img_fp_md']; ?>" class="img_a"  />
		</div>
	</div>
	<div class="col-12 col-md-6">
		<div class="text_a">
			<div>
				<h3 class="text_a_midasi"><?php echo $data[4]['midasi1']; ?></h3>
			</div>
			<div class="text_a_body" ><?php echo $data[4]['text1']; ?></div>
		</div>
	</div>
</div><!--  row　区分1-1と1-2 -->

<div class="belt_a"></div>


<div class="row" style="margin-top:80px">

	<div class="col-12 col-md-6">
		<div class="text_a">
			<div>
				<h3 class="text_a_midasi"><?php echo $data[5]['midasi1']; ?></h3>
			</div>
				<div class="text_a_body" ><?php echo $data[5]['text1']; ?></div>
		</div>
	</div>
	<div class="col-12 col-md-6">
		<div >
			<img src="<?php  echo $data[5]['img_fp_md']; ?>" class="img_a"  />
		</div>
	</div>
</div><!--  row　区分1-1と1-2 -->

<div class="belt_a"></div>


<div class="row" style="margin-top:80px">
	<div class="col-12 col-md-6">
		<div >
			<img src="<?php  echo $data[6]['img_fp_md']; ?>" class="img_a"  />
		</div>
	</div>
	<div class="col-12 col-md-6">
		<div class="text_a">
			<div>
				<h3 class="text_a_midasi" ><?php echo $data[6]['midasi1']; ?></h3>
			</div>
			<div class="text_a_body" ><?php echo $data[6]['text1']; ?></div>
		</div>
	</div>
</div><!--  row　区分1-1と1-2 -->

<div class="belt_a"></div>

<div class="carousel_w" >
    <div id="carousel1" >
    
    	<?php
    	   foreach($carousels as $crsEnt){
    		  echo "<img src='{$crsEnt['img_fp_md']}' style='width:100%' />";
    	   }
    	?>
    
    </div>
</div>

<div style="padding:10px">
    <div class="row" style="margin-top:80px">
    	<div class="col-12 col-md-3">
    		<div class="card border-primary mb-3">
	   		<div class="card-header">
	   			カードのテスト
	   		</div>
	   		<div class="card-body">
	   			<h5 class="card-title">カードのタイトル</h5>
	   			<div class="card-text">
	   				<img src="<?php echo URL_BASE; ?>rsc/img/md1/md_DSC_0202.jpg" style="width:100%"  />
	   			</div>
	   			<div class="card-text">
	   				カードのテキスト<br>
	   				聖書は神を1つの固有の名前で呼んでいますが，数多くの称号や描写を用いて神について述べています。
	   			</div>
	   		</div>
	   	</div>
    	</div>
    	
    	
    	<div class="col-12 col-md-3">
    		<div class="card border-primary mb-3" style="border-width:2px;">
	   		<div class="card-header bg-primary text-light" style="border-radius:0px;">
	   			カードのテスト
	   		</div>
	   		<div class="card-body">
	   			<h5 class="card-title">カードのタイトル</h5>
	   			<div class="card-text">
	   				<img src="<?php echo URL_BASE; ?>rsc/img/md1/md_DSC_0203.jpg" style="width:100%"  />
	   			</div>
	   			<div class="card-text">
	   				カードのテキスト<br>
	   				聖書は神を1つの固有の名前で呼んでいますが，数多くの称号や描写を用いて神について述べています。
	   			</div>
	   		</div>
	   	</div>
    	</div>
    	
    	
    	<div class="col-12 col-md-3">
    		<div class="card border-primary mb-3">
	   		<div class="card-header">
	   			カードのテスト
	   		</div>
	   		<div class="card-body">
	   			<h5 class="card-title">カードのタイトル</h5>
	   			<div class="card-text">
	   				<img src="<?php echo URL_BASE; ?>rsc/img/md1/md_DSC_0204.jpg" style="width:100%"  />
	   			</div>
	   			<div class="card-text">
	   				カードのテキスト<br>
	   				聖書は神を1つの固有の名前で呼んでいますが，数多くの称号や描写を用いて神について述べています。
	   			</div>
	   		</div>
	   	</div>
    	</div>
    	
    	
    	<div class="col-12 col-md-3">
    		<div class="card border-primary mb-3">
	   		<div class="card-header">
	   			カードのテスト
	   		</div>
	   		<div class="card-body">
	   			<h5 class="card-title">カードのタイトル</h5>
	   			<div class="card-text">
	   				<img src="<?php echo URL_BASE; ?>rsc/img/md1/md_DSC_0205.jpg" style="width:100%"  />
	   			</div>
	   			<div class="card-text">
	   				カードのテキスト<br>
	   				聖書は神を1つの固有の名前で呼んでいますが，数多くの称号や描写を用いて神について述べています。
	   			</div>
	   		</div>
	   	</div>
    	</div>
    </div>
</div>

<div class="yohaku"></div>

</div><!-- content -->
<div id="footer" style="background-color:#64a8d9">(C) Coral Paint 2021-9-27</div>
</body>
</html>