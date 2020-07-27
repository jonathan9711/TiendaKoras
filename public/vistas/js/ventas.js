function mostrarLasVentas(almacen)
{
	var tablaVenta = $('.tablaAdministradora').DataTable({
	"destroy":true,
	"ajax": 
	{
		url:"ajax/dataTable-administrar.ajax.php",
		type: "POST",
		data: {almacen:almacen}
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

	})

	$(".tablaAdministradora tbody").on("click","button.btnImprimirFactura",function()
	{
		var codigoVenta = $(this).attr("codigo");
		//console.log("codigoVenta",codigoVenta);
		//window.open("extenciones/tcpdf/pdf/factura.php?codigo="+codigoVenta,"_blank");
		window.location = "index.php?ruta=detalle-venta&codigo="+codigoVenta;
	})

	$(".tablaAdministradora tbody").on("click","button.btnEliminarVenta",function()
{
	    var idVenta = $(this).attr("id_venta");
		swal({
			title: '¿esta seguro que desea cancelar la venta?',
			text: "¡si no lo esta puede cancelar!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, cancelar la venta'

		}).then((result)=>
		{
			if (result.value)
			{
				window.location = "index.php?ruta=ventas&idVenta="+idVenta;
			}
		})
})
}

$(".almacenVentas").change(function()
{
	var almacen = $("#almacen").val();
	var fecha = $("#fecha").val();
	var convinacion = almacen + "," + fecha;
	mostrarTotal();
	mostrarLasVentas(convinacion);
})

$(".fechaActual").change(function()
{
	var almacen = $("#almacen").val();
	var fecha = $("#fecha").val();
	var convinacion = almacen + "," + fecha;
	mostrarTotal();
	mostrarLasVentas(convinacion);
})

window.onload = function()
{
	var almacen = $("#almacen").val();
	var fecha = $("#fecha").val();
	var convinacion = almacen + "," + fecha;
	mostrarTotal();
	mostrarLasVentas(convinacion);
}

function mostrarTotal()
{
	var almacen = $("#almacen").val();
	var fecha = $("#fecha").val();
	var data = new FormData();
	data.append("almacen",almacen);
	data.append("fecha",fecha);
	$.ajax({
		url:"ajax/administrar.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			$("#totalVenta").val(respuesta[0]);
			
		}});
}






	



	
