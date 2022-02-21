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

class ResponseBodyV1Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $notEmpty = ['constraints' => new NotBlank()];

        $builder
            ->add('auto_renew_adam_id', IntegerType::class, $notEmpty)
            ->add('auto_renew_product_id', TextType::class, $notEmpty)
            ->add('auto_renew_status', BooleanType::class, $notEmpty)
            ->add('auto_renew_status_change_date', DateTimeType::class, [
                'widget' => 'single_text',
                'constraints' => new NotBlank(),
            ])
            ->add('auto_renew_status_change_date_ms', IntegerType::class, $notEmpty)
            ->add('auto_renew_status_change_date_pst', DateTimeType::class, [
                'widget' => 'single_text',
                'constraints' => new NotBlank(),
            ])
            ->add('bid', TextType::class, $notEmpty)
            ->add('bvrs', TextType::class, $notEmpty)
            ->add('environment', TextType::class, [
                'choices' => ResponseBodyV1Request::getAvailableEnvTypes(),
                'constraints' => new NotBlank(),
            ])
            ->add('expiration_intent', IntegerType::class, $notEmpty)
            ->add('notification_type', ChoiceType::class, [
                'choices' => ResponseBodyV1Request::getAvailableNotificationTypes(),
                'constraints' => new NotBlank(),
            ])
            ->add('original_transaction_id', TextType::class, $notEmpty)
            ->add('password', TextType::class, $notEmpty);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'allow_extra_fields' => true,
            'data_class' => ResponseBodyV1Request::class,
        ]);
    }
}
