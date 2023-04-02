<?php

namespace App\Controller;

use App\Entity\ProductionType;
use App\Form\ProductionTypeType;
use App\Repository\ProductionTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/production/type')]
class ProductionTypeController extends AbstractController
{
    #[Route('/', name: 'app_production_type_index', methods: ['GET'])]
    public function index(ProductionTypeRepository $productionTypeRepository): Response
    {
        return $this->render('production_type/index.html.twig', [
            'production_types' => $productionTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_production_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductionTypeRepository $productionTypeRepository): Response
    {
        $productionType = new ProductionType();
        $form = $this->createForm(ProductionTypeType::class, $productionType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productionTypeRepository->save($productionType, true);

            return $this->redirectToRoute('app_production_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production_type/new.html.twig', [
            'production_type' => $productionType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_production_type_show', methods: ['GET'])]
    public function show(ProductionType $productionType): Response
    {
        return $this->render('production_type/show.html.twig', [
            'production_type' => $productionType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_production_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductionType $productionType, ProductionTypeRepository $productionTypeRepository): Response
    {
        $form = $this->createForm(ProductionTypeType::class, $productionType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productionTypeRepository->save($productionType, true);

            return $this->redirectToRoute('app_production_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production_type/edit.html.twig', [
            'production_type' => $productionType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_production_type_delete', methods: ['POST'])]
    public function delete(Request $request, ProductionType $productionType, ProductionTypeRepository $productionTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productionType->getId(), $request->request->get('_token'))) {
            $productionTypeRepository->remove($productionType, true);
        }

        return $this->redirectToRoute('app_production_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
