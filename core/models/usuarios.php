<?php
class Usuarios extends Validator
{
	//Declaración de propiedades
	private $id = null;
	private $alias = null;
	private $correo = null;
	private $foto = null;
	private $fecha_creacion = null;
	private $estado = null;
	private $tipo_usuario = null;
	private $clave = null;
	private $token = null;
	private $cantidad_productos = null;
	private $cantidad_categorias = null;
	private $logueo = null;
	private $fecha_contrasena = null;
	private $fecha_cambiopw = null;
	private $ruta = '../../resources/img/usuarios/';

	//Métodos para sobrecarga de propiedades
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

	public function setLogueo($value)
	{
		if ($this->validateLogueo($value)) {
			$this->logueo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getLogueo()
	{
		return $this->logueo;
	}

	public function setAlias($value)
	{
		if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->alias = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getAlias()
	{
		return $this->alias;
	}

	public function setCorreo($value)
	{
		if ($this->validateEmail($value)) {
			$this->correo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCorreo()
	{
		return $this->correo;
	}

	public function setFoto($file, $name)
	{
		if ($this->validateImageFile($file, $this->ruta, $name, 500, 500)) {
			$this->foto = $this->getImageName();
			return true;
		} else {
			return false;
		}
	}

	public function getFoto()
	{
		return $this->foto;
	}

	public function setFecha_creacion($file, $name)
	{
		$this->fecha_creacion = $value;
	}

	public function getFecha_creacion()
	{
		return $this->fecha_creacion;
	}

	public function setEstado($value)
	{
		if ($value == '1' || $value == '0') {
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

	public function setTipo_usuario($value)
	{
		if ($this->validateId($value)) {
			$this->tipo_usuario = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getTipo_usuario()
	{
		return $this->tipo_usuario;
	}

	public function setClave($value)
	{
		$validator = $this->validatePassword($value);
		if ($validator[0]) {
			$this->clave = $value;
			return array (true, '');
		} else {
			return array (false, $validator[1]);
		}
	}

	public function getClave()
	{
		return $this->clave;
	}

	public function setToken($value)
	{
		 $this->token = $value;
		 return true;
	}

	public function getToken()
	{
		return $this->token;
	}

	public function setFecha_cambiopw($value)
	{
		$this->fecha_cambiopw = $value;
	}

	public function getFecha_cambiopw()
	{
		return $this->fecha_cambiopw;
	}

	public function setFecha_contrasena($value)
	{
		$this->fecha_contrasena = $value;
	}

	public function getFecha_contrasena()
	{
		return $this->fecha_contrasena;
	}

	public function getRuta()
	{
		return $this->ruta;
	}
	
	public function setCantidad_Produtos($value)
	{
		if ($this->validateId($value)) {
			$this->cantidad_productos = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCantidad_Productos()
	{
		return $this->cantidad_productos;
	}

	//Métodos para manejar la sesión del usuario
	//Método para erificar que el nombre de usuario exista a la hora de iniciar sesión
	public function checkAlias()
	{
		$sql = 'SELECT id_usuario, ADDDATE(fecha_contrasena, 90) AS fecha_cambiopw FROM usuarios WHERE alias = ? LIMIT 1';
		$params = array($this->alias);
		$data = Conexion::getRow($sql, $params);
		if ($data) {
			$this->id = $data['id_usuario'];
			$this->fecha_cambiopw = $data['fecha_cambiopw'];
			return true;
		} else {
			return false;
		}
	}

	public function checkContra()
	{
		$sql = 'SELECT alias FROM usuarios WHERE id_usuario = ?';
		$params = array($this->id);
		$data = Conexion::getRow($sql, $params);
	}

	public function checkAlias2()
	{
		$sql = 'SELECT id_usuario FROM usuarios WHERE alias = ? AND id_usuario = ? LIMIT 1';
		$params = array($this->alias, $this->id);
		return Conexion::getRow($sql, $params);
	}
	//Método para verificar si el estado del usuario está ativo para dejarlo entrar al sistema
	public function checkEstado()
	{
		$sql = 'SELECT estado_usuario FROM usuarios WHERE alias = ? AND estado_usuario = 1 ';
		$params = array($this->alias);
		$data = Conexion::getRow($sql, $params);
		if ($data) {
			$this->id = $data['estado_usuario'];
			return true;
		} else {
			return false;
		}
	}

	public function checkActivacion()
	{
		$sql = 'SELECT estado_usuario FROM usuarios WHERE alias = ? AND estado_usuario = 3 LIMIT 1';
		$params = array($this->alias);
		return Conexion::getRow($sql, $params);
	}

	public function activarCuenta()
	{
		$sql = 'UPDATE usuarios SET estado_usuario = 1 WHERE id_usuario = ?';
		$params = array($this->id);
		return Conexion::executeRow($sql, $params);
	}

	//Méodo para vificar que la contraseña exista y que sea igual al del usuario
	public function checkPassword()
	{
		$sql = 'SELECT clave_usuario FROM usuarios WHERE id_usuario = ? LIMIT 1';
		$params = array($this->id);
		$data = Conexion::getRow($sql, $params);
		if (password_verify($this->clave, $data['clave_usuario'])) {
			return true;
		} else {
			return false;
		}
	}

	//Método para verificar que el correo ingresado para recuperar la contraseña, esté registrado en el sistema
	public function checkCorreo()
	{
		$sql = 'SELECT correo_usuario FROM usuarios WHERE correo_usuario = ? LIMIT 1';
		$params = array($this->correo);
		return Conexion::getRow($sql, $params);
	}

	public function updateToken()
	{
		$sql = 'UPDATE usuarios SET token_usuario = ? WHERE correo_usuario = ?';
		$params = array($this->token, $this->correo);
		return Conexion::executeRow($sql, $params);
	}

	public function updateTokenAutenticacion()
	{
		$sql = 'UPDATE usuarios SET token_usuario = ? WHERE alias = ?';
		$params = array($this->token, $this->alias);
		return Conexion::executeRow($sql, $params);
	}

	public function getDatosToken()
	{
		$sql = 'SELECT id_usuario, alias, correo_usuario, id_Tipousuario FROM usuarios WHERE token_usuario = ?';
		$params = array($this->token);
		$data = Conexion::getRow($sql, $params);
		if ($data) {
			$this->id = $data['id_usuario'];
			$this->alias = $data['alias'];
			$this->correo = $data['correo_usuario'];
			$this->tipo_usuario = $data['id_Tipousuario'];
			return true;
		} else {
			return false;
		}
	}

	public function readMenu()
	{
		$sql = 'SELECT nombre_vista, ruta, icono FROM acciones INNER JOIN vistas USING(id_vista) WHERE estado = 1 AND id_Tipousuario = ?';
		$params = array($this->tipo_usuario);
		return Conexion::getRows($sql, $params);
	}

	public function deleteToken()
	{
		$sql = 'UPDATE usuarios SET token_usuario = null WHERE id_usuario = ?';
		$params = array($this->id);
		return Conexion::executeRow($sql, $params);
	}

	public function validarToken()
	{
		$sql = 'SELECT token_usuario FROM usuarios WHERE token_usuario = ? LIMIT 1';
		$params = array($this->token);
		return Conexion::getRow($sql, $params);
	}

	//Metodos para sumar intentos
	public function SumarIntentos()
	{
		$sql = 'UPDATE usuarios SET intentos = intentos + 1 WHERE alias = ?';
		$params = array($this->alias);
		return Conexion::executeRow($sql, $params);
	}

	//Metodos para bloquear los intentos es decir cambiar el estado a 0
	public function BloquearIntentos()
	{
		$sql = 'UPDATE usuarios SET estado_usuario = 0, intentos = 0 WHERE alias = ? and intentos >= 3';
		$params = array($this->alias);
		return Conexion::executeRow($sql, $params);
	}

	public function ConsultarIntentos()
	{
		$sql = 'SELECT intentos from usuarios where alias = ? AND intentos <= 3';
		$params = array($this->alias);
		return Conexion::getRow($sql, $params);
	}

	//Metodo para que a la hora de logearse los intentos se refresquen o cambien a 0
	public function UpdateLogin()
	{
		$sql = 'UPDATE usuarios SET intentos = 0';
		$params = array(null);
		return Conexion::executeRow($sql, $params);
	} 

	//Métodos para manejar el CRUD
	//Método para leer la tabla usuarios
	public function readUsuarios()
	{
		$sql = 'SELECT id_usuario, foto_usuario, alias, correo_usuario, estado_usuario, logueado, fecha_creacion, tipo FROM usuarios INNER JOIN tipousuario USING (id_Tipousuario)';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function checkLogin()
	{
		$sql = 'SELECT logueado from usuarios where logueado = 0';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function UpdateLogin1()
	{
		$sql = 'UPDATE usuarios SET logueado = 1 where id_usuario = ?';
		$params = array($this->id);
		return Conexion::executeRow($sql, $params);
	}

	public function UpdateLogout()
	{
		$sql = 'UPDATE usuarios SET logueado = 0 where id_usuario = ?';
		$params = array($this->id);
		return Conexion::executeRow($sql, $params);
	}

	//Método para mostrar los tipos de usuario con estado activo
	public function readTipoUsuario()
	{
		$sql = 'SELECT id_Tipousuario, tipo FROM tipousuario WHERE estado = 1';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}
	

	//Método para crear un usuario
	public function createUsuario()
	{
		$hash = password_hash($this->clave, PASSWORD_DEFAULT);
		$sql = 'INSERT INTO usuarios(alias, correo_usuario, token_usuario, foto_usuario, estado_usuario, id_Tipousuario, clave_usuario, fecha_contrasena) VALUES(?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)';
		$params = array($this->alias, $this->correo, $this->token, $this->foto, 3, $this->tipo_usuario, $hash);
		return Conexion::executeRow($sql, $params);
	}
	
	//Método para obtener la información e un usuario específico
	public function getUsuario()
	{
		$sql = 'SELECT id_usuario, alias, correo_usuario, foto_usuario, fecha_creacion, estado_usuario, logueado, id_Tipousuario, clave_usuario FROM usuarios WHERE id_usuario = ?';
		$params = array($this->id);
		return Conexion::getRow($sql, $params);
	}

	public function updateProfile()
	{
		$sql = 'UPDATE usuarios SET alias = ?, foto_usuario = ?, correo_usuario = ? WHERE id_usuario = ?';
		$params = array($this->alias, $this->foto, $this->correo, $this->id);
		return Conexion::executeRow($sql, $params);
	}
	//Método para modificar la información de un usuario
	public function updateUsuario()
	{
		$sql = 'UPDATE usuarios SET alias = ?, foto_usuario = ?, correo_usuario = ?, estado_usuario = ?, id_Tipousuario = ?, logueado = ? WHERE id_usuario = ?';
		$params = array($this->alias, $this->foto, $this->correo, $this->estado, $this->tipo_usuario, $this->logueo, $this->id);
		return Conexion::executeRow($sql, $params);
	}
	//Método para eliminar un usuario
	public function deleteUsuario()
	{
		$sql = 'DELETE FROM usuarios WHERE id_usuario = ?';
		$params = array($this->id);
		return Conexion::executeRow($sql, $params);
	}
	//Método para modificar la contraseña en donde la desencripta para verificar que sea igual y encripta la contraseña nueva 
	public function changePassword()
	{
		$hash = password_hash($this->clave, PASSWORD_DEFAULT);
		$sql = 'UPDATE usuarios SET clave_usuario = ?, fecha_contrasena = CURRENT_TIMESTAMP WHERE token_usuario = ?';
		$params = array($hash, $this->token);
			return Conexion::executeRow($sql, $params);
	}

	//Método para contar el numero de registros en la tabla productos
	public function getCantidadProductos()
	{
		$sql = 'SELECT COUNT(idMateria) as registros_produtos FROM materiasprimas';
		$params = array($this->cantidad_productos);
		return Conexion::getRow($sql, $params);
	}
	//Método para contar el numero de registros en la tabla categorias
	public function getCantidadCategorias()
	{
		$sql = 'SELECT COUNT(id_categoria) as registros_categorias FROM categorias';
		$params = array($this->cantidad_categorias);
		return Conexion::getRow($sql, $params);
	}
	//Método para contar el numero de registros en la tabla usuarios
	public function getCantidadUsuarios()
	{
		$sql = 'SELECT COUNT(id_usuario) as registros_usuarios FROM usuarios';
		$params = array($this->cantidad_categorias);
		return Conexion::getRow($sql, $params);
	}
	//Método para contar el numero de registros en la tabla empleados
	public function getCantidadEmpleados()
	{
		$sql = 'SELECT COUNT(id_empleado) as registros_empleados FROM empleados';
		$params = array($this->cantidad_categorias);
		return Conexion::getRow($sql, $params);
	}
}
?>
