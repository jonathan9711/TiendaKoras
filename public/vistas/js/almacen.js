var tablaAlmacen = $(".tablaAlmacen").DataTable({
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		
		"ajax":
			{
				url: "/ajax/dataTable-almacen", 
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
})




$(".tablaAlmacen tbody").on("click","button.btnActivar", function()
{
	var idAlmacen = $(this).attr("idAlmacen");
	var estadoAlmacen = $(this).attr("estadoAlmacen");

	var datos = new FormData();
	datos.append("activarId",idAlmacen);
	datos.append("activarAlmacen",estadoAlmacen);
	$.ajax(
	{
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: "/ajax/activas-almacen",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta)
		{

		}
	})

	if(estadoAlmacen == 0)
	{
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoAlmacen',1);
	}
	else
	{
		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoAlmacen',0);
	}
})

$(".tablaAlmacen tbody").on("click","button.btnEliminarAlmacen", function()
{
	var idAlmacen = $(this).attr("idAlmacen");
	var datos = new FormData();
		datos.append("id_almacen", idAlmacen);
		swal({
		title: '¿Esta seguro de eliminar el alamcen?',
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
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:"/ajax/borrar-almacen",
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
			// window.location = "index.php?ruta=almacen&idAlmacen="+idAlmacen;
		}
	})
})

$(".tablaAlmacen tbody").on("click","button.btnEditarAlmacen", function()
{
	var idAlmacen =$(this).attr("idAlmacen");
	var data = new FormData();
	data.append("idAlmacen",idAlmacen);
	$.ajax(
	{
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: "/ajax/editar-almacen",
		method: "POST",
      	data: data,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
		success:function(respuesta)
		{
			$("#editarAlmacen").val(respuesta[0]["nombre"]);
			$("#editarUbicacion").val(respuesta[0]["ubicacion"]);
			$("#id_almacen").val(respuesta[0]["id_almacen"]);
		}
	})
})
