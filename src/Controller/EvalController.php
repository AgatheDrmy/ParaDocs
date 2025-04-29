<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Repository\TypeRepository;
use App\Repository\DifficulteRepository;
use App\Repository\ChapitreRepository;
use App\Repository\ThemeRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\QuestionRepository;
use App\Repository\EvaluationRepository;

use App\Form\EvalFormType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/eval', name: 'app_eval_')]
class EvalController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function list(EvaluationRepository $evaluationrepository)
    {
        return $this->render('eval/list_eval.html.twig', ['evaluation' => $evaluationrepository->findBy([], ['id' => 'asc'])]);
    }

    #[Route('/{id}/modifier', name: 'modifier')]
    public function modifier(Request $request,  EntityManagerInterface $em, 
        Evaluation $evaluation, 
        TypeRepository $typerepository, 
        DifficulteRepository $difficulterepository, 
        ChapitreRepository $chapitrerepository, 
        ThemeRepository $themerepository,
        QuestionRepository $questionrepository
    ): Response
    {
        // $enonce = $question->getEnonce();

        $evalForm = $this->createForm(EvalFormType::class, $evaluation);

        $evalForm->handleRequest($request);

        if($evalForm->isSubmitted() && $evalForm->isValid()){
            $em->persist($evaluation);
            $em->flush();

            $this -> addFlash('success', 'question créée');

            return $this->redirectToRoute('app_eval_list');
        }

        return $this->render('eval/evaluation.html.twig', [
            'evaluation' => $evaluation,
            'evalForm' => $evalForm,
            'type' => $typerepository->findBy([], ['id' => 'asc']),
            'difficulte' => $difficulterepository->findBy([], ['id' => 'asc']),
            'chapitre' => $chapitrerepository->findBy([], ['id' => 'asc']),
            'theme' => $themerepository->findBy([], ['id' => 'asc']),
            'question' => $questionrepository->findBy([], ['id' => 'asc'])
        ]);
    }


    #[Route('/ajouter', name: 'ajouter')]
    public function Addeval(Request $request, EntityManagerInterface $em, 
        TypeRepository $typerepository,
        ChapitreRepository $chapitrerepository,
        DifficulteRepository $difficulterepository,
        UtilisateurRepository $utilisateurrepository,
        ThemeRepository $themerepository,
        QuestionRepository $questionrepository
        ): Response
    {

        $evaluations = new Evaluation();

        $evalForm = $this->createForm(EvalFormType::class, $evaluations);

        $evaluations->setEvaluationUtilisateur($utilisateurrepository->find(1));
        $evaluations->setIsActive(1);
        $evaluations->setDateCreation(new \DateTimeImmutable('now'));

        $evalForm->handleRequest($request);

        if($evalForm->isSubmitted() && $evalForm->isValid()){
            $em->persist($evaluations);
            $em->flush();

            $this -> addFlash('success', 'question créée');

            return $this->redirectToRoute('app_eval_list');
        }
        
        return $this->render('eval/evaluation.html.twig', [
            'evalForm' => $evalForm->createView(),
            'type' => $typerepository->findBy([], ['id' => 'asc']),
            'chapitre' => $chapitrerepository->findBy([], ['id' => 'asc']),
            'difficulte' => $difficulterepository->findBy([], ['id' => 'asc']),
            'theme' => $themerepository->findBy([], ['id' => 'asc']),
            'question' => $questionrepository->findBy([], ['id' => 'asc'])
        ]);

    }

}
