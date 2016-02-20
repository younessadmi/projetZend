<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    protected $adminTable;
    
    //the ServiceManager can create an AlbumTable instance for us, we can add a method to the controller to retrieve it.
    public function getAdminTable()
    {
        if (!$this->adminTable) {
            $sm = $this->getServiceLocator();
            $this->adminTable = $sm->get('Admin\Model\AdminTable');
        }
        return $this->adminTable;
    }
    
    public function indexAction()
    {
        return new ViewModel([
            'admins' => $this->getAdminTable()->fetchAll(),
        ]);
    }

    public function loginAction()
    {
    }

    public function logoutAction()
    {
    }

    public function gestion_pageAction()
    {
    }

    public function gestion_articleAction()
    {
    }

    public function gestion_newsletterAction()
    {
    }

    public function gestion_commentAction()
    {
    }

    public function gestion_categorieAction()
    {
    }

    public function gestion_adminAction()
    {
    }

    public function gestion_profilAction()
    {
    }

    public function kpiAction()
    {
    }
}