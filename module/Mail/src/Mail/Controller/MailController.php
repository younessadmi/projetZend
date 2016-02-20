<?php

namespace Mail\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Mail\Model\Mail;
//use Mail\Form\MailForm;

class MailController extends AbstractActionController
{
    protected $mailTable;

    //the ServiceManager can create an MailTable instance for us, we can add a method to the controller to retrieve it.
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
    }
}