
function cargatabla(){
	var table = $(".tablaProductos").DataTable({
		
		"ajax":
			{
				url: "/ajax/dataTable-productos", 
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: "GET",
			},
		
		"language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

		}

	});

}




$("#nuevoPrecioCompra").change(function()
{
	if ($(".porcentaje").prop("checked"))
	{
		var valorPorcentaje = $(".nuevoPorcentaje").val();

		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100)) + Number($("#nuevoPrecioCompra").val());

		
		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);
	
	}
	

})

$("#precioCompra").change(function()
{
	if ($(".porcentaje").prop("checked"))
	{
		var valorPorcentaje = $(".nuevoPorcentaje").val();

		var porcentaje = Number(($("#precioCompra").val()*valorPorcentaje/100)) + Number($("#precioCompra").val());
		
		$("#editarPrecioVenta").val(porcentaje);
		$("#editarPrecioVenta").prop("readonly",true);
	}
	

})

$(".nuevoPorcentaje").change(function()
{
	if ($(".porcentaje").prop("checked"))
	{
		var valorPorcentaje = $(this).val();

		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100)) + Number($("#nuevoPrecioCompra").val());
		var editarProcentaje = Number(($("#precioCompra").val()*valorPorcentaje/100)) + Number($("#precioCompra").val());
		
		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);

		$("#editarPrecioVenta").val(editarProcentaje);
		$("#editarPrecioVenta").prop("readonly",true);
	}
})

$(".porcentaje").on("ifUnchecked",function()
{
	$("#nuevoPrecioVenta").prop("readonly",false);
	$("#editarPrecioVenta").prop("readonly",false);
})

$(".porcentaje").on("ifChecked",function()
{
	$("#nuevoPrecioVenta").prop("readonly",true);
	$("#editarPrecioVenta").prop("readonly",true);
})


$(".nuevaImagen").change(function()
{
	var imagen = this.files[0];

	//validar que sea png o jpg
	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") 
	{
		$(".nuevaImagen").val(""); 

		swal({
			title: "error al subir foto",
			text: "¡la imagen debe ser en formato JPG o PNG!",
			type: "error",
			conmfirmButtonText:"¡cerrar!"});
	}
	else if(imagen["size"] > 2000000)
	{
		$(".nuevaImagen").val(""); 
		swal({
			title: "Error al subir la imagen",
			text: "la imagen no debe pesar mas de 2MB",
			type: "error",
			conmfirmButtonText: "¡Cerrar!"});
	}
	else
	{
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);
		$(datosImagen).on("load", function(event)
		{
			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src", rutaImagen);
		})
	}
})

$(".tablaProductos tbody").on("click","button.btnEditarProducto",function()
{
	var idProducto = $(this).attr("idProducto");

	var datos  = new FormData();
	datos.append("idProducto",idProducto);
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url:"/ajax/editar-producto",
		method:"POST",
		data: datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta)
		{
			$("#editarCodigo").val(respuesta[0]["codigo"]);
			$("#editarNombre").val(respuesta[0]["nombre"]);
			$("#editarMarca").val(respuesta[0]["marca"]);
			$("#editarDescripcion").val(respuesta[0]["descripcion"]);
			$("#precioCompra").val(respuesta[0]["precio_compra"]);
			$("#editarPrecioVenta").val(respuesta[0]["precio_venta"]);
			$("#idProducto").val(respuesta[0]["id_producto"]);
			if (respuesta[0]["imagen"] != "") 
			{
				$("#imagenActual").val(respuesta["imagen"]);
				$(".previsualizar").attr("src",respuesta["imagen"]);
			}
		}
	})
})

$(".tablaProductos tbody").on("click","button.btnEliminarProducto",function()
{
	var idProducto = $(this).attr("idProducto");
	var imagen = $(this).attr("imagen");
	var nombre = $(this).attr("nombre");
	var datos = new FormData();
		datos.append("id_producto", idProducto);
		datos.append("imagen", imagen);
		datos.append("nombre", nombre);
	swal({
		title: '¿esta seguro que decea borrar el producto?',
		text: "¡si no lo esta puede cancelar!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText:'Cancelar',
		confirmButtonText:'Si, borrar producto'
	}).then((result)=>
	{
		if (result.value)
		{
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:"/ajax/borrar-producto",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta)
				{
					if(respuesta==1){

						
						window.location.reload();
					}
				}
			});
			// window.location = "index.php?ruta=productos&nombre="+nombre+"&idProducto="+idProducto+"&imagen="+imagen;
		}
	})
})

window.onload = function()
{
	cargatabla();
}

$("#Codigo").change(function()
{
	$(".alert").remove();
	var codigo = $(this).val();
	var datos = new FormData();
	datos.append("codigo",codigo);
	$.ajax(
	{
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: "/ajax/codigo-productos",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			if(respuesta==1)
			{
				$("#Codigo").parent().after('<div class="alert alert-warning">Este codigo ya existe</div>')
				$("#Codigo").val("");
				
			}
		}
	})

});


$('#print-code').on('click', function() {

	
	printBarcode($('#Codigo').val());

});



