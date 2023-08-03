<?php

namespace App\Controller\Admin;

use App\Entity\Dish;
use App\Entity\User;
use App\Entity\Order;
use App\Entity\Table;
use App\Entity\Ingredient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(TableCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Start')
            ->generateRelativeUrls(); 
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Home','fas fa-home','app_table_index');
        yield MenuItem::linkToCrud('Ingredienti', 'fas fa-list', Ingredient::class);
        yield MenuItem::linkToCrud('Piatti', 'fas fa-list', Dish::class);
        yield MenuItem::linkToCrud('Ordini', 'fas fa-list', Order::class);
        yield MenuItem::linkToCrud('Tavolo', 'fas fa-list', Table::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
    }
}
