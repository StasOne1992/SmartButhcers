<?php

namespace App\Controller;

use App\Entity\ClassifierOKEI;
use App\Form\ClassifierOKEIType;
use App\Repository\ClassifierOKEIRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/classifierokei')]
class ClassifierOKEIController extends AbstractController
{
    #[Route('/', name: 'app_classifier_o_k_e_i_index', methods: ['GET'])]
    public function index(ClassifierOKEIRepository $classifierOKEIRepository): Response
    {
        return $this->render('classifier_okei/index.html.twig', [
            'classifier_o_k_e_is' => $classifierOKEIRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_classifier_o_k_e_i_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ClassifierOKEIRepository $classifierOKEIRepository): Response
    {
        $classifierOKEI = new ClassifierOKEI();
        $form = $this->createForm(ClassifierOKEIType::class, $classifierOKEI);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $classifierOKEIRepository->save($classifierOKEI, true);

            return $this->redirectToRoute('app_classifier_o_k_e_i_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('classifier_okei/new.html.twig', [
            'classifier_o_k_e_i' => $classifierOKEI,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_classifier_o_k_e_i_show', methods: ['GET'])]
    public function show(ClassifierOKEI $classifierOKEI): Response
    {
        return $this->render('classifier_okei/show.html.twig', [
            'classifier_o_k_e_i' => $classifierOKEI,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_classifier_o_k_e_i_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ClassifierOKEI $classifierOKEI, ClassifierOKEIRepository $classifierOKEIRepository): Response
    {
        $form = $this->createForm(ClassifierOKEIType::class, $classifierOKEI);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $classifierOKEIRepository->save($classifierOKEI, true);

            return $this->redirectToRoute('app_classifier_o_k_e_i_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('classifier_okei/edit.html.twig', [
            'classifier_o_k_e_i' => $classifierOKEI,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_classifier_o_k_e_i_delete', methods: ['POST'])]
    public function delete(Request $request, ClassifierOKEI $classifierOKEI, ClassifierOKEIRepository $classifierOKEIRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classifierOKEI->getId(), $request->request->get('_token'))) {
            $classifierOKEIRepository->remove($classifierOKEI, true);
        }

        return $this->redirectToRoute('app_classifier_o_k_e_i_index', [], Response::HTTP_SEE_OTHER);
    }
}
