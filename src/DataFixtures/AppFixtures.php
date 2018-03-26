<?php 

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Competence;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		$comp = new Competence();
		$comp->setTipe('Logiciel');
		$comp->setLibelle('Traitement de texte');
		$manager->persist($comp);
		
		$comp = new Competence();
		$comp->setTipe('Logiciel');
		$comp->setLibelle('OS');
		$manager->persist($comp);
		
		$comp = new Competence();
		$comp->setTipe('Logiciel');
		$comp->setLibelle('ERP');
		$manager->persist($comp);
		
		
		$comp = new Competence();
		$comp->setTipe('Materiel');
		$comp->setLibelle('Carte mère');
		$manager->persist($comp);
		
		$comp = new Competence();
		$comp->setTipe('Materiel');
		$comp->setLibelle('Alimentation');
		$manager->persist($comp);
		
		$comp = new Competence();
		$comp->setTipe('Materiel');
		$comp->setLibelle('Disque dur');
		$manager->persist($comp);
		
		$comp = new Competence();
		$comp->setTipe('Materiel');
		$comp->setLibelle('Ecran');
		$manager->persist($comp);
		
		$comp = new Competence();
		$comp->setTipe('Materiel');
		$comp->setLibelle('Réseau');
		$manager->persist($comp);
		
		$user = new User();	
		$user->setUsername('test');
		$user->setPassword('test');
		$user->setPlainpassword('test');
		$user->setEmail('test@test.com');
		$user->addRole('ROLE_ADMIN');
		$user->addRole('ROLE_SUPER_ADMIN');
		$manager->persist($user);

        $manager->flush();
    }
}