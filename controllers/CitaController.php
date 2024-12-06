<?php
namespace Controllers;

use MVC\Router;
use Model\Servicio;

class CitaController {
    public static function index(Router $router) {
        if (!isset($_SESSION)) {
            session_start();
        }

        // Verificar si el usuario está autenticado
        isAuth();

        // Pasar los datos a la vista
        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }
}
