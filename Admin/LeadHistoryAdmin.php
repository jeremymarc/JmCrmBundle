<?php

namespace Jm\CrmBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\Admin;
use Jm\CrmBundle\Enum\ContactTypeEnum;
use Jm\CrmBundle\Enum\ContactedByEnum;

class LeadHistoryAdmin extends Admin
{
    private $contactedBy;

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('type')
            ->add('contactedBy')
            ->add('description')
            ->add('date')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('LeadHistory')
                ->add('lead')
                ->add('contactType', 'choice', array(
                    'choices' => ContactTypeEnum::toArray(),
                ))
                ->add('contactedBy', 'choice', array(
                    'choices' => $this->contactedBy
                ))
                ->add('description')
            ->end()
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('lead')
            ->add('contactType')
            ->add('contactedBy')
            ->add('description')
            ->add('date')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view'   => array(),
                )
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('lead')
            ->add('lead.id')
            ->add('contactType')
            ->add('contactedBy')
            ->add('description')
            ->add('date')
            ;
    }

    public function setContactedBy($contactedBy)
    {
        $this->contactedBy = $contactedBy;
    }
}
