$("#nuevaCategoria").change(function()
{
	$(".alert").remove();
	var categoria = $(this).val();
	var datos = new FormData();
	datos.append("validarCategoria",categoria);
	$.ajax(
	{
		url: "ajax/categorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			if(respuesta)
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
		url: "ajax/categorias.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success:function(respuesta)
     	{
     		console.log(respuesta);
     		$("#editarCategoria").val(respuesta["categoria"]);
     		$("#idCategoria").val(respuesta["id"]);
     	}

	})
})

$(".btnEliminarCategoria").click(function()
{
	var idCategoria = $(this).attr("idCategoria");

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
			window.location = "index.php?ruta=categoria&idCategoria="+idCategoria;
		}
	})
})

