<?php

namespace App\Controller;

use App\Entity\ProductionRecipe;
use App\Repository\ProductionRecipeStructureRepository;
use App\Repository\ProductionRecipeArgumentsRepository;
use App\Repository\ProductionRecipeContentRepository;
use App\Form\ProductionRecipeType;
use App\Repository\ProductionRecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/production/recipe')]
class ProductionRecipeController extends AbstractController
{
    #[Route('/', name: 'app_production_recipe_index', methods: ['GET'])]
    public function index(ProductionRecipeRepository $productionRecipeRepository): Response
    {
        return $this->render('production_recipe/index.html.twig', [
            'production_recipes' => $productionRecipeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_production_recipe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductionRecipeRepository $productionRecipeRepository): Response
    {
        $productionRecipe = new ProductionRecipe();
        $form = $this->createForm(ProductionRecipeType::class, $productionRecipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productionRecipeRepository->save($productionRecipe, true);

            return $this->redirectToRoute('app_production_recipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production_recipe/new.html.twig', [
            'production_recipe' => $productionRecipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_production_recipe_show', methods: ['GET'])]
    public function show(ProductionRecipe $productionRecipe, ProductionRecipeStructureRepository $ProductionRecipeStructureRepository,ProductionRecipeContentRepository $ProductionRecipeContentRepository, ProductionRecipeArgumentsRepository $ProductionRecipeArgumentsRepository): Response
    {

        $productionRecipe->getProductionRecipeArguments()->getValues();
        $productionRecipe->getProductionRecipeStructures()->getValues();
        $productionRecipe->getProductionRecipeContents()->getValues();
        

       // $arguments=$ProductionRecipeArgumentsRepository->findBy(['RecipeID'=>$productionRecipe->getId()]);
        dump($productionRecipe);
        return $this->render('production_recipe/show.html.twig', [
            'production_recipe' => $productionRecipe,

        ]);
    }

    #[Route('/{id}/edit', name: 'app_production_recipe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductionRecipe $productionRecipe, ProductionRecipeRepository $productionRecipeRepository): Response
    {
        $form = $this->createForm(ProductionRecipeType::class, $productionRecipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productionRecipeRepository->save($productionRecipe, true);

            return $this->redirectToRoute('app_production_recipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production_recipe/edit.html.twig', [
            'production_recipe' => $productionRecipe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_production_recipe_delete', methods: ['POST'])]
    public function delete(Request $request, ProductionRecipe $productionRecipe, ProductionRecipeRepository $productionRecipeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productionRecipe->getId(), $request->request->get('_token'))) {
            $productionRecipeRepository->remove($productionRecipe, true);
        }

        return $this->redirectToRoute('app_production_recipe_index', [], Response::HTTP_SEE_OTHER);
    }


}
