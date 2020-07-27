var table4 = $(".tablaClientes").DataTable({
	"deferRender": true,
    "retrieve": true,
	"processing": true,
	"ajax":"ajax/dataTable.clientes.ajax.php",
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
		url:"ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			$("#editarCliente").val(respuesta["nombre"]);
			$("#editarApellido").val(respuesta["apellido"]);
			$("#editarDireccion").val(respuesta["direccion"]);
			$("#editarRfc").val(respuesta["RFC"]);
			$("#editarCiudad").val(respuesta["ciudad"]);
			$("#editarEmail").val(respuesta["email"]);
			$("#editarTelefono").val(respuesta["telefono"]);
			$("#id").val(respuesta["id_cliente"]);

		}
	});
})

$(".tablaClientes tbody").on("click","button.btnBorrarCliente",function()
{
	var idCliente = $(this).attr("idCliente");
	swal({
		title: "¿estas seguro de borrar el cliente?",
		text: "si no lo esta puede cancelar",
		type: 'warning',
		showCancelButton: true,
		confirmButtonCOlor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si,Borrar'
		}).then((result)=>
		{
			if (result.value)
			{
				window.location = "index.php?ruta=clientes&idCliente="+idCliente;
			}
		})
})