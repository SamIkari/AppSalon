<?php
namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {
    // Obtener todos los servicios
    public static function index() {
        header('Content-Type: application/json');
        $servicios = Servicio::all(); // Asegúrate de que el método all() esté bien implementado
        echo json_encode($servicios);
    }

    // Guardar cita con servicios seleccionados
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

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }

    // Cambiar estado de servicio (activo o inactivo)
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
?>
