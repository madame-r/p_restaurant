<?php

namespace App\Controller;

use App\Repository\MenuItemsRepository; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OnlineOrderController extends AbstractController
{
    #[Route('/online/order', name: 'app_online_order')]
    public function index(MenuItemsRepository $menuItemsRepository): Response
    {

        $menuItems = $menuItemsRepository->findAll();

        // dd($menuItems); 

        return $this->render('online_order/index.html.twig', [
            'menu_items' => $menuItems,
        ]);
    }
}
