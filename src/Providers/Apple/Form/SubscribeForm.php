<?php

namespace App\Providers\Apple\Form;

use App\Providers\Apple\Model\ResponseBodyV1Request;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SubscribeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $notEmpty = ['constraints' => new NotBlank()];

        $builder
            ->add('number', IntegerType::class, $notEmpty);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'allow_extra_fields' => true,
            'data_class' => ResponseBodyV1Request::class,
        ]);
    }
}
