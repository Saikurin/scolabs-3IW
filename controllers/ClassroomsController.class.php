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
        $view = new View("classrooms_add", "admin");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $errors = Validator::checkForm(classrooms::getNewEntityForm(), $_POST);
            if (count($errors) === 0) {
                $classroom = new classrooms();
                $classroom->setLevel($_POST['level']);
                $classroom->setName($_POST['name']);
                $classroom->save();
                header('Location: ' . helpers::getUrl('Classrooms', 'index'));
            } else {
                $view->assign("errors", $errors);
            }
        }
        $view->assign("newEntityForm", classrooms::getNewEntityForm());
    }
}