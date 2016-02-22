<?php

namespace Admin\Form;

use Zend\Form\Form;

class AdminAddAdminForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('admin');
        
        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nom',
            ),
        ));
        $this->add(array(
            'name' => 'firstname',
            'type' => 'Text',
            'options' => array(
                'label' => 'Prénom',
            ),
        ));
        $this->add(array(
            'name' => 'genre',
            'type' => 'Text',
            'options' => array(
                'label' => 'Genre (M/F)',
            ),
        ));
//        $this->add(array(
//            'name' => 'status',
//            'type' => 'Text',
//            'options' => array(
//                'label' => 'Status (1: activé)',
//            ),
//        ));
        
        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'options' => array(
                'label' => 'Mot de passe',
            ),
        ));
        $this->add(array(
            'name' => 'idmail',
            'type' => 'email',
            'options' => array(
                'label' => 'Adresse mail',
            ),
        ));
        $this->add(array(
            'name' => 'idrole',
            'type' => 'text',
            'options' => array(
                'label' => 'Role (Super Administrateur, Auteur, Editeur, Contributeur, Analyste, Graphiste)',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}