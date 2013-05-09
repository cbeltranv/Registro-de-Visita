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
 * @package Modelos
 * @license http://www.gnu.org/licenses/agpl.txt GNU AFFERO GENERAL PUBLIC LICENSE version 3.
 * @author Héctor Rodríguez Velásquez <rodriguez.hectoralejandro@gmail.com>
 */
class Registro extends ActiveRecord {
    
    public $debug = false;
    
    public function getList(){
        $campos = "registro.*, municipio.nombre as municipio, parroquia.nombre as parroquia";
       @$joins .= "INNER JOIN municipio ON registro.municipio_id = municipio.id ";
        $joins .= "INNER JOIN parroquia ON registro.parroquia_id = parroquia.id";
        $orden  = "registro.municipio_id ASC";
        return $this->find("columns: $campos","join: $joins","order: $orden");
    }
    
}
?>