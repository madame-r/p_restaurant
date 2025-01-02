<?php

namespace App\Controller;

use App\Entity\MenuItems;
use App\Form\MenuItemsType;
use App\Repository\MenuItemsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

#[Route('/menu/items')]
final class MenuItemsController extends AbstractController
{
    #[Route(name: 'app_menu_items_index', methods: ['GET'])]
    public function index(MenuItemsRepository $menuItemsRepository): Response
    {
        return $this->render('menu_items/index.html.twig', [
            'menu_items' => $menuItemsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_menu_items_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $menuItem = new MenuItems();
        $form = $this->createForm(MenuItemsType::class, $menuItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($menuItem);
            $entityManager->flush();

            return $this->redirectToRoute('app_menu_items_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('menu_items/new.html.twig', [
            'menu_item' => $menuItem,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_menu_items_show', methods: ['GET'])]
    public function show(MenuItems $menuItem, UploaderHelper $helper): Response
    {

        // Generate the URL for the cover image
        $menuItemImagePath = $helper->asset($menuItem, 'imageFile');

        return $this->render('menu_items/show.html.twig', [
            'menu_item' => $menuItem,
            'menuItemImagePath' => $menuItemImagePath,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_menu_items_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MenuItems $menuItem, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MenuItemsType::class, $menuItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_menu_items_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('menu_items/edit.html.twig', [
            'menu_item' => $menuItem,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_menu_items_delete', methods: ['POST'])]
    public function delete(Request $request, MenuItems $menuItem, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $menuItem->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($menuItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_menu_items_index', [], Response::HTTP_SEE_OTHER);
    }
}
