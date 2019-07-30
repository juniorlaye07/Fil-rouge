<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UtilisateurControllerTest extends WebTestCase
{
//========================================================Teste lister Partenaire==============================================================================//
    public function testlistPartenTRUE()
    {
        $client = static::createClient([],
            [
                'PHP_AUTH_USER' => "layejunior07",
                'PHP_AUTH_PW' => "junior07"
            ]
        );
        $crawler = $client->request('GET', '/api/listParten');
        $jsonstring = "[
                 {
                    \"id\": 1,
                    \"ninea\":\"2548ML\",
                    \"raisonsocial\":\"ELTON\",
                    \"adresse\":\"Dakar\",
                    \"adresseMail\":\"janismoney@gmail.com\",
                    \"tel\":339764188,
                    \"status\": \"Bloquer\",
                } 
             ]";
        $rep = $client->getResponse();
        $this->assertSame(200, $client->getResponse()->getStatuscode());
    } 
//============================Teste Creation de Comptbank===========================================================================================================================================//
     public function testnewTRUE()
    {

        $client = static::createClient([],
            [
                'PHP_AUTH_USER' => "layejunior07",
                'PHP_AUTH_PW' => "junior07"
            ]
        );
        $crawler = $client->request(
            'POST',
            '/api/compte',[],[],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                "numcompte": 184814,
                "solde": 210000,
                "idPartenaire":9
  
            }'
      );
        $repo = $client->getResponse();
        var_dump($repo);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }
    public function testnewFALSE()
    {

        $client = static::createClient([],
            [
                'PHP_AUTH_USER' => "layejunior07",
                'PHP_AUTH_PW' => "junior07"
            ]
        );
        $crawler = $client->request(
            'POST',
            '/api/compte',[],[],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                "numcompte":,
                "solde": "jhxcv",
                "idPartenaire":8
            }'
        );
        $repo = $client->getResponse();
        var_dump($repo);
        $this->assertSame(400, $client->getResponse()->getStatusCode());
    }
    //========================Test Depot Argent=======================£====================================================================// 
    public function testFaireDepotTRUE()
    {

        $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => "layejunior07",
                'PHP_AUTH_PW' => "junior07"
            ]
        );
        $crawler = $client->request(
            'POST',
            '/api/depocompte',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                 "montant": 7500,
                "dateDepot": "",
                "comptbank": "2"
  
            }'
        );
        $repo = $client->getResponse();
        var_dump($repo);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }
    public function testFaireDepotFALSE()
    {

        $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => "layejunior07",
                'PHP_AUTH_PW' => "junior07"
            ]
        );
        $crawler = $client->request(
            'POST',
            '/api/depocompte',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                "montant":,
                "dateDepot": "",
                "comptbank": "2"
            }'
        );
        $repo = $client->getResponse();
        var_dump($repo);
        $this->assertSame(400, $client->getResponse()->getStatusCode());
    }
}
