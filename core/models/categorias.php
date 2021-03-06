<?php
class Categorias extends Validator
{
	// Declaración de propiedades
	private $id = null;
	private $idMes = null;
	private $idMesDesperdicios = null;
	private $nombre = null;
	private $imagen = null;
	private $descripcion = null;
	private $estado = null;
	private $ruta = '../../resources/img/categorias/';

	// Métodos para sobrecarga de propiedades
	public function setId($value)
	{
		if ($this->validateId($value)) {
			$this->id = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function setNombre($value)
	{
		if($this->validateAlphanumeric($value, 1, 50)) {
			$this->nombre = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function setImagen($file, $name)
	{
		if ($this->validateImageFile($file, $this->ruta, $name, 500, 500)) {
			$this->imagen = $this->getImageName();
			return true;
		} else {
			return false;
		}
	}

	public function getImagen()
	{
		return $this->imagen;
	}

	public function getRuta()
	{
		return $this->ruta;
	}

	public function setDescripcion($value)
	{
		if ($value) {
			if ($this->validateAlphanumeric($value, 1, 1000)) {
				$this->descripcion = $value;
				return true;
			} else {
				return false;
			}
		} else {
			$this->descripcion = null;
			return true;
		}
	}

	public function getDescripcion()
	{
		return $this->descripcion;
	}
	
	public function setEstado($value)
	{
		if ($value == 0 || $value == 1) {
			$this->estado = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getEstado()
	{
		return $this->estado;
	}

	// Métodos para el manejo del SCRUD
	public function readCategorias()
	{
		$sql = 'SELECT id_categoria, nombre_categoria, descripcion, foto_categoria, estado FROM categorias ORDER BY nombre_categoria';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function createCategoria()
	{
		$sql = 'INSERT INTO categorias(nombre_categoria, descripcion, foto_categoria, estado) VALUES(?, ?, ?, ?)';
		$params = array($this->nombre, $this->descripcion, $this->imagen, $this->estado);
		return conexion::executeRow($sql, $params);
	}

	public function getCategoria()
	{
		$sql = 'SELECT id_categoria, nombre_categoria, descripcion, foto_categoria, estado FROM categorias WHERE id_categoria = ? LIMIT 1';
		$params = array($this->id);
		return conexion::getRow($sql, $params);
	}

	public function updateCategoria()
	{
		$sql = 'UPDATE categorias SET nombre_categoria = ?, descripcion = ?, foto_categoria = ?, estado=? WHERE id_categoria = ?';
		$params = array($this->nombre,  $this->descripcion, $this->imagen, $this->estado, $this->id);
		return conexion::executeRow($sql, $params);
	}

	public function deleteCategoria()
	{
		$sql = 'DELETE FROM categorias WHERE id_categoria = ?';
		$params = array($this->id);
		return conexion::executeRow($sql, $params);
	}

	public function readCategoriaMateria()
	{
		$sql = 'SELECT id_categoria, nombre_categoria, descripcion FROM categorias WHERE estado = 1';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function graficar_existencia_categoria_agotar()
	{//funcion para traer la cantidad de materia prima por categoria
		$sql = 'CALL `existenciasPorAgotar`();';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	
	public function graficar_existencia_categoria_sobre_existen()
	{//funcion para traer la cantidad de materia prima por categoria
		$sql = 'CALL `sobreExistencias`();';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	/* public function graficar_ventas_categoria($id_categoria)
	{
		$sql = "SELECT SUM(cantidad) as cantidad, nombre_platillo, precio*SUM(cantidad) as subtotal FROM platillos 
		INNER JOIN categorias USING (id_categoria) 
		INNER JOIN detalle_pedido USING (id_platillo) 
		WHERE platillos.estado = 1 AND id_categoria = $id_categoria  GROUP BY nombre_platillo ORDER BY subtotal DESC LIMIT 5";
		$params = array($id_categoria);
		return conexion::getRows($sql, $params);
	} */

	public function ventas_categoria_reporte($id_categoria)
	{
		$sql = "SELECT SUM(cantidad) as cantidad, nombre_platillo, precio*SUM(cantidad) as subtotal, nombre_categoria
		FROM platillos 
		INNER JOIN categorias USING (id_categoria) 
		INNER JOIN detalle_pedido USING (id_platillo) 
		WHERE id_categoria = $id_categoria  GROUP BY nombre_platillo ORDER BY subtotal";
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function ventas($id_categoria)
	{
		$sql = "SELECT SUM(cantidad) as cantidad, nombre_platillo, precio*SUM(cantidad) as subtotal FROM platillos 
		INNER JOIN categorias USING (id_categoria) 
		INNER JOIN detalle_pedido USING (id_platillo) 
		WHERE platillos.estado = 1 AND id_categoria = $id_categoria  GROUP BY nombre_platillo ORDER BY subtotal DESC LIMIT 5";
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function ganancias_categoria_reporte($id_categoria)
	{
		$sql = "SELECT SUM(cantidad) as cantidad, nombre_platillo, precio*SUM(cantidad) as subtotal FROM platillos 
		INNER JOIN categorias USING (id_categoria) 
		INNER JOIN detalle_pedido USING (id_platillo) 
		WHERE platillos.estado = 1 AND id_categoria = $id_categoria  GROUP BY nombre_platillo ORDER BY subtotal";
		$params = array(null);
		return conexion::getRows($sql, $params);
	}


	public function graficar_ventas_mes($idMes)
	{
		$sql = "SELECT SUM(cantidad) as cantidad, fecha_pedido, nombre_platillo, precio*SUM(cantidad) as ventas FROM platillos 
		INNER JOIN detalle_pedido USING (id_platillo) 
        INNER JOIN pedidos USING (id_pedido)
        WHERE platillos.estado = 1 AND YEAR(fecha_pedido) = YEAR(NOW()) AND MONTH(fecha_pedido) = ?
        GROUP BY nombre_platillo ORDER BY ventas DESC LIMIT 5";
		$params = array($idMes);
		return conexion::getRows($sql, $params);
	}

	public function graficar_ventas_mes1($idMes)
	{
		$sql = "SELECT SUM(cantidad) as cantidad, fecha_pedido, nombre_platillo, precio*SUM(cantidad) as ventas FROM platillos 
		INNER JOIN detalle_pedido USING (id_platillo) 
        INNER JOIN pedidos USING (id_pedido)
        WHERE platillos.estado = 1 AND YEAR(fecha_pedido) = YEAR(NOW()) AND MONTH(fecha_pedido) = ?
        GROUP BY nombre_platillo ORDER BY ventas DESC LIMIT 5";
		$params = array($idMes);
		return conexion::getRows($sql, $params);
	}

	public function ventas_reporte($idMes)
	{
		$sql = "SELECT SUM(cantidad) as cantidad, fecha_pedido, nombre_platillo, precio*SUM(cantidad) as ventas FROM platillos 
		INNER JOIN detalle_pedido USING (id_platillo) 
        INNER JOIN pedidos USING (id_pedido)
        WHERE platillos.estado = 1 AND YEAR(fecha_pedido) = YEAR(NOW()) AND MONTH(fecha_pedido) = ?
        GROUP BY nombre_platillo";
		$params = array($idMes);
		return conexion::getRows($sql, $params);
	}

	public function graficar_desperdicios($idMesDesperdicios)
	{
		$sql = "SELECT SUM(cantidad) as cantidad, fecha_desperdicio, nombre_receta FROM desperdicios 
		INNER JOIN receta USING (id_receta) WHERE YEAR(fecha_desperdicio) = YEAR(NOW()) AND MONTH (fecha_desperdicio) = ? 
		GROUP BY nombre_receta ORDER BY cantidad DESC LIMIT 5";
		$params = array($idMesDesperdicios);
		return conexion::getRows($sql, $params);
	}

	public function graficar_existencia_materia_prima_agotar($id_categoria_materia)
	{
		$sql = "SELECT nombre_categoria, nombre_materia, (COALESCE(SUM(cantidad),0)-(SELECT COALESCE(SUM(elab.`cantidad`),0) 
		FROM pedidos AS ped 
		JOIN detalle_pedido detped USING(`id_pedido`) 
		JOIN platillos plat USING (`id_platillo`) 
		JOIN receta rec USING(`id_receta`)
		JOIN elaboraciones elab USING(`id_receta`)
		WHERE elab.`idMateria`=inv.`idMateria` ORDER BY elab.`idMateria`)-(SELECT (COALESCE(SUM(des.cantidad),0)*COALESCE(SUM(elab.cantidad),0)) AS Cantidad FROM desperdicios des JOIN receta re USING(`id_receta`) JOIN elaboraciones elab USING(`id_receta`)
		WHERE elab.idMateria= inv.`idMateria`
		GROUP BY elab.idMateria )) AS CantidadTotal, CONCAT(nombre_materia, ' (', uni.descripcion, ')') AS Materia 
		FROM inventarios AS inv JOIN facturas AS fact ON inv.`id_factura`=fact.`id_factura` 
		JOIN materiasprimas mate USING(`idMateria`) JOIN unidadmedida uni USING(id_Medida)
		JOIN categorias cat USING(`id_categoria`)
		WHERE fact.`estado`= 1 AND mate.`id_categoria` = $id_categoria_materia GROUP BY cat.nombre_categoria ORDER BY CantidadTotal ASC LIMIT 5";
		$params = array(null);
		return conexion::getRows($sql, $params);
	}
	
	public function graficar_existencia_materia_prima_sobre_existente($id_categoria_materia_prima)
	{
		$sql = "SELECT nombre_categoria, nombre_materia, (COALESCE(SUM(cantidad),0)-(SELECT COALESCE(SUM(elab.`cantidad`),0) 
		FROM pedidos AS ped 
		JOIN detalle_pedido detped USING(`id_pedido`) 
		JOIN platillos plat USING (`id_platillo`) 
		JOIN receta rec USING(`id_receta`)
		JOIN elaboraciones elab USING(`id_receta`)
		WHERE elab.`idMateria`=inv.`idMateria` ORDER BY elab.`idMateria`)-(SELECT (COALESCE(SUM(des.cantidad),0)*COALESCE(SUM(elab.cantidad),0)) AS Cantidad FROM desperdicios des JOIN receta re USING(`id_receta`) JOIN elaboraciones elab USING(`id_receta`)
		WHERE elab.idMateria= inv.`idMateria`
		GROUP BY elab.idMateria )) AS CantidadTotal, CONCAT(nombre_materia, ' (', uni.descripcion, ')') AS Materia 
		FROM inventarios AS inv JOIN facturas AS fact ON inv.`id_factura`=fact.`id_factura` 
		JOIN materiasprimas mate USING(`idMateria`) JOIN unidadmedida uni USING(id_Medida)
		JOIN categorias cat USING(`id_categoria`)
		WHERE fact.`estado`= 1 AND mate.`id_categoria` = $id_categoria_materia_prima GROUP BY cat.nombre_categoria ORDER BY CantidadTotal DESC LIMIT 5";
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	private function getMonthName($monthNum)
	{
		switch ((int) $monthNum) {
			case 1:
				return 'Enero';
				break;
			case 2:
				return 'Febrero';
				break;
			case 3:
				return 'Marzo';
				break;
			case 4:
				return 'Abril';
				break;
			case 5:
				return 'Mayo';
				break;
			case 6:
				return 'Junio';
				break;
			case 7:
				return 'Julio';
				break;
			case 8:
				return 'Agosto';
				break;
			case 9:
				return 'Septiembre';
				break;
			case 10:
				return 'Octubre';
				break;
			case 11:
				return 'Noviembre';
				break;
			case 12:
				return 'Diciembre';
				break;
			default:
				return 'Mes incorrecto';
				break;
		}
	}

}
?>
