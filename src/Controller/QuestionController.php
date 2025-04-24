<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\TypeRepository;
use App\Repository\DifficulteRepository;
use App\Repository\ChapitreRepository;
use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/questions', name: 'questions_')]
class QuestionController extends AbstractController
{
    #[Route('/{id}', name: 'list')]
    public function list(Question $question, TypeRepository $typerepository, DifficulteRepository $difficulterepository, ChapitreRepository $chapitrerepository, ThemeRepository $themerepository): Response
    {
        // $enonce = $question->getEnonce();

        return $this->render('questions/questions.html.twig', [
            'question' => $question,
            'type' => $typerepository->findBy([], ['id' => 'asc']),
            'difficulte' => $difficulterepository->findBy([], ['id' => 'asc']),
            'chapitre' => $chapitrerepository->findBy([], ['id' => 'asc']),
            'theme' => $themerepository->findBy([], ['id' => 'asc'])
        ]);
    }
}