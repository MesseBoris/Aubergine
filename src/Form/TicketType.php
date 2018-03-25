<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use App\Entity\Ticket;
use App\Entity\Competence;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add("poste", TextType::class)
			->add("description",Texttype::class)
			->add("qualification", EntityType::class,array(
				'class'=>Competence::class,
				'choice_label' => 'libelle',
				'query_builder' => function (EntityRepository $er) {
					return $er->createQueryBuilder('u')
							->orderBy('u.tipe', 'ASC');
				},
				)
			)
			
			
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