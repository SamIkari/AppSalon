<?php
namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar() {
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $id = $resultado['id'];

        $idServicios = explode(",", $_POST['servicios']);
        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }

    public static function cambiarEstado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nuevoEstado = $_POST['estado']; // 1 = Activo, 0 = Inactivo

            $servicio = Servicio::find($id);

            if ($servicio) {
                $servicio->estado = $nuevoEstado;
                $resultado = $servicio->guardar();

                echo json_encode([
                    'resultado' => $resultado ? 'exito' : 'error',
                    'estado' => $nuevoEstado
                ]);
            } else {
                echo json_encode(['resultado' => 'error']);
            }
        }
    }
}
