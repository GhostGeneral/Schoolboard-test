<?php

namespace school_board_test;

class Grade extends Model
{

   
    public function __construct($post = array())
    {
        $this->init_db();
        $this->table = new GradeSchema();
        $this->init_class($post);
    }



    public function read($student_id){
        $sql = "SELECT grade FROM grades WHERE student_id='{$student_id}'";
        $res = $this->db->query($sql);
        return array_map(function($a){return $a['grade'];},  $res->fetch_all(MYSQLI_ASSOC));
    }

    public function insert()
    {
        $this->validation();
        if(empty($this->errors)){
            $sql = "INSERT into grades SET 
                    grade='{$this->table->grade}',
                    student_id='{$this->table->student_id}'";

            if($this->db->query($sql)){
                return true;
            }else{
                $this->errors = "Something went wrong.";
            }
        }
        return false;
    }

   
    protected function validation(){
        if(empty($this->table->grade)){
            $this->errors[]= "Grade is empty.";
        }else{
            if(is_int($this->table->grade)){
                $this->errors[]= "Grade must be number.";
            }else{
                if($this->table->grade > 10 or $this->table->grade < 0){
                    $this->errors[]= "Grade must be number from 0 to 10.";
                }
            }
        }

        if(empty($this->table->student_id)){
            $this->errors[]= "Student ID is empty.";
        }else{
            if(is_int($this->table->student_id)){
                $this->errors[]= "Student ID must be number.";
            }else{
                $res = $this->db->query("SELECT * FROM students WHERE id='{$this->table->student_id}'");
                if($res->num_rows !== 1){
                    $this->errors[]= "Student ID not found.";
                }else{
                    $res = $this->db->query("SELECT count(id) as count_grade FROM grades WHERE student_id='{$this->table->student_id}'");
                    $res = $res->fetch_object();
                    if($res->count_grade > 3){
                        $this->errors[]= "Student already have {$res->count_grade} grade.";
                    }
                }
            }
        }
    }
}