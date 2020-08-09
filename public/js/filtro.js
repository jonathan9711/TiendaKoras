$(document).ready(function()
{
    $('#USA').hide();
    $('#MXN').hide();
    $('#USA_som').hide();
    $('#MXN_som').hide();
    $('#USA_zap').hide();
    $('#MXN_zap').hide();
    $('.tabla01 .category_item[category="todo"]').addClass('active');
    $('.category_item').click(function()
    {
        var categoria = $(this).attr('category');
       
        $('.category_item').removeClass('active');
        $(this).addClass('active');
        
        //ocultar productos
        $('.tarjeta').css('transform','scale(0)');
        function hideProducto()
        {
            $('.tarjeta').hide();
        }setTimeout(hideProducto,400);
        
        //mostrar productos
        function showProducto()
        {
            $('.tarjeta[category="'+categoria+'"]').show();
            $('.tarjeta[category="'+categoria+'"]').css('transform','scale(1)');
        }setTimeout(showProducto,400);

        
        // $('.block2-img[category="'+categoria+'"]').show();
        $('.category_item[category="todo"]').click(function()
        {
            function showAll()
            {
               $('.tarjeta').show(); 
               $('.tarjeta').css('transform','scale(1)');
            }setTimeout(showAll,400);
            
        });
        
    });

    // login script

    var formInputs = $('input[type="email"],input[type="password"]');
	formInputs.focus(function() {
       $(this).parent().children('p.formLabel').addClass('formTop');
       $('div#formWrapper').addClass('darken-bg');
       $('div.logo').addClass('logo-active');
	});
	formInputs.focusout(function() {
		if ($.trim($(this).val()).length == 0){
		$(this).parent().children('p.formLabel').removeClass('formTop');
		}
		$('div#formWrapper').removeClass('darken-bg');
		$('div.logo').removeClass('logo-active');
	});
	$('p.formLabel').click(function(){
		 $(this).parent().children('.form-style').focus();
	});
});