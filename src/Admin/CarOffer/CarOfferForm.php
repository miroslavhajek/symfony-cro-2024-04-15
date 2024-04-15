<?php declare(strict_types=1);

namespace App\Admin\CarOffer;

use App\Infrastructure\Form\SubmitNovalidateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CarOfferForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Price',
            ])
            ->add('submit', SubmitNovalidateType::class, [
                'label' => 'Create',
            ]);
    }

}
