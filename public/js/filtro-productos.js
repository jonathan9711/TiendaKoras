$(document).ready(function()
{
    $('#USA').hide();
    $('#MXN').hide();
    $('#USA_som').hide();
    $('#MXN_som').hide();
    $('.leftbar .category_producto[category="todo"]').addClass('active');
    
    $('.category_producto').click(function()
    {
        var categoria = $(this).attr('category');
    //    alert(categoria);
        $('.category_producto').removeClass('active');

        $(this).addClass('active');
         
        $.ajax({
            url: '/ajax/producto_category_index',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {categoria: categoria},
            type: 'GET',
            datatype: 'json',
            success: function(data){
                // $('.productosPaginate').html(data);
                $('.productosPaginate2').html(data);
                $('.tarjeta').css('transform','scale(0)');
                function hideProducto()
                {
                    $('.tarjeta').hide();
                }setTimeout(hideProducto,400);
                function showProducto()
                {
                    $('.tarjeta').show();
                    $('.tarjeta').css('transform','scale(1)');
                }setTimeout(showProducto,400);
            }
        });
        
        //ocultar productos
        // $('.tarjeta').css('transform','scale(0)');
        // function hideProducto()
        // {
        //     $('.tarjeta').hide();
        // }setTimeout(hideProducto,400);
        
        //mostrar productos
        // function showProducto()
        // {
        //     $('.tarjeta[category="'+categoria+'"]').show();
        //     $('.tarjeta[category="'+categoria+'"]').css('transform','scale(1)');
        // }setTimeout(showProducto,400);

        
        // $('.block2-img[category="'+categoria+'"]').show();
        // $('.category_producto[category="todo"]').click(function()
        // {
        //     function showAll()
        //     {
        //        $('.tarjeta').show(); 
        //        $('.tarjeta').css('transform','scale(1)');
        //     }setTimeout(showAll,400);
            
        // });
        
    });

    
});