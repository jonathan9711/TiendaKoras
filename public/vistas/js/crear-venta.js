
$("#anticipo").focus(function()
{
	$(this).val("");
});

$("#anticipo").blur(function()
{
	if($(this).val() == "")
	{
		$(this).val("0");
	}
});


	
function mostrarTablaVenta(almacenVenta)
{
	
	var tablaVenta = $('.tablaVentas').DataTable(
	{ 
		
		"destroy":true,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"bFilter": true,
		"bLengthChange" : true,
		"lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
		"ajax":
		{
			url: "/ajax/dataTable-ventas", 
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: "POST",
			data:  {almacenVenta:almacenVenta}
			
		
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

	$(".tablaVentas tbody").on("click","button.agregarProducto", function()
	{
		
		var idProductoVenta = $(this).attr("idProducto");
		var almacenVenta = $('#almacenVenta').val();
		$(this).removeClass("btn-primary agregarProducto");
		$(this).addClass("btn-default");
		var datos = new FormData();
   		datos.append("idProductoVenta", idProductoVenta);
		datos.append("almacenVenta", almacenVenta);
		   
     	$.ajax({
			
			url: '/ajax/traerproducto',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
	      	method: "POST",
	      	data: datos,
	      	cache: false,
	      	contentType: false,
	      	processData: false,
	      	dataType:"json",
	      	success:function(respuesta)
	      	{
	      		var nombre = respuesta[0]["nombre"];
	          	var existencia = respuesta[0]["existencia"];
	          	var precio = respuesta[0]["precio_venta"];
	          	var idDproducto = respuesta[0]["id_producto"];

	          	if(existencia == 0)
	          	{
	      			swal({
				      title: "No hay existencia disponible",
				      type: "error",
				      confirmButtonText: "¡Cerrar!"
				    });

				    $("#button"+idProductoVenta).addClass("btn-primary agregarProducto");

				    return;
	          	}

	          	$(".nuevoProducto").append(

	          	'<div class="row" style="padding:5px 15px">'+

				  '<!-- Descripción del producto -->'+
		          
		          '<div class="col-xs-5" style="padding-right:0px">'+
		          
		            '<div class="input-group">'+
		              
		              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProductoVenta+'"><i class="fa fa-times"></i></button></span>'+

		              '<input type="text" class="form-control nuevoNombreProducto" idProducto="'+idDproducto+'" name="agregarProducto" value="'+nombre+'" readonly required>'+

		            '</div>'+

		          '</div>'+

		          '<!-- Cantidad del producto -->'+

		          '<div class="col-xs-1">'+
		            
		             '<h5>'+precio+'</h5>'+

		          '</div>' +

		          '<!-- Cantidad del producto -->'+

		          '<div class="col-xs-3">'+
		            
		             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" existencia="'+existencia+'" nuevaExistencia="'+Number(existencia-1)+'" required>'+

		          '</div>' +

		          '<!-- Precio del producto -->'+

		          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

		            '<div class="input-group">'+

		              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
		                 
		              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
		 
		            '</div>'+
		             
		          '</div>'+

		        '</div>') 

		        // SUMAR TOTAL DE PRECIOS
		        sumarTotalPrecios()
		        // AGREGAR IMPUESTO
		        agregarImpuesto()
		        // AGRUPAR PRODUCTOS EN FORMATO JSON
		        listarProductos()
		        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
		        $(".nuevoPrecioProducto").number(true, 2);
			
			
			},
			error: function(e) {
		  	console.log(e.responseText);
		},
	    })

	});

	$(".tablaVentas").on("draw.dt", function()
	{
		if(localStorage.getItem("quitarProducto") != null)
		{
			var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
			for(var i = 0; i < listaIdProductos.length; i++)
			{
				$("#button"+listaIdProductos[i]["idProducto"]).removeClass('btn-default');
				$("#button"+listaIdProductos[i]["idProducto"]).addClass('btn-primary agregarProducto');
			}
		}
	});

	localStorage.removeItem("quitarProducto");

	$(".formularioVenta").on("click", "button.quitarProducto", function()
	{
		$(this).parent().parent().parent().parent().remove();
		var idProducto = $(this).attr("idProducto");
		if (localStorage.getItem("listaDProductos")!=null) 
		{
			var local = localStorage.getItem("listaDProductos");
			var arreglo = JSON.parse(local)

			for (var i = 0; i < arreglo.length; i++) 
			{
				if (arreglo[i]['codigo'] == idProducto)
				{
					arreglo.splice(i,1);
				}
			}

			localStorage.removeItem("listaDProductos");

			if (arreglo.length!=0)
			{
				localStorage.setItem("listaDProductos", JSON.stringify(arreglo));
  			}
 		}

		$("#button"+idProducto).removeClass("btn-default");
		$("#button"+idProducto).addClass("btn-primary agregarProducto");

		if($(".nuevoProducto").children().length == 0)
		{
			$("#nuevoImpuestoVenta").val(16);
			$("#nuevoTotalVenta").html(0);
			$("#totalVenta").val(0);
			$("#nuevoTotalVenta").attr("total",0);
			$("#nuevoValorEfectivo").val(null);
			$("#nuevoCambioEfectivo").val(null);
		}
		else
		{
	     	sumarTotalPrecios();
	     	agregarImpuesto();
	     	listarProductos();
		}
	});

	/*=============================================
	MODIFICAR LA CANTIDAD
	=============================================*/

	$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function()
	{
		var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

		var precioFinal = $(this).val() * precio.attr("precioReal");
		
		precio.val(precioFinal);

		var nuevaExistencia = Number($(this).attr("existencia")) - $(this).val();
		
		$(this).attr("nuevaExistencia", nuevaExistencia);

		if (Number($(this).val()) > Number($(this).attr("existencia")))
		{
			$(this).val(1);
			swal({
				title: "La cantidad supera la existencia",
				text: "¡Solo hay "+$(this).attr("existencia")+" pares!",
				type: "error",
				confirmButtonText: "¡Cerrar!"
			});
		}
		sumarTotalPrecios();
		agregarImpuesto();
		listarProductos();
	});

	/*=============================================
	MODIFICAR LA CANTIDAD
	=============================================*/

	function sumarTotalPrecios()
	{
		var precioItem = $(".nuevoPrecioProducto");
		var arraySumaPrecio = [];

		for (var i = 0; i < precioItem.length; i++) 
		{
			arraySumaPrecio.push(Number($(precioItem[i]).val()));
		}
		
		function sumaArrayPrecios(total,numero)
		{
			return total + numero;
		}
		var sumaTotalPrecios = arraySumaPrecio.reduce(sumaArrayPrecios);
		$("#nuevoTotalVenta").html(sumaTotalPrecios);
		$("#totalVenta").val(sumaTotalPrecios);
		$("#nuevoTotalVenta").attr("total",sumaTotalPrecios);
	}

	/*=============================================
	Agregar impuesto
	=============================================*/

	function agregarImpuesto()
	{
		var precioTotal = $("#nuevoTotalVenta").attr("total");

		$("#nuevoTotalVenta").val(precioTotal);
		$("#nuevoPrecioImpuesto").val(precioTotal);
		$("#totalVenta").val(precioTotal);
		$("#nuevoPrecioNeto").val(precioTotal);
	}

	$("#nuevoImpuestoVenta").change(function(){
		agregarImpuesto();
	});
	//  PONER FORMATO AL PRECIO DE LOS PRODUCTOS
	// $("#nuevoTotalVenta").number(true, 2);

	$("#nuevoMetodoPago").change(function()
	{
		var metodo = $(this).val();
		
		if(metodo == "Efectivo")
		{

			$(this).parent().parent().removeClass("col-xs-6");

			$(this).parent().parent().addClass("col-xs-4");

			$(this).parent().parent().parent().children(".cajasMetodoPago").html(

				 '<div class="col-xs-4">'+ 

				 	'<div class="input-group">'+ 

				 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

				 		'<input type="text" class="form-control input-lg" id="nuevoValorEfectivo" placeholder="Efectivo" name="totalPayment" required>'+

				 	'</div>'+

				 '</div>'+

				 '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

				 	'<div class="input-group">'+

				 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

				 		'<input type="text" class="form-control input-lg" id="nuevoCambioEfectivo" placeholder="Cambio" readonly required>'+

				 	'</div>'+

				 '</div>'

			 )
			// Agregar formato al precio
			$('#nuevoValorEfectivo').number( true, 2);
	      	$('#nuevoCambioEfectivo').number( true, 2);
	      	// Listar método en la entrada
	      	listarMetodos()
		}
		else
		{
			$(this).parent().parent().removeClass('col-xs-4');
			$(this).parent().parent().addClass('col-xs-6');
    		$(this).parent().parent().parent().children('.cajasMetodoPago').html(

			 	'<div class="col-xs-6" style="padding-left:0px">'+
	                        
	                '<div class="input-group">'+
	                     
	                  '<input type="number" min="0" class="form-control input-lg" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
	                       
	                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
	                  
	                '</div>'+

	              '</div>')
		}
	});

	$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function()
	{
		var efectivo = $(this).val();
		if (Number(efectivo) < Number($('#totalVenta').val())) 
		{
			swal({

				title: "El efectivo es menor al total",
				text: "¡Favor de capturar bien el efectivo!",
				type: "error",
				confirmButtonText: "¡Cerrar!"
			});
			$("#nuevoValorEfectivo").val(null);
	    }
		else
		{
			var cambio =  Number(efectivo) - Number($('#totalVenta').val());
			var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');
			nuevoCambioEfectivo.val(cambio);
		    nuevoCambioEfectivo.number(true, 2);
		}
	});

	$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){
	     listarMetodos()
	});

	$(".apartar").click(function()
	{
		var mywindow = window.location.replace('/panel/crear-apartado');
	})

	
}


