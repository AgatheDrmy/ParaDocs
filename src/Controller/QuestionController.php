<?php

namespace App\Controller;

use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/questions', name: 'questions_')]
class QuestionController extends AbstractController
{
    #[Route('/{id}', name: 'list')]
    public function list(Question $question): Response
    {
        return $this->render('questions/questions.html.twig', compact('question'));
    }
}