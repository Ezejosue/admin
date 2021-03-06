<?php
require_once('../../core/helpers/conexion.php');
require_once('../../core/helpers/validator.php');
require_once('../../core/models/recetas.php');

//Se comprueba si existe una petición del sitio web y la acción a realizar, de lo contrario se muestra una página de error
if (isset($_GET['action'])) {
    session_start();
    $recetas = new Recetas;
    $result = array('status' => 0, 'exception' => '');
    //Se verifica si existe una sesión iniciada como administrador para realizar las operaciones correspondientes
    if (isset($_SESSION['idUsuario'])) {
        switch ($_GET['action']) {
            
            case 'read':
                if ($result['dataset'] = $recetas->readRecetas()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'No hay recetas registradas';
                }
                break;              
            //Operación para crear nuevos usuarios
            case 'create':
                $_POST = $recetas->validateForm($_POST);
                    if ($recetas->setNombreReceta($_POST['create_nombre'])) {
                        if ($recetas->setTiempo($_POST['create_tiempo'])) {
                            if ($recetas->createRecetas()) {
                                    $result['status'] = 1;
                            } else {
                                $result['exception'] = 'Operación fallida';
                            }
                        }else {
                                $result['exception'] = 'Tiempo incorrecto';
                            }
                    } else {
                        $result['exception'] = 'Nombre incorrecto';
                    }                                     
                break;
            //Operación para crear elaboración de recetas
            case 'createElaboracion':
                $_POST = $recetas->validateForm($_POST);
                    if ($recetas->setIdReceta($_POST['id_receta'])){
                        if ($recetas->setCantidad($_POST['cantidad_materia'])) {
                            if ($recetas->setIdMateria($_POST['id_materias'])) {
                                if ($recetas->createElaboracion()) {
                                        $result['status'] = 1;
                                } else {
                                    $result['exception'] = 'Operación fallida';
                                }
                            }else {
                                    $result['exception'] = 'Materia prima incorrecta';
                                }
                        } else {
                            $result['exception'] = 'Cantidad incorrecta';
                        } 
                    }else{
                        $result['exception'] = 'Receta incorrecta';
                    }                                    
                break;
            //Operación para saber el usuario que se va a modificar
            case 'get':
                if ($recetas->setIdReceta($_POST['id_receta'])) {
                    if ($result['dataset'] = $recetas->getReceta()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Receta inexistente';
                    }
                } else {
                    
                    $result['exception'] = 'Receta incorrecta';
                }
                break;

                case 'getElaboracion':
                if ($recetas->setIdElab($_POST['id_elaboracion'])) {
                    if ($result['dataset'] = $recetas->getElab()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = 'Elaboración inexistente';
                    }
                } else {
                    
                    $result['exception'] = 'Elaboración incorrecta';
                }
                break;
                case 'readTableRecetas':
                    if ($recetas->setIdReceta($_POST['id_receta'])) {
                        if ($result['dataset'] = $recetas->getMateriasRecetas()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = 'No hay materia prima registrada';
                        }
                    }else{
                        $result['exception'] = 'Receta incorrecta';
                    }
                break;
            //Operación para actualizar un usuario
            case 'update':
				$_POST = $recetas->validateForm($_POST);
				if ($recetas->setIdReceta($_POST['id_receta'])) {
					if ($recetas->getReceta()) {
		                if ($recetas->setNombreReceta($_POST['update_nombre'])) {
                            if ($recetas->setTiempo($_POST['update_tiempo'])) {
                                        if ($recetas->updateReceta()) {
                                            $result['status'] = 1;
                                        } else {
                                            $result['exception'] = 'Operación fallida';
                                        }
                                }else {
                                    $result['exception'] = 'Tiempo incorrecta';
                                }
                            }else {
                                $result['exception'] = 'Nombre de receta incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Receta inexistente';
                        }
                    } else {
                        $result['exception'] = 'Receta incorrecta';
                    }
                    break;
                    case 'updateElaboracion':
                        $_POST = $recetas->validateForm($_POST);
                        if ($recetas->setIdElab($_POST['id_elaboracion'])) {
                            if ($recetas->getElab()) {
                                if ($recetas->setIdReceta($_POST['id_receta_updatemate'])) {
                                    if ($recetas->setIdMateria($_POST['id_update_materia'])) {
                                        if ($recetas->setCantidad($_POST['cantidad_materia_update'])) {
                                                    if ($recetas->updateElaboracion()) {
                                                        $result['status'] = 1;
                                                    } else {
                                                        $result['exception'] = 'Operación fallida';
                                                    }
                                                }else{
                                                    $result['exception'] = 'Cantidad incorrecta';
                                            }
                                        }else {
                                                $result['exception'] = 'Materia prima incorrecta';
                                            }
                                    }else {
                                        $result['exception'] = 'Receta incorrecta';
                                    }
                                } else {
                                    $result['exception'] = 'Receta inexistente';
                                }
                            } else {
                                $result['exception'] = 'Receta incorrecta';
                            }
                        break;
            case 'deleteMateria':
                    if ($recetas->setIdElab($_POST['idElaboracion'])) {
                        if ($recetas->deleteElaboracion()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = 'Operación fallida';
                        }
                    } else {
                        $result['exception'] = 'Materia prima inexistente';
                    }
                break;
                case 'deleteReceta':
                    if ($recetas->setIdReceta($_POST['id_receta'])) {
                        if ($recetas->deleteReceta()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = 'Operación fallida';
                        }
                    } else {
                        $result['exception'] = 'Materia prima inexistente';
                    }
                break;
            case 'readMateriaPrima':
                if ($result['dataset'] = $recetas->readMateriasPrimas()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
                }
                break;

            case 'readUnidad':
                if ($result['dataset'] = $recetas->readMedidaMateria()) {
                    $result['status'] = 1;
                } else {
                    $result['exception'] = 'Contenido no disponible';
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