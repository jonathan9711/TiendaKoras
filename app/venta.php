<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use \PDO;
use App\conexion;
use DateInterval;
use DateTime;

class venta extends Model
{
    protected $table = 'venta';

    public function detalle_ventas(){
        return $this->hasMany(detalle_venta::class);
    }

    public function cliente(){
        return $this->belongsTo(cliente::class,'id_cliente');
    }

    public function usuario(){
        return $this->belongsTo(usuarios::class,'id_usuario');
    }
    
    public function almacen(){
        return $this->belongsTo(almacen::class,'id_almacen');
    }

    ////admin
	static public function mdlActualizarVenta($tabla,$item1,$item2,$id_venta)
	{
		$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_venta = :id_venta");
		$stmt->bindParam(":".$item1,$item2,PDO::PARAM_STR);
		$stmt->bindParam(":id_venta",$id_venta,PDO::PARAM_STR);
		if($stmt->execute())
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

	static public function mdlMostrarVentas($tabla, $item, $valor)
	{
		if($item != null)
		{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");

			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		else
		{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_venta ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarVentasAlmacen($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where id_almacen = :valor");
		$stmt->bindParam(":valor",$valor,PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;

	}

	static public function mdlMostrarVentaPorFecha($tabla, $item, $valor,$fecha)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND fecha = :fecha ORDER BY id_venta ASC");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> bindParam(":fecha", $fecha, PDO::PARAM_STR);

		$stmt -> execute();
		
		return $stmt -> fetchAll();

	}

	static public function mdlIngresarVenta($tabla,$datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cliente, id_usuario, codigo, fecha, hora, subtotal, total, iva, productos, metodo_pago,status,id_almacen) VALUES (:id_cliente, :id_usuario, :codigo, :fecha, :hora, :subtotal, :total, :iva, :productos, :metodo_pago,:status,:id_almacen)");
		
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
		$stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":id_almacen", $datos["id_almacen"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $datos["hora"], PDO::PARAM_STR);
		$stmt->bindParam(":status", $datos["status"], PDO::PARAM_STR);
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEditarVentas($tabla,$datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_cliente = :id_cliente, id_usuario = :id_usuario, subtotal = :subtotal, total= :total, iva = :iva,  productos = :productos, metodo_pago = :metodo_pago WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
		$stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEliminarVenta($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_venta = :id_venta");

		$stmt->bindParam(":id_venta", $datos, PDO::PARAM_INT);

		if($stmt->execute())
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

	static public function mdlSumaTotalVentas($tabla,$item)
	{	

		$stmt = conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla where status=:$item");
		$stmt->bindParam(":".$item,$item,PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlSumaPorAlmacen($tabla,$almacen)
	{
		$stmt = conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla where id_almacen = :id_almacen");
		$stmt -> bindParam(":id_almacen",$almacen,PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlSumarVentaDiaria($tabla,$item,$valor1,$valor2)
	{	
		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla where $item = :valor1 and fecha = :valor2");
		$stmt->bindParam(":valor1",$valor1,PDO::PARAM_STR);
		$stmt->bindParam(":valor2",$valor2,PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;

	}

	static public function mdlSumarVentasActivas($tabla,$item,$valor1,$valor2,$valor3)
	{	
		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla where $item = :valor1 and fecha = :valor2 and status = :valor3");
		$stmt->bindParam(":valor1",$valor1,PDO::PARAM_STR);
		$stmt->bindParam(":valor2",$valor2,PDO::PARAM_STR);
		$stmt->bindParam(":valor3",$valor3,PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;

	}

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal, $almacen)
	{
		if ($almacen == null)
		{
			if($fechaInicial == null)
			{
				$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_venta ASC");
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
				$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla where id_almacen = :almacen ORDER BY id_venta ASC");
				$stmt -> bindParam(":almacen", $almacen, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetchAll();	
			}
			else if($fechaInicial == $fechaFinal)
			{
				$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' and id_almacen = :almacen");
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
