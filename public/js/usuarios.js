function mostrarTablaUsuarios(almacenId)
{
	console.log("almacenID",almacenId);
	var tableUsuario = $(".tablaUsuarios").DataTable({
		"destroy":true,
		"ajax":
		{
			url:"ajax/dataTable-usuarios.ajax.php",
			type: "POST",
			data:{almacenId:almacenId}
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

	//editar usuario
	$(".tablaUsuarios tbody").on("click","button.btnEditarUsuario",function()
	{
		var idUsuario = $(this).attr("idUsuario");
		var datos = new FormData();
		datos.append("idUsuario", idUsuario);
		
		$.ajax({

			url:"ajax/usuarios.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta)
			{
				console.log("datos",respuesta);
				$("#editarNombre").val(respuesta["nombre"]);
				$("#editarUsuario").val(respuesta["usuario"]);
				$("#editarPerfil").html(respuesta["perfil"]);
				$("#editarPerfil").val(respuesta["perfil"]);
				$("#fotoActual").val(respuesta["foto"]);
				$("#editarAlmacen").val(respuesta["almacen"]);
				$("#passwordActual").val(respuesta["password"]);
				if (respuesta["foto"] != "") 
				{
					$(".previsualizar").attr("src",respuesta["foto"]);

				}
			}});
	})

	$(".tablaUsuarios tbody").on("click","button.btnActivar",function()
	{
		var idUsuario = $(this).attr("idUsuario");
		var estadoUsuario = $(this).attr("estadoUsuario");

		var datos = new FormData();
		datos.append("activarId",idUsuario);
		datos.append("activarUsuario",estadoUsuario);
		$.ajax(
		{
			url: "ajax/usuarios.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta)
			{
			}
		})
		console.log(estadoUsuario);

		if(estadoUsuario == 0)
		{
			$(this).removeClass('btn-success');
			$(this).addClass('btn-danger');
			$(this).html('Desactivado');
			$(this).attr('estadoUsuario',1);
		}
		else
		{
			$(this).addClass('btn-success');
			$(this).removeClass('btn-danger');
			$(this).html('Activado');
			$(this).attr('estadoUsuario',0);
		}
	})
	
	//eliminarUsuario
	$(".tablaUsuarios tbody").on("click","button.btnEliminarUsuario",function()
	{
		var idUsuario = $(this).attr("idUsuario");
		var fotoUsuario = $(this).attr("fotoUsuario");
		var usuario = $(this).attr("usuario");
		swal({
			title: '¿esta seguro que decea borrar usuario?',
			text: "¡si no lo esta puede cancelar!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, borrar usuario'

		}).then((result)=>
		{
			if (result.value)
			{
				window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
			}
		})
	})
}

/*=============================================
=            subir foto          =
=============================================*/

$(".nuevaFoto").change(function()
{
	var imagen = this.files[0];
	//validar que sea png o jpg
	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") 
	{
		$(".nuevaFoto").val(""); 

		swal({
			title: "error al subir foto",
			text: "¡la imagen debe ser en formato JPG o PNG!",
			type: "error",
			conmfirmButtonText:"¡cerrar!"});
	}
	else 
	if(imagen["size"] > 2000000)
	{
		$(".nuevaFoto").val(""); 
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

// revisar usuario para que no este repetido

$("#nuevoUsuario").change(function()
{
	$(".alert").remove();
	var usuario = $(this).val();
	var datos = new FormData();
	datos.append("validarUsuario",usuario);
	$.ajax(
	{
		url: "ajax/usuarios.ajax.php",
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
				$("#nuevoUsuario").parent().after('<div class="alert alert-warning">el usuario ya existe en nuestra base de datos</div>')
				$("#nuevoUsuario").val("");
				
			}
		}
	})

})

$(".selectAlmacen").change(function()
{
	var almacenId = $("#almacenUsuarios").val();
	mostrarTablaUsuarios(almacenId);
})


//almacen usuarios
window.onload = function()
{
   var almacenId = $('#almacenUsuarios').val();
   mostrarTablaUsuarios(almacenId);
};