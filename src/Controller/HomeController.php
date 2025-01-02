<?php

namespace App\Controller;


use App\Repository\MenuItemsRepository; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MenuItemsRepository $menuItemsRepository): Response
    {

        $menuItems = $menuItemsRepository->findAll();

        


        return $this->render('home/index.html.twig', [
            'menu_items' => $menuItems,
        ]);
    }
}
