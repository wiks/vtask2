<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyLog
 *
 * @author wiks
 */
//class MyLog {
    
    /**
     * 
     * @param type $log_msg
     */
    function mylog($log_msg)
    {
        $log_foldername = "log";
        if (!file_exists($log_foldername)) 
        {
            // create directory/folder uploads.
            mkdir($log_foldername, 0777, true);
        }
        $log_file_data = $log_foldername.'/log_' . date('Ymd') . '.log';
        file_put_contents($log_file_data, date('H:i:s').' - '.$log_msg . "\n", FILE_APPEND);
    }

//}
