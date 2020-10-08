<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use \PDO;
use App\conexion;
require_once "conexion.php";

class cliente extends Model 
{

    protected $table = 'cliente';

    protected $fillable=[
        'nombre', 'apellido','direccion', 'RFC', 'ciudad', 'email', 'password', 'telefono'
    ];
    public function apartados(){
        return $this->hasMany(apartado::class);
    }

    public function venta(){
        return $this->hasMany(venta::class);
    }
    ///admin
    // static public function mdlCrearCliente($tabla,$datos)
	// {
	// 	$stmt = conexion::conectar()->prepare("INSERT INTO $tabla(nombre,apellido,direccion,RFC,ciudad,email,telefono) VALUES (:nombre,:apellido,:direccion,:RFC,:ciudad,:email,:telefono)");

	// 	$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
	// 	$stmt->bindParam(":apellido",$datos["apellidos"],PDO::PARAM_STR);
	// 	$stmt->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
	// 	$stmt->bindParam(":RFC",$datos["RFC"],PDO::PARAM_STR);
	// 	$stmt->bindParam(":ciudad",$datos["ciudad"],PDO::PARAM_STR);
	// 	$stmt->bindParam(":email",$datos["email"],PDO::PARAM_STR);
	// 	$stmt->bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);

	// 	if ($stmt->execute())
	// 	{
	// 		return "ok";
	// 	}
	// 	else
	// 	{
	// 		return "error";
	// 	}

	// 	$stmt->close();
	// 	$stmt=null;
	// }

	// static public function mdlMostrarClientes($tabla,$item,$valor)
	// {
	// 	if ($item!=null)
	// 	{
	// 		// $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
	// 		// $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
	// 		// $stmt->execute();
	// 		$stmt=cliente::where($item,$valor);
	// 		return $stmt;
	// 	}
	// 	else
	// 	{
	// 		// $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla");
	// 		// $stmt->execute();
	// 		$stmt=cliente::all();
	// 		return $stmt;

	// 	}	
	// 	$stmt->close();
	// 	$stmt=null;
	// }
	// static public function mdlEditarCliente($tabla,$datos)
	// {
	// 	$stmt = conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido = :apellido, direccion = :direccion, RFC = :RFC, ciudad = :ciudad, email = :email, telefono = :telefono where id_cliente = :id");

	// 	$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
	// 	$stmt->bindParam(":apellido",$datos["apellido"],PDO::PARAM_STR);
	// 	$stmt->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
	// 	$stmt->bindParam(":RFC",$datos["RFC"],PDO::PARAM_STR);
	// 	$stmt->bindParam(":ciudad",$datos["ciudad"],PDO::PARAM_STR);
	// 	$stmt->bindParam(":email",$datos["email"],PDO::PARAM_STR);
	// 	$stmt->bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
	// 	$stmt->bindParam(":id",$datos["id"],PDO::PARAM_STR);

	// 	if ($stmt->execute())
	// 	{
	// 		return "ok";
	// 	}
	// 	else
	// 	{
	// 		return "error";
	// 	}

	// 	$stmt->close();
	// 	$stmt=null;

	// }

	// static public function mdlBorrarCliente($tabla,$dato)
	// {
	// 	$stmt = conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cliente = :id");
	// 	$stmt -> bindParam(":id",$dato,PDO::PARAM_INT);
	// 	if ($stmt->execute())
	// 	{
	// 		return "ok";
	// 	}
	// 	else
	// 	{
	// 		return "error";
	// 	}
	// 	$stmt->close();
	// 	$stmt=null;
	// }

	// static public function mdlActualizarCliente($tabla, $item1, $valor1,$valor2)
	// {

	// 	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_cliente = :id_cliente");

	// 	$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
	// 	$stmt -> bindParam(":id_cliente", $valor2, PDO::PARAM_STR);

	// 	if($stmt -> execute())
	// 	{

	// 		return "ok";
		
	// 	}
	// 	else
	// 	{

	// 		return "error";	

	// 	}

	// 	$stmt -> close();

	// 	$stmt = null;

	// }
}
