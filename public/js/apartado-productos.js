$(".btnEliminarApartado").click(function(){
	var idApartado = $(this).attr("idApartado");
	console.log("idApartado",idApartado);
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
			window.location="index.php?ruta=apartado-productos&idApartado="+idApartado;
		}
	})	
})

$(".btnVender").click(function()
{
	var idApartado = $(this).attr("idApartado");
	swal({
		title: '¿Quiere liquidar esta venta?',
		text: "¡si no es asi puede cancelar!",
		type: 'info',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'cancelar',
		confirmButtonText: 'Si, Liquidar'
	}).then((result)=>
	{
		if (result.value)
		{
			window.location="index.php?ruta=apartados&ApartadoId="+idApartado;
		}
	})
})