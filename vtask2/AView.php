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
class AView {
    

    public function __construct() {
    }

    
    public function output($nbp) {

        $html = '<div class="container">'
                ."<h2>NBP ".$nbp[0]->no." </h2>"
                ."<h4> ".$nbp[0]->effectiveDate." </h4>"
                .'<p>takie jakie kursy</p>'
                .'<table class="table table-hover">'
                  .'<thead>'
                    .'<tr>'
                      .'<th>currency</th>'
                      .'<th>mid</th>'
                      .'<th>code</th>'
                    .'</tr>'
                  .'</thead>'
                  .'<tbody>';
        foreach ($nbp[0]->rates as $obj) {
            $html .=    '<tr>'
                          .'<td>'.$obj->currency.'</td>'
                          .'<td>'.$obj->mid.'</td>'
                          .'<td>'.$obj->code.'</td>'
                        .'</tr>';
        }
        $html .=  '</tbody>'
                .'</table>'
              .'</div>';
        return $html;

    }
    
}
