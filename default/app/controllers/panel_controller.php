<?php

/**
 * JPSUV - Seguimiento - KumbiaPHP
 * PHP version 5
 * LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * ERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Controlador
 * @license http://www.gnu.org/licenses/agpl.txt GNU AFFERO GENERAL PUBLIC LICENSE version 3.
 * @author Héctor A. Rodríguez <rodriguez.hectoralejandro@gmail.com>
 */
Load::models('sys/registro','sys/visita');
class PanelController extends AdminController
{
    /**
     * Luego de ejecutar las acciones, se verifica si la petición es ajax
     * para no mostrar ni vista ni template.
     */
    protected function after_filter() {
        if (Input::isAjax()) {
            View::select(NULL, NULL);
        }
    }
    
    public function index(){
        try{
            $this->titulo = "Pizarra";
            $visita = new Visita();
            $this->estadisticas_del_dia = $visita->estadisticas_del_dia();
            $this->total = $visita->total_por_dia();
        } catch(KumbiaException $e){
            View::excepcion($e);
        }
    }
}
?>