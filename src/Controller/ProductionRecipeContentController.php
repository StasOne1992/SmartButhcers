<?php

namespace App\Controller;


use App\Entity\ProductionRecipeContent;
use App\Form\ProductionRecipeContentType;
use App\Repository\ProductionRecipeContentRepository;
use App\Repository\ProductionRecipeRepository;
use App\Repository\ProductionRecipeStructureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;



#[Route('/productionrecipe/content')]
class ProductionRecipeContentController extends AbstractController
{
    #[Route('/', name: 'app_production_recipe_content_index', methods: ['GET'])]
    public function index(ProductionRecipeContentRepository $productionRecipeContentRepository): Response
    {
        return $this->render('production_recipe_content/index.html.twig', [
            'production_recipe_contents' => $productionRecipeContentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_production_recipe_content_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductionRecipeContentRepository $productionRecipeContentRepository, ProductionRecipeStructureRepository $productionRecipeStructureRepository,ProductionRecipeRepository $ProductionRecipeRepository): Response
    {
        $productionRecipeContent = new ProductionRecipeContent();

        $requestParams = $request->query->all();
        $productionRecipeContent->opts=array();
        if (isset($requestParams['recepie_structure_id'])) {
            $productionRecipeContent->setProductionRecipeSection($productionRecipeStructureRepository->findOneBy(['id'=>$requestParams['recepie_structure_id']]));
            $productionRecipeContent->opts[]=['disablerecipestructureselect'=>true];
        }


        $form = $this->createForm(ProductionRecipeContentType::class, $productionRecipeContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productionRecipeContentRepository->save($productionRecipeContent, true);

            return $this->redirectToRoute('app_production_recipe_content_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production_recipe_content/new.html.twig', [
            'production_recipe_content' => $productionRecipeContent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_production_recipe_content_show', methods: ['GET'])]
    public function show(ProductionRecipeContent $productionRecipeContent): Response
    {
        return $this->render('production_recipe_content/show.html.twig', [
            'production_recipe_content' => $productionRecipeContent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_production_recipe_content_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductionRecipeContent $productionRecipeContent, ProductionRecipeContentRepository $productionRecipeContentRepository): Response
    {
        $form = $this->createForm(ProductionRecipeContentType::class, $productionRecipeContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productionRecipeContentRepository->save($productionRecipeContent, true);

            return $this->redirectToRoute('app_production_recipe_content_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production_recipe_content/edit.html.twig', [
            'production_recipe_content' => $productionRecipeContent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_production_recipe_content_delete', methods: ['POST'])]
    public function delete(Request $request, ProductionRecipeContent $productionRecipeContent, ProductionRecipeContentRepository $productionRecipeContentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productionRecipeContent->getId(), $request->request->get('_token'))) {
            $productionRecipeContentRepository->remove($productionRecipeContent, true);
        }

        return $this->redirectToRoute('app_production_recipe_content_index', [], Response::HTTP_SEE_OTHER);
    }
}
