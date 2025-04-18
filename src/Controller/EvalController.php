<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EvalController extends AbstractController
{
    #[Route('/eval', name: 'app_eval')]
    public function index(): Response
    {
        return $this->render('eval/list_eval.html.twig', [
            'controller_name' => 'EvalController',
        ]);
    }
}
