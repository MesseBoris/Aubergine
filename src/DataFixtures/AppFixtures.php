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
		$comps=[];
		
		$comp = new Competence();
		$comp->setTipe('Logiciel');
		$comp->setLibelle('Traitement de texte');
		$comps[]=$comp;
		$manager->persist($comp);
		
		$comp = new Competence();
		$comp->setTipe('Logiciel');
		$comp->setLibelle('OS');
		$comps[]=$comp;
		$manager->persist($comp);
		
		$comp = new Competence();
		$comp->setTipe('Logiciel');
		$comp->setLibelle('ERP');
		$comps[]=$comp;
		$manager->persist($comp);
		
		
		$comp = new Competence();
		$comp->setTipe('Materiel');
		$comp->setLibelle('Carte mère');
		$comps[]=$comp;
		$manager->persist($comp);
		
		$comp = new Competence();
		$comp->setTipe('Materiel');
		$comp->setLibelle('Alimentation');
		$comps[]=$comp;
		$manager->persist($comp);
		
		$comp = new Competence();
		$comp->setTipe('Materiel');
		$comp->setLibelle('Disque dur');
		$comps[]=$comp;
		$manager->persist($comp);
		
		$comp = new Competence();
		$comp->setTipe('Materiel');
		$comp->setLibelle('Ecran');
		$comps[]=$comp;
		$manager->persist($comp);
		
		$comp = new Competence();
		$comp->setTipe('Materiel');
		$comp->setLibelle('Réseau');
		$comps[]=$comp;
		$manager->persist($comp);
		
		$user = new User();	
		$user->setUsername('test');
		$user->setPassword('test');
		$user->setPlainpassword('test');
		$user->setEmail('test@test.com');
		$user->addRole('ROLE_ADMIN');
		$user->addRole('ROLE_SUPER_ADMIN');
		$manager->persist($user);
		
		$user = new User();	
		$user->setUsername('test2');
		$user->setPassword('test2');
		$user->setPlainpassword('test');
		$user->setEmail('test@test.com');
		$user->addRole('ROLE_ADMIN');
		
		foreach($comps as $comp)
			$user->addCompetence($comp);
		$manager->persist($user);

        $manager->flush();
    }
}