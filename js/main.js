$(document).ready(function(){
	var imgItems = $('.slider li').length; //numero de sliders
	var imgPos = 1;

    // agrega paginacion
	for(i=1; i<=imgItems; i++){
		$('.pagination').append('<li><span class="fa fa-circle"></span></li>');
	}

	

	$('.slider li').hide(); // oculta todos los sliders
	$('.slider li:first').show(); // muestra el 1er slider
	$('.pagination li:first').css({'color':'#CD6E2E'}); // estilos al 1er item de la paginacion

   // Se ejecutan las funciones
    $('.pagination li').click(pagination);
    $('.right span').click(nextSlider);
    $('.left span').click(prevSlider);

    setInterval(function(){
    	nextSlider();
    }, 6000);


   // FUNCIONES =====================================================

   function pagination(){

	   	var paginationPos = $(this).index()+1; // posicion de la paginacion seleccionada

	   	$('.slider li').hide(); // oculta todos los sliders
	   	$('.slider li:nth-child('+paginationPos+')').fadeIn(); // muestra el slider seleccionado

	    // da estilos a los sliders
	    $('.pagination li').css({'color':'#858585'}); 
	    $(this).css({'color':'#CD6E2E'}); 


	    imgPos = paginationPos;
	}

   function nextSlider(){
   		if(imgPos >= imgItems){imgPos = 1;}
   		else {imgPos++;}

   		$('.pagination li').css({'color':'#858585'});
   		$('.pagination li:nth-child('+ imgPos +')').css({'color':'#CD6E2E'}); 


	   	$('.slider li').hide(); // oculta todos los sliders
	   	$('.slider li:nth-child('+imgPos+')').fadeIn(); // muestra el slider seleccionado
   	
   		
   }


      function prevSlider(){
   		if(imgPos <= 1){imgPos = imgItems;}
   		else {imgPos--;}

   		$('.pagination li').css({'color':'#858585'});
   		$('.pagination li:nth-child('+ imgPos +')').css({'color':'#CD6E2E'}); 


	   	$('.slider li').hide(); // oculta todos los sliders
	   	$('.slider li:nth-child('+imgPos+')').fadeIn(); // muestra el slider seleccionado
   	
   		
   }

});