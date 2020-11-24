$(".btnVolver").click(function(){
	window.location = "inventarios";

})

/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("capturarRango3") != null){

	$("#daterange-btn3 span").html(localStorage.getItem("capturarRango3"));


}else{

	$("#daterange-btn3 span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}

/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn3').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn3 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-M-D');

    var fechaFinal = end.format('YYYY-M-D');

    var capturarRango = $("#daterange-btn3 span").html();

    var almacen = $("#almacen").val();

    var perfil = $("#perfil").val();

   	localStorage.setItem("capturarRango3", capturarRango);
     var datos = new FormData();
     datos.append("fechaInicial", fechaInicial);
     datos.append("fechaFinal", fechaFinal);
     if (perfil == "Gerente General")
     {
       almacen='';
      datos.append("almacen", almacen);
      //  window.location = "/ajax/fechas/"+datos;
     }
     else
     {
       datos.append("almacen", almacen);
      //  window.location = "/ajax/fechas/"+datos;
     }
     $.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:"/ajax/Rango_fechas",
			method:"POST",
			data: datos,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(respuesta)
			{		
        // console.log("tamaño "+respuesta.length);
        var contenido='';
        var i=0;
        contenido+='<thead>';
                     contenido+='<tr>';
                         contenido+='<th style="width: 10px">#</th>';
                         contenido+='<th>Producto</th>';
                         contenido+='<th>Almacen</th>';
                        contenido+=' <th>Tipo de movimiento</th>';
                         contenido+='<th>Catidad</th>';
                         contenido+='<th>Usuario</th>';
                         contenido+='<th>Descripción</th>';
                         contenido+='<th>Hora</th>';
                         contenido+='<th>Fecha</th>';
                     contenido+='</tr>';
                    contenido+= '</thead>';
        for(var key=0; key<respuesta.length; key++) 
        {
          contenido+= '<tr>';
          contenido+= '<td>'+(key+1)+'</td>';
          contenido+='<td>'+respuesta[key]['producto']+'</td>';
          contenido+='<td>'+respuesta[key]["almacen"]+'</td>';
          contenido+='<td>'+respuesta[key]["tipo_movimiento"]+'</td>';
          contenido+='<td>'+respuesta[key]["cantidad"]+'</td>';
          contenido+='<td>'+respuesta[key]["usuario"]+'</td>';
          contenido+='<td>'+respuesta[key]["descripción"]+'</td>';
          contenido+='<td>'+respuesta[key]["hora"]+'</td>';
          contenido+='<td>'+respuesta[key]["fecha"]+'</td>';
          contenido+='</tr>'; 
        
        }
        $(".tablas").DataTable().clear().destroy(); 
        $(".tablas").html(contenido); 
        tabla();
	     	// window.location.reload();
			}
		})
    
    
   	

  })
function tabla(){
  $(".tablas").DataTable({
    "lengthMenu": [[20, 30, 50, -1], [20, 30, 50, "All"]],
       language: {
       sProcessing: "Procesando...",
       sLengthMenu: "Mostrar _MENU_ registros",
       sZeroRecords: "No se encontraron resultados",
       sEmptyTable: "Ningún dato disponible en esta tabla",
       sInfo:
           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
       sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
       sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
       sInfoPostFix: "",
       sSearch: "Buscar:",
       sUrl: "",
       sInfoThousands: ",",
       sLoadingRecords: "Cargando...",
       oPaginate: {
           sFirst: "Primero",
           sLast: "Último",
           sNext: "Siguiente",
           sPrevious: "Anterior",
       },
       oAria: {
           sSortAscending:
               ": Activar para ordenar la columna de manera ascendente",
           sSortDescending:
               ": Activar para ordenar la columna de manera descendente",
       },
       
       
       }
  });
}

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango3");
	localStorage.clear();
	window.location = "movimientos";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensright .ranges li").on("click", function(){


	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		var fechaInicial = año+"-"+mes+"-"+dia;

    var fechaFinal = año+"-"+mes+"-"+dia;

    localStorage.setItem("capturarRango3", "Hoy");

    var almacen = $("#almacen").val();

    var perfil = $("#perfil").val();

    var datos = new FormData();
    datos.append("fechaInicial", fechaInicial);
    datos.append("fechaFinal", fechaFinal);
    if (perfil == "Gerente General")
     {
       almacen='';
      datos.append("almacen", almacen);
      //  window.location = "/ajax/fechas/"+datos;
     }
     else
     {
       datos.append("almacen", almacen);
      //  window.location = "/ajax/fechas/"+datos;
     }
     $.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:"/ajax/Rango_fechas",
			method:"POST",
			data: datos,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(respuesta)
			{		
        // console.log("tamaño "+respuesta.length);
        var contenido='';
        var i=0;
        contenido+='<thead>';
                     contenido+='<tr>';
                         contenido+='<th style="width: 10px">#</th>';
                         contenido+='<th>Producto</th>';
                         contenido+='<th>Almacen</th>';
                        contenido+=' <th>Tipo de movimiento</th>';
                         contenido+='<th>Catidad</th>';
                         contenido+='<th>Usuario</th>';
                         contenido+='<th>Descripción</th>';
                         contenido+='<th>Hora</th>';
                         contenido+='<th>Fecha</th>';
                     contenido+='</tr>';
                    contenido+= '</thead>';
        for(var key=0; key<respuesta.length; key++) 
        {
          contenido+= '<tr>';
          contenido+= '<td>'+(key+1)+'</td>';
          contenido+='<td>'+respuesta[key]['producto']+'</td>';
          contenido+='<td>'+respuesta[key]["almacen"]+'</td>';
          contenido+='<td>'+respuesta[key]["tipo_movimiento"]+'</td>';
          contenido+='<td>'+respuesta[key]["cantidad"]+'</td>';
          contenido+='<td>'+respuesta[key]["usuario"]+'</td>';
          contenido+='<td>'+respuesta[key]["descripción"]+'</td>';
          contenido+='<td>'+respuesta[key]["hora"]+'</td>';
          contenido+='<td>'+respuesta[key]["fecha"]+'</td>';
          contenido+='</tr>'; 
        
        }
        $(".tablas").DataTable().clear().destroy(); 
        $(".tablas").html(contenido); 
        tabla();
	     	// window.location.reload();
			}
		})
    
	}

})

