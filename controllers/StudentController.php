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

    public function index($id = false)
    {
       
        $id = ($id === false) ? $_GET['student'] : $id;
            var_dump($id);
              
        $student = new Student();
        if($student->read($id)){
         
       
            $student->table->average = $student->get_average();
            

            $student->table->final_result = SchoolController::get_final_result($student->table);

            var_dump( $student->table->final_result);
            die();
            echo SchoolController::return_by_school_format($student->table);
            

        }else{
            echo json_encode($student->errors);
        }
    }
   

}