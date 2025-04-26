<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        // Récupérer l'utilisateur connecté via la méthode intégrée
        $user = $this->getUser();

        // Vérifier que l'utilisateur est connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('profil/profil.html.twig', [
            'user' => $user,
        ]);
    }


    #[Route('/update-profile-photo', name: 'update_profile_photo')]
    public function updateProfilePhoto(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $photoFile = $request->files->get('photo');
        if ($photoFile) {
            // Générer un nom unique
            $newFilename = uniqid().'.'.$photoFile->guessExtension();
            
            // Déplacer le fichier
            try {
                $photoFile->move(
                    $this->getParameter('photos_directory'),
                    $newFilename
                );
                
                // Mettre à jour l'utilisateur
                $user->setPhoto($newFilename);
                $entityManager->flush();
                
                $this->addFlash('success', 'Photo de profil mise à jour!');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Erreur lors du téléchargement de la photo.');
            }
        }

        return $this->redirectToRoute('app_profil');
    }

    #[Route('/update-password', name: 'update_password')]
    public function updatePassword(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        
        $newPassword = $request->request->get('new_password');
        if ($newPassword) {
            // Encoder le nouveau mot de passe
            $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
            $user->setPassword($hashedPassword);
            
            // Enregistrer en base de données
            $entityManager->flush();
            
            $this->addFlash('success', 'Mot de passe mis à jour avec succès');
        } else {
            $this->addFlash('error', 'Le nouveau mot de passe ne peut pas être vide');
        }
        
        return $this->redirectToRoute('app_profil');
    }
}
