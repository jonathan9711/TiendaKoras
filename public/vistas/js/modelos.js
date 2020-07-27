$(".btnMostrarModelo").click(function()
{
	var idProducto = $(this).attr("idProducto");
	window.location = "index.php?ruta=modelosProducto&idProducto="+idProducto;
})

$(".btnEditarModelo").click(function()
{
	var idModelo = $(this).attr("idModelo");
	var datos = new FormData();
	datos.append("idModelo",idModelo);

	$.ajax({
		url: "ajax/modelosProductos.ajax.php",
	    method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			$("#editarModelo").val(respuesta["modelo"]);
			$("#editarColor").val(respuesta["color"]);
			$("#editarTalla").val(respuesta["talla"]);
			$("#editarExistencia").val(respuesta["existencia"]);
			$("#idModelo1").val(respuesta["id_modelo"]);
			
		}

	});


})

$(".btnEliminarModelo").click(function(){

	var idModelo = $(this).attr("idModelo");
	var idProducto = $(this).attr("idProducto");
	swal({
		title: '¿Esta seguro de borrar el modelo?',
		text: "¡si no lo esta puede cancelar!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'cancelar',
		confirmButtonText: 'Si,Borrar'
	}).then((result)=>
	{
		if (result.value)
		{

			window.location = "index.php?ruta=modelosProducto&idProducto="+idProducto+"&idModelo="+idModelo;
		}
	})
})

$("#nuevoModelo").change(function(){
	$(".alert").remove();
	var modelo = $(this).val();
	var datos = new FormData();
	datos.append("validarModelo",modelo);
	$.ajax({
	    url: "ajax/modelosProductos.ajax.php",
	    method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			if(respuesta)
			{
				$("#nuevoModelo").parent().after('<div class="alert alert-warning">el modelo ya existe</div>')
				$("#nuevoModelo").val("");
			}			
		}

	});
})

