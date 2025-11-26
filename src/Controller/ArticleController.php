<?php

namespace App\Controller;

use App\Entity\Nounours;
use App\Form\NounoursType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\NounoursRepository;

final class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
    // creation d'un nouvel article

    #[Route('/article/new', name: 'app_article_new', methods: ["GET", "POST"])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Nounours();

        // creation du formulaire
        $form = $this->createForm(NounoursType::class, $article);

        // Traitement de la requete
        $form->handleRequest($request);

        // Si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Article créer avec succes !');

            return $this->redirectToRoute('app_article_list');
        }

        return $this->render('article/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // liste 
    #[Route('/article/list', name: 'app_article_list', methods: ['GET'])]
    public function list(NounoursRepository $nounoursRepository): Response
    {
        return $this->render('article/list.html.twig', [
            'articles' => $nounoursRepository->findAll(),
        ]);
    }

    // edition
    #[Route('/article/edit/{id}', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em, Nounours $nounours): Response
    {
        // creatoin du formulaire
        $form = $this->createForm(NounoursType::class, $nounours);

        // Traitement de la requete
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Article modifié avec succès !');

            return $this->redirectToRoute('app_article_list');
        }
        return $this->render('article/edit.html.twig', [
            'form' => $form->createView()

        ]);
    }

    // suppression
    #[Route('/article/delete/{id}', name: 'app_article_delete', methods: ['POST'])]
    public function delete(Request $request, EntityManagerInterface $em, Nounours $nounours): Response
    {
        if ($this->isCsrfTokenValid('delete' . $nounours->getId(), $request->getPayload()->getString('_token'))) {
            $em->remove($nounours);
            $em->flush();

            $this->addFlash('success', 'Article supprimé avec succès !');
        }

        return $this->redirectToRoute('app_article_list');
    }
}