function nuevaCantidadProducto()
{
	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	var precioFinal = $(this).val() * precio.attr("precioReal");
	precio.val(precioFinal);
	var nuevaExistencia = Number($(this).attr("existencia")) - $(this).val();
	$(this).attr("nuevaExistencia", nuevaExistencia);
	if (Number($(this).val()) > Number($(this).attr("existencia")))
	{
		$(this).val(1);
		swal({
			title: "La cantidad supera la existencia",
			text: "¡Solo hay "+$(this).attr("existencia")+" pares!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});
	}
	sumarTotalPrecios();
	agregarImpuesto();
	listarProductos();
}

window.onload = function()
{
	
   var almacenVenta = $('#almacenVenta').val();
   listarProductos();
   listarMetodos();
   
   mostrarTablaVenta(almacenVenta);
};

function listarProductos()
{
	var listaProductos =[];
	var descripcion = $(".nuevoNombreProducto");
	var cantidad = $(".nuevaCantidadProducto");
	var precio = $(".nuevoPrecioProducto");

	for(var i=0; i<descripcion.length; i++)
	{
		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "existencia" : $(cantidad[i]).attr("nuevaExistencia"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()});
	}

	$("#listaProductos").val(JSON.stringify(listaProductos));  
	$("#listaMetodoPago").val("Efectivo");
}

function listarMetodos()
{
	var listaMetodos = "";

	if($("#nuevoMetodoPago").val() == "Efectivo")
	{
		$("#listaMetodoPago").val("Efectivo");
	}
	else
	{
		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());
	}
}


