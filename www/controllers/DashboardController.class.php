<?php


class DashboardController
{
    public function indexAction()
    {
        helpers::checkAuth();
    }
}