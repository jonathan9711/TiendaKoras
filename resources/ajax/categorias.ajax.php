
<?php



require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class ajaxCategorias 
{
	public $validarCategoria;

	public function ajaxValidarCategoria()
	{
		$item = "categoria";
		$valor = $this->validarCategoria;
		$respuesta = ControladorCategorias::ctrMostrarCategorias($item,$valor);
		echo json_encode($respuesta); 
	}

	public $idCategoria;

	public function ajaxEditarCategoria()
	{

		$item = "id";
		$valor = $this->idCategoria;
		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);
		echo json_encode($respuesta);

	}

}

if (isset($_POST["validarCategoria"])) 
{
	$valCategoria = new ajaxCategorias();
	$valCategoria -> validarCategoria = $_POST["validarCategoria"];
	$valCategoria -> ajaxValidarCategoria();
}

if(isset($_POST["idCategoria"]))
{
	$categoria = new AjaxCategorias();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditarCategoria();
}


