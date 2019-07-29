<?php

namespace App\Controller;

use App\Entity\Comptbank;
use App\Entity\DepotArgent;
use App\Entity\Partenaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/** 
 * @Route("/api")
 */
class CaisierController extends AbstractController
{
//======================Créer un compte=================================£==============================================//
    /** 
     * @Route("/compte", name="comptbk", methods={"POST"})
     */
    public function new(Request $request,EntityManagerInterface $entityManager ): Response
    {
        $values = json_decode($request->getContent());
        if (isset($values->solde)) {
            
            $comptebank = new Comptbank();
            $comptebank->setNumcompte($values->numcompte);
            $comptebank->setSolde($values->solde);
            $repo = $this->getDoctrine()->getRepository(Partenaire::class);
            $parten= $repo->find($values->idPartenaire);
            $comptebank->setIdPartenaire($parten);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comptebank);
            $entityManager->flush();
            $data = [
                'statu' => 201,
                'messag' => 'Le compte a été bien créer !'
                   ];
            return new JsonResponse($data, 201);
        }
        $data = [
            'statu' => 500,
            'messag' => 'Vous devez renseigner tous les champs,s\'vous plait!'
              ];
        return new JsonResponse($data, 500);
    }
//=============Faire un dépot d'argent===========================£================================================================//
    /**
     * @Route("/depocompte", name="depot", methods={"POST"})
     */
    public function FaireDepot(Request $request,  EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        if (isset($values->montant)) {
            $depo = new DepotArgent();
            $depo->setMontant($values->montant);
            $depo->setDateDepot(new \DateTime());

            $repo = $this->getDoctrine()->getRepository(Comptbank::class);
            $parten = $repo->find($values->comptbank);
            $depo->setComptbank($parten);

            $parten->setSolde($parten->getSolde() + $values->montant);

            $entityManager->persist($parten);

            $entityManager->persist($depo);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'Le depot  a été bien enregistré !'
                   ];
            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner tous les champs,s\'il vous plait!'
                ];
        return new JsonResponse($data, 500);
    }
}