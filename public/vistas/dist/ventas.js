var table2 = $('.tablaVentas').DataTable({

	"ajax":"ajax/datatable-ventas.ajax.php",
	"columnDefs": [

		{
			"targets": -6,
			 "data": null,
			 "defaultContent": '<img class="img-thumbnail imgTablaVenta" width="40px">'

		},


		{
			"targets": -2,
			 "data": null,
			 "defaultContent": '<div class="btn-group"><button class="btn btn-success limiteExistencia"></button></div>'

		},

		{
			"targets": -1,
			 "data": null,
			 "defaultContent": '<div class="btn-group"><button class="btn btn-primary agregarProducto recuperarBoton" idModelo>Agregar</button></div>'

		}

	],

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

$(".tablaVentas tbody").on( 'click', 'button.agregarProducto', function () {

	var data = table2.row( $(this).parents('tr') ).data();

	$(this).attr("idModelo",data[6]);

})

/*=============================================
FUNCIÓN PARA CARGAR LAS IMÁGENES CON EL PAGINADOR Y EL FILTRO
=============================================*/

function cargarImagenesProductos()
{
	 var imgTabla = $(".imgTablaVenta");
	 var limiteExistencia = $(".limiteExistencia");
	 for(var i = 0; i < imgTabla.length; i ++)
	 {
	    var data = table2.row( $(imgTabla[i]).parents('tr') ).data();
	    
	    $(imgTabla[i]).attr("src",data[1]);

	    if(data[5] <= 10)
	    {
	    	if (data[5] == 10) 
	    	{
	    		$(limiteExistencia[i]).addClass("btn-danger");
         	    $(limiteExistencia[i]).html(data[5]);
	    	}
	    	else
	    	{
	    		$(limiteExistencia[i]).addClass("btn-danger");
         	    $(limiteExistencia[i]).html("0"+data[5]);
	    	}
	    }
	    else if(data[5] > 11 && data[5] <= 15)
	    {
	    	$(limiteExistencia[i]).addClass("btn-warning");
	    	$(limiteExistencia[i]).html(data[5]);
        } 
        else
        {
	    	$(limiteExistencia[i]).addClass("btn-success");
	    	$(limiteExistencia[i]).html(data[5]);
	    }
  	}
}

setTimeout(function()
{

  cargarImagenesProductos()

},300);

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL PAGINADOR
=============================================*/

$(".dataTables_paginate").click(function(){

	cargarImagenesProductos()
})

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL BUSCADOR
=============================================*/
$("input[aria-controls='DataTables_Table_0']").focus(function(){

	$(document).keyup(function(event){

		event.preventDefault();

		cargarImagenesProductos()

	})


})

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL FILTRO DE CANTIDAD
=============================================*/

$("select[name='DataTables_Table_0_length']").change(function(){

	cargarImagenesProductos()

})

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL FILTRO DE ORDENAR
=============================================*/

$(".sorting").click(function(){

	cargarImagenesProductos()

})

$(".tablaVentas tbody").on("click","button.agregarProducto", function(){

	var idModelo = $(this).attr("idModelo");

	$(this).removeClass("btn-primary agregarProducto");
	$(this).addClass("btn-default");

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
	
			var existencia = respuesta["existencia"];
			var idProducto = respuesta["id_producto"];
	     	var datos = new FormData();
			datos.append("idProducto",idProducto);
			$.ajax({
				url: "ajax/productos.ajax.php",
			    method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta2)
				{
					var precio = respuesta2["precio_venta"];
					var descripcion = respuesta2["descripcion"];
					$(".nuevoProducto").append(

			          	'<div class="row" style="padding:5px 15px">'+

						  '<!-- Descripción del producto -->'+
				          
				          '<div class="col-xs-6" style="padding-right:0px">'+
				          
				            '<div class="input-group">'+
				              
				              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idModelo="'+idModelo+'"><i class="fa fa-times"></i></button></span>'+

				              '<input type="text" class="form-control nuevaDescripcionProducto" idModelo="'+idModelo+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+

				            '</div>'+

				          '</div>'+

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
				        sumarTotalPrecios(); 
				        agregarImpuesto();	
				        listarProductos();
				        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
	                    $(".nuevoPrecioProducto").number(true, 2);
				}

		    });

		}

	});
})

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();
	var idModelo = $(this).attr("idModelo");
	$("button.recuperarBoton[idModelo='"+idModelo+"']").removeClass("btn-default");
	$("button.recuperarBoton[idModelo='"+idModelo+"']").addClass("btn-primary agregarProducto");

	if($(".nuevoProducto").children().length == 0)
	{
		$("#nuevoImpuestoVenta").val(16);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);
	}
	else
	{
     	sumarTotalPrecios();
     	agregarImpuesto();
     	listarProductos();
	}
})

