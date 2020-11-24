/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("capturarRango2") != null){

	$("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));


}else{

	$("#daterange-btn2 span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}

/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn2').daterangepicker(
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
    $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-M-D');

    var fechaFinal = end.format('YYYY-M-D');

    var capturarRango = $("#daterange-btn2 span").html();
    var almacen = $("#almacenes").val();
   	localStorage.setItem("capturarRango2", capturarRango);
    var datos = new FormData();
    datos.append("fechaInicial", fechaInicial);
    datos.append("fechaFinal", fechaFinal);
    datos.append("almacen", almacen);
    
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url:"/ajax/Rango_fechas_grafico",
      method:"POST",
      data: datos,
      cache:false,
      contentType:false,
      processData:false,
      dataType:"json",
      success:function(respuesta)
      {
        $("#line-chart-ventas").empty();
        Morris.Line({
          element          : 'line-chart-ventas',
          resize           : true,
          data             : [respuesta],
          xkey             : 'y',
          ykeys            : ['ventas'],
          labels           : ['ventas'],
          lineColors       : ['#efefef'],
          lineWidth        : 2,
          hideHover        : 'auto',
          gridTextColor    : '#fff',
          gridStrokeWidth  : 0.4,
          pointSize        : 4,
          pointStrokeColors: ['#efefef'],
          gridLineColor    : '#efefef',
          gridTextFamily   : 'Open Sans',
          preUnits         : '$',
          gridTextSize     : 10
        });

          // window.location.replace(respuesta);
      }
		})
    //  window.location = "admin.reportes.grafico-ventas"+fechaInicial+"&fechaFinal="+fechaFinal;

  })


/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango2");
	localStorage.clear();
	window.location = "reportes";
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

    	localStorage.setItem("capturarRango2", "Hoy");

    	// window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})

