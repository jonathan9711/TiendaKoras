<?php
require_once "conexion.php";
class ModeloApartados
{
	static public function mdlMostrarApartados($tabla,$item,$valor)
	{
		if ($item != null)
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor,PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt->fetch();
		}
		else
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
		}

		$stmt -> close();
		$stmt = null;
	}

	static public function mdlCrearApartado($tabla,$datos)
	{
		$link = new PDO("mysql:host=localhost;dbname=roarpos","root","");
		$stmt = $link->prepare("INSERT INTO $tabla(id_usuario,productos,id_cliente,id_almacen,cantidad,total,anticipo,fecha_realizacion,fecha_limite,comentario) VALUES (:id_usuario,:productos,:id_cliente,:id_almacen,:cantidad,:total,:anticipo,:fecha_realizacion,:fecha_limite,:comentario)");
		
		$stmt -> bindParam(":id_usuario", $datos["id_usuario"],PDO::PARAM_STR);
		$stmt -> bindParam(":productos", $datos["productos"],PDO::PARAM_STR);
		$stmt -> bindParam(":id_cliente", $datos["id_cliente"],PDO::PARAM_STR);
		$stmt -> bindParam(":id_usuario", $datos["id_usuario"],PDO::PARAM_STR);
		$stmt -> bindParam(":id_almacen", $datos["id_almacen"],PDO::PARAM_STR);
		$stmt -> bindParam(":cantidad", $datos["cantidad"],PDO::PARAM_STR);
		$stmt -> bindParam(":total", $datos["total"],PDO::PARAM_STR);
		$stmt -> bindParam(":anticipo", $datos["anticipo"],PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_realizacion", $datos["fecha_realizacion"],PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_limite", $datos["fecha_limite"],PDO::PARAM_STR);
		$stmt -> bindParam(":comentario", $datos["comentario"],PDO::PARAM_STR);

		if ($stmt->execute()) 
		{
			return $link->lastInsertId();
		}
		else
		{
			return "error";
		}
		$stmt->close();
    	$stmt = null;
	}

	static public function mdlEliminarApartado($tabla,$item,$valor)
	{
		$stmt= conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");
		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
		$stmt->close();
    	$stmt = null;
	}

	static public function mdlActualizarApartado($tabla, $item1, $valor1,$valor2)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_apartado = :id_apartado");
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id_apartado", $valor2, PDO::PARAM_STR);
		if($stmt -> execute())
		{
			return "ok";
		}
		else
		{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}
}