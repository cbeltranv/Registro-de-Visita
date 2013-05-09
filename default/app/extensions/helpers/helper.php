<?php

class Helper
{
    
    public static function link($action,$text,$class)
    {
        return Html::linkAction($action,
               Form::button($text,array('id'=>'fat-btn','class'=>$class,
                                        'data-loading-text'=>'Descargando...')),
               array('target'=>'_blank'));
    }

    public static function link2($action,$text,$class)
    {
        return Html::linkAction($action,
               Form::button($text,array('id'=>'fat-btn','class'=>$class,
                                        'data-loading-text'=>'Descargando...')));
    }
    
    public static function linkIcon($action,$icon,$text,$attrs = NULL)
    {
        if (is_array($attrs)) {
            $attrs = Tag::getAttrs($attrs);
        }   
        return '<a href="' . PUBLIC_PATH . Router::get('controller_path') . "/$action\" $attrs ><i class='icon-$icon'></i>  $text</a>";
    }
    
    public static function link2Icon($action,$icon,$text,$attrs = NULL)
    {
        if (is_array($attrs)) {
            $attrs = Tag::getAttrs($attrs);
        }   
        return '<a href="' . PUBLIC_PATH . "$action\" $attrs ><i class='icon-$icon'></i>  $text</a>";
    }
    
    /**
     * LectorRSS
     * $url del feed
     * $elementos => cantidad de feed a mostrar
     *
     *
     */
    public static function lectorRSS($url,$elementos=6,$inicio=0)
    {
        $cache_version = "cache/" . basename($url);
        $archivo = fopen($url, 'r');
        stream_set_blocking($archivo,true);
        stream_set_timeout($archivo, 5);
        $datos = stream_get_contents($archivo);
        $status = stream_get_meta_data($archivo);
        fclose($archivo);
        if ($status['timed_out']) {
          $noticias = simplexml_load_file($cache_version);
        } else {
          $archivo_cache = fopen($cache_version, 'w');
          fwrite($archivo_cache, $datos);
          fclose($archivo_cache);
          $noticias = simplexml_load_string($datos);
        }
    
        $ContadorNoticias=1;
        echo "<ul class='unstyled'>";
        foreach ($noticias->channel->item as $noticia) { 
            if($ContadorNoticias<$elementos){
                if($ContadorNoticias>$inicio){
                    echo "<li><a href='".$noticia->link."' target='_blank' class='tooltip' title='".utf8_decode($noticia->title)."'>";
                    echo utf8_decode($noticia->title);
                    echo "</a></li>";
                }
                $ContadorNoticias = $ContadorNoticias + 1;
            }
        } 
        echo "</ul>";
    }
    
    
}

?>