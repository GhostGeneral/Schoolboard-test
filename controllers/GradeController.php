<?php

namespace school_board_test;

class GradeController
{

    public function store(){
        $grade = new Grade($_POST);
        if($grade->insert()){
            echo json_encode("Successfully added grade.");
        }else{
            echo json_encode($grade->errors);
        }
    }

}
