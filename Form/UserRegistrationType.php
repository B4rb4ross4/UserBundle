<?php

namespace B4rb4ross4\UserBundle\Form;

use B4rb4ross4\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', EmailType::class)
            ->add('username')
            ->add('plainPassword', RepeatedType::class, array(
              'type' => PasswordType::class,
              'invalid_message' => 'The password fields must match.',
              'options' => array('attr' => array('class' => 'password-field')),
              'required' => true,
              'first_options'  => array('label' => 'Password'),
              'second_options' => array('label' => 'Confirm Password'),
            ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class
        ));
    }
}
