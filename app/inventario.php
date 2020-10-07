<?php

namespace App;
use App\producto;
use \PDO;
use App\conexion;
require_once "conexion.php";
use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    protected $table = 'inventario';
    protected $fillabel = [
    	"id_producto",
    	"id_almacen",
        
    ];

    public function product(){
        return $this->belongsTo(producto::class,'id_producto','id_producto');
    }
   
    
    public function almacen(){
        return $this->belongsTo(almacen::class,'id_almacen');
    }

    //admin
    static public function mdlAgregarInventario($tabla,$datos)
	{
		$stmt = conexion::conectar()->prepare("INSERT INTO $tabla(id_producto,id_almacen,existencia) VALUES (:id_producto,:id_almacen,:existencia)");

		$stmt -> bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_almacen",$datos["id_almacen"],PDO::PARAM_STR);
		$stmt -> bindParam(":existencia",$datos["cantidad"],PDO::PARAM_STR);
		
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

	static public function mdlActualizarCantidad($tabla,$suma,$valor1,$valor2)
	{
		$stmt = conexion::conectar()->prepare("UPDATE $tabla SET existencia = :existencia WHERE id_producto = :id_producto and id_almacen = :id_almacen");
		$stmt->bindParam(":existencia",$suma,PDO::PARAM_INT);
		$stmt->bindParam(":id_producto",$valor1,PDO::PARAM_STR);
		$stmt->bindParam(":id_almacen",$valor2,PDO::PARAM_STR);

		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
		$stmt -> close();
		$stmt=null;
	}

	static public function mdlBorrarInventario($tabla,$dato)
	{
		$stmt = conexion::conectar()->prepare("DELETE FROM 	$tabla WHERE id_producto = :id_producto AND id_almacen = :id_almacen");
		$stmt->bindParam(":id_producto",$dato,PDO::PARAM_INT);
		$stmt->bindParam(":id_almacen",$dato,PDO::PARAM_INT);
		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
	}

	static public function mdlEditarInventario($tabla,$datos)
	{
		$stmt = conexion::conectar()->prepare("UPDATE $tabla SET existencia = :existencia WHERE id_producto = :id_producto");

		$stmt->bindParam(":existencia",$datos["existencia"],PDO::PARAM_STR);
		
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

	static public function mdlVerificarInventario($tabla,$producto,$almacen)
	{
		$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_producto = :producto and id_almacen = :almacen");
		$stmt->bindParam(":producto",$producto,PDO::PARAM_STR);
		$stmt->bindParam(":almacen",$almacen,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
		$stmt = null;
	}

	static public function mdlMostrarInventario($tabla,$item,$valor,$almacen)
	{
		if ($item != null)
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor and id_almacen = :almacen");
			$stmt->bindParam(":valor",$valor,PDO::PARAM_STR);
			$stmt->bindParam(":almacen",$almacen,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
			$stmt->close();
			$stmt=null;
		}
		else
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_almacen = :almacen");
			$stmt->bindParam(":almacen",$almacen,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
			$stmt=null;
		}
	
	}
 
 	static public function mdlMostrarTodo($tabla)
	{
		$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
		$stmt=null;
	}


	static public function mdlMostrar($tabla,$item,$valor,$almacen)
	{
		$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and id_almacen = :almacen");

		$stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
		$stmt->bindParam(":almacen",$almacen,PDO::PARAM_STR);
		
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt=null;
	}

	static public function mdlActualizarInventario($tabla, $item1, $valor1,$valor2,$almacen)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_producto = :id_producto and id_almacen = :id_almacen");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id_producto", $valor2, PDO::PARAM_STR);
		$stmt -> bindParam(":id_almacen", $almacen, PDO::PARAM_STR);
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

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/	

	static public function mdlMostrarSumaVentas($tabla,$almacen)
	{
		if ($almacen != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT SUM(venta) as total FROM $tabla where id_almacen = :almacen");
			$stmt -> bindParam(":almacen", $almacen, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt -> close();
			$stmt = null;
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT SUM(venta) as total FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt -> close();
			$stmt = null;
		}
	}
}
