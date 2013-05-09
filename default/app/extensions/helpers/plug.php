<?php

class Plug
{
    /**
     * Link de una Imagen con Html::link()
     *
     */
    public static function linkImg($url, $src, $alt=null, $attrsL=null,$linkAction = true, $attrsI=null)
    {
	if($linkAction):
	    $link = Html::linkAction($url, Html::img($src, $alt, array('title'=>$alt)), $attrsL);
	else:
	    $link = Html::link($url, Html::img($src, $alt, $attrsI), $attrsL);
        endif;
	return $link;
    }
    
    /**
     * Calendario con JQUERY
     *
     */
    public static function fecha($field, $attrs = NULL, $value = NULL){ 
        static $i = false; 
        $code   =   ''; 
        if($i == false){
            $i = true; 
            $code   =    Tag::css('scripts/ui/south/jquery.ui.all');
            $code   .=   Tag::js('jquery/ui/jquery.ui.core');
            $code   .=   Tag::js('jquery/ui/jquery.ui.datepicker');
	    $code   .=   Html::includeCss();
        } 
        $code   .=   Form::text($field, $attrs, $value); 
        $field  =   str_replace('.', '_', $field); 
        $code   .=  "<script type=\"text/javascript\"> 
                      $(function() { 
                          $(\"#" . $field . "\").datepicker({ 
                          altFormat: 'dd-mm-yy', 
                          autoSize: true, 
                          dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'], 
                          dayNamesMin: ['Dom', 'Lu', 'Ma', 'Mi', 'Je', 'Vi', 'Sa'], 
                          firstDay: 1, 
                          monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'], 
                          monthNamesShort: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'], 
                          dateFormat: 'yy-mm-dd', 
                          changeMonth: true, 
                          changeYear: true }); 
                      }); 
                      </script>"; 
        return $code; 
    }
    
    /**
 * Crea <tr> de colores pasando como parametro los colores
 * @deprecated
 */
    public static function tr_color(){
	static $i;
	if(func_num_args()>1){
		$params = Util::getParams(func_get_args());
	}
	if(!$i) {
		$i = 1;
	}
	print "<tr bgcolor=\"{$params[$i-1]}\"";
	if(count($params)==$i) {
		$i = 1;
	} else {
		$i++;
	}
	if(isset($params)){
		if(is_array($params)){
			foreach($params as $key => $value){
				if(!is_numeric($key)){
					print " $key = '$value'";
				}
			}
		}
	}
	print ">";
    }
    
    
    public static function td_break($x = '', $color = '')
    {
	static $l;
	if($x=='') {
		$l = 0;
		return;
	}
	if(!$l) {
		$l = 1;
	} else {
		$l++;
	}
	if(($l%$x)==0) {
		print "</td style='background: $color;'><td>";
	}
    }
    
    /**
     * Formatea la Fecha en dd/mm/yyyy
     * @param date $date pasa la fecha
     * @param string $lang = 'es'
     */
    public static function formatFecha($date,$lang = 'es')
    {
	$code = explode('-',$date);
	if($lang == 'es'):
	    $year= $code['0'];
	    $month= $code['1'];
	    $day= $code['2'];
	    $fecha = $day.'-'.$month.'-'.$year;
	// En caso de devolver el valor en ingles formato MySQL
	elseif($lang == 'en'):
	    $year= $code['2'];
	    $month= $code['1'];
	    $day= $code['0'];
	    $fecha = $year.'-'.$month.'-'.$day;
	endif;
	return $fecha;
    }
    
    public static function listar_directorios($action='')
    {	
	$dir = APP_PATH.$action;
	$a = scandir($dir, 1);
	//print_r($a);
	foreach($a As $k=>$z):
	    echo $a[$k].',';
	endforeach;
    }
    
    /**
     * Calcular edad...
     * $fecha en formato date Y-m-d
     */
    public static function CalculaEdad($fecha) {
	list($Y,$m,$d) = explode("-",$fecha);
	return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }
    
    /**
      * Normaliza una fecha de
      * dd/mm/aaaa a aaaa/mm/dd
    */ 
    public static function normalize_date($date) {
	if(!empty($date)){
	    $var = explode('/',str_replace('-','/',$date));
	    return "$var[2]/$var[1]/$var[0]";
	}
    }
    
    public static function getRealIpAddr() {
       if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
              $ip=$_SERVER['HTTP_CLIENT_IP'];
       } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
              $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
       }else{
              $ip=$_SERVER['REMOTE_ADDR'];
       }
    return $ip;
    }
}

?>