<?php

class TemplateEngine{

    public static function template($file, $args){
        if ( !file_exists( $file ) ) {
            return '';
        }

        if ( is_array( $args ) ){
            extract( $args );
        }
        ob_start();
        include $file;
        return ob_get_clean();
    }
}
?>