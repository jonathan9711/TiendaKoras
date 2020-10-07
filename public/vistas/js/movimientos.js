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
      window.location = "/ajax/fechas/"+datos;
    }
    else
    {
      datos.append("almacen", almacen);
      window.location = "/ajax/fechas/"+datos;
    }
   	

  })


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
      window.location = "/ajax/fechas/"+datos;
    }
    else
    {
      datos.append("almacen", almacen);
      window.location = "/ajax/fechas/"+datos;
    }
	}

})

