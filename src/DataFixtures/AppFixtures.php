<?php 

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Competence;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
		
		
		

        $manager->flush();
    }
}