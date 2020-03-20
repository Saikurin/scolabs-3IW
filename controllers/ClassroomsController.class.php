<?php

class ClassroomsController
{
    public function indexAction()
    {
        $classroomsEntity = new classrooms();

        $view = new View("classrooms.list", "admin");

        $view->addJS("jquery.dataTables.min.js");
        $view->addLinkJS("https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js");
        $view->addCSS('jquery.dataTables.min.css');

        $view->assign("classrooms", $classroomsEntity->select('*')->get());
    }

    /**
     * @param string $name
     */
    public function editAction(string $name)
    {
        $view = new View('classrooms.edit', 'admin');

        $classroomEntity = new classrooms();
        $classroomEntity->select('*')->where('name', '=', $name);
        $classroom = $classroomEntity->get();

        if (empty($classroom)) {
            DangerException::fatalError("Tentative de hack !!");
        } else {
            $view->assign('classroom', $classroom[0]);
            $view->assign('form', classrooms::getEditEntityForm($classroom[0]));
        }
    }

    public function deleteAction()
    {
        // TODO : in wait delete function in queryBuilder
    }

    /**
     * @param int $id
     */
    public function updateAction(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classroom = new classrooms();
            $classroom->setId($id);
            $classroom->setName($_POST['name']);
            $classroom->setLevel($_POST['level']);
            $classroom->save();
            header('Location: ' . helpers::getUrl('Classrooms', 'index'));
        }
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