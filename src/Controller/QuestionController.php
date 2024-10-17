<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Form\QuestionType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\QuestionsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/question')]
class QuestionController extends AbstractController
{
    #[Route('/', name: 'app_question')]
    public function index(): Response
    {
        return $this->render('question/index.html.twig', [
            'controller_name' => 'QuestionController',
        ]);


    }#[Route('/add', name: 'question_add')]
   public function createEvaluation(Request $request, ManagerRegistry $doctrine): Response
    {
        
        $question = new Questions();
        $form = $this->createForm(QuestionType::class, $question);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $manager = $doctrine->getManager();
            $manager->persist($question);


            $manager->flush();
            $this->addFlash("succes","La question a été ajoutée avec succès");
            return $this->redirectToRoute('question_add');
        }else {
            $this->addFlash("error","La création a échoué! Veuillez réessayer");

            return $this->render('question/question-add.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }
}