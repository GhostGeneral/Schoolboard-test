<?php

namespace school_board_test;

trait DB
{


    public $db;

    // DB constructor.
     
    function __construct()
    {
        $this->init_db();
    }

    // init database connection
    
    function init_db(){
        $this->db = Database::connection();
    }
}