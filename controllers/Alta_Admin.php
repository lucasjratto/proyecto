<?php

// controllers/Login_Productos.php

require '../fw/fw.php';
require '../models/Usuarios.php';
require '../views/Alta_Admin.php';
//

$m = new Usuarios();

if(!$m->isRoot()) // No es Usuario ROOT (Tampoco esta Logeado)
    {
        header('Location: ' . PathConfig::LISTA_PRODUCTO_PATH);
        exit;
    }

/*
********************************
**** Si Pasó Por aca es ROOT ***
********************************
*/

if(isset($_POST['Email']) && isset($_POST['Pass']))
    {
        $m->altaAdmin ($_POST['Email'], $_POST['Pass']);
        $v = new Alta_Admin();
        $v->Mensaje = 'Usuario registrado correctamente';

        $v->add_Navegacion('Alta Productos' , PathConfig::ALTA_PRODUCTO_PATH);
        if($m->isRoot()) $v->add_Navegacion('Alta Administrador' , PathConfig::ALTA_ADMIN_PATH);
        $v->add_Navegacion('Cerrar Sesión' , PathConfig::LOGOUT_PATH);
        $v->render();
        exit;
    }

$v = new Alta_Admin();
$v->Mensaje = 'Ingrese Email y Contraseña para dar de alta un Administrador';
$v->add_Navegacion('Productos' , PathConfig::LISTA_PRODUCTO_PATH,);
$v->add_Navegacion('Alta Productos' , PathConfig::ALTA_PRODUCTO_PATH);
$v->add_Navegacion('Alta Administrador' , PathConfig::ALTA_ADMIN_PATH);
$v->add_Navegacion('Cerrar Sesión' , PathConfig::LOGOUT_PATH);
$v->render();
