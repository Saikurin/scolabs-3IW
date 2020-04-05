<?php

class rolesController
{
    public function indexAction()
    {
        $roles = new roles();

        $view = new View("roles_list", "admin");
        $view->assign("roles", $roles->select('*')->get());
    }

    /**
     * @param string $name
     */
    public function editAction(string $name)
    {
        $view = new View('roles_edit', 'admin');

        $roleEntity = new roles();
        $roleEntity->select('*')->where('name', '=', $name);
        $role = $roleEntity->get();

        if (empty($role)) {
            DangerException::fatalError("Tentative de hack !!");
        } else {
            $view->assign('role', $role[0]);
            $view->assign('form', roles::getEditEntityForm($role[0]));
        }
    }

    public function deleteAction()
    {
    }

    /**
     * @param int $id
     */
    public function updateAction(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role = new roles();
            $role->setId($id);
            $role->setName($_POST['name']);
            $role->save();
            header('Location: ' . helpers::getUrl('Roles', 'index'));
        }
    }

    public function addAction()
    {
        $view = new View("roles_add", "admin");
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $errors = Validator::checkForm(roles::getNewEntityForm(), $_POST);
            if (count($errors) === 0) {
                $role = new roles();
                $role->setName($_POST['name']);
                $role->save();
                header('Location: ' . helpers::getUrl('Roles', 'index'));
            } else {
                $view->assign("errors", $errors);
            }
        }
        $view->assign("newEntityForm", roles::getNewEntityForm());
    }
}