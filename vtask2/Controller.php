<?php

require '../../vtask2/View.php';

/**
 * Description of Controller
 *
 * @author wiks
 */
class Controller {
    
    /** view
     *
     * @var type 
     */
    public $v;
    
    /** name of class from path
     *
     * @var type 
     */
    private $request_class = null;
    /** name of method from path
     *
     * @var type 
     */
    private $request_method = null;
    /** maybe even some data from path
     *
     * @var type 
     */
    private $request_data = null;
    
    /** list of present file with name like *Controller
     *
     * @var type 
     */
    private $present_class_file_list = [];
    
    /** construct - create View obj, check all filec fit to Controller.php name
     * 
     * @param type $request
     */
    public function __construct($request) {
        
        $this->v = new View();        
        
        $this->body = '';
        foreach (glob("../../vtask2/*Controller.php") as $filename_path)
        {
            $res = explode("/", $filename_path);
            if($res) {
                $filename = $res[count($res)-1];
                $res2 = explode("Controller.php", $filename);
                if($res2 && count($res2)==2) {
                    $this->present_class_file_list[] = ['fullpath' => $filename_path, 
                                                        'filename' => $res2[0]];
                }
            }
        }
    }

    /** pickup clann name and method from request
     * 
     * @param type $request
     */
    private function get_names_of_requested_class_method_data($request) {

        $request_list = explode("/", $request, 3);
        if($request_list && count($request_list) >= 2) {
            $this->request_class = $request_list[0];
            $this->request_method = $request_list[1];
            if (count($request_list) > 2) {
                $this->request_data = $request_list[2];
            }
        }
    }

    /** check is class and method exist
     * 
     * @param type $request_class
     * @param type $request_method
     * @return boolean
     */
    private function check_if_class_method_exist($request_class, $request_method) {
        
        $ret = null;
        $classname = ucfirst($request_class).'Controller';
        if($request_class && class_exists($classname)) {
            $this->body .= 'klasa: '.$classname.' istnieje<br>';
            $type = $classname;
            $instance = new $type;
            if( method_exists($instance, $request_method) ) {
                $this->body .= 'metoda '.$request_method.' istnieje <br>';
                $ret = true;
            }else{
                $this->body .= 'BRAK metod '.$request_method.'<br>';
            }
        }else{
            $this->body .= 'brak klasy: '.$classname.'<br>';
        }            
        return $ret;
    }

    /** pickup request data, include requested class, check if method exist and is callable
     *  and fire it
     * 
     * @param type $request
     * @return type
     */
    public function show($request) {
        
        if($request) {
            $this->get_names_of_requested_class_method_data($request);
        }

        foreach ($this->present_class_file_list as $filename_path)
        {
            if($this->request_class && strtolower($filename_path['filename']) == $this->request_class) {
                $this->body .= 'include "'.$filename_path['fullpath'].'";<br>';
                include $filename_path['fullpath'];
            }
        }
        
        if($this->check_if_class_method_exist($this->request_class, 
                                              $this->request_method)) {
            $class_name = $this->request_class."Controller";
            $obj = new $class_name;
            $m = $this->request_method;
            if( is_callable([$obj, $m]) ) {
                $this->body = $this->v->success($this->body);
                $this->body .= $obj->$m();
            }else{
                $this->body = $this->v->badrequest($this->body);
            }
        }else{
            $this->body = $this->v->badrequest($this->body);
        }
        return $this->v->main_view($this->body);
    }    
    
}
