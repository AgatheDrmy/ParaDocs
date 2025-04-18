<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ModifBddController extends AbstractController
{
    #[Route('/', name: 'app_modif_bdd')]
    public function index(): Response
    {
        return $this->render('modif_bdd/modif_bdd.html.twig', [
            'controller_name' => 'ModifBddController',
        ]);
    }
}
