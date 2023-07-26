<?php 

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;



class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('roles',ArrayType::class ,['choices'=>['admin'=>'ROLE_ADMIN','user'=>'ROLE_USER']]);

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesAsArray): bool {
                    // transform the array to a string
                    return in_array('ROLE_ADMIN',[$rolesAsArray]);
                },
                function ($rolesAsString): array {
                    if ($rolesAsString) {
                        return ['ROLE_ADMIN'];
                    }
                    else
                        return [];
                    
                }
            ))
        ;
    }

    
}