<?php

namespace school_board_test;


class StudentController
{

    
    public function register()
    {
        $student = new Student($_POST);
        if($student->register()){
            echo json_encode("Successfully added student.");
        }else{
            echo json_encode($student->errors);
        }
    }

    
   

}