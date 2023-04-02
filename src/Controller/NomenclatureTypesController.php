<?php

namespace App\Controller;

use App\Entity\NomenclatureTypes;
use App\Form\NomenclatureTypesType;
use App\Repository\NomenclatureTypesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/nomenclaturetypes')]
class NomenclatureTypesController extends AbstractController
{
    #[Route('/', name: 'app_nomenclature_types_index', methods: ['GET'])]
    public function index(NomenclatureTypesRepository $nomenclatureTypesRepository): Response
    {
        return $this->render('nomenclature_types/index.html.twig', [
            'nomenclature_types' => $nomenclatureTypesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_nomenclature_types_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NomenclatureTypesRepository $nomenclatureTypesRepository): Response
    {
        $nomenclatureType = new NomenclatureTypes();
        $form = $this->createForm(NomenclatureTypesType::class, $nomenclatureType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nomenclatureTypesRepository->save($nomenclatureType, true);

            return $this->redirectToRoute('app_nomenclature_types_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nomenclature_types/new.html.twig', [
            'nomenclature_type' => $nomenclatureType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nomenclature_types_show', methods: ['GET'])]
    public function show(NomenclatureTypes $nomenclatureType): Response
    {
        return $this->render('nomenclature_types/show.html.twig', [
            'nomenclature_type' => $nomenclatureType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_nomenclature_types_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NomenclatureTypes $nomenclatureType, NomenclatureTypesRepository $nomenclatureTypesRepository): Response
    {
        $form = $this->createForm(NomenclatureTypesType::class, $nomenclatureType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nomenclatureTypesRepository->save($nomenclatureType, true);

            return $this->redirectToRoute('app_nomenclature_types_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nomenclature_types/edit.html.twig', [
            'nomenclature_type' => $nomenclatureType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nomenclature_types_delete', methods: ['POST'])]
    public function delete(Request $request, NomenclatureTypes $nomenclatureType, NomenclatureTypesRepository $nomenclatureTypesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nomenclatureType->getId(), $request->request->get('_token'))) {
            $nomenclatureTypesRepository->remove($nomenclatureType, true);
        }

        return $this->redirectToRoute('app_nomenclature_types_index', [], Response::HTTP_SEE_OTHER);
    }
}
