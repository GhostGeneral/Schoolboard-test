<?php
use Pecee\SimpleRouter\SimpleRouter;
use school_board_test\GradeController;
use school_board_test\SchoolController;
use school_board_test\StudentController;
SimpleRouter::setDefaultNamespace('\school_board_test');

SimpleRouter::get('/', [StudentController::class, 'index']);
SimpleRouter::post('/register', [StudentController::class, 'register']);

SimpleRouter::post('/grade/add', [GradeController::class, 'store']);
SimpleRouter::get('students/{id}', [StudentController::class, 'index']);

// Start the routing
SimpleRouter::start();




