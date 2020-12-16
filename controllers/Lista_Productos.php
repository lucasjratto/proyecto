<?php

// controllers/Lista_Productos.php

require '../fw/fw.php';
require '../models/Productos.php';
require '../models/Usuarios.php';
require '../views/Lista_Productos.php';

$Usuario = new Usuarios();
$m = new Productos();
$v = new Lista_Productos();

if(isset($_GET['Nombre']))
    {
        if(!empty($_GET['Nombre']) || !empty($_GET['Descripcion']) || !empty($_GET['Precio_Max']) || !empty($_GET['Precio_Min']) || !empty($_GET['Alto_Max']) || !empty($_GET['Alto_Min']) || !empty($_GET['Ancho_Max']) || !empty($_GET['Ancho_Min']) || !empty($_GET['Largo_Max']) || !empty($_GET['Largo_Min']) || $_GET['Categorias'] != -1 || $_GET['Materiales'] != -1 || $_GET['Colores'] != -1)
            {
                $Productos = $m->BusquedaProducto( $_GET['Nombre'], $_GET['Descripcion'], $_GET['Precio_Max'], $_GET['Precio_Min'], $_GET['Alto_Max'], $_GET['Alto_Min'], $_GET['Ancho_Max'], $_GET['Ancho_Min'], $_GET['Largo_Max'],$_GET['Largo_Min'],$_GET['Categorias'], $_GET['Materiales'], $_GET['Colores']);
                $v->Old_Nombre = htmlentities($_GET['Nombre']);
                $v->Old_Descripcion = htmlentities($_GET['Descripcion']);
                $v->Old_Precio_Max = htmlentities($_GET['Precio_Max']);
                $v->Old_Precio_Min = htmlentities($_GET['Precio_Min']);
                $v->Old_Alto_Max = htmlentities($_GET['Alto_Max']);
                $v->Old_Alto_Min = htmlentities($_GET['Alto_Min']);
                $v->Old_Ancho_Max = htmlentities($_GET['Ancho_Max']);
                $v->Old_Ancho_Min = htmlentities($_GET['Ancho_Min']);
                $v->Old_Largo_Max = htmlentities($_GET['Largo_Max']);
                $v->Old_Largo_Min = htmlentities($_GET['Largo_Min']);
                $v->Old_Categoria = htmlentities($_GET['Categorias']);
                $v->Old_Material = htmlentities($_GET['Materiales']);
                $v->Old_Color = htmlentities($_GET['Colores']);
            }
        else 
            {
                $Productos = $m->getTodos();
            }
    }
else 
    {
        $Productos = $m->getTodos();
    }

$Categorias = $m->getTodosCategorias();
$Materiales = $m->getTodosMateriales();
$Colores = $m->getTodosColores();
$v->Categorias = $Categorias;
$v->Productos = $Productos;
$v->Materiales = $Materiales;
$v->Colores = $Colores;
$v->add_Navegacion('Productos' , PathConfig::LISTA_PRODUCTO_PATH,);
if($Usuario->isLoged()) $v->add_Navegacion('Alta Productos' , PathConfig::ALTA_PRODUCTO_PATH);
if($Usuario->isRoot()) $v->add_Navegacion('Alta Administrador' , PathConfig::ALTA_ADMIN_PATH);
if($Usuario->isLoged()) $v->add_Navegacion('Cerrar Sesión' , PathConfig::LOGOUT_PATH);
if(!$Usuario->isLoged()) $v->add_Navegacion('Login' , PathConfig::LOGIN_PATH);
$v->render();