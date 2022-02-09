<?php

namespace school_board_test;


class Database extends \mysqli
{
   
    public static $connection;


    public static function connection(){
      
        if (self::$connection){
            return self::$connection;
        } else {
            
            self::$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
            or die(self::$connection->connect_error);
            self::$connection->set_charset("utf8");
            return self::$connection;
        }
    }
}