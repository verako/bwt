(function($){
	$(function(){
		

		//прокрутки
		$(window).scroll(function(){ //функция прокрутки окна
			//console.log($(window).scrollTop())//кол-во прокрученных пикселей
			//$(window).scrollTop(500)//устанавливает свеху 500px

			var scrollTop=$(window).scrollTop();//сколько прокрутили
			var windowHeight=$(window).height();//высота окна

			//появляется и исчезает плавно кнопка вверх 
			if(scrollTop>windowHeight)
				$('.top').fadeIn(300);
			else
				$('.top').fadeOut(300);

			//слегка прокручиваем кртинку на фоне во второй секции (по х 0, по y минус сколько прокручено*0.1)
			$('#section2').css('background-position', '0 -'+(scrollTop*0.1)+'px');
			$('#section1').css('background-position', '0 -'+(scrollTop*0.1)+'px');
			
			

			//через атрибуты
			$('.parallax').each(function(){
				var speed=$(this).data('speed');//var speed =$(this).attr('data-speed');
				var pos=$(this).data('position');
				$(this).css('top', -(scrollTop*speed)+pos+'px');
			})


		})

		$('.top').click(function(){
			//для разных браузеров либо html либо body анимируется
			$('html, body').animate({
				scrollTop:0//устанавливаем top:0
			},500)
			return false;
		})
		//плавная прокрутка при нажатии на меню
		$('.menu a').click(function(){
			var elem =$(this).attr('href');//получаем то,что написано в арибуте
			var top =$(elem).offset().top;//получаем координаты элем относит лев верх угла
			$('html, body').animate({
				scrollTop:top//устанавливаем top: полученные координаты
			},500)
			return false;
		})


$(function(){

	$('.spinner').spinner({
		min: 1
	});

	var minPrice = parseInt($('.price:first').text()), maxPrice = 0;
	$('.price').each(function(){
		var p = parseInt($(this).text());
		if(p>maxPrice)
			maxPrice=p;
		if(p<minPrice)
			minPrice = p;
	})


	$( "#slider-range" ).slider({
      range: true,
      min: minPrice,
      max: maxPrice,
      values: [ minPrice, maxPrice ],
      step: 100,
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );


})

		
})})(jQuery)