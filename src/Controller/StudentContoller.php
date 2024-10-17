<?php

namespace App\Controller;

use App\Entity\Students;
use App\Form\StudentType;
use App\Repository\StudentsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry as DoctrineManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route; 

#[Route('admin/student')]

class StudentContoller extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/', name: 'student')]

    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
        ]);
    }


    #[Route('/add', name: 'student_add')]

    public function addStudent(ManagerRegistry $doctrine, Request $request ): Response
    {
        $entityManager = $doctrine->getManager();
        $student = new Students();
        
        $form = $this->createForm(StudentType::class, $student);


        $form->handleRequest($request);
        if($form->isSubmitted()){
            // dump($student);
            $manager = $doctrine->getManager();
            $manager->persist($student);


            $manager->flush();
            $this->addFlash("succes","L'étudiant(e) ".$student->getFirstName().$student->getName(). " a été enregistré(e) avec succès");
            return $this->redirectToRoute('student-list');
        }else{
            $this->addFlash("error","L'enregistrement a échoué! Veuillez réessayer");

            return $this->render('student/add-student.html.twig', [
                'form' => $form->createView()
            ]);
        }
        
        
    }
    #[Route('/list', name:'student-list')]

    public function studentList( StudentsRepository $studentsRepository): Response {

        $students = $studentsRepository->findAll(); 

        return $this->render('student/students-list.html.twig', ['students' => $students]);
    }

    #[Route('/{id}', name:'student-detail')]
public function detail(StudentsRepository $studentsRepository, int $id): Response 
{
    $student = $studentsRepository->find($id); 

    if (!$student) {
        $this->addFlash('error', "L'élève n'existe pas ");
        return $this->redirectToRoute('student_list');
    }

    return $this->render('student/student-detail.html.twig', [
        'student' => $student 
    ]);
}


    //     $repository = $doctrine->getRepository(Students::class);
    //     $students = $repository->findAll();
    //     return $this->render('student/students-list.html.twig', ['students' => $students]);
    // }
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