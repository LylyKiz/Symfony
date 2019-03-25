<?php

namespace Dom\CarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class HistoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dataTaking', DateTimeType::class,array(
	            'label'  => 'Дата взятия в прокат'))
            ->add('dataReturn', DateTimeType::class,array(
	            'label'  => 'Дата возврата в прокат'))
	        ->add('car', EntityType::class, array(
		        'class' =>'DomCarBundle:Car',
		        'choice_label' => 'brand',
		        'label'  => 'Автомобиль'))
	        ->add('tenant', EntityType::class, array(
		        'class' =>'DomCarBundle:Tenant',
		        'choice_label' => 'fullname',
		        'label'  => 'Арендатор'))
	        ->add('point', EntityType::class, array(
	        'class' =>'DomCarBundle:Point',
	        'choice_label' => 'adres',
	        'label'  => 'Адрес точки проката'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dom\CarBundle\Entity\History'
        ));
    }
}
