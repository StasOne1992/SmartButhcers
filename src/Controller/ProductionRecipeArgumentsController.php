<?php

namespace App\Controller;

use App\Entity\ProductionRecipeArguments;
use App\Form\ProductionRecipeArgumentsType;
use App\Repository\ProductionRecipeArgumentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/production/recipe/arguments')]
class ProductionRecipeArgumentsController extends AbstractController
{
    #[Route('/', name: 'app_production_recipe_arguments_index', methods: ['GET'])]
    public function index(ProductionRecipeArgumentsRepository $productionRecipeArgumentsRepository): Response
    {
        return $this->render('production_recipe_arguments/index.html.twig', [
            'production_recipe_arguments' => $productionRecipeArgumentsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_production_recipe_arguments_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductionRecipeArgumentsRepository $productionRecipeArgumentsRepository): Response
    {
        $productionRecipeArgument = new ProductionRecipeArguments();
        $form = $this->createForm(ProductionRecipeArgumentsType::class, $productionRecipeArgument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productionRecipeArgumentsRepository->save($productionRecipeArgument, true);

            return $this->redirectToRoute('app_production_recipe_arguments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production_recipe_arguments/new.html.twig', [
            'production_recipe_argument' => $productionRecipeArgument,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_production_recipe_arguments_show', methods: ['GET'])]
    public function show(ProductionRecipeArguments $productionRecipeArgument): Response
    {
        return $this->render('production_recipe_arguments/show.html.twig', [
            'production_recipe_argument' => $productionRecipeArgument,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_production_recipe_arguments_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductionRecipeArguments $productionRecipeArgument, ProductionRecipeArgumentsRepository $productionRecipeArgumentsRepository): Response
    {
        $form = $this->createForm(ProductionRecipeArgumentsType::class, $productionRecipeArgument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productionRecipeArgumentsRepository->save($productionRecipeArgument, true);

            return $this->redirectToRoute('app_production_recipe_arguments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production_recipe_arguments/edit.html.twig', [
            'production_recipe_argument' => $productionRecipeArgument,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_production_recipe_arguments_delete', methods: ['POST'])]
    public function delete(Request $request, ProductionRecipeArguments $productionRecipeArgument, ProductionRecipeArgumentsRepository $productionRecipeArgumentsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productionRecipeArgument->getId(), $request->request->get('_token'))) {
            $productionRecipeArgumentsRepository->remove($productionRecipeArgument, true);
        }

        return $this->redirectToRoute('app_production_recipe_arguments_index', [], Response::HTTP_SEE_OTHER);
    }
}
