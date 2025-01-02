<?php

namespace App\Controller;

use App\Entity\MenuCategories;
use App\Form\MenuCategoriesType;
use App\Repository\MenuCategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/menu/categories')]
final class MenuCategoriesController extends AbstractController
{
    #[Route(name: 'app_menu_categories_index', methods: ['GET'])]
    public function index(MenuCategoriesRepository $menuCategoriesRepository): Response
    {
        return $this->render('menu_categories/index.html.twig', [
            'menu_categories' => $menuCategoriesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_menu_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $menuCategory = new MenuCategories();
        $form = $this->createForm(MenuCategoriesType::class, $menuCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($menuCategory);
            $entityManager->flush();

            return $this->redirectToRoute('app_menu_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('menu_categories/new.html.twig', [
            'menu_category' => $menuCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_menu_categories_show', methods: ['GET'])]
    public function show(MenuCategories $menuCategory): Response
    {
        return $this->render('menu_categories/show.html.twig', [
            'menu_category' => $menuCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_menu_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MenuCategories $menuCategory, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MenuCategoriesType::class, $menuCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_menu_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('menu_categories/edit.html.twig', [
            'menu_category' => $menuCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_menu_categories_delete', methods: ['POST'])]
    public function delete(Request $request, MenuCategories $menuCategory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menuCategory->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($menuCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_menu_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
