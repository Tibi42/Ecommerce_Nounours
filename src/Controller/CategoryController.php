<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;

final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Catégorie créée avec succès !');

            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/new', name: 'app_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Catégorie créée avec succès !');

            return $this->redirectToRoute('app_category_list');
        }

        return $this->render('category/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/list', name: 'app_category_list', methods: ['GET'])]
    public function list(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/list.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/category/edit/{id}', name: 'app_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Catégorie modifiée avec succès !');

            return $this->redirectToRoute('app_category_list');
        }

        return $this->render('category/edit.html.twig', [
            'form' => $form->createView(),
            'category' => $category,
        ]);
    }

    #[Route('/category/delete/{id}', name: 'app_category_delete', methods: ['POST'])]
    public function delete(Request $request, EntityManagerInterface $entityManager, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();

            $this->addFlash('success', 'Catégorie supprimée avec succès !');
        }

        return $this->redirectToRoute('app_category_list');
    }
}
