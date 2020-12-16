<?php

// controllers/Lista_Productos.php

require '../fw/fw.php';
require '../models/Productos.php';
require '../models/Usuarios.php';
require '../views/Detalle_Productos.php';
require '../views/Detalle_Productos_Update.php';

$Usuario = new Usuarios();

if(!isset($_GET['Id_Producto'])) // No llega desde el click de la web
    {
        header('Location: ' . PathConfig::LISTA_PRODUCTO_PATH);
        exit;
    }

if(!$Usuario->isLoged()) // No logeado
    {
        $m = new Productos();
        $Productos = $m->getIdProducto($_GET['Id_Producto']);

        $v = new Detalle_Productos();
        $v->Productos = $Productos;
        $v->add_Navegacion('Productos' , PathConfig::LISTA_PRODUCTO_PATH);
        $v->add_Navegacion('Login' , PathConfig::LOGIN_PATH);
        $v->render();
        exit;
    }

/*
*************************************
**** Si Pasó Por aca esta Logeado ***
*************************************
*/

else // Logeado
    {

        if(isset($_POST['Nombre']) && isset($_POST['Modificar_Producto'])) // Logeado - Modificar
            {
                $m = new Productos();

                // Valido Imputs del Form
                if(!isset($_POST['Nombre']) || !isset($_POST['Descripcion']) || !isset($_POST['Precio']) || !isset($_POST['Alto']) || !isset($_POST['Ancho']) || !isset($_POST['Largo']) || !isset($_POST['Stock']) || !isset($_POST['Stock']) || !isset($_POST['Categorias']) || !isset($_POST['Materiales']) || !isset($_POST['Colores'])) die ('Error 97');

                $m->UpdateProducto($_GET['Id_Producto'],$_POST['Nombre'],$_POST['Descripcion'],$_POST['Precio'],$_POST['Alto'],$_POST['Ancho'],$_POST['Largo'],$_POST['Stock'],$_FILES["Image"] , $_POST['Categorias'], $_POST['Materiales'], $_POST['Colores']);

            }

        elseif (isset($_POST['Nombre']) && isset($_POST['Eliminar_Producto'])) // Logeado - Eliminar
            {
                $m = new Productos();

                // Valido Imputs del Form
                if( !isset($_POST['Nombre']) || !isset($_POST['Descripcion']) || !isset($_POST['Precio']) || !isset($_POST['Alto']) || !isset($_POST['Ancho']) || !isset($_POST['Largo']) || !isset($_POST['Stock'])) die ('Error 96');

                $m->DeleteProducto($_GET['Id_Producto']);
                header('Location: ' . PathConfig::LISTA_PRODUCTO_PATH);
                exit;
            }
    }

$mm = new Productos();
$Producto = $mm->getIdProducto($_GET['Id_Producto']);

$mca = new Categorias();
$mco = new Colores();
$ma = new Materiales();

$Categorias = $mca->getTodos();
$Materiales = $ma->getTodos();
$Colores = $mco->getTodos();

$v = new Detalle_Productos_Update();
$v->Productos = $Producto;
$v->Categorias = $Categorias;
$v->Materiales = $Materiales;
$v->Colores = $Colores;

$v->add_Navegacion('Productos' , PathConfig::LISTA_PRODUCTO_PATH);
$v->add_Navegacion('Alta Productos' , PathConfig::ALTA_PRODUCTO_PATH);
if($Usuario->isRoot()) $v->add_Navegacion('Alta Administrador' , PathConfig::ALTA_ADMIN_PATH);
$v->add_Navegacion('Cerrar Sesión' , PathConfig::LOGOUT_PATH);
$v->render();