//boton para dispositivos

$(".btnAgregarProducto").click(function()
{
	var datos = new FormData();
	datos.append("traerProductos","ok");
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
			$(".nuevoProducto").append(

			  	'<div class="row" style="padding:5px 15px">'+

			    '<!-- Descripción del producto -->'+
				      
			       '<div class="col-xs-6" style="padding-right:0px">'+
						         
				       '<div class="input-group">'+
						              
				            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idModelo><i class="fa fa-times"></i></button></span>'+

				                '<select class="form-control nuevaDescripcionProducto"  idModelo name="nuevaDescripcionProducto" required>'+
					                '<option value >Seleccione Modelo</option>'+
				                '</select>'+

		 				'</div>'+

				    '</div>'+
			   '<!-- Cantidad del producto -->'+
			        '<div class="col-xs-3 ingresoCantidad">'+
				            
		                '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" existencia nuevaExistencia required>'+

		            '</div>' +

			    '<!-- Precio del producto -->'+

			        '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

			            '<div class="input-group">'+

			              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
		             
			              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" value readonly required>'+
					 
			            '</div>'+
				             
         	        '</div>'+
 
		    '</div>');

			respuesta.forEach(funcionForEach);

			function funcionForEach(item, index)
			{
			    $(".nuevaDescripcionProducto").append(
					'<option idModelo="'+item.id_modelo+'" value="'+item.modelo+'">'+item.modelo+'</option>'
	   			)
     		}
     		sumarTotalPrecios();
     		agregarImpuesto();
     		
     		// PONER FORMATO AL PRECIO DE LOS PRODUCTOS
	        $(".nuevoPrecioProducto").number(true, 2);
     	}

	})
})


$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function()
{
	var modelo = $(this).val();
	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
	var datos = new FormData();
	datos.append("modelo",modelo);
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
			$(nuevaCantidadProducto).attr("existencia",respuesta["existencia"]);
			$(nuevaCantidadProducto).attr("nuevaExistencia", Number(respuesta["existencia"])-1);
			$(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);
			var idProducto = respuesta["id_producto"];
			var datos = new FormData();
			datos.append("idProducto",idProducto);
			$.ajax({
				url: "ajax/productos.ajax.php",
			    method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta2)
				{
					var precio = respuesta2["precio_venta"];
					$(nuevoPrecioProducto).val(precio);
				}
			})
			listarProductos();
		}
	})

})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);

	var nuevaExistencia = Number($(this).attr("existencia")) - $(this).val();
	
	console.log("nueva existencia", nuevaExistencia);

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
})

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
	$("#nuevoTotalVenta").val(sumaTotalPrecios);
	$("#totalVenta").val(sumaTotalPrecios);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecios);
}

/*=============================================
Agregar impuesto
=============================================*/

function agregarImpuesto()
{
	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto /100);
	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

	$("#nuevoTotalVenta").val(totalConImpuesto);
	$("#nuevoPrecioImpuesto").val(precioImpuesto);
	$("#totalVenta").val(totalConImpuesto);
	$("#nuevoPrecioNeto").val(precioTotal);
}

$("#nuevoImpuestoVenta").change(function(){
	agregarImpuesto();
})

 // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
$("#nuevoTotalVenta").number(true, 2);


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

			 		'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="Efectivo" required>'+

			 	'</div>'+

			 '</div>'+

			 '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+

			 	'<div class="input-group">'+

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

			 		'<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="Cambio" readonly required>'+

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
                     
                  '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

              '</div>')
	}
})

$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();
	if (Number(efectivo) < Number($('#nuevoTotalVenta').val())) 
	{
		swal({

			title: "El efectivo es menor al total",
			text: "¡Favor de capturar bien el efectivo!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		
		});
		
	}
	else
	{
		var cambio =  Number(efectivo) - Number($('#nuevoTotalVenta').val());

		var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

		nuevoCambioEfectivo.val(cambio);
	}
})

$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){

	// Listar método en la entrada
     listarMetodos()


})


function listarProductos()
{
	var listaProductos =[];
	var descripcion = $(".nuevaDescripcionProducto");
	var cantidad = $(".nuevaCantidadProducto");
	var precio = $(".nuevoPrecioProducto");

	for(var i=0; i<descripcion.length; i++)
	{
		listaProductos.push({ "id" : $(descripcion[i]).attr("idModelo"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "existencia" : $(cantidad[i]).attr("nuevaExistencia"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()});
	}

	$("#listaProductos").val(JSON.stringify(listaProductos));  
	console.log("lista productos", $("#listaProductos").val());
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

$(".btnEditarVenta").click(function(){

	var idVenta = $(this).attr("idVenta");
	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;

})
