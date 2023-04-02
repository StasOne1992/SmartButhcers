<?php

namespace App\Controller;

use App\Entity\Nomenclature;
use App\Form\NomenclatureType;
use App\Repository\NomenclatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/nomenclature')]
class NomenclatureController extends AbstractController
{
    #[Route('/', name: 'app_nomenclature_index', methods: ['GET'])]
    public function index(NomenclatureRepository $nomenclatureRepository): Response
    {
        return $this->render('nomenclature/index.html.twig', [
            'nomenclatures' => $nomenclatureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_nomenclature_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NomenclatureRepository $nomenclatureRepository): Response
    {
        $nomenclature = new Nomenclature();
        $form = $this->createForm(NomenclatureType::class, $nomenclature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nomenclatureRepository->save($nomenclature, true);

            return $this->redirectToRoute('app_nomenclature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nomenclature/new.html.twig', [
            'nomenclature' => $nomenclature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nomenclature_show', methods: ['GET'])]
    public function show(Nomenclature $nomenclature): Response
    {
        return $this->render('nomenclature/show.html.twig', [
            'nomenclature' => $nomenclature,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_nomenclature_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Nomenclature $nomenclature, NomenclatureRepository $nomenclatureRepository): Response
    {
        $form = $this->createForm(NomenclatureType::class, $nomenclature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nomenclatureRepository->save($nomenclature, true);

            return $this->redirectToRoute('app_nomenclature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nomenclature/edit.html.twig', [
            'nomenclature' => $nomenclature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nomenclature_delete', methods: ['POST'])]
    public function delete(Request $request, Nomenclature $nomenclature, NomenclatureRepository $nomenclatureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nomenclature->getId(), $request->request->get('_token'))) {
            $nomenclatureRepository->remove($nomenclature, true);
        }

        return $this->redirectToRoute('app_nomenclature_index', [], Response::HTTP_SEE_OTHER);
    }
}
