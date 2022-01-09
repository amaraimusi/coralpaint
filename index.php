
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
	<link rel='shortcut icon' href='img/favicon.ico' />
	
	<link href="<?php echo URL_BASE; ?>css/bootstrap-4.3.1-dist/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo URL_BASE; ?>css/jquery-ui.css" rel="stylesheet">
	<link href="<?php echo URL_BASE; ?>css/common2.css" rel="stylesheet">
	<link href="<?php echo URL_BASE; ?>js/slick/slick.css" rel="stylesheet">
	<link href="<?php echo URL_BASE; ?>js/slick/slick-theme.css" rel="stylesheet" />
	<link href="<?php echo URL_BASE; ?>css/index.css?v=1.0.1" rel="stylesheet">
	
	<script src="<?php echo URL_BASE; ?>js/jquery.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/jquery-ui.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/bootstrap-4.3.1-dist/bootstrap.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/vue.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/livipage.js"></script>
	<script src="<?php echo URL_BASE; ?>js/ImgCompactK.js"></script>
	<script src="<?php echo URL_BASE; ?>js/slick/slick.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/index.js?v=1.0.1"></script>
</head>
<body>

<div id="fixed_title" style="width:40%;max-width:320px"><img src="<?php echo URL_BASE; ?>img/fixed_title.png" style="width:100%" /></div>

<div style="height:290px;width:100%;">
    <div id="head_title" style="background-image: url(<?php echo $data[2]['img_fp']; ?>);">
    	<h1 id="head_title_text">
    		<span id="head_title_text_a">CORAL PAINT</span><br>
    		<?php echo $data[2]['midasi1']; ?>
    	</h1>
    </div>
</div>
<div style="width:50%;text-align:center">
    <div style="width:50%;display:inline-block">
    	<div id="test1" style="widht:400px;height:300px;display:none;background-color:#2b9f48">コーラルペイント</div>
    </div>
</div>

<div id="header2" >
	<img src="<?php echo $data[3]['img_fp']; ?>" alt="<?php echo $data[3]['midasi1']; ?>"  style="width:70%" />
</div>
	
<div class="container-fluid" style="padding:0px">


<div class="row" style="margin-top:40px">
	<div class="col-12 col-md-6">
		<div >
			<img src="<?php  echo $data[4]['img_fp_md']; ?>" class="img_a"  />
		</div>
	</div>
	<div class="col-12 col-md-6">
		<div class="text_a back_img_a">
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
		<div class="text_a back_img_b">
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
		<div class="text_a back_img_c">
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
    	   		<h5 class="card-header">
    	   			<?php echo $data[14]['midasi1']?>
    	   		</h5>
    	   		<div class="card-body">
    	   			<div class="card-text">
    	   				<img src="<?php echo $data[14]['img_fp_md']; ?>" style="width:100%"  />
    	   			</div>
    	   			<div class="card-text card_text_ex" >
    	   				<?php echo $data[14]['text1']?>
    	   			</div>
    	   		</div>
	   		</div>
    	</div>
    
    	<div class="col-12 col-md-3">
    		<div class="card border-primary mb-3">
    	   		<h5 class="card-header">
    	   			<?php echo $data[15]['midasi1']?>
    	   		</h5>
    	   		<div class="card-body">
    	   			<div class="card-text">
    	   				<img src="<?php echo $data[15]['img_fp_md']; ?>" style="width:100%"  />
    	   			</div>
    	   			<div class="card-text card_text_ex">
    	   				<?php echo $data[15]['text1']?>
    	   			</div>
    	   		</div>
	   		</div>
    	</div>
    
    	<div class="col-12 col-md-3">
    		<div class="card border-primary mb-3">
    	   		<h5 class="card-header">
    	   			<?php echo $data[16]['midasi1']?>
    	   		</h5>
    	   		<div class="card-body">
    	   			<div class="card-text">
    	   				<img src="<?php echo $data[16]['img_fp_md']; ?>" style="width:100%"  />
    	   			</div>
    	   			<div class="card-text card_text_ex">
    	   				<?php echo $data[16]['text1']?>
    	   			</div>
    	   		</div>
	   		</div>
    	</div>
    
    	<div class="col-12 col-md-3">
    		<div class="card border-primary mb-3">
    	   		<h5 class="card-header">
    	   			<?php echo $data[17]['midasi1']?>
    	   		</h5>
    	   		<div class="card-body">
    	   			<div class="card-text">
    	   				<img src="<?php echo $data[17]['img_fp_md']; ?>" style="width:100%"  />
    	   			</div>
    	   			<div class="card-text card_text_ex">
    	   				<?php echo $data[17]['text1']?>
    	   			</div>
    	   		</div>
	   		</div>
    	</div>

    </div>
</div>

<div class="belt_a"></div>

<div style="text-align:center">
	<div id="contact1" >
		<p>お問い合わせ</p>
		<div id="mail1" ></div>
		<div style="margin-top:0.8em"><?php echo $data[18]['text1']?></div>
	</div>
</div>

<div class="yohaku"></div>

</div><!-- content -->
<div id="footer" style="background-color:#64a8d9">(C) Coral Paint 2021-9-27</div>
</body>
</html>