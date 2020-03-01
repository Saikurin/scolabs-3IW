<?php

class ClassroomsController
{
    public function indexAction()
    {
        $classroomsEntity = new classrooms();

        $view = new View("classrooms_list", "admin");
        $view->assign("classrooms", $classroomsEntity->select('*')->get());
    }

    public function addAction()
    {
        
    }
}