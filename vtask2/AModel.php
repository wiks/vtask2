<?php

/**
 * Description of Model
 *
 * @author wiks
 */
class AModel {

    
    private $nbptable = null;
    
    /**
     * construct and read from NBP or from file if not so old
     */
    public function __construct() {
    
        mylog('Model construct');
        $nbpresultjson0 = null;
        $nbp_path_filename = "nbpjson.txt";
        $nbpjsonfile0 = null;
        $nbpjson_dt = null;
        if (file_exists($nbp_path_filename)) {
            mylog('NBP file_exists');
            $nbpjsonfile0 = fopen($nbp_path_filename, "rw");
            $nbpresultjson0 = fread($nbpjsonfile0, filesize($nbp_path_filename));
            $nbpf_date = new DateTime();
            $nbpf_timestamp = filemtime($nbp_path_filename);
            $nbpf_date->setTimestamp($nbpf_timestamp);
            $nbpjson_dt = $nbpf_date->format('Y-m-d H');
            mylog('NBP file DT: '. $nbpjson_dt);
            $now = new DateTime();
            mylog('now: '. $now->format('Y-m-d H'));
            if( $nbpjson_dt != $now->format('Y-m-d H') ) {
                $nbpjson_dt = null;
            }
        }
        if(!$nbpresultjson0 || !$nbpjson_dt) {
            $nbpurl = 'http://api.nbp.pl/api/exchangerates/tables/A/today/?format=json';
            $nbpresultjson = file_get_contents($nbpurl);
            mylog('NBP tbl request --> saved to file');
            $nbpjsonfile = fopen($nbp_path_filename, "w");
            fwrite($nbpjsonfile, $nbpresultjson);
            fclose($nbpjsonfile);
            $this->nbptable = json_decode($nbpresultjson);
        }
        if(!$this->nbptable && $nbpresultjson0) {
            $this->nbptable = json_decode($nbpresultjson0);
            mylog('NBP tbl read from file');
        }
    }
    
    
    public function getNbp() {
        
        return $this->nbptable;
    }
    
}
