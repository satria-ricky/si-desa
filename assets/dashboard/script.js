$('.page-scroll').on('click', function(e){

	// console.log('klik');

	var tujuan = $(this).attr('href');

	// console.log(href);

	var elementTujuan = $(tujuan);

	$('html , body').animate({
	  scrollTop: elementTujuan.offset().top - 60
	}, 1000);

	e.preventDefault();


})