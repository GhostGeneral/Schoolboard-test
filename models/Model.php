<?php

namespace school_board_test;

class Model
{

    use DB;

    public $table;
    public $errors;

   
    protected function init_class($post){
        foreach ($post as $key => $value){
            $this->table->$key = $this->db->real_escape_string($value);
        }
    }

}