<?php

namespace App\Controller;

use App\Entity\GenreLitteraire;
use App\Form\GenreLitteraireType;
use App\Repository\GenreLitteraireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/genre/litteraire')]
final class GenreLitteraireController extends AbstractController
{
    #[Route(name: 'app_genre_litteraire_index', methods: ['GET'])]
    public function index(GenreLitteraireRepository $genreLitteraireRepository): Response
    {
        return $this->render('genre_litteraire/index.html.twig', [
            'genre_litteraires' => $genreLitteraireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_genre_litteraire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $genreLitteraire = new GenreLitteraire();
        $form = $this->createForm(GenreLitteraireType::class, $genreLitteraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($genreLitteraire);
            $entityManager->flush();

            return $this->redirectToRoute('app_genre_litteraire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('genre_litteraire/new.html.twig', [
            'genre_litteraire' => $genreLitteraire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_genre_litteraire_show', methods: ['GET'])]
    public function show(GenreLitteraire $genreLitteraire): Response
    {
        return $this->render('genre_litteraire/show.html.twig', [
            'genre_litteraire' => $genreLitteraire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_genre_litteraire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GenreLitteraire $genreLitteraire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GenreLitteraireType::class, $genreLitteraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_genre_litteraire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('genre_litteraire/edit.html.twig', [
            'genre_litteraire' => $genreLitteraire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_genre_litteraire_delete', methods: ['POST'])]
    public function delete(Request $request, GenreLitteraire $genreLitteraire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$genreLitteraire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($genreLitteraire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_genre_litteraire_index', [], Response::HTTP_SEE_OTHER);
    }
}
