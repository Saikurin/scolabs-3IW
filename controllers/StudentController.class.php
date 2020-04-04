<?php
/*
 * indexAction : Renvoie la liste des étudiants (en limitant à 50 par pages et par ordre alphabétique) avec recherche possible
 * synthesisAction : Renvoie la synthèse pour un seul étudiant basé sur le schéma fait préalablement
 * addAction : Renvoie un formulaire simple d'ajout d'étudiant et prends en compte l'ajout lorsqu'il est fait sans relancer la vue
 * updateAction : Permets de mettre à jour un étudiant (voir comment le mettre en forme)
 */
class StudentController
{
    public function indexAction()
    {
        $studentsEntity = new students();

        $view = new View("students.list", "admin");
        $view->assign("students", $studentsEntity->select('*')->get());
    }

    /**
     * @param integer $id
     */
    public function synthesisAction(int $id){

        $studentsEntity = new students();

        $view = new View("students.synthesis", "admin");
        $view->assign("student", $studentsEntity->select("*")->where("id_student", "=", $id)->get());
        $view->assign("parents", $studentsEntity->select("parent1, parent2")->where("id_student", "=", $id));
    }

    /**
     * @param string $name
     */
    public function editAction(string $name)
    {
        $view = new View('classrooms_edit', 'admin');

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