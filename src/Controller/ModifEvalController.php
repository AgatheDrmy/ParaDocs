<?php

namespace App\Controller;

use App\Entity\Evaluation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', name: 'app_modif_eval_')]
class ModifEvalController extends AbstractController
{
    #[Route('/{id}', name: 'gen')]
    public function list(Evaluation $evaluation): Response
    {
        // $enonce = $question->getEnonce();

        return $this->render('questions/questions.html.twig', [
            'evaluation' => $evaluation,
        ]);
    }
}