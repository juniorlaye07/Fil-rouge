<?php
namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\Partenaire;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response ;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/api")
 */
class UtilisateurController extends AbstractController
{
//==================Login================================£=========================================================================================//
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $user = $this->getUser();
        return $this->json([

            'roles' => $user->getRoles(),
            'username' => $user->getUsername()
        ]);
    }
    //====================Ajouter utilisateur==================================£========================================================================================================================£
    /**
     * @Route("/utilisateur", name="register", methods={"POST"})
     * @IsGranted("ROLE_ADMIN",message="Acces refusé!")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
       
        if(isset($values->username,$values->password)) {
            $user = new Utilisateur();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user,$values->password));
            $user->setRoles(['ROLE_USER']);
            $user->setNom($values->nom);
            $user->setPrenom($values->prenom);
            $user->setTel($values->tel);
            $user->setStatus($values->status);
            $user->setProfil($values->profil);

            $repo = $this->getDoctrine()->getRepository(Partenaire::class)->find($values->id_partenaire);
            $user->setIdPartenaire($repo);
           
            
            $entityManager->persist($user);
            $entityManager->flush();

            $data = [
                'statuts' => 201,
                'message' => 'L\'utilisateur a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'statut' => 500,
            'messag' => 'Vous devez renseigner les clés d\'utilisateur et mot de passe'
        ];
        return new JsonResponse($data, 500);
    }
//========================bloquer utilisateur========================£===============================================================================================//
    /**
     * @Route("/utilisateur/{id}", name="utilisaUpdate", methods={"PUT"})
     */
    public function updat(Request $request, SerializerInterface $serializer, Utilisateur $user, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $utilisaUpdate = $entityManager->getRepository(Utilisateur::class)->find($user->getId());
        $data = json_decode($request->getContent());
        foreach ($data as $key => $values) {
            if ($key && !empty($values)) {
                $status = ucfirst($key);
                $setter = 'set' . $status;
                $utilisaUpdate->$setter($values);
            }
        }
        $errors = $validator->validate($utilisaUpdate);
        if (count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'Content-Type' => 'application/json'
            ]);
        }
        $entityManager->flush();
        $data = [
            'statut' => 200,
            'messag' => 'Le statuts de l\'utilisateur a été mis à jour'
        ];
        return new JsonResponse($data);
    }
//======================================================================================================================================================//
}
