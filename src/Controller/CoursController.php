<?php

namespace App\Controller;
use App\Entity\Classes;
use App\Entity\Cours;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use App\Repository\ClassesRepository;
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
        
        // Récupérer l'ID de la classe depuis la requête
        $classId = $request->query->get('class_id');
        if ($classId) {
            $classe = $entityManager->getRepository(Classes::class)->find($classId);
            $cours->setClasse($classe); // Préremplir le champ classe
        }

        // Créez le formulaire en passant l'objet Cours
         $form = $this->createForm(CoursType::class, $cours);

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $entityManager = $doctrine->getManager();
            $entityManager->persist($cours);
            $entityManager->flush();

            //Message de succès
            $this->addFlash("success","Le cours ".$cours->getTitle()." a été ajouté avec succès");

            //Rerection vers la liste des cours
            return $this->redirectToRoute('cours_list');
        }

        
            return $this->render('cours/add-cours.html.twig', [
                'form' => $form->createView(),
                
            ]);
        
        
    }
    #[Route('/list', name: 'cours_list')]
    public function listCours(CoursRepository $coursRepository, ClassesRepository $classesRepository, Request $request)
    {
        $classes = $classesRepository->findAll();
        $selectedClass = $request->query->get('class_id'); // Récupérer la classe sélectionnée

    // Filtrer les cours en fonction de la classe sélectionnée
    $queryBuilder = $coursRepository->createQueryBuilder('c');

    if ($selectedClass) {
        $queryBuilder
            ->andWhere('c.classe = :classId')
            ->setParameter('classId', $selectedClass);
    }

    $cours = $queryBuilder->getQuery()->getResult();

    return $this->render('cours/cours-list.html.twig', [
        'cours' => $cours,
        'classes' => $classes,
        'selectedClass' => $selectedClass,
        'addCourseLink' => $this->generateUrl('cours_add', ['class_id' => $selectedClass])
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
