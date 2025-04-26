<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\TypeRepository;
use App\Repository\DifficulteRepository;
use App\Repository\ChapitreRepository;
use App\Repository\ThemeRepository;
use App\Repository\UtilisateurRepository;

use App\Form\AddQuestionFormType;

use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/questions', name: 'questions_')]
class QuestionController extends AbstractController
{
    #[Route('/{id}/modifier', name: 'list')]
    public function list(Request $request,  EntityManagerInterface $em, Question $question, TypeRepository $typerepository, DifficulteRepository $difficulterepository, ChapitreRepository $chapitrerepository, ThemeRepository $themerepository): Response
    {
        // $enonce = $question->getEnonce();

        $questionForm = $this->createForm(AddQuestionFormType::class, $question);

        $questionForm->handleRequest($request);

        if($questionForm->isSubmitted() && $questionForm->isValid()){
            $em->persist($question);
            $em->flush();

            $this -> addFlash('success', 'question créée');

            return $this->redirectToRoute('apphome');
        }

        return $this->render('questions/questions.html.twig', [
            'question' => $question,
            'questionForm' => $questionForm,
            'type' => $typerepository->findBy([], ['id' => 'asc']),
            'difficulte' => $difficulterepository->findBy([], ['id' => 'asc']),
            'chapitre' => $chapitrerepository->findBy([], ['id' => 'asc']),
            'theme' => $themerepository->findBy([], ['id' => 'asc'])
        ]);
    }


    #[Route('/ajouter', name: 'ajouter')]
    public function AddQuestion(Request $request, EntityManagerInterface $em, 
        TypeRepository $typerepository,
        ChapitreRepository $chapitrerepository,
        DifficulteRepository $difficulterepository,
        UtilisateurRepository $utilisateurrepository,
        ): Response
    {

        $questions = new Question();

        $questionForm = $this->createForm(AddQuestionFormType::class, $questions);

        $questions->setQuestionUtilisateur($utilisateurrepository->find(1));
        $questions->setIsActive(1);

        $questionForm->handleRequest($request);

        if($questionForm->isSubmitted() && $questionForm->isValid()){
            $em->persist($questions);
            $em->flush();

            $this -> addFlash('success', 'question créée');

            return $this->redirectToRoute('apphome');
        }
        
        return $this->render('questions/questions.html.twig', [
            'questionForm' => $questionForm->createView(),
            'type' => $typerepository->findBy([], ['id' => 'asc']),
            'chapitre' => $chapitrerepository->findBy([], ['id' => 'asc']),
            'difficulte' => $difficulterepository->findBy([], ['id' => 'asc']),
        ]);

    }
    
}