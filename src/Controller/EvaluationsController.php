<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Evaluations;
use App\Entity\Classes;
use App\Entity\Cours;
use App\Entity\Questions;
use App\Form\QuestionType;
use App\Form\ClasseEvaluationFilterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EvaluationsType;
use App\Repository\EvaluationsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/admin/classes/{classId}/evaluations')]
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
    public function createEvaluation(Request $request, EntityManagerInterface $entityManager, int $classId): Response
    {
        
         //Recuperer la classe
         $classe = $entityManager->getRepository(Classes::class)->find($classId);

         if (!$classe) {
         throw $this->createNotFoundException('Classe non trouvée');
        }
        $cours = $entityManager->getRepository(Cours::class)
        ->findBy(['classe' => $classe]);

        // Récupérer les cours liés à la classe
        $evaluation = new Evaluations();
        $evaluation->setClasse( $classe);
        $form = $this->createForm(EvaluationsType::class, $evaluation, [
            'classe' => $classe,
            'cours' => $cours,
        ]);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $classe = $evaluation->getClasse();
            $cours = $entityManager->getRepository(Cours::class)
            ->findBy(['classe' => $classe]);
            try {
                $entityManager->persist($evaluation);
                $entityManager->flush();
    
                $this->addFlash("success","L'evaluation ". $evaluation->getNomEvaluation() ." a été enregistrée avec succès");
                return $this->redirectToRoute('evaluation_list'); // Rediriger vers la liste des évaluations
            } catch (\Exception $e) {
            }
        }
    
        return $this->render('evaluations/evaluation-create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/list', name: 'evaluation_list')]

    public function listEvaluations(Request $request, EvaluationsRepository $evaluationsRepository, int $classId, EntityManagerInterface $entityManager): Response
    {
        $classe = $entityManager->getRepository(Classes::class)->find($classId);
        
         if (!$classe) {
         throw $this->createNotFoundException('Classe non trouvée');
        }

        $form = $this->createForm(ClasseEvaluationFilterType::class, null, [
            'classe' => $classe,
        ]);
        $form->handleRequest($request);
        // $classe = $entityManager->getRepository(Classes::class)->find($classId);
        //  if (!$classe) {
        //  throw $this->createNotFoundException('Classe non trouvée');
        // }
        $evaluations = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $classe = $form->get('class_id')->getData(); // Récupérer l'objet Classes
            $evaluations = $evaluationsRepository->findByClasse($classe); // Filtrer les évaluations
        }
        

        return $this->render('evaluations/evaluation_list.html.twig', [
            'form' => $form->createView(),
            'evaluations' => $evaluations,
            'classe' => $classe,
            
        ]);
    }

    #[Route('/{id<d+>}', name: 'evaluation_show')]
public function show(int $id, EntityManagerInterface $entityManager): Response
{
    $evaluation = $entityManager->getRepository(Evaluations::class)->find($id);
    if (!$evaluation) {
        throw $this->createNotFoundException('Évaluation non trouvée');
    }

    // Récupérer la classe associée
    $classe = $evaluation->getClasse();

    return $this->render('evaluations/show.html.twig', [
        'evaluation' => $evaluation,
        'classe' => $classe,
    ]);
}
    

    // #[Route('/{id<d+>}/questions/new', name: 'evaluation_question_new', methods: ['GET', 'POST'])]
    // public function newQuestion(Request $request, EntityManagerInterface $entityManager, int $id): Response
    // {
    //     // Récupérer l'évaluation
    //     $evaluation = $entityManager->getRepository(Evaluations::class)->find($id);
    //     if (!$evaluation) {
    //         throw $this->createNotFoundException('Évaluation non trouvée');
    //     }

    //     // Créer une nouvelle question
    //     $question = new Questions();
    //     $form = $this->createForm(QuestionType::class, $question);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $question->setEvaluations($evaluation); // Associer la question à l'évaluation
    //         $entityManager->persist($question);
    //         $entityManager->flush();

    //         // Rediriger vers la même page pour afficher la nouvelle question
    //         return $this->redirectToRoute('evaluation_question_new', ['id' => $id]);
    //     }

    //     return $this->render('evaluations/questions_evaluation.html.twig', [
    //         'form' => $form->createView(),
    //         'questions' => $evaluation->getQuestions(),
    //         'evaluation' => $evaluation,
    //     ]);
    // }
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



