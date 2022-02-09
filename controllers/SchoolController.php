<?php

namespace school_board_test;

use school_board_test\CSMRule;
use school_board_test\CSMBRule;

class SchoolController
{

 
    public static function get_final_result($student)
    {
       
        switch ($student->school_id){
            case CSM:
            return CSMRule::get_final_result($student->average);
               
            case CSMB:
             return CSMBRule::get_final_result($student->grades);
             
            default:
                return "School ID not found.";
        }
    }

   
    public static function return_by_school_format($student)
    {
        switch ($student->school_id){
            case CSM:
                unset($student->school_id);
                return json_encode($student);
            case CSMB:
                unset($student->school_id);
                if(count($student->grades) >= 2){
                    sort($student->grades);
                    array_shift($student->grades);
                    $student->average = array_sum($student->grades) / count($student->grades);
                }

                $xml = new \SimpleXMLElement('<xml/>');

                foreach ($student as $k=>$v) {
                    if(is_array($v)){
                        $v = implode(', ', $v);
                    }
                    $xml->addChild($k, $v);
                }
                return ($xml->asXML());

            default:
                return "School ID not found.";
        }
    }

}