<?php

namespace school_board_test;


class Student extends Model
{

   
    public function __construct($post = array())
    {
        $this->init_db();
        $this->table = new StudentSchema();
        $this->init_class($post);
    }

    
    public function read($id){
        $user_id = $this->db->real_escape_string($id);
        $sql = "SELECT * FROM students WHERE id='{$id}'";
        $this->table = $this->db->query($sql)->fetch_object();

        if($this->table){
            $grade = new Grade();
            $this->table->grades = $grade->read($this->table->id);
            return $this->table;
        }
        $this->errors[] = "Student ID not found";
        return false;
    }

    /**
     * @return bool
     */
    public function register()
    {
        $this->validation();

        if(empty($this->errors)){
            $sql = "INSERT into students SET 
                    name='{$this->table->name}',
                    school_id='{$this->table->school_id}'";

            if($this->db->query($sql)){
                return true;
            }else{
                $this->errors = "Something went wrong.";
            }
        }
        return false;
    }

    /**
     *
     */
    protected function validation(){
        if(empty($this->table->name)){
            $this->errors[]= "Name is empty.";
        }

        if(empty($this->table->school_id)){
            $this->errors[]= "School ID is empty.";
        }else{
            if(is_int($this->table->school_id)){
                $this->errors[]= "School ID must be number.";
            }else{
                $res = $this->db->query("SELECT * FROM schools WHERE id='{$this->table->school_id}'");
                if($res->num_rows !== 1){
                    $this->errors[]= "School ID not found.";
                }
            }
        }
    }

    /**
     * @return float
     */
    public function get_average(){

        $res = $this->db->query("SELECT avg(grade) as average FROM grades WHERE student_id='{$this->table->id}'");
        $res = $res->fetch_object();

        return round($res->average, 2);
    }

}