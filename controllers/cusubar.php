<?php
require_once('models/musubar.php');

class SolicitudController {
    private $model;

    public function __construct() {
        $this->model = new SolicitudModel();
    }

    // Obtener los pasos de progreso para la vista
    public function getProgressBarData($idUsuario) {
        $solicitud = $this->model->getSolicitudEstadoByUsuario($idUsuario);

        if (!$solicitud) {
            return ['steps' => [], 'progress' => 1];
        }

        $etasol = $solicitud['etasol'];

        $steps = [
            1 => ['label' => 'En espera', 'completed' => $etasol >= 1],
            2 => ['label' => 'En proceso', 'completed' => $etasol >= 2],
            3 => ['label' => 'Finalizada', 'completed' => $etasol >= 3],
        ];

        $completedSteps = count(array_filter($steps, fn($step) => $step['completed']));
        $progress = ($completedSteps - 1) / (count($steps) - 1) * 100;

        return ['steps' => $steps, 'progress' => $progress];
    }
}
?>

