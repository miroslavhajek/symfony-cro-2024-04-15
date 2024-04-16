<?php declare(strict_types=1);

namespace App\App\CarOffer;

use App\Infra\Form\SubmitButtonType;
use App\Infrastructure\Form\SubmitNovalidateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class InquiryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone',
            ])
            ->add('note', TextareaType::class, [
                'label' => 'Note',
            ])
            ->add('submit', SubmitNovalidateType::class, [
                'label' => 'Submit Inquiry',
            ]);
    }

}
