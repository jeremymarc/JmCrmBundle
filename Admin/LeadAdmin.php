<?php

namespace Jm\CrmBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\Admin;
use Jm\CrmBundle\Enum\CompanyCategoryEnum;
use Jm\CrmBundle\Enum\CompanyTypeEnum;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;

class LeadAdmin extends Admin
{
    private $contactedBy;

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Lead')
                ->add('id')
                ->add('firstname')
                ->add('lastname')
                ->add('companyName')
                ->add('email')
                ->add('website')
                ->add('phone')
                ->add('mobile')
                ->add('companyCategory')
                ->add('companyType')
                ->add('managedBy')
            ->end()
            ->with('History')
                ->add('historys', 'entity')
            ->end()
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
                ->add('phone')
                ->add('mobile')
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
            ->addIdentifier('id')
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
            ->add('id')
            ->add('companyName')
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('website')
            ->add('companyCategory')
            ->add('companyType')
            ->add('managedBy')
            ->add('createdAt', 'doctrine_orm_date_range')
            ->add('updatedAt', 'doctrine_orm_date_range')
            ;
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

        if ('show' == $action) {
            $item = $this->menuFactory->createItem('history', array(
                'uri' => '/admin/jm/crm/leadhistory/list?filter%5Blead__id%5D%5Bvalue%5D=' . $id,
                'label' => 'View history',
            ));
            $menu->addChild($item);

            if (class_exists('Rj\EmailBundle\RjEmailBundle')) {
                //$item = $this->menuFactory->createItem('history', array(
                    //'uri' => '#',
                    //'label' => 'Send a new email',
                //));
                //$menu->addChild($item);
            }
        }
        
    }

    public function setContactedBy($contactedBy)
    {
        $this->contactedBy = $contactedBy;
    }
}
