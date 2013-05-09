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
class Visita extends ActiveRecord {
    public $debug = false;
    
    public function estadisticas_del_dia(){
        $date = date("Y-m-d");
        $sql = "SELECT servicios.nombre AS servicios, COUNT( visita.id ) AS cant, DATE_FORMAT( c_at, '%Y-%m-%d' ) AS fecha
                FROM visita
                INNER JOIN servicios ON visita.servicios_id = servicios.id
                WHERE DATE_FORMAT( c_at, '%Y-%m-%d' ) = '$date'
                GROUP BY visita.servicios_id";
        return $this->find_all_by_sql($sql);
    }
    
    public function total_por_dia(){
        $date = date("Y-m-d");
        $sql = "SELECT COUNT(id) As cant
                FROM visita
                WHERE DATE_FORMAT( c_at, '%Y-%m-%d' ) = '$date'";
        return $this->count_by_sql($sql);
    }
}
?>