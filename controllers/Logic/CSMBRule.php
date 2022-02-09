<?php

namespace school_board_test;

class CSMBRule
{
   
    public static function get_final_result($grades){
        if(max($grades) > 8){
            return "Pass";
        }
        return "Fail";
    }
}