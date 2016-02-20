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
        if(!isset($_SESSION['id'])){
            $this->redirect()->toRoute('admin', ['action' => 'login']);
        }
        return new ViewModel([
            'admins' => $this->getAdminTable()->fetchAll(),
        ]);
    }

    public function loginAction()
    {
        
    }

    public function logoutAction()
    {
        $_SESSION = [];
        session_destroy();
        $this->redirect()->toRoute('admin', ['action' => 'login']);
    }

    public function gestion_pageAction()
    {
        if(!isset($_SESSION['id'])){
            $this->redirect()->toRoute('admin', ['action' => 'login']);
        }
    }

    public function gestion_articleAction()
    {
        if(!isset($_SESSION['id'])){
            $this->redirect()->toRoute('admin', ['action' => 'login']);
        }
    }

    public function gestion_newsletterAction()
    {
        if(!isset($_SESSION['id'])){
            $this->redirect()->toRoute('admin', ['action' => 'login']);
        }
    }

    public function gestion_commentAction()
    {
        if(!isset($_SESSION['id'])){
            $this->redirect()->toRoute('admin', ['action' => 'login']);
        }
    }

    public function gestion_categorieAction()
    {
        if(!isset($_SESSION['id'])){
            $this->redirect()->toRoute('admin', ['action' => 'login']);
        }
    }

    public function gestion_adminAction()
    {
        if(!isset($_SESSION['id'])){
            $this->redirect()->toRoute('admin', ['action' => 'login']);
        }
    }

    public function gestion_profilAction()
    {
        if(!isset($_SESSION['id'])){
            $this->redirect()->toRoute('admin', ['action' => 'login']);
        }
    }

    public function kpiAction()
    {
        if(!isset($_SESSION['id'])){
            $this->redirect()->toRoute('admin', ['action' => 'login']);
        }
    }
}