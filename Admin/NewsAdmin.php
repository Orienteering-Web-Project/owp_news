<?php

// src/Admin/EventTypeAdmin.php
namespace Owp\OwpNews\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Owp\OwpCore\Admin\AbstractNodeAdmin;
use Vich\UploaderBundle\Form\Type\VichImageType;

final class NewsAdmin extends AbstractNodeAdmin
{
    protected $baseRoutePattern  = 'news';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Informations générales', ['class' => 'text-bold col-12 col-lg-9'])
                ->add(self::LABEL, TextType::class)
                ->add('content', CKEditorType::class, array('config_name' => 'default'))
                ->add('imageFile', VichImageType::class, [
                    'required' => false,
                    'allow_delete' => true,
                    'download_uri' => true,
                    'image_uri' => true,
                    'asset_helper' => true,
                ])
                ->add('promote', CheckboxType::class, ['required' => false])
                ->add('private', CheckboxType::class, [
                    'required' => false,
                    'label' => 'Rendre cette actualité privée, visible uniquement par les licenciés du club'
                ])
            ->end()
        ;

        parent::configureFormFields($formMapper);
    }
}
