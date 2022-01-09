$(()=>{
	
	// カルーセル
	$('#carousel1').slick({ 
		arrows: true, // 左右のボタンを表示
		dots: true, // 下部分にドットを表示
		accessibility: true,
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3
	});
	

	//$("#head_title").show("drop", {"direction":"up"}, 1000);
	
	setTimeout(function(){
		$('.mail1').html('coralpaint.okinawa@gmail.com');
	},100);
})