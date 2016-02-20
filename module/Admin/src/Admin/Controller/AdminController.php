<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\Admin;
use Admin\Form\AdminForm;

class AdminController extends AbstractActionController
{
    protected $adminTable;
    protected $mailTable;

    //the ServiceManager can create an AdminTable instance for us, we can add a method to the controller to retrieve it.
    public function getAdminTable()
    {
        if (!$this->adminTable) {
            $sm = $this->getServiceLocator();
            $this->adminTable = $sm->get('Admin\Model\AdminTable');
        }
        return $this->adminTable;
    }

    public function getMailTable()
    {
        if (!$this->mailTable) {
            $sm = $this->getServiceLocator();
            $this->mailTable = $sm->get('Mail\Model\MailTable');
        }
        return $this->mailTable;
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
        if(!isset($_SESSION['id'])){
            $form = new AdminForm();
            $form->get('submit')->setValue('Login');

            $request = $this->getRequest();
            if ($request->isPost()) {
                $admin = new Admin();
                $form->setInputFilter($admin->getInputFilter());
                $form->setData($request->getPost());

                if ($form->isValid()) {

                    $temp = $form->getData();
                    $mails = $this->getMailTable()->getMailByMail($temp['email']);
                    if($mails){
                        $temp['email'] = $mails->id;

                        // $admin->exchangeArray($form->getData());
                        if(($temp = $this->getAdminTable()->getInfoAdmin($temp['email'], $temp['pwd'])) !== false){
                            // défini les variables de sessions
                            $_SESSION['id'] = $temp->id;
                            $_SESSION['name'] = $temp->name;
                            $_SESSION['firstname'] = $temp->firstname;
                            $_SESSION['genre'] = $temp->genre;
                            $_SESSION['status'] = $temp->status;
                            $_SESSION['date_create'] = $temp->date_create;
                            $_SESSION['date_edit'] = $temp->date_edit;
                            $_SESSION['idmail'] = $temp->idmail;
                            $_SESSION['idrole'] = $temp->idrole;
                            return $this->redirect()->toRoute('admin');
                        }
                        // $this->getAdminTable()->saveAdmin($admin);
                    }
                }
            }
            return array('form' => $form);
        }else $this->redirect()->toRoute('admin');
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