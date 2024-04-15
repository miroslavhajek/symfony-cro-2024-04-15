<?php declare(strict_types=1);

namespace App\Infrastructure\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubmitNovalidateType extends SubmitType
{

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefault('validate', false);
    }

}
