<?php declare(strict_types=1);

namespace App\Admin\CarOffer;

use App\Infrastructure\Form\SubmitNovalidateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarOfferForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var bool $isUpdate */
        $isUpdate = $options['is_update'];

        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Price',
            ])
            ->add('submit', SubmitNovalidateType::class, [
                'label' => $isUpdate ? 'Edit' : 'Create',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefined('is_update');
        $resolver->setAllowedTypes('is_update', 'bool');
        $resolver->setDefault('is_update', false);
    }


}
