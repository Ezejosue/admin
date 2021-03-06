<?php
//aqui es donde se llama la conexión, el modal de platillos y el archivo para validaciones
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/platillos.php');

//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['action'])) {
    session_start();
    $platillo = new Platillos;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if (isset($_SESSION['idUsuario'])) {
        switch ($_GET['action']) {
            case 'read':
                if ($result['dataset'] = $platillo->readPlatillo()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay platillos registrados';
                }
                break;
            //Operación para crear nuevos platillos 
            case 'create':
                $_POST = $platillo->validateForm($_POST);
                    if ($platillo->setNombre($_POST['create_platillos'])) {
                            if ($platillo->setPrecio($_POST['create_precio'])) {
                                if ($platillo->setCategoria($_POST['create_categoria'])) {
                                    if ($platillo->setReceta($_POST['create_receta'])) {
                                        if ($platillo->setEstado(isset($_POST['estado']) ? 1:0)) {
                                            if (is_uploaded_file($_FILES['create_archivo']['tmp_name'])) {
                                                if ($platillo->setImagen($_FILES['create_archivo'], null)) {
                                                    if ($platillo->createPlatillo()) {
                                                        if ($platillo->saveFile($_FILES['create_archivo'], $platillo->getRuta(), $platillo->getImagen())) {
                                                            $result['status'] = 1;
                                                    } else {
                                                        $result['status'] = 2;
                                                        $result['exception'] = 'No se guardó el archivo';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Operación fallida';
                                                }
                                            } else {
                                                $result['exception'] = $platillo->getImageError();;
                                                } 
                                            }   else {
                                            $result['exception'] = 'Seleccione una imagen';
                                                } 
                                            
                                        } else {
                                            $result['exception'] = 'Estado incorrecto';
                                        }  
                                    } else {
                                        $result['exception'] = 'Seleccione una receta';
                                    }  
                                } else {
                                $result['exception'] = 'Seleccione una categoría';
                            }  
                            } else {
                                $result['exception'] = 'Precio incorrecto';
                            }
                    } else {
                        $result['exception'] = 'Nombre incorrecto';
                    }                                     
                    break;
            //Operación para saber el platillo a modificar
            case 'get':
                if ($platillo->setId($_POST['id_platillo'])) {
                    if ($result['dataset'] = $platillo->getPlatillo()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Platillos inexistente';
                    }
                } else {
                    $result['exception'] = 'Platillo incorrecto';
                }
                break;
            //Operación para actualizar un platillo donde se actualiza
            //cada campos a operar
            case 'update':
				$_POST = $platillo->validateForm($_POST);
				if ($platillo->setId($_POST['id_platillo'])) {
					if ($platillo->getPlatillo()) {
		                if ($platillo->setNombre($_POST['update_nombre_platillo'])) {
                            if ($platillo->setPrecio($_POST['update_precio'])) {
                                if ($platillo->setCategoria($_POST['update_categoria'])) {
                                     if ($platillo->setReceta($_POST['update_receta'])) {
                                    if ($platillo->setEstado(isset($_POST['update_estado']) ? 1 : 0)) {
                                        if (is_uploaded_file($_FILES['update_imagen']['tmp_name'])) {
                                            if ($platillo->setImagen($_FILES['update_imagen'], $_POST['imagen_platillo'])) {
                                                $archivo = true;
                                            } else {
                                                $result['exception'] = $platillo->getImageError();
                                                $archivo = false;
                                            }
                                        } else {
                                            if (!$platillo->setImagen(null, $_POST['imagen_platillo'])) {
                                                $result['exception'] = $platillo->getImageError();
                                            }
                                            $archivo = false;
                                        }
                                        if ($platillo->updatePlatillo()) {
                                            $result['status'] = 1;
                                            if ($archivo) {
                                                if ($platillo->saveFile($_FILES['update_imagen'], $platillo->getRuta(), $platillo->getImagen())) {
                                                    $result['message'] = 'Categoría modificada correctamente';
                                                        } else {
                                                            $result['message'] = 'Categoría modificada. No se guardó el archivo';
                                                        }
                                                    } else {
                                                        $result['message'] = 'Categoría modificada. No se subió ningún archivo';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Operación fallida';
                                                }
                                            } else {
                                                $result['exception'] = 'Estado incorrecto';
                                            }
                                        } else {
                                            $result['exception'] = 'Seleccione una receta';
                                            }
                                    }else {
                                        $result['exception'] = 'Seleccione una categoría';
                                    } 
                                }else {
                                    $result['exception'] = 'Precio incorrecto';
                                }
                            }else {
                                $result['exception'] = 'Nombre de platillo incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Platillos inexistente';
                        }
                    } else {
                        $result['exception'] = 'Platillo incorrecto';
                    }
                    break;
            //Operación para eliminar un platillo esto lo hace a través del id
            //platillo que mandamos a traer desde el getId
            case 'delete':
            //El caso a eliminar es el de deleteplatillo
                    if ($platillo->setId($_POST['id_platillo'])) {
                        if ($platillo->getId()) {
                            if ($platillo->deletePlatillo()) {
                                $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Operación fallida';
                            }
                        } else {
                            $result['exception'] = 'Platillo inexistente';
                        }
                    } else {
                        $result['exception'] = 'Platillo incorrecto';
                    }
                break;
            //Operación para mostrar los tipos de categorías en la tabla
            case 'readReceta':
                if ($result['dataset'] = $platillo->readReceta()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
                break;
                //Operación para mostrar los tipos de receta en el tabla
            case 'readCategoria':
                if ($result['dataset'] = $platillo->readCategoria()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
                break;

                //operaciones de gráficas
                //operación para traer el modelo de la gráfica de cuales platillos se han vendido más
				case 'ventas_platillos_mayor':
				if ($result['dataset'] = $platillo->grafica_ventas_platillo()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay categorías registradas';
				}
                break;
                
                //operación para traer el modelo de la gráfica de cuales platillos se han vendido menos
				case 'ventas_platillos_menor':
				if ($result['dataset'] = $platillo->grafica_ventas_platillo_menor()) {
					$result['status'] = 1;
				} else {
					$result['exception'] = 'No hay categorías registradas';
				}
				break;

                //operación para traer los platillos con precio más elevado
                case 'grafica_platillos_mayores':
                if ($result['dataset'] = $platillo->grafica_platillos_caros()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay platillos registrados';
                }
                break;
                
                //operación para traer los platillos con precio más barato
                case 'grafica_platillos_menores':
                if ($result['dataset'] = $platillo->grafica_platillos_baratos()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay platillos registrados';
                }
                break;
                
            default:
                exit('Acción no disponible 1');
        }
    } 
	print(json_encode($result));
} else {
	exit('Recurso denegado');
}
?>
