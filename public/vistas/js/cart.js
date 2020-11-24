// $(".tablaCarrito tbody").on("click","button.btnEditarCarrito",function()
// {
// 	var carrito = $(this).attr("idproduct");
//     alert(carrito);
// 	var datos  = new FormData();
// 	datos.append("carrito",carrito);
// 	$.ajax({
// 		headers: {
// 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 		},
// 		url:"/ajax/editar-producto-carrito",
// 		method:"POST",
// 		data: datos,
// 		cache:false,
// 		contentType:false,
// 		processData:false,
// 		dataType:"json",
// 		success:function(respuesta)
// 		{
			// $("#cuerpoCarrito").html(respuesta[0]);
			// $("#editarNombre").val(respuesta[0]["nombre"]);
			// $("#editarMarca").val(respuesta[0]["marca"]);
			// $("#editarDescripcion").val(respuesta[0]["descripcion"]);
			// $("#precioCompra").val(respuesta[0]["precio_compra"]);
			// $("#editarPrecioVenta").val(respuesta[0]["precio_venta"]);
			// $("#idProducto").val(respuesta[0]["id_producto"]);
			// if (respuesta[0]["imagen"] != "") 
			// {
			// 	$("#imagenActual").val(respuesta["imagen"]);
			// 	$(".previsualizar").attr("src",respuesta["imagen"]);
			// }
// 		}
// 	})
// })