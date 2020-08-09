<?php
require_once "conexion.php";

class ModeloAlmacen
{
	static public function mdlGetNombreAlmacen($tabla,$valor)
	{
		$stmt=conexion::conectar()->prepare("SELECT nombre from $tabla where id_almacen = :id_almacen");
		$stmt->bindParam(":id_almacen",$valor,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
		$stmt=null;
	}

	static public function mdlMostrarAlmacen($tabla,$item,$valor)
	{
		if ($item!=null)
		{
			$stmt=conexion::conectar()->prepare("SELECT * from $tabla where $item = :valor");
			$stmt->bindParam(":valor",$valor,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		}
		else
		{
			$stmt=conexion::conectar()->prepare("SELECT * from $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		$stmt->close();
		$stmt=null;
	}

	static public function mdlEditarAlmacen($tabla,$datos)
	{
		$stmt=conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre,  ubicacion=:ubicacion where id_almacen = :id_almacen");
		$stmt->bindParam(":nombre",$datos["nombreAlmacen"],PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion",$datos["ubicacion"],PDO::PARAM_STR);
		$stmt->bindParam(":id_almacen",$datos["id_almacen"],PDO::PARAM_STR);

		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
		;
		$stmt->close();
		$stmt=null;
	}

	static public function mdlActualizarAlmacen($tabla,$item1,$valor1,$item2,$valor2)
	{
		$stmt=conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1 where $item2 = :valor2");

		$stmt->bindParam(":valor1",$valor1,PDO::PARAM_STR);
		$stmt->bindParam(":valor2",$valor2,PDO::PARAM_STR);
		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
		;
		$stmt->close();
		$stmt=null;
	}

	static public function mdlAgregarAlmacen($tabla,$datos)
	{
		$stmt = conexion::conectar()->prepare("INSERT into $tabla(nombre,ubicacion,estado) values(:nombre,:ubicacion,:estado);");
		$stmt->bindParam(":nombre",$datos["nombreAlmacen"],PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion",$datos["ubicacion"],PDO::PARAM_STR);
		$stmt->bindParam(":estado",$datos["estadoInicial"],PDO::PARAM_STR);
		
		if ($stmt->execute())
		{
			return "ok";			
		}
		else
		{
			return "error";
		}
		$stmt->close();
		$stmt=null;
	}

	static public function mdlEliminarAlmacen($tabla,$idAlmacen)
	{
		$stmt = conexion::conectar()->prepare("DELETE from $tabla where id_almacen = :id_almacen;");
		$stmt->bindParam(":id_almacen",$idAlmacen,PDO::PARAM_STR);
	
		if ($stmt->execute())
		{
			return "ok";			
		}
		else
		{
			return "error";
		}
		$stmt->close();
		$stmt=null;
	}

}