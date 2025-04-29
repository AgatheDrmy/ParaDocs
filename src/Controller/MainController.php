<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{

    #[Route('/', name: 'apphome')]

    public function homepage(QuestionRepository $questionrepository)
    {
        return $this->render('main/modif_data.html.twig', ['question' => $questionrepository->findBy([], ['id' => 'asc'])]);
    }
}