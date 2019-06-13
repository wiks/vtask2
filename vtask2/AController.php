<?php

require '../../vtask2/AModel.php';
require '../../vtask2/AView.php';

//echo '--';

/**
 * Description of Controller
 *
 * @author wiks
 */
class AController {
    

    private $model;
    
    private $view;


    public function __construct() {

        $this->model = new AModel();
        $this->view = new AView();
    }

    
    public function show() {

        $html = $this->view->output($this->model->getNbp());
        return $html;
    }    
    
}
