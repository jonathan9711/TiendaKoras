<?php

namespace App;
use \PDO;
use App\conexion;
require_once "conexion.php";
use Illuminate\Database\Eloquent\Model;

class Movimientos extends Model
{

	protected $table = 'movimientos_inventario';

    public function producto(){
        return $this->belongsTo(producto::class,'id_producto');
    }
    
    public function almacen(){
        return $this->belongsTo(almacen::class,'id_almacen');
    }

    public function usuario(){
        return $this->belongsTo(usuarios::class,'id_usuario');
    }
    

    static public function mdlAgregarMovimiento($tabla,$datos)
	{
		$stmt = conexion::conectar()->prepare("INSERT INTO $tabla (id_producto,id_almacen,tipo_movimiento,cantidad,id_usuario,descripción,hora,fecha) VALUES
			(:id_producto,:id_almacen,:tipo_movimiento,:cantidad,:id_usuario,:descripcion,:hora,:fecha)");

		$stmt->bindParam(":id_producto",$datos["id_producto"],PDO::PARAM_STR);
		$stmt->bindParam(":id_almacen",$datos["id_almacen"],PDO::PARAM_STR);
		$stmt->bindParam(":tipo_movimiento",$datos["tipo_movimiento"],PDO::PARAM_STR);
		$stmt->bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario",$datos["id_usuario"],PDO::PARAM_STR);
		$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
		$stmt->bindParam(":hora",$datos["hora"],PDO::PARAM_STR);
		$stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);

		if($stmt->execute())
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

	static public function mdlRangoFechasMovimientos($tabla,$fechaInicio,$fechaFin)
	{
		$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla where fecha BETWEEN :fechaInicio AND :fechaFin");
		$stmt->bindParam(":fechaInicio",$fechaInicio,PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin",$fechaFin,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	   	$stmt->close();
		$stmt=null;
	}

	static public function mdlRangoFechasMovimientosProducto($tabla,$fechaInicio,$fechaFin,$id_producto,$almacen)
	{
		$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla where id_almacen = :almacen and id_producto = :id_producto and fecha BETWEEN :fechaInicio AND :fechaFin");
		
		$stmt->bindParam(":fechaInicio",$fechaInicio,PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin",$fechaFin,PDO::PARAM_STR);
		$stmt->bindParam(":id_producto",$id_producto,PDO::PARAM_STR);
		$stmt->bindParam(":almacen",$almacen,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	   	$stmt->close();
		$stmt=null;
	}

	static public function verMovimientos($tabla,$almacen)
	{
		if ($almacen != null)
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla where id_almacen = :almacen");
			$stmt -> bindParam(":almacen",$almacen,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
			$stmt=null;
		}
		else
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
			$stmt=null;
		}

	}

	static public function mdlMostrarMovimientos($tabla,$fechaInicial,$fechaFinal,$almacen)
	{
		if ($almacen == null)
		{
			if($fechaInicial == null)
			{
				$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha ASC");
				$stmt -> execute();
				return $stmt -> fetchAll();	
			}
			else if($fechaInicial == $fechaFinal)
			{
				$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");
				$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetchAll();
			}
			else
			{
				$fechaFinal = new DateTime();
				$fechaFinal->add(new DateInterval('P1D'));
				$fechaFinal2 = $fechaFinal->format('Y-m-d');
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal2'");
				$stmt -> execute();
				return $stmt -> fetchAll();
			}
		}
		else
		{
			if($fechaInicial == null)
			{
				$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla where id_almacen = :almacen ORDER BY fecha ASC");
				$stmt -> bindParam(":almacen", $almacen, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetchAll();	
			}
			else if($fechaInicial == $fechaFinal)
			{
				$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE :fecha id_almacen = :almacen and like '%$fechaFinal%' ");
				$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);
				$stmt -> bindParam(":almacen", $almacen, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetchAll();
			}
			else
			{
				$fechaFinal = new DateTime();
				$fechaFinal->add(new DateInterval('P1D'));
				$fechaFinal2 = $fechaFinal->format('Y-m-d');
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_almacen = :almacen and fecha BETWEEN '$fechaInicial' AND '$fechaFinal2'");
				$stmt -> bindParam(":almacen", $almacen, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetchAll();
			}
		}
	}
}
