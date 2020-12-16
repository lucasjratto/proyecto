<?php

// controllers/Alta_Productos.php

require '../fw/fw.php';
require '../models/Productos.php';
require '../models/Usuarios.php';
require '../views/Alta_Productos.php';

$Usuario = new Usuarios();

if(!$Usuario->isLoged()) // No Logeado
    {
        header('Location: ' . PathConfig::LISTA_PRODUCTO_PATH);
        exit;
    }

/*
*************************************
**** Si Pasó Por aca esta Logeado ***
*************************************
*/

if(isset($_POST['Nombre']))
    {
        // Valido Imputs del Form
        if(!isset($_POST['Nombre']) || !isset($_POST['Descripcion']) || !isset($_POST['Precio']) || !isset($_POST['Alto']) || !isset($_POST['Ancho']) || !isset($_POST['Largo']) || !isset($_POST['Stock']) || !isset($_FILES["Image"]["tmp_name"]) || !isset($_POST['Categorias']) || !isset($_POST['Materiales']) || !isset($_POST['Colores'])) die ('Error 98');

        $m = new Productos();
        $m->AltaProducto( $_POST['Nombre'],$_POST['Descripcion'],$_POST['Precio'],$_POST['Alto'],$_POST['Ancho'],$_POST['Largo'],$_POST['Stock'],$_FILES["Image"], $_POST['Categorias'], $_POST['Materiales'], $_POST['Colores']);
        
    }

$mca = new Categorias();
$mco = new Colores();
$ma = new Materiales();

$Categorias = $mca->getTodos();
$Materiales = $ma->getTodos();
$Colores = $mco->getTodos();

$v = new Alta_Productos();

$v->Categorias = $Categorias;
$v->Materiales = $Materiales;
$v->Colores = $Colores;

$v->add_Navegacion('Productos' , PathConfig::LISTA_PRODUCTO_PATH,);
$v->add_Navegacion('Alta Productos' , PathConfig::ALTA_PRODUCTO_PATH);
if($Usuario->isRoot()) $v->add_Navegacion('Alta Administrador' , PathConfig::ALTA_ADMIN_PATH);
$v->add_Navegacion('Cerrar Sesión' , PathConfig::LOGOUT_PATH);
$v->render();