function mostrarTablaOrdenes(orden)
{
	// console.log("almacenID",almacenId);
	var tableUsuario = $(".tablaOrdenesOnline").DataTable({
		"destroy":true,
		"ajax":
		{
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:"/ajax/dataTable-ordenes-online",
			type: "POST",
			data:{estado:orden}
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

	

	$(".tablaOrdenesOnline tbody").on("click","button.btnEliminarOrden",function()
	{
		var idOrden = $(this).attr("idOrden");
		// var estado = $(this).attr("estadoOrden");

		var datos = new FormData();
		datos.append("IdOrden",idOrden);
		// datos.append("activarEstado",estado);
		$.ajax(
		{
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "/ajax/eliminar_orden",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta)
			{
                 window.location.reload();
			}
		})
		// console.log(estadoUsuario);

		
	})


    $(".tablaOrdenesOnline tbody").on("click","button.btnActivar",function()
	{
		var idOrden = $(this).attr("idOrden");
		var estado = $(this).attr("estadoOrden");

		var datos = new FormData();
		datos.append("IdOrden",idOrden);
		datos.append("activarEstado",estado);
		$.ajax(
		{
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "/ajax/activar_ordenes",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta)
			{
                window.location.reload();
			}
		})
		// console.log(estadoUsuario);

		if(estadoOrden== 0)
		{
			$(this).removeClass('btn-success');
			$(this).addClass('btn-danger');
			$(this).html('Desactivado');
			$(this).attr('estadoOrden',1);
		}
		else
		{
			$(this).addClass('btn-success');
			$(this).removeClass('btn-danger');
			$(this).html('Activado');
			$(this).attr('estadoORden',0);
		}
	})
}




$(".selectAlmacen").change(function()
{
    var orden = $("#Ordenes").val();
   
	mostrarTablaOrdenes(orden);
})

//almacen usuarios
window.onload = function()
{
   var orden = $('#Ordenes').val();
   mostrarTablaOrdenes(orden);
};