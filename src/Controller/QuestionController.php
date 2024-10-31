<?php

namespace App\Controller;

use App\Entity\Evaluations;
use App\Entity\Questions;
use App\Form\QuestionType;
use App\Entity\Classes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/admin/classes/{classId}/evaluations/{evaluationId}')]

class QuestionController extends AbstractController
{
    #[Route('/questions/new', name: 'question_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, int $classId, int $evaluationId): Response
    {
        // Récupérer l'évaluation
        $evaluation = $entityManager->getRepository(Evaluations::class)->find($evaluationId);
        if (!$evaluation) {
            throw $this->createNotFoundException('Évaluation non trouvée');
        }

        //Recuperer la classe
        $classe = $entityManager->getRepository(Classes::class)->find($classId);
        if (!$classe) {
        throw $this->createNotFoundException('Classe non trouvée');
        }

        // Créer une nouvelle question
        $question = new Questions();
        $form = $this->createForm(QuestionType::class, $question, [
            'evaluation' => $evaluation,
        ]);

        // Pré-sélectionner l'évaluation dans le formulaire
        $question->setEvaluations($evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question->setEvaluations($evaluation); // Associer la question à l'évaluation
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('question_new', [
                'classId' => $classId, 
                'evaluationId' => $evaluationId]);
        }

        return $this->render('question/question_evaluation.html.twig', [
            'form' => $form->createView(),
            'questions' => $evaluation->getQuestions(),
            'evaluation' => $evaluation,
            'classe' => $classe,
        ]);
    } 

    #[Route('/questions', name: 'question_list', methods: ['GET'])]
    public function list(int $evaluationId, EntityManagerInterface $entityManager, int $classId): Response
    {
        $classe = $entityManager->getRepository(Classes::class)->find($classId);
        if (!$classe) {
        throw $this->createNotFoundException('Classe non trouvée');
        }
        $evaluation = $entityManager->getRepository(Evaluations::class)->find($evaluationId);
        if (!$evaluation) {
            throw $this->createNotFoundException('Évaluation non trouvée');
        }

        return $this->render('question/question_list.html.twig', [
            'questions' => $evaluation->getQuestions(),
            'evaluation' => $evaluation,
            'classe' => $classe,
            'classId' => $classId,
            'evaluationId' => $evaluationId,
        ]);
    }
   
    

    #[Route('/questions/edit/{id}', name: 'question_edit')]

    public function edit(Questions $question, Request $request, EntityManagerInterface $entityManager, $id)
{
    $evaluation = $entityManager->getRepository(Evaluations::class)->find($id);
    
    if (!$evaluation) {
        throw $this->createNotFoundException('Évaluation non trouvée');
    }
    $form = $this->createForm(QuestionType::class, $question, [
        'evaluations' => $evaluation,
    ]);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();
        $this->addFlash('success', 'La question a été modifiée avec succès.');
        return $this->redirectToRoute('question_list', [
            'classId' => $question->getEvaluations()->getClasse()->getId(),
            'evaluationId' => $question->getEvaluations()->getId()
        ]);
    }

    return $this->render('question/edit.html.twig', [
        'form' => $form->createView(),
        'question' => $question
    ]);
}
#[Route('/questions/{id}/delete', name: 'question_delete')]

public function delete(int $classId, int $evaluationId, Questions $question, Request $request, EntityManagerInterface $entityManager): Response
{
    // Vérifier le jeton CSRF pour sécuriser la suppression
    if ($this->isCsrfTokenValid('delete_question_' . $question->getId(), $request->request->get('_token'))) {
        try {
            $entityManager->remove($question);
            $entityManager->flush();
            $this->addFlash('success', 'La question a été supprimée avec succès.');
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Une erreur est survenue lors de la suppression de la question : ' . $e->getMessage());
        }
    } else {
        $this->addFlash('danger', 'Une erreur est survenue lors de la suppression de la question. Veuillez réessayer.');
    }

    return $this->redirectToRoute('question_list', [
        'classId' => $classId,
        'evaluationId' => $evaluationId,
    ]);
}
}
//     #[Route('/add', name: 'question_add')]
//    public function createQuestion(Request $request, ManagerRegistry $doctrine,EvaluationsRepository $evaluationsRepository,$id): Response
//     {
//         $evaluation = $this->getUser()->getCurrentEvaluation(); // Filtrer les évaluations
//         $evaluation_name = $evaluation->getNomEvaluation();

//         $question = new Questions();
//         $form = $this->createForm(QuestionType::class, $question);

//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) 
//         {
//             $manager = $doctrine->getManager();
//             $manager->persist($question);


//             $manager->flush();
//             $this->addFlash("succes","La question a été ajoutée avec succès");
//             return $this->redirectToRoute('question_add');
//         } 
//             // $this->addFlash("error","La création a échoué! Veuillez réessayer");

//             return $this->render('question/question-add.html.twig', [
//                 'evaluations' => $evaluation,
//                 'evaluation_name' => $evaluation_name,
//                 'form' => $form->createView()
//             ]);

        
        
//     }

    
