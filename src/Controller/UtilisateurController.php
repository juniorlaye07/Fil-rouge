<?php
namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/api")
 */
class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="register", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
       
        if(isset($values->username,$values->password)) {
            $user = new Utilisateur();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user,$values->password));
            $user->setRoles($user->getRoles());
            $user->setNom($values->nom);
            $user->setPrenom($values->prenom);
            $user->setTel($values->tel);
            $user->setStatus($values->status);
            $user->setProfil($values->profil);
            $entityManager->persist($user);
            $entityManager->flush();

            $data = [
                'statut' => 201,
                'messag' => 'L\'utilisateur a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'statut' => 500,
            'messag' => 'Vous devez renseigner les clés d\'utilisateur et mot de passe'
        ];
        return new JsonResponse($data, 500);
    }
}