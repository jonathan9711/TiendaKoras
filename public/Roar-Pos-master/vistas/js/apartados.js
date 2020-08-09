var tablaApartados = $(".tablaApartados").DataTable({
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"ajax":"ajax/dataTable-apartados.ajax.php",
		"rowCallback": function(Row,Data) {
			n =  new Date();
			y = n.getFullYear();
			m = n.getMonth() + 1;
			d = n.getDate();
			var fechaLocal = (m>10)?y+"-"+m+"-"+d:y+"-0"+m+"-"+d;
			var fechaData= Data[7].split("-");
			console.log("Local", fechaLocal);
			console.log("data",Data[7]);
		    if (Data[7] == fechaLocal || (d>fechaData[2] && m>=fechaData[1]))
		    {
		        $('td', Row).css('background-color', '#ff5151');
		        $('td', Row).css('color', 'white');
		    }
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

$(".tablaApartados tbody").on("click","button.ver",function()
{
	var idApartado = $(this).attr("idApartado");
	window.location="index.php?ruta=apartado-productos&idApartadoVer="+idApartado;
})

$(".apartar").click(function()
{
	console.log("hola");
	window.location="index.php?ruta=crear-venta&apartar="+1;
})

$(".tablaApartados tbody").on("click","button.btnEliminarApartado",function(){
	var idApartado = $(this).attr("idApartado");
	swal({
		title: '¿Esta seguro de cancelar este apartado?',
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
			window.location="index.php?ruta=apartados&idApartado="+idApartado;
		}
	})	
})

$(".tablaApartados tbody").on("click","button.btnAbonar",function()
{
	$("#id_apartado").val($(this).attr("idApartado"));
})