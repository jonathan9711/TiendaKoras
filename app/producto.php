<?php

namespace App;

use App\categorias;
use \PDO;
use App\conexion;
require_once "conexion.php";
use Illuminate\Database\Eloquent\Model;


class producto extends Model
{
    protected $table = 'producto';

    public function category(){
        return $this->belongsTo(categorias::class,'id_categoria');
    }

    public function detalle_ventas(){
        return $this->hasMany(detalle_venta::class);
    }

    public function inventario(){
        return $this->hasMany(inventario::class);
    }

    public function movimiento_inventarios(){
        return $this->hasMany(movimientos_inventario::class);
    }

  //admin
  static public function mdlBorrarProducto($tabla,$valor)
  {
      $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_producto = :id_producto");

      $stmt->bindParam(":id_producto",$valor,PDO::PARAM_INT);
      
      if ($stmt->execute())
      {
          return "ok";
      }
      else
      {
          return "error";
      }
      $stmt ->close();
      $stmt = null;
  }
  static public function mdlMostrarProductos($tabla,$item,$valor)
  {
      if ($item != null)
      {
          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

          $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetch();
      }
      else
      {
          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
          $stmt -> execute();
          return $stmt -> fetchAll();
      }
      $stmt -> close();
      $stmt = null;
  }

  static public function mdlMostrarProductosOrden($tabla,$valor)
  {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla order by $valor");
      $stmt -> execute();
      return $stmt -> fetchAll();
      $stmt -> close();
      $stmt = null;
  }

  static public function mdlMostrarProductosOrdenados($tabla,$valor)
  {
      $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla as productos INNER JOIN inventario as inventario 
          on productos.id_producto = inventario.id_producto where inventario.id_almacen = :valor order by inventario.venta desc");
      $stmt->bindParam(":valor",$valor,PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchAll();
     
  }

  static public function mdlMostrarProductosVenta($tabla,$valor,$almacen)
  {
      $stmt = conexion::conectar()->prepare("SELECT p.id_producto,p.nombre,p.precio_venta,p.descripcion,i.existencia FROM $tabla as p INNER JOIN inventario as i on p.id_producto = i.id_producto where i.id_almacen = :almacen and p.codigo = :valor");
      $stmt->bindParam(":valor",$valor,PDO::PARAM_STR);
      $stmt->bindParam(":almacen",$almacen,PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchAll();
      $stmt->close();
      $stmt=null;
  }

  static public function mdlMostrarProductosInventario($tabla,$valor,$orden)
  {
      $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla as p inner join inventario as i on p.id_producto = i.id_producto where i.id_almacen = :valor");

      $stmt->bindParam(":valor",$valor,PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchAll();
      $stmt->close();
      $stmt=null;
      
  }

  static public function mdlMostrarProductosMasVendidos($tabla,$almacen)
  {
      if ($almacen != null)
      {
          $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla as p inner join inventario as i on p.id_producto = i.id_producto where i.id_almacen = :almacen order by i.venta desc limit 8");
          $stmt->bindParam(":almacen",$almacen,PDO::PARAM_STR);
          $stmt->execute();
          return $stmt->fetchAll();
          $stmt->close();
          $stmt=null;
      }
      else
      {
          $stmt = conexion::conectar()->prepare("SELECT p.id_producto, p.imagen ,p.nombre, sum(i.venta) as venta FROM $tabla as p inner join inventario as i on p.id_producto = i.id_producto GROUP by p.nombre order by i.venta desc LIMIT 8");
          $stmt->execute();
          return $stmt->fetchAll();
          $stmt->close();
          $stmt=null;
      }
  
  }

  static public function mdlEditarProducto($tabla,$datos)
  {
      $stmt = conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, nombre = :nombre, descripcion = :descripcion, precio_compra = :precio_compra, precio_venta = :precio_venta, imagen = :imagen, marca = :marca where id_producto = :id_producto");

      $stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
      $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
      $stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
      $stmt->bindParam(":precio_compra",$datos["precioCompra"],PDO::PARAM_STR);
      $stmt->bindParam(":precio_venta",$datos["precioVenta"],PDO::PARAM_STR);
      $stmt->bindParam(":imagen",$datos["imagen"],PDO::PARAM_STR);
      $stmt->bindParam(":marca",$datos["marca"],PDO::PARAM_STR);
      $stmt->bindParam(":id_producto",$datos["idProducto"],PDO::PARAM_INT);

      if ($stmt->execute())
      {
          return "ok";
      }
      else
      {
          return "error";
      }

  }

  static public function mdlIngresarProducto($tabla,$datos)
  {
      $stmt = conexion::conectar()->prepare("INSERT INTO $tabla(codigo,nombre,descripcion,precio_compra,precio_venta,imagen,marca) VALUES (:codigo,:nombre,:descripcion,:precio_compra,:precio_venta,:imagen,:marca)");
      
      $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
      $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
      $stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
      $stmt->bindParam(":precio_compra",$datos["precioCompra"],PDO::PARAM_STR);
      $stmt->bindParam(":precio_venta",$datos["precioVenta"],PDO::PARAM_STR);
      $stmt->bindParam(":imagen",$datos["imagen"],PDO::PARAM_STR);
      $stmt->bindParam(":marca",$datos["marca"],PDO::PARAM_STR);

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
}
