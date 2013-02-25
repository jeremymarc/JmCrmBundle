<?php

namespace Jm\CrmBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\Admin;
use Jm\CrmBundle\Enum\CompanyCategoryEnum;
use Jm\CrmBundle\Enum\CompanyTypeEnum;

class LeadAdmin extends Admin
{
    private $contactedBy;

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('firstname')
            ->add('lastname')
            ->add('companyName')
            ->add('email')
            ->add('website')
            ->add('companyCategory')
            ->add('companyType')
            ->add('managedBy')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Lead')
                ->add('companyName')
                ->add('email')
                ->add('firstname')
                ->add('lastname')
                ->add('website')
                ->add('companyCategory', 'choice', array(
                    'choices' => CompanyCategoryEnum::toArray(),
                ))
                ->add('companyType', 'choice', array(
                    'choices' => CompanyTypeEnum::toArray(),
                ))
                ->add('managedBy', 'choice', array(
                    'choices' => $this->contactedBy,
                ))
            ->end()
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('companyName')
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('website')
            ->add('companyCategory')
            ->add('companyType')
            ->add('managedBy')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view'   => array(),
                    'history' => array(
                        'template' => 'JmCrmBundle:Admin:history.html.twig'
                    ),
                    'edit'   => array(),
                )
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('companyName')
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('website')
            ->add('companyCategory')
            ->add('companyType')
            ->add('managedBy')
            ->add('createdAt')
            ->add('updatedAt')
            ;
    }

    public function setContactedBy($contactedBy)
    {
        $this->contactedBy = $contactedBy;
    }
}
