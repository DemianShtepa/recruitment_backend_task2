<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Form\FormBuilderInterface;

final class TimeInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):  void
    {
        $builder
            ->add('date', DateType::class, [
                'required' => true,
                'format' => DateType::HTML5_FORMAT,
            ])
            ->add('timezone', TimezoneType::class)
            ->add('submit', SubmitType::class);
    }
}
