<?php

	require_once "conexion.php";

	class modeloUsuarios
	{
		static public function mdlMostrarUsuarios($tabla,$item,$valor)
		{
			if ($item != null)
			{
				$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt -> bindParam(":".$item,$valor,PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
			}
			else
			{
				$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla");
				$stmt -> execute();
				return $stmt -> fetchAll();
			}
			$stmt -> close();
			$stmt = null;
		}

		static public function mdlMostrarUsuariosAlmacen($tabla,$item,$valor)
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla where almacen = :valor");
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt -> close();
			$stmt = null;
		}

		
		static public function mdlIngresarUsuario($tabla,$datos)
		{
			$stmt = conexion::conectar()->prepare("INSERT INTO $tabla(nombre,usuario,password,perfil,foto,almacen) VALUES (:nombre,:usuario,:password,:perfil,:foto,:almacen)");

			$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
			$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
			$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
			$stmt->bindParam(":almacen", $datos["almacen"], PDO::PARAM_STR);

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
		static public function mdlEditarUsuario($tabla,$datos)
		{
			$stmt = conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto=:foto, almacen = :almacen where usuario = :usuario");

			$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
			$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
			$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
			$stmt->bindParam(":almacen",$datos["almacen"],PDO::PARAM_STR);

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
		
	

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

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

	static public function mdlBorrarUsuario($tabla,$datos)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id=:id");
		$stmt -> bindParam(":id",$datos,PDO::PARAM_INT);

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

	static public function mdlMostrarUsuariosMenosUno($tabla,$dato,$almacen)
	{
		if ($almacen != "todos")
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE perfil <> :dato and almacen = :almacen");
			$stmt->bindParam(":dato",$dato,PDO::PARAM_STR);
			$stmt->bindParam(":almacen",$almacen,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		else
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE perfil <> :dato");
			$stmt->bindParam(":dato",$dato,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		
		$stmt->close();
		$stmt=null;
	}

}
?>

