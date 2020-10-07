<?php

namespace App\Http\Controllers;
class ControladorPlantilla
{
    public function ctrPlantilla()
    {
        if(isset($_GET["ruta"]) && strpos($_GET["ruta"], 'print-ticket-') !== false) {
            include "vistas/modulos/print-ticket.php";

        }else{
            // include "vistas/plantilla.php";
        }
    }
}
