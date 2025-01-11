<?php

namespace App\Controller;

use App\Entity\Students; 
use App\Entity\Classes; 
use App\Form\StudentType;
use App\Repository\StudentsRepository;
use App\Repository\ClassesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry as DoctrineManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route; 
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('admin/student')]

class StudentController extends AbstractController
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


    public function addStudent(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        $entityManager = $doctrine->getManager();
        $student = new Students();
        
        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            
            // Récupérer l'image depuis le formulaire
            $imageFile = $form->get('photo')->getData(); // 'photo' est le nom du champ dans StudentType

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // Générer un nom de fichier sécurisé
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    // Déplacer l'image dans le répertoire de stockage
                    $imageFile->move(
                        $this->getParameter('images_directory'), 
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer   
 
                    $this->addFlash('error', "Erreur lors du téléchargement de l'image.");
                    return $this->redirectToRoute('student_add'); 
               }

                // Enregistrer le nom du fichier dans l'entité Student
               $student->setPhotoFilename($newFilename); // Utiliser le nom correct de la propriété
            }
 
            $manager = $doctrine->getManager();
            $manager->persist($student);
            $manager->flush();

            $this->addFlash("success","L'étudiant(e) ".$student->getFirstName()." ".$student->getName(). " a été enregistré(e) avec succès");
            return $this->redirectToRoute('student-list');
        } else {
            // $this->addFlash("danger","L'enregistrement a échoué! Veuillez réessayer");

            return $this->render('student/add-student.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }


    #[Route('/list', name:'student-list')]

    public function studentList( ClassesRepository $classesRepository,StudentsRepository $studentsRepository, Request $request): Response {

        $classes = $classesRepository->findAll();
        $selectedClass = $request->query->get('class_id');
        $students = $studentsRepository->findAll(); 
        $search = $request->query->get('search'); // Récupérer la valeur de recherche

    // Créer une requête de base
    $queryBuilder = $studentsRepository->createQueryBuilder('s');

    // Appliquer le filtre de recherche si une valeur est fournie
    if ($search) {
        $queryBuilder->andWhere('s.name LIKE :search OR s.firstname LIKE :search')
                     ->setParameter('search', '%' . $search . '%');
    }

    // Appliquer le filtre de classe si une classe est sélectionnée
    if ($selectedClass) {
        $queryBuilder->andWhere('s.class_id = :classId')
                     ->setParameter('classId', $selectedClass);
    }

    // Exécuter la requête
    $students = $queryBuilder->getQuery()->getResult();
        if($selectedClass) {
            $students = $studentsRepository->findBy(['class_id'=> $selectedClass]);
        }else {
            $students = $studentsRepository->findAll();
        }

        return $this->render('student/students-list.html.twig', [
            'students' => $students,
            'classes' => $classes,
            'selectedClass' => $selectedClass,
            'search' => $search 
        ]);
    }

    #[Route('/{id}', name:'student-detail')]
public function detail(StudentsRepository $studentsRepository, int $id): Response 
{
    $student = $studentsRepository->find($id); 
    $classe = $student->getClassId();
    if (!$student) {
        $this->addFlash('error', "Cet(te) élève n'existe pas ");
        return $this->redirectToRoute('student_list');
    }

    return $this->render('student/student-detail.html.twig', [
        'student' => $student,
        'classe' => $classe
    ]);
}



}
