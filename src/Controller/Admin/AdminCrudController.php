<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdminCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Admin::class;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Blog'),
            MenuItem::section('Users'),
            MenuItem::linkToCrud('Users', 'fa fa-user', Admin::class),
            MenuItem::linkToLogout('Logout', 'fa fa-exit'),
        ];
    }
}
