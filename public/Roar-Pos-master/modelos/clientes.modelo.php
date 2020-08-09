<?php

require_once "conexion.php";

class modeloClientes
{
	static public function mdlCrearCliente($tabla,$datos)
	{
		$stmt = conexion::conectar()->prepare("INSERT INTO $tabla(nombre,apellido,direccion,RFC,ciudad,email,telefono) VALUES (:nombre,:apellido,:direccion,:RFC,:ciudad,:email,:telefono)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellido",$datos["apellidos"],PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
		$stmt->bindParam(":RFC",$datos["RFC"],PDO::PARAM_STR);
		$stmt->bindParam(":ciudad",$datos["ciudad"],PDO::PARAM_STR);
		$stmt->bindParam(":email",$datos["email"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);

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

	static public function mdlMostrarClientes($tabla,$item,$valor)
	{
		if ($item!=null)
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		}
		else
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();

		}	
		$stmt->close();
		$stmt=null;
	}
	static public function mdlEditarCliente($tabla,$datos)
	{
		$stmt = conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido = :apellido, direccion = :direccion, RFC = :RFC, ciudad = :ciudad, email = :email, telefono = :telefono where id_cliente = :id");

		$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":apellido",$datos["apellido"],PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
		$stmt->bindParam(":RFC",$datos["RFC"],PDO::PARAM_STR);
		$stmt->bindParam(":ciudad",$datos["ciudad"],PDO::PARAM_STR);
		$stmt->bindParam(":email",$datos["email"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
		$stmt->bindParam(":id",$datos["id"],PDO::PARAM_STR);

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

	static public function mdlBorrarCliente($tabla,$dato)
	{
		$stmt = conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cliente = :id");
		$stmt -> bindParam(":id",$dato,PDO::PARAM_INT);
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

	static public function mdlActualizarCliente($tabla, $item1, $valor1,$valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_cliente = :id_cliente");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id_cliente", $valor2, PDO::PARAM_STR);

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