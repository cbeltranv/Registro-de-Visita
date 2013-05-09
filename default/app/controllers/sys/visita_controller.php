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
Load::models('sys/registro','sys/visita');
class VisitaController extends AdminController {

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
            
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }        
    }
    
    public function crear($ids = ''){
        $this->titulo = "Registrar Mótivo de Visita";
        try{
            // Separa la Variable que trae los datos del usuario(a)
            $data   = explode('-',$ids);
            $id     = $data[0];
            $cedula = $data[1];
            $registro = new Registro();
            $this->reg = $registro->find_first($id);
            if (Input::hasPost('sys')) {
                $sys = new Visita(Input::post('sys'));
                $sys->registro_id   = $id;
                $sys->cedula        = $cedula;
                $sys->users         = Auth::get('id');
                if ($sys->save()) {
                    Flash::valid('Se Registro Exitosamente el Mótivo de la Visita...!!!');
                    if (!Input::isAjax()) {
                        return Router::redirect("panel/index");
                    }
                } else {
                    Flash::warning('No se Pudieron Guardar los Datos...!!!');
                }
            }            
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function editar($id){
        try{
            
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }        
    }
    
    public function borrar($id){
        try{
            
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }
    
    /**
     * Busca si la Cedula ya se encuentra en el registro de usuarios
     * si existe te envia al registro de la visita, sino,
     * redirecciona al Registro de Usuario(a)
     */
    
    public function buscar(){
        try{
            if(Input::hasPost('sys')){
                $cedula = $_POST['sys']['cedula'];
                $reg = new Registro();
                $busca = $reg->find_first("cedula = $cedula");
                if($busca){
                    Flash::success("$busca->nombres: Indique mótivo de su visita");
                    return Router::redirect("sys/visita/crear/$busca->id-$busca->cedula");    
                } else {
                    Flash::success("Cedula: $cedula, no esta Registrada. Por Favor Ingrese Información de Registro");
                    return Router::redirect("sys/registro/crear");    
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

}
?>