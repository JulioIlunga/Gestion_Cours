<?php

namespace App\Controller;

use App\Entity\Students;
use App\Form\StudentType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('student')]

class StudentContollerController extends AbstractController
{
    #[Route('/', name: 'student')]

    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
        ]);
    }


    #[Route('/add', name: 'student')]

    public function addStudent(ManagerRegistry $doctrine, Request $request ): Response
    {
        $entityManager = $doctrine->getManager();
        $student = new Students();
        $form = $this->createForm(StudentType::class, $student);


        $form->handleRequest($request);
        if($form->isSubmitted()){
            dump($student);


        }else{
            return $this->render('student/add-student.html.twig', [
                'form' => $form->createView()
            ]);
        }
        return $this->render('student/add-student.html.twig', [
            'form' => $form->createView()
        ]);
        
    }
    // public function addStudent(ManagerRegistry $doctrine): Response
    // {

    //     $entityManager = $doctrine->getManager();
    //     $student = new Students();
    //     // $student->setClassId("3");
    //     $student->setFirstname("Elie");
    //     $student->setName("Ilunga");
    //     $student->setGender("M");
    //     // $student->setBirthDate("2024-10-10 16:19:16");
    //     $student->setPlaceOfBirth("Lubumbashi");
    //     $student->setParentPhone("+243828821532");
    //     $student->setAdress("Limete");
    //     $student->setGeneraleAverage("72.8");

    //     $entityManager->persist($student);

        
    //     return $this->render('student/index.html.twig', [
    //         'student' => '$student',
    //     ]);
    // }

}
