<?php

namespace Xcx\IstxtBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IsdocType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('company')
            ->add('position')
            ->add('description')
            ->add('is_public')
            ->add('is_activated')
            ->add('email')
            ->add('expires_at')
            ->add('created_at')
            ->add('updated_at')
            ->add('category')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Xcx\IstxtBundle\Entity\Isdoc'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'xcx_istxtbundle_isdoc';
    }
}
