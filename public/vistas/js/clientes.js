// $(document).ready(function()
// {
// 	cargardatostabla();
// 	console.log("se cargan los datos de la tabla");
// });


	var tabla4=$(".tablaClientes").DataTable({
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"ajax":
			{
				url: "/ajax/dataTable-clientes", 
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


$(".tablaClientes tbody").on("click","button.btnEditarCliente",function()
{
	var idCliente = $(this).attr("idCliente");
	var datos = new FormData();
	datos.append("idCliente",idCliente);
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url:"/ajax/clientes-editar",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			$("#editarCliente").val(respuesta[0]["nombre"]);
			$("#editarApellido").val(respuesta[0]["apellido"]);
			$("#editarDireccion").val(respuesta[0]["direccion"]);
			$("#editarRfc").val(respuesta[0]["RFC"]);
			$("#editarCiudad").val(respuesta[0]["ciudad"]);
			$("#editarEmail").val(respuesta[0]["email"]);
			$("#editarTelefono").val(respuesta[0]["telefono"]);
			$("#id").val(respuesta[0]["id_cliente"]);

		}
	});
})

$(".tablaClientes tbody").on("click","button.btnBorrarCliente",function()
{
	var idCliente = $(this).attr("idCliente");
	console.log(idCliente);
	var datos = new FormData();
	datos.append("idCliente", idCliente);
	swal({
		title: "¿estas seguro de borrar el cliente?",
		text: "si no lo esta puede cancelar",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si,Borrar'
		}).then((result)=>
		{
			if (result.value)
			{
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:"/ajax/borrar-cliente",
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
				// route= "admin.borrar-cliente/";
			}
		})
})