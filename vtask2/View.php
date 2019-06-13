<?php
/*
 * Zadanie 2
 * =========
 * Zaimplementuj od zera architekturę MVC bardzo podstawową:
 * ---------------------------------------------------------
 * Routingi tylko statyczne(żadnych zmiennych – stały tekst, który ma się zgrać z request’em)
 * Użyj .htaccess lub configu Nginx do wrzucenia ścieżki odpytywanej do zmiennej
 * Routing ma wywoływać klasę i wybraną z niej publiczną metodę, jako kontroler
 * Warstwa View – widoku może być includem(...) zwykłego pliku php, w którym będzie dany
 * widok. Nie musi być tu użyty żadnej silnik templetów.
 */


/**
 * Warstwa View – widoku może być includem(...) zwykłego pliku php, w którym będzie dany
 * widok. Nie musi być tu użyty żadnej silnik templetów.
 *
 * @author wiks
 */
class View {
    
    /** wrap all in HTML regules
     * 
     * @param type $body
     * @return string
     */
    public function main_view($body) {

        $html = '<!DOCTYPE html>
                <html>
                    <head>
                        <meta charset="UTF-8">
                        <title>vTask2</title>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>   
                        <script type="text/javascript" src="js/jquery-ui-1.8.1.custom.min.js"></script>
                    </head>
                    <body>';
        $html .= $body;
        $html .= '</body>
            </html>';
        return $html;
    }
    
    /** success info
     * 
     * @param type $html0
     * @return string
     */
    public function success($html0) {
        
        $html = '<div class="alert alert-success" role="alert">'
                .$html0
                .'</div>';
        return $html;
    }    
    
    /** show alert info
     * 
     * @param type $html0
     * @return string
     */
    public function badrequest($html0) {
        
        $html = '<div class="alert alert-danger" role="alert">'
                .$html0
                .'</div>';
        return $html;
    }
    
    
}
