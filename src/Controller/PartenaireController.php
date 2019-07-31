<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
/**
 * @Route("/api")
 */
class PartenaireController extends AbstractController
{
//==============Ajouter un partenaire====================================£============================================================//    
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
//=================Bloquer un partenaire========================£======================================================================================================//
    /**
     * @Route("/partenaire/{id}", name="updatparten", methods={"PUT"})
     */
    public function update(Request $request, SerializerInterface $serializer, Partenaire $parten, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        $partenUpdate = $entityManager->getRepository(Partenaire::class)->find($parten->getId());
        $data = json_decode($request->getContent());
        foreach ($data as $key => $value) {
            if ($key && !empty($value)) {
                $status = ucfirst($key);
                $setter = 'set' . $status;
                $partenUpdate->$setter($value);
            }
        }
        $errors = $validator->validate($partenUpdate);
        if (count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'Content-Type' => 'application/json'
            ]);
        }
        $entityManager->flush();
        $data = [
            'statut' => 200,
            'messag' => 'Le statuts du partenaire a été modifier'
        ];
        return new JsonResponse($data);
    }
//=================================Lister les Partenaires===============£=====================================================================================//
    /**
     * @Route("/listParten", name="listpartenaire", methods={"GET"})
     */
    public function listParten(PartenaireRepository $partenaireRepository, SerializerInterface $serializer)
    {
        $partenaires = $partenaireRepository->findAll();
        $data = $serializer->serialize($partenaires, 'json');

        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
}
//=======================================================================================================================================================//