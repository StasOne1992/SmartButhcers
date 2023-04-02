<?php

namespace App\Controller;

use App\Entity\Assignment;
use App\Form\AssignmentType;
use App\Repository\AssignmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/app/assignment')]
class AssignmentController extends AbstractController
{
    #[Route('/', name: 'app_assignment_index', methods: ['GET'])]
    public function index(AssignmentRepository $assignmentRepository): Response
    {
        return $this->render('assignment/index.html.twig', [
            'assignments' => $assignmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_assignment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AssignmentRepository $assignmentRepository): Response
    {
        $assignment = new Assignment();
        $form = $this->createForm(AssignmentType::class, $assignment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $assignmentRepository->save($assignment, true);

            return $this->redirectToRoute('app_assignment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('assignment/new.html.twig', [
            'assignment' => $assignment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_assignment_show', methods: ['GET'])]
    public function show(Assignment $assignment): Response
    {
        return $this->render('assignment/show.html.twig', [
            'assignment' => $assignment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_assignment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Assignment $assignment, AssignmentRepository $assignmentRepository): Response
    {
        $form = $this->createForm(AssignmentType::class, $assignment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $assignmentRepository->save($assignment, true);

            return $this->redirectToRoute('app_assignment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('assignment/edit.html.twig', [
            'assignment' => $assignment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_assignment_delete', methods: ['POST'])]
    public function delete(Request $request, Assignment $assignment, AssignmentRepository $assignmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$assignment->getId(), $request->request->get('_token'))) {
            $assignmentRepository->remove($assignment, true);
        }

        return $this->redirectToRoute('app_assignment_index', [], Response::HTTP_SEE_OTHER);
    }
}
