<?php

namespace App\Controller;
 
use App\Entity\Classes;
use App\Repository\ClassesRepository;
use App\Repository\StudentsRepository;
use App\Form\ClassesType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/list',name: 'classes_list')]
       public function listClasses(ClassesRepository $classesRepository): Response
       {
           $classes = $classesRepository->findAll();
   
           return $this->render('classes/classes-list.html.twig', [
               'classes' => $classes,
           ]);
       } 
    #[Route('/add', name: 'classe_add')] 
    public function addClasse(Request $request, EntityManagerInterface $entityManager): Response
    {
        $classe = new Classes();
        $form = $this->createForm(ClassesType::class, $classe);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($classe);
            $entityManager->flush();

            $this->addFlash('success',"La classe ". $classe->getName() ." a été ajoutée avec succès.");

            return $this->redirectToRoute('classes_list'); // Redirigez vers la liste des classes après l'ajout
        }

        return $this->render('classes/add-classe.html.twig', [
            'form' => $form->createView(),
        ]); 
    }

    #[Route('/{id}', name: 'classes_details')]
    public function details(Classes $classe, EntityManagerInterface $entityManager): Response
    {
        $entityManager->refresh($classe);
        // $students = $classe->getStudents();
        // $studentCount = $students->count(); 
        return $this->render('classes/details-classe.html.twig', [
            'classe' => $classe,
            // 'studentCount' => $studentCount,
        ]);
    }
    #[Route('{classId}/cours', name: 'admin_classe_cours')]
    public function getCoursForClasse(int $classId, EntityManagerInterface $entityManager): JsonResponse
    {
        $classe = $entityManager->getRepository(Classes::class)->find($classId);
        $cours = $classe->getCours();

        $coursData = [];
        foreach ($cours as $cours) {
            $coursData[] = [
                'id' => $cours->getId(),
                'nom' => $cours->getTitle(),
            ];
        }

        return new JsonResponse($coursData);
    }
}