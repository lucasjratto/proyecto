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

session_start();
session_destroy();
header('Location: ' . PathConfig::LISTA_PRODUCTO_PATH);
exit;