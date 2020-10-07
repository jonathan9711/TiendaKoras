$("#nuevaCategoria").change(function()
{
	$(".alert").remove();
	var categoria = $(this).val();
	var datos = new FormData();
	datos.append("categoria",categoria);
	$.ajax(
	{
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: "/ajax/nombre-categorias",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			if(respuesta==1)
			{
				$("#nuevaCategoria").parent().after('<div class="alert alert-warning">La categoria ya existe en nuestra base de datos</div>')
				$("#nuevaCategoria").val("");
				
			}
		}
	})

})

$(".btnEditarCategoria").click(function()
{
	var idCategoria = $(this).attr("idCategoria");
	var datos = new FormData();
	datos.append("idCategoria", idCategoria);
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: "/ajax/editar-categoria",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success:function(respuesta)
     	{
     		// console.log(respuesta);
     		$("#editarCategoria").val(respuesta[0]["categoria"]);
     		$("#idCategoria").val(respuesta[0]["id"]);
     	}

	})
})

$(".btnEliminarCategoria").click(function()
{
	var idCategoria = $(this).attr("idCategoria");
	var datos = new FormData();
	datos.append("id_categoria", idCategoria);
	swal({
		title: 'Esta seguro de borrar la categoria?',
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
				url:"/ajax/borrar-categoria",
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
			// window.location = "index.php?ruta=categoria&idCategoria="+idCategoria;
		}
	})
})

