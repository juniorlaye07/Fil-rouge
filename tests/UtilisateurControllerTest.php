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
}
