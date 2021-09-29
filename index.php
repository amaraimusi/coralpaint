
<?php 


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
	
	<link href="<?php echo URL_BASE; ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo URL_BASE; ?>css/bootstrap-4.3.1-dist/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo URL_BASE; ?>css/common2.css" rel="stylesheet">
	<link href="<?php echo URL_BASE; ?>js/slick/slick.css" rel="stylesheet">
	<link href="<?php echo URL_BASE; ?>js/slick/slick-theme.css" rel="stylesheet" />
	<link href="<?php echo URL_BASE; ?>css/index.css" rel="stylesheet">
	
	<script src="<?php echo URL_BASE; ?>js/jquery.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/popper.js"></script><!-- ポップアップ機能およびBootstrapの補助ライブラリ -->
	<script src="<?php echo URL_BASE; ?>js/bootstrap-4.3.1-dist/bootstrap.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/vue.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/livipage.js"></script>
	<script src="<?php echo URL_BASE; ?>js/ImgCompactK.js"></script>
	<script src="<?php echo URL_BASE; ?>js/slick/slick.min.js"></script>
	<script src="<?php echo URL_BASE; ?>js/index.js"></script>
</head>
<body>

<div class="bannar">
	<h1 class="bannar_text">
		コーラルペイント
	</h1>
</div>

<div id="header2">
	<h2>Let's fix the house before it breaks</h2>
</div>
	
<div class="container-fluid" style="padding:0px">


<div class="row" style="margin-top:40px">
	<div class="col-12 col-md-6">
		<div >
			<img src="/coralpaint/rsc/img/md1/md_DSC_0115.jpg" style="width:100%"  />
		</div>
	</div>
	<div class="col-12 col-md-6">
		<div class="div_a_1">
			<div>
				<h3>見出し1</h3>
			</div>
			<div class="div_a_1_1">
そこで神はそれらを祝福して言った。「子を生み，増えて，海の水の中でいっぱいになれ+。飛ぶ生き物は，地上で増えよ」。 23 こうして，晩になり朝になり，5日目が過ぎた。

24 神は言った。「陸に，さまざまな種類の生き物が現れよ。さまざまな種類の家畜と野生動物と地面を動く生き物*である+」。するとそのようになった。 25 神は，さまざまな種類の野生動物，さまざまな種類の家畜，地面を動くさまざまな種類の生き物を造った。神が見ると，それは良かった。
			</div>
		</div>
	</div>
</div><!--  row　区分1-1と1-2 -->


<div class="row" style="margin-top:80px">

	<div class="col-12 col-md-6">
		<div class="div_a_1">
			<div>
				<h3>見出し2</h3>
			</div>
			<div class="div_a_1_1">
ネブカドネザルは治世の第2年に，何度か夢を見て心が落ち着かず+，眠れなくなった。 2 それで王は，夢について説明させるために，魔術師，まじない師，呪術師，カルデア人*を招集するよう命じた。その者たちはやって来て，王の前に立った+。 3 王は彼らに言った。「私はある夢を見た。その夢で見たのが何だったのか知りたくて，心が落ち着かない」。 4 カルデア人たちはアラム語+で王に答えた*。「王がいつまでも生き続けますように。どのような夢かを私どもにお話しください。そうすれば解き明かします」。
			</div>
		</div>
	</div>
	<div class="col-12 col-md-6">
		<div >
			<img src="/coralpaint/rsc/img/md1/md_DSC_0130.jpg" style="width:100%"  />
		</div>
	</div>
</div><!--  row　区分1-1と1-2 -->


<div class="row" style="margin-top:80px">
	<div class="col-12 col-md-6">
		<div >
			<img src="/coralpaint/rsc/img/md1/md_DSC_0250.jpg" style="width:100%"  />
		</div>
	</div>
	<div class="col-12 col-md-6">
		<div class="div_a_1">
			<div>
				<h3>見出し3</h3>
			</div>
			<div class="div_a_1_1">
別の安息日のこと，イエスは会堂に入って教え始めた。そこに，右手がまひした*男性がいた+。 7 律法学者とパリサイ派の人たちは，イエスが安息日に治すのかどうか，じっと見ていた。イエスを訴える理由を見つけようとしてだった
			</div>
		</div>
	</div>
</div><!--  row　区分1-1と1-2 -->

<div style="margin-top:80px;padding-left:30px;padding-right:30px;background-color:#dd5044">
    <div id="carousel1" >
    
    	<?php for($i=0;$i<10;$i++){?>
    	<div class='carousel1_cell'>
    		<img src="/coralpaint/rsc/img/md1/md_DSC_011<?php echo $i ?>.jpg" style="width:100%" />
    	</div>
    	<?php } ?>
    
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
        				<img src="/coralpaint/rsc/img/md1/md_DSC_0202.jpg" style="width:100%"  />
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
        				<img src="/coralpaint/rsc/img/md1/md_DSC_0203.jpg" style="width:100%"  />
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
        				<img src="/coralpaint/rsc/img/md1/md_DSC_0204.jpg" style="width:100%"  />
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
        				<img src="/coralpaint/rsc/img/md1/md_DSC_0205.jpg" style="width:100%"  />
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
<div id="footer">(C) Coparal paint 2021-9-27</div>
</body>
</html>