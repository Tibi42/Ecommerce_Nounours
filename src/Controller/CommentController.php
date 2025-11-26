<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;

final class CommentController extends AbstractController
{
    #[Route('/comment', name: 'app_comment')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Valeurs par défaut pour les champs obligatoires
            if (!$comment->getIpAddress()) {
                $comment->setIpAddress($request->getClientIp() ?? '127.0.0.1');
            }
            if ($comment->isApproved() === null) {
                $comment->setIsApproved(false);
            }
            if (!$comment->getCreateAt()) {
                $comment->setCreateAt(new \DateTime());
            }

            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Commentaire créé avec succès !');

            return $this->redirectToRoute('app_comment');
        }

        return $this->render('comment/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/comment/new', name: 'app_comment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Valeurs par défaut pour les champs obligatoires
            if (!$comment->getIpAddress()) {
                $comment->setIpAddress($request->getClientIp() ?? '127.0.0.1');
            }
            if ($comment->isApproved() === null) {
                $comment->setIsApproved(false);
            }
            if (!$comment->getCreateAt()) {
                $comment->setCreateAt(new \DateTime());
            }

            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Commentaire créé avec succès !');

            return $this->redirectToRoute('app_comment_list');
        }

        return $this->render('comment/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/comment/list', name: 'app_comment_list', methods: ['GET'])]
    public function list(CommentRepository $commentRepository): Response
    {
        return $this->render('comment/list.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);
    }

    #[Route('/comment/edit/{id}', name: 'app_comment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, Comment $comment): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Commentaire modifié avec succès !');

            return $this->redirectToRoute('app_comment_list');
        }

        return $this->render('comment/edit.html.twig', [
            'form' => $form->createView(),
            'comment' => $comment,
        ]);
    }

    #[Route('/comment/delete/{id}', name: 'app_comment_delete', methods: ['POST'])]
    public function delete(Request $request, EntityManagerInterface $entityManager, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete' . $comment->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Commentaire supprimé avec succès !');
        }

        return $this->redirectToRoute('app_comment_list');
    }
}
