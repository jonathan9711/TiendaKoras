function mostrarTablaInventario(almacen)
{
	var perfil = $("#perfil").val();
	var almacenRoot = $("#root1").val();
    var	tableInventario = $(".tablaInventario").DataTable({
		"destroy": true,
		"ajax":
		{
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: "/ajax/dataTable-inventario",
			type: "POST",
			data:
			{
				almacen:almacen,
				rootAlmacen:almacenRoot,
				perfil:perfil
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

	});

	$(".tablaInventario tbody").on("click","button.btnEntradaProducto",function()
	{
		var id_producto = $(this).attr("id_producto");
		console.log(id_producto);
		var valor = $("#almacenid").val();
		var datos  = new FormData();
		datos.append("id_producto",id_producto);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:"/ajax/inventario",
			method:"POST",
			data: datos,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(respuesta)
			{
				$("#codigoEntrada").val(respuesta[0]["codigo"]);
	     		$("#id_producto").val(respuesta[0]["id_producto"]);
	     		$("#codigoSalida").val(respuesta[0]["codigo"]);
	     		$("#id_productoS").val(respuesta[0]["id_producto"]);
	     		$("#idproductoe").val(respuesta[0]["id_producto"]);
	     		$("#nuevoAlmacen").val(valor);
	     		$("#nuevoAlmacenAux").val("Almacen " + valor);
	     		$("#almacenSalida").val(valor);
	     		$("#almacenSalidaAux").val("Almacen " + valor);
			}
		})
	})

	
	$(".tablaInventario tbody").on("click","button.btnEntradaProductoM",function()
	{
		var id_producto = $(this).attr("id_producto");
		console.log(id_producto);
		var valor = $("#almacenid").val();
		var datos  = new FormData();
		datos.append("id_producto",id_producto);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:"/ajax/inventario",
			method:"POST",
			data: datos,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(respuesta)
			{		
	     		$("#id_producto").val(respuesta[0]["id_producto"]);	     		
	     		$("#id_productoS").val(respuesta[0]["id_producto"]);
	     		$("#idproductoe").val(respuesta[0]["id_producto"]);
				$("#nuevoAlmacen").val(valor);
				$("#Almacen").val(valor);				 
	     		$("#nuevoAlmacenAux").val("Almacen " + valor);
	     		$("#almacenSalida").val(valor);
	     		$("#almacenSalidaAux").val("Almacen " + valor);
			}
		})
	})


	
}

$(".almacenInventario").change(function()
{
	var almacenId = $("#almacenid").val();
	var almacenRoot = $("#root1").val();
	mostrarTablaInventario(almacenId);
	localStorage.setItem("almacenActual", JSON.stringify(almacenId));
})

$(".almacenInventarioRoot").change(function()
{
	var almacenId = $("#almacenid").val();
	var almacenRoot = $("#root1").val();
	mostrarTablaInventario(almacenId);
	localStorage.setItem("almacenActual", JSON.stringify(almacenId));
	if (almacenId == almacenRoot)
	{
		$("#agregar").css("display", "block");
	}
	else
	{
		$("#agregar").css("display", "none");
	}
})

window.onload = function()
{
    if(localStorage.getItem("almacenActual") == null)
    {
		var almacenInventario = $('#almacenid').val();
		mostrarTablaInventario(almacenInventario);
		
	}
	else
	{
		var almacenStorage = $('#almacenid').val();
		//$("#almacen").val(almacenStorage);
		mostrarTablaInventario(almacenStorage);
	}		
   
};

$("#agregar").click(function()
{
	var valorAlmacen = $('#almacenid').val();
	console.log(valorAlmacen);
	$("#almacenAgregar1").val("Almacen" + valorAlmacen);
	$("#almacenAgregarid").val(valorAlmacen);
})



