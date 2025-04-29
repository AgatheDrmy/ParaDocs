<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // Création d'un formulaire d'inscription vide pour l'affichage sur la même page
        $user = new Utilisateur();
        $registrationForm = $this->createForm(RegistrationFormType::class, $user);

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'registrationForm' => $registrationForm,
            'display_form' => 'login' // Indique quel formulaire afficher par défaut
        ]);
    }

    #[Route(path: '/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, AuthenticationUtils $authenticationUtils): Response
    {
        file_put_contents('debug.txt', 'Méthode register appelée: ' . date('Y-m-d H:i:s'));

        $user = new Utilisateur();
        $user->setToken(bin2hex(random_bytes(20))); // Un token aléatoire
        $user->setNbQuestions(0);
        $user->setNbEval(0);
        $registrationForm = $this->createForm(RegistrationFormType::class, $user);
        $registrationForm->handleRequest($request);

        if ($registrationForm->isSubmitted()) {
            dump('Formulaire soumis');
            dump($request->request->all()); // Données POST
            dump($user); // État de l'utilisateur après handleRequest
            dump($registrationForm->isValid()); // Le formulaire est-il valide?
            dump($registrationForm->getErrors(true)); // Affiche toutes les erreurs

            if ($registrationForm->isValid()) {
                // Assurez-vous que l'email est défini explicitement
                $email = $registrationForm->get('email')->getData();
                $user->setEmail($email);
            }
            
            /** @var string $plainPassword */
            $plainPassword = $registrationForm->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        // Si le formulaire n'est pas valide, on récupère les infos de login
        // pour pouvoir afficher la page avec les deux formulaires
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'registrationForm' => $registrationForm,
            'display_form' => 'register' // Affiche le formulaire d'inscription par défaut
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}