<?php

namespace App\Controller\Admin;

use App\Entity\Profile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(Profile::class);

        return $this->redirect($routeBuilder->setController(OneOfYourCrudController::class)->generateUrl());

        // you can also redirect to different pages depending on the current user
        if ('jane' === $this->getUser()->getUsername()) {
            return $this->redirect('...');
        }

        // you can also render some template to display a proper Dashboard
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        return $this->render('some/path/my-dashboard.html.twig');
    }
}
