<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use App\Entity\Ticket;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add("poste", TextType::class)
			->add("description",Texttype::class)
			->add("qualification", ChoiceType::class,array(
				'choices' => array(
					'Logiciel' => array(
						'Traitement de texte' => 'Traitement de texte',
						'OS' => 'OS',
						'ERP' => 'ERP',
					),
					'Materiel' => array(
						'Carte mère' => 'Carte mère',
						'Alimentation' => 'Alimentation',
						'Disque dur' => 'Disque dur',
						'Ecran' => 'Ecran',
						'Réseau' => 'Réseau',
					),
				)
			))
			
			
			->add("save", SubmitType::class, ["label" => "créer ticket"])
			;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ticket::class,
        ));
    }
}