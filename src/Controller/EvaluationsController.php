<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Evaluations;
use App\Entity\Cours;
use App\Form\ClasseEvaluationFilterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EvaluationsType;
use App\Repository\EvaluationsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/admin/evaluations')]
class EvaluationsController extends AbstractController
{
    #[Route('/', name: 'app_evaluations')]
    public function index(): Response
    {
        return $this->render('evaluations/index.html.twig', [
            'controller_name' => 'EvaluationsController',
        ]);
    }

    #[Route('/create', name:'evaluation_create')]
    public function createEvaluation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $evaluation = new Evaluations();
        $form = $this->createForm(EvaluationsType::class, $evaluation);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->persist($evaluation);
                $entityManager->flush();
    
                $this->addFlash("succes","L'evaluation a été enregistrée avec succès");
                return $this->redirectToRoute('evaluation_list'); // Rediriger vers la liste des évaluations
            } catch (\Exception $e) {
                $this->addFlash("error","Une erreur est survenue lors de l'enregistrement de l'évaluation.");
            }
        }
    
        return $this->render('evaluations/evaluation-create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/list', name: 'evaluation_list')]

    public function listEvaluations(Request $request, EvaluationsRepository $evaluationsRepository): Response
    {
        $form = $this->createForm(ClasseEvaluationFilterType::class);
    $form->handleRequest($request);

    $evaluations = [];

    if ($form->isSubmitted() && $form->isValid()) {
        $classe = $form->get('class_id')->getData(); // Récupérer l'objet Classes
        $evaluations = $evaluationsRepository->findByClasse($classe); // Filtrer les évaluations
    }

    return $this->render('evaluations/evaluation_list.html.twig', [
        'form' => $form->createView(),
        'evaluations' => $evaluations,
    ]);
    }

    #[Route('/{id}', name: 'cours_details')]
    public function details(Cours $cours): Response
    {
        return $this->render('cours/details-cours.html.twig', [
            'cours' => $cours,
        ]);
    }

    
}

// #[Route('/cours/by_class', name: 'cours_by_class', methods: ['POST'])]
// public function getCoursByClass(Request $request, EntityManagerInterface $entityManager): JsonResponse
// {
//     $classIds = $request->request->get('classes'); 

//     if ($classIds) {
//         $cours = $entityManager->getRepository(Cours::class)->findBy([
//             'class_id' => $classIds,
//         ]);

//         $coursArray = [];
//         foreach ($cours as $cour) {
//             $coursArray[] = [
//                 'id' => $cour->getId(),
//                 'title' => $cour->getTitle(),
//             ];
//         }

//         return new JsonResponse($coursArray);
//     }

//     return new JsonResponse([]);
// }



