<?php

// controllers/Login_Productos.php

require '../fw/fw.php';
require '../models/Usuarios.php';
require '../views/Login.php';

$m = new Usuarios();

if($m->isLoged()) // logeado
    {
        header('Location: ' . PathConfig::LISTA_PRODUCTO_PATH);
        exit;
    }

/*
****************************************
**** Si Pasó Por aca NO esta Logeado ***
****************************************
*/

if(isset($_POST['Email']) && isset($_POST['Pass']))
    {
        if($m->LoginUsuario($_POST['Email'], $_POST['Pass'])) // Logeado OK
            {
                header('Location: ' . PathConfig::LISTA_PRODUCTO_PATH);
                exit;
            }
        else // Logeado no OK
            {
                $v = new Login();
                $v->Mensaje = 'Email o contraseña incorrecta';
                $v->add_Navegacion('Lista Productos' , PathConfig::LISTA_PRODUCTO_PATH);
                $v->add_Navegacion('Login' , PathConfig::LOGIN_PATH);
                $v->render();
                exit;
            }
    }

$v = new Login();
$v->Mensaje = 'Ingrese Email y contraseña';
$v->add_Navegacion('Productos' , PathConfig::LISTA_PRODUCTO_PATH);
$v->add_Navegacion('Login' , PathConfig::LOGIN_PATH);
$v->render();
