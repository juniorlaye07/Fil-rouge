<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UtilisateurControllerTest extends WebTestCase
{
    public function testregister()
    {
    
        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/api/utilisateur',[],[],
            ['CONTENT_TYPE' => 'application/json'],
            '{"username":"layejunior07","password": "junior07","Ngom": "Abdoulaye","tel": 776418887,"status": "Actif","profil":"ROLE_SUPER_ADMIN"}');
        $repo = $client->getResponse();
        var_dump($repo);
        $this->assertSame(401, $client->getResponse()->getStatusCode());
    }
    public function testregisterFalse()
    {

        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/api/utilisateur',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"username":"layeju","password": 74108520,"Ngom": "26949","tel": ,"status": "Actif","profil":"ROLE_ADMIN"}'
        );
        $repo = $client->getResponse();
        var_dump($repo);
        $this->assertSame(400, $client->getResponse()->getStatusCode());
    }
    public function testadd()
    {
        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/api/partenaire',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"ninea": "AH59L491","raisonsocial":"salmanSA","adresse":"St-louis","adresseMail"="salmamoney@yahoo.fr",tel":332289604,"status":"Bloquer"}'
        );
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }






    public function testAddParten()
    {
        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/api/partenaire',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"ninea": "295A96309SF","raisonsocial":"dfghjmlkjhgfd","adresse":"Mermoz","adresseMail":3232,"tel":"jcsvshv","status":"Bloquerdfghjkl"}'
        );
        $rep = $client->getResponse();
        var_dump($rep);
        $this->assertSame(400, $client->getResponse()->getStatusCode());
    }

}
