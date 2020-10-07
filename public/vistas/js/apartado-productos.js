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
	var datos = new FormData();
	datos.append("idApartado", idApartado);
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
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:"/ajax/liquidar-apartado",
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
					}else{
						window.location="/panel/apartados";
					}			
				}
			});
			// window.location="index.php?ruta=apartados&ApartadoId="+idApartado;
		}
	})
})