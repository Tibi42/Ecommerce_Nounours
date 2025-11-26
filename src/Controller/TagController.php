<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;

final class TagController extends AbstractController
{
    #[Route('/tag', name: 'app_tag')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tag);
            $entityManager->flush();

            $this->addFlash('success', 'Tag créé avec succès !');

            return $this->redirectToRoute('app_tag');
        }

        return $this->render('tag/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/tag/new', name: 'app_tag_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tag);
            $entityManager->flush();

            $this->addFlash('success', 'Tag créé avec succès !');

            return $this->redirectToRoute('app_tag_list');
        }

        return $this->render('tag/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/tag/list', name: 'app_tag_list', methods: ['GET'])]
    public function list(TagRepository $tagRepository): Response
    {
        return $this->render('tag/list.html.twig', [
            'tags' => $tagRepository->findAll(),
        ]);
    }

    #[Route('/tag/edit/{id}', name: 'app_tag_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, Tag $tag): Response
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Tag modifié avec succès !');

            return $this->redirectToRoute('app_tag_list');
        }

        return $this->render('tag/edit.html.twig', [
            'form' => $form->createView(),
            'tag' => $tag,
        ]);
    }

    #[Route('/tag/delete/{id}', name: 'app_tag_delete', methods: ['POST'])]
    public function delete(Request $request, EntityManagerInterface $entityManager, Tag $tag): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tag->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tag);
            $entityManager->flush();

            $this->addFlash('success', 'Tag supprimé avec succès !');
        }

        return $this->redirectToRoute('app_tag_list');
    }
}
