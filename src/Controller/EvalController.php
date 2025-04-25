<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Repository\QuestionRepository;
use App\Repository\EvaluationRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/eval', name: 'app_eval_')]
class EvalController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function list(): Response
    {
        return $this->render('eval/list_eval.html.twig', [
            'controller_name' => 'EvalController',
        ]);
    }

    #[Route('/comp', name: 'gen')]
    public function gen(): Response
    {
        return $this->render('eval/comp_gen_eval.html.twig', [
            'controller_name' => 'EvalController',
        ]);
    }

    #[Route('/choix', name: 'choix')]
    public function choix(): Response
    {
        return $this->render('eval/choix_question_eval.html.twig', [
            'controller_name' => 'EvalController',
        ]);
    }

    #[Route('/finalisation', name: 'finalisation')]
    public function finalisation(): Response
    {
        return $this->render('eval/finalisation_eval.html.twig', [
            'controller_name' => 'EvalController',
        ]);
    }
}
