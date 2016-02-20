<?php
namespace Admin\Form;

use Zend\Form\Form;

class AdminForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('admin');

        $this->add(array(
            'name' => 'email',
            'type' => 'email',
            'options' => array(
                'label' => 'Email address',
            ),
        ));
        $this->add(array(
            'name' => 'pwd',
            'type' => 'password',
            'options' => array(
                'label' => 'Password',
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