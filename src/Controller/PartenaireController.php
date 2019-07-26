<?php

namespace App\Controller;

use App\Entity\Partenaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/api")
 */
class PartenaireController extends AbstractController
{           
/**
 * @Route("/partenaire", name="partenaire", methods={"POST"})
 */
    public function add(Request $request, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());

        if (isset($values->ninea, $values->raisonsocial)) {
            $parten = new Partenaire();
            $parten->setNinea($values->ninea);
            $parten->setAdresse($values->adresse);
            $parten->setRaisonsocial($values->raisonsocial);
            $parten->setAdresseMail($values->adresse_mail);
            $parten->setTel($values->tel);
            $parten->setStatus($values->status);
            $entityManager->persist($parten);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'Le partenaire a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner les clés de ninea et du raisonsocial'
        ];
        return new JsonResponse($data, 500);
    }
}
