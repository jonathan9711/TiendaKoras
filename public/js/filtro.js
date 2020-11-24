$(document).ready(function()
{
    $(".ComprasCliente").DataTable({
        "lengthMenu": [[5,10,20, 30, 50, -1], [5,10,20, 30, 50, "All"]],
           language: {
           sProcessing: "Procesando...",
           sLengthMenu: "Mostrar _MENU_ registros",
           sZeroRecords: "No se encontraron resultados",
           sEmptyTable: "Ningún dato disponible en esta tabla",
           sInfo:
               "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
           sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
           sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
           sInfoPostFix: "",
           sSearch: "Buscar:",
           sUrl: "",
           sInfoThousands: ",",
           sLoadingRecords: "Cargando...",
           oPaginate: {
               sFirst: "Primero",
               sLast: "Último",
               sNext: "Siguiente",
               sPrevious: "Anterior",
           },
           oAria: {
               sSortAscending:
                   ": Activar para ordenar la columna de manera ascendente",
               sSortDescending:
                   ": Activar para ordenar la columna de manera descendente",
           },
           
           
           }
      });


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
        $(this).addClass('active');
        // $('.category_item[category="todo"]').click(function()
        // {
        //     function showProducto()
        //         {
        //             $('.tarjeta').show();
        //             $('.tarjeta').css('transform','scale(1)');
        //         }setTimeout(showProducto,400);
        // });
        $('.tarjeta').css('transform','scale(0)');
        function hideProducto()
        {
            $('.tarjeta').hide();
        }setTimeout(hideProducto,400);

        $.ajax({
            url: '/ajax/producto_category',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {categoria: categoria},
            type: 'GET',
            datatype: 'json',
            success: function(data){
                $('.productosPaginate').html(data);
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

         $('.category_item').removeClass('active');
        
        
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






$('.selection-2').change(function(){
    var precio=$(this).val();
    var texto=$("#texto").val();
    if(texto===""){
        texto="nada";
    }
    $.ajax({
        url: '/ajax/producto_filtrado',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {precio: precio, texto:texto},
        type: 'GET',
        datatype: 'json',
        success: function(data){
            $('.productosPaginate').html(data);
        }
    });
})

$("#texto").keyup(function(){
    var precio=$('.selection-2').val();
    var texto=$(this).val();
    $.ajax({
        url: '/ajax/producto_filtrado',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {texto: texto,precio:precio},
        type: 'GET',
        datatype: 'json',
        success: function(data){
            $('.productosPaginate').html(data);
        }
    });
});

// $(".addtoCart").on("click",function()
// {
   
// 	var idProducto = $(this).attr("idProducto");

// 	var datos  = new FormData();
// 	datos.append("idProducto",idProducto);
// 	$.ajax({
// 		headers: {
// 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 		},
// 		url:"/ajax/editar-producto",
// 		method:"POST",
// 		data: datos,
// 		cache:false,
// 		contentType:false,
// 		processData:false,
// 		dataType:"json",
// 		success:function(respuesta)
// 		{
// 			$("#editarCodigo").val(respuesta[0]["codigo"]);
// 			$("#editarNombre").val(respuesta[0]["nombre"]);
// 			$("#editarMarca").val(respuesta[0]["marca"]);
// 			$("#editarDescripcion").val(respuesta[0]["descripcion"]);
// 			$("#precioCompra").val(respuesta[0]["precio_compra"]);
// 			$("#editarPrecioVenta").val(respuesta[0]["precio_venta"]);
// 			$("#idProducto").val(respuesta[0]["id_producto"]);
// 			if (respuesta[0]["imagen"] != "") 
// 			{
// 				$("#imagenActual").val(respuesta["imagen"]);
// 				$(".previsualizar").attr("src",respuesta["imagen"]);
// 			}
// 		}
// 	})
// })