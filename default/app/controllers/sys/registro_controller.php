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

Load::models('sys/registro');
class RegistroController extends AdminController {

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
        $this->titulo = "Usuarios Registrados";
        try{
            $registro = new Registro();
            $this->results = $registro->getList();
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }        
    }
    
    public function crear(){
        $this->titulo = "Registrar Usuario(a)";
        try{
            if (Input::hasPost('sys')) {
                $sys = new Registro(Input::post('sys'));
                $sys->users = Auth::get('id');
                $sys->f_nac = Plug::normalize_date($_POST['sys']['f_nac']);
                if ($sys->save()) {
                    Flash::valid('El o La Usuario(a) se ha Registrado Exitosamente...!!!');
                    if (!Input::isAjax()) {
                        return Router::redirect("sys/visita/crear/$sys->id-$sys->cedula");
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
    
    public function view($id){
        try{
            
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }
    

}
?>