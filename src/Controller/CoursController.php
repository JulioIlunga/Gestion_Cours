<?php

namespace App\Controller;

use App\Entity\Cours;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('admin/cours')]
class CoursController extends AbstractController
{
    #[Route('/', name: 'app_cours')]
    public function index(): Response
    {
        return $this->render('cours/index.html.twig', [
            'controller_name' => 'CoursController',
        ]);
    }
    #[Route('/add', name: 'cours_add')]

    public function addCours(ManagerRegistry $doctrine, Request $request ): Response
    {
        $entityManager = $doctrine->getManager();
        $cours = new Cours();
        
        $form = $this->createForm(CoursType::class, $cours);


        $form->handleRequest($request);
        if($form->isSubmitted()){
            // dump($student);
            $manager = $doctrine->getManager();
            $manager->persist($cours);


            $manager->flush();
            $this->addFlash("succes","Le cours ".$cours->getTitle()." a été ajouté avec succès");
            return $this->render('cours/add-cours.html.twig', [
                'form' => $form->createView()

            ]);
        }else{
            $this->addFlash("error","La création a échoué! Veuillez réessayer");

            return $this->render('cours/add-cours.html.twig', [
                'form' => $form->createView()
            ]);
        } 
        
    }
    #[Route('/list', name: 'cours_list')]
    public function listCours(CoursRepository $coursRepository)
    {
        $cours = $coursRepository->findAll();

        return $this->render('cours/cours-list.html.twig', [
            'cours' => $cours,
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
