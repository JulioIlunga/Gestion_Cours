<?php

namespace App\Controller;
 
use App\Entity\Classes;
use App\Form\ClassesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('admin/classes')]
class ClassesController extends AbstractController
{
    #[Route('/', name: 'app_classes')]
    public function index(): Response
    {
        return $this->render('classes/index.html.twig', [
            'controller_name' => 'ClassesController',
        ]);
    }
    #[Route('/add', name: 'classe_add')]

    public function addClasse(ManagerRegistry $doctrine, Request $request ): Response
    {
        

        $entityManager = $doctrine->getManager();
        $classe = new Classes();
        
        $form = $this->createForm(ClassesType::class, $classe);


        $form->handleRequest($request);
        if($form->isSubmitted()){
            // dump($student);
            $manager = $doctrine->getManager();
            $manager->persist($classe);


            $manager->flush();
            $this->addFlash("succes","La classe ".$classe->getName(). " de la section". $classe->getSection(). " a été créée avec succès");
            return $this->render('classes/add-classe.html.twig', [
                'form' => $form->createView()

            ]);
        }else{
            $this->addFlash("error","La création a échoué! Veuillez réessayer");

            return $this->render('classes/add-classe.html.twig', [
                'form' => $form->createView()
            ]);
        }
        
        
    }
}