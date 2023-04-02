<?php

namespace App\Controller;

use App\Entity\ProductionRecipeStructure;
use App\Form\ProductionRecipeStructureType;
use App\Repository\ProductionRecipeStructureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/productionrecipe/structure')]
class ProductionRecipeStructureController extends AbstractController
{
    #[Route('/', name: 'app_production_recipe_structure_index', methods: ['GET'])]
    public function index(ProductionRecipeStructureRepository $productionRecipeStructureRepository): Response
    {
        return $this->render('production_recipe_structure/index.html.twig', [
            'production_recipe_structures' => $productionRecipeStructureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_production_recipe_structure_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductionRecipeStructureRepository $productionRecipeStructureRepository): Response
    {
        $productionRecipeStructure = new ProductionRecipeStructure();
        $form = $this->createForm(ProductionRecipeStructureType::class, $productionRecipeStructure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productionRecipeStructureRepository->save($productionRecipeStructure, true);

            return $this->redirectToRoute('app_production_recipe_structure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production_recipe_structure/new.html.twig', [
            'production_recipe_structure' => $productionRecipeStructure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_production_recipe_structure_show', methods: ['GET'])]
    public function show(ProductionRecipeStructure $productionRecipeStructure): Response
    {
        $productionRecipeStructure->getProductionRecipeContents();
        dump($productionRecipeStructure);
        return $this->render('production_recipe_structure/show.html.twig', [
            'production_recipe_structure' => $productionRecipeStructure,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_production_recipe_structure_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductionRecipeStructure $productionRecipeStructure, ProductionRecipeStructureRepository $productionRecipeStructureRepository): Response
    {
        $form = $this->createForm(ProductionRecipeStructureType::class, $productionRecipeStructure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productionRecipeStructureRepository->save($productionRecipeStructure, true);

            return $this->redirectToRoute('app_production_recipe_structure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production_recipe_structure/edit.html.twig', [
            'production_recipe_structure' => $productionRecipeStructure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_production_recipe_structure_delete', methods: ['POST'])]
    public function delete(Request $request, ProductionRecipeStructure $productionRecipeStructure, ProductionRecipeStructureRepository $productionRecipeStructureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productionRecipeStructure->getId(), $request->request->get('_token'))) {
            $productionRecipeStructureRepository->remove($productionRecipeStructure, true);
        }

        return $this->redirectToRoute('app_production_recipe_structure_index', [], Response::HTTP_SEE_OTHER);
    }
}
