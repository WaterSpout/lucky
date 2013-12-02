<?php

namespace Core\LuckyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email', array('label' => "Введите вашу почту", 'required'=>true))
				->add('save', 'submit', array('label' => "Перейти к способам оплаты", 'attr' => array('class' => 'btn btn-default')));
    }

    public function getName()
    {
        return 'start';
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Core\LuckyBundle\Entity\User',
	        'validation_groups' =>  array('start_user'),
		));
	}
}
