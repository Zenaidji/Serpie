<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use SebastianBergmann\CodeCoverage\Report\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TexType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',\Symfony\Component\Form\Extension\Core\Type\TextType::class,["constraints"=> new Length(["min"=>2,"max"=>30]),"label" => "Nom","attr"=>["placeholder"=>"Ex Zenaidji"]] )
            ->add('lastname',\Symfony\Component\Form\Extension\Core\Type\TextType::class,["constraints"=> new Length(["min"=>2,"max"=>30]),"label" => "Prénom","attr"=>["placeholder"=>"Ex yacine"]] )
            ->add('email',\Symfony\Component\Form\Extension\Core\Type\EmailType::class,["constraints"=> new Length(["min"=>9,"max"=>50]),"attr"=>["placeholder"=>"Ex Yacine07@gmail.com"]])
            ->add('number',\Symfony\Component\Form\Extension\Core\Type\NumberType::class,["constraints"=> new Length(["min"=>9,"max"=>14]),"label"=>"numéro","attr"=>["placeholder"=>"+213752525625"]])
            ->add('password',\Symfony\Component\Form\Extension\Core\Type\RepeatedType::class,["type"=> \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, "first_options"=>["label"=>"mot de passe"],"second_options"=>["label"=>"confirmez votre mot de passe"] ,"required"=>true,"invalid_message"=>"les mots de passe ne sont pas identique"])
            ->add('submit',\Symfony\Component\Form\Extension\Core\Type\SubmitType::class,["label"=>"Inscription"])
          
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
