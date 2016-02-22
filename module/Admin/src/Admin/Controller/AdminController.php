<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\Admin;
use Mail\Model\Mail;
use Admin\Form\AdminLoginForm;
use Admin\Form\AdminAddAdminForm;

class AdminController extends AbstractActionController
{
    protected $adminTable;
    protected $mailTable;
    protected $articleTable;
    protected $roleTable;

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

    public function getArticleTable()
    {
        if (!$this->articleTable) {
            $sm = $this->getServiceLocator();
            $this->articleTable = $sm->get('Article\Model\ArticleTable');
        }
        return $this->articleTable;
    }

    public function getRoleTable()
    {
        if (!$this->roleTable) {
            $sm = $this->getServiceLocator();
            $this->roleTable = $sm->get('Admin\Model\RoleTable');
        }
        return $this->roleTable;
    }

    public function indexAction()
    {
        if(!isset($_SESSION['id'])){
            $this->redirect()->toRoute('admin', ['action' => 'login']);
        }
    }

    public function loginAction()
    {
        if(!isset($_SESSION['id'])){
            $form = new AdminLoginForm();
            $form->get('submit')->setValue('Login');

            $request = $this->getRequest();
            if ($request->isPost()) {
                $viewModel['test'] = 'post';
                $admin = new Admin();
                $form->setInputFilter($admin->getInputFilter('login'));
                $form->setData($request->getPost());
                if ($form->isValid()) {
                    $temp = $form->getData();
                    $mails = $this->getMailTable()->getMailByMail($temp['email']);
                    if($mails){
                        $temp['email'] = $mails->id;
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
                        }else $viewModel['error'] = 'Email ou mot de passe incorrect';
                    }else $viewModel['error'] = 'Email ou mot de passe incorrect';
                }else $viewModel['error'] = 'Formulaire non valide';
            }
            $viewModel['form'] = $form;

            return $viewModel;
        }else $this->redirect()->toRoute('admin');
    }

    public function logoutAction()
    {
        $_SESSION = [];
        session_destroy();
        $this->redirect()->toRoute('admin', ['action' => 'login']);
    }

    public function gestionArticleAction()
    {
        if(!isset($_SESSION['id'])){
            $this->redirect()->toRoute('admin', ['action' => 'login']);
        }

        $verb = $this->getEvent()->getRouteMatch()->getParam('verb');
        switch($verb){
            case 'list':{
                break;
            }
            case 'add':{
                break;
            }
            case 'edit':{
                break;
            }
            case 'delete':{
                break;
            }
        }
        return new ViewModel([
            'verb' => $verb,
        ]);
    }

    public function gestionAdminAction()
    {
        if(!isset($_SESSION['id'])){
            $this->redirect()->toRoute('admin', ['action' => 'login']);
        }

        $viewModel = [];
        $verb = $this->getEvent()->getRouteMatch()->getParam('verb');
        switch($verb){
            case 'list':{
                $viewModel['admins'] = $this->getAdminTable()->fetchAll();
                break;
            }
            case 'add':{
                $form = new AdminAddAdminForm();
                $form->get('submit')->setValue('Ajouter');

                $request = $this->getRequest();
                if($request->isPost()){
                    //                    if(true){
                    $admin = new Admin();
                    $form->setInputFilter($admin->getInputFilter('addAdmin'));
                    $form->setData($request->getPost());
                    if($form->isValid()){
                        $getDataForm = $form->getData();
                        if($getDataForm['genre'] == 'M' || $getDataForm['genre'] == 'F'){
                            $idRole = $this->getRoleTable()->getRoleByRole($getDataForm['idrole']);
                            if($idRole){
                                $getDataForm['idrole'] = ($idRole->id != null)? $idRole->id : 0 ;
                                $idmail = $this->getMailTable()->getMailByMail($getDataForm['idmail']);
                                if(!$idmail){
                                    $mail = new Mail();
                                    $mail->exchangeArray([
                                        'mail'=>$getDataForm['idmail'],
                                        'status'=>0,
                                        'suscribed'=>0
                                    ]);
                                    $this->getMailTable()->saveMail($mail);
                                }
                                $idmail = $this->getMailTable()->getMailByMail($getDataForm['idmail']);
                                $getDataForm['idmail'] = $idmail->id;
                                $existingAdminMail = $this->getAdminTable()->getAdminByIdmail($getDataForm['idmail']);
                                if(!$existingAdminMail){
                                    $admin->exchangeArray($getDataForm);
                                    $this->getAdminTable()->saveAdmin($admin);
                                    return $this->redirect()->toRoute('admin', ['action'=>'gestionAdmin']);
                                }else $viewModel['error'] = 'Cette adresse mail est déjà attribué à un administrateur';
                            }else $viewModel['error'] = 'Rôle inconnu';
                        }else $viewModel['error'] = 'Le genre est incorrect. Entrer M ou F';
                    }else $viewModel['error'] = 'Formulaire invalide';
                }
                $viewModel['form'] = $form;
                break;
            }
            case 'edit':{
                break;
            }
            case 'delete':{
                $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
                if(!$id){
                    $this->redirect()->toRoute('admin', ['action' => 'gestionAdmin']);
                }
                $admin = $this->getAdminTable()->getAdmin($id);
                if($admin){
                    $admin->status = 2;
                    $this->getAdminTable()->saveAdmin($admin);
                    $viewModel['success'] = 'Administrateur supprimé ';
                }else $this->redirect()->toRoute('admin', ['action' => 'gestionAdmin']);



                break;
            }
        }
        $viewModel['verb'] = $verb;

        return new ViewModel($viewModel);
    }

    //    public function gestionPageAction()
    //    {
    //        if(!isset($_SESSION['id'])){
    //            $this->redirect()->toRoute('admin', ['action' => 'login']);
    //        }
    //    }

    //    public function gestionProfilAction()
    //    {
    //        if(!isset($_SESSION['id'])){
    //            $this->redirect()->toRoute('admin', ['action' => 'login']);
    //        }
    //    }

    //    public function kpiAction()
    //    {
    //        if(!isset($_SESSION['id'])){
    //            $this->redirect()->toRoute('admin', ['action' => 'login']);
    //        }
    //    }
    //    public function gestionNewsletterAction()
    //    {
    //        if(!isset($_SESSION['id'])){
    //            $this->redirect()->toRoute('admin', ['action' => 'login']);
    //        }
    //    }

    //    public function gestionCommentAction()
    //    {
    //        if(!isset($_SESSION['id'])){
    //            $this->redirect()->toRoute('admin', ['action' => 'login']);
    //        }
    //    }

    //    public function gestionCategorieAction()
    //    {
    //        if(!isset($_SESSION['id'])){
    //            $this->redirect()->toRoute('admin', ['action' => 'login']);
    //        }
    //    }
}