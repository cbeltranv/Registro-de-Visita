<?php
/**
* SSPPJ - App Para Registro Visitantes de INSAJUV
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
* @package Controller
* @license http://www.gnu.org/licenses/agpl.txt GNU AFFERO GENERAL PUBLIC LICENSE version 3.
* @author Héctor Rodríguez Velásquez <rodriguez.hectoralejandro@gmail.com>
*/
class VariableController extends AdminController {

    /**
     * Funcion para mostrar la Parroquia
     * $id parametro de ID del municipio que lista las parroquias
     */
    
    public function parroquia($id){
        View::response('view');
        echo Form::dbSelect('sys.parroquia_id','nombre',array("sys/parroquia","find","municipio_id = $id"));
    }

}
?>