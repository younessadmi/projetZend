<?php
namespace Article\Form;

use Zend\Form\Form;

class AddArticleForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('article');

        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Titre',
            ),
        ));
        $this->add(array(
            'name' => 'date_publish',
            'type' => 'date',
            'options' => array(
                'label' => 'Date de publication',
            ),
        ));
        $this->add(array(
            'name' => 'url_picture',
            'type' => 'url',
            'options' => array(
                'label' => 'Lien de l\'image principale',
            ),
        ));
        $this->add(array(
            'name' => 'description',
            'type' => 'text',
            'options' => array(
                'label' => 'Description',
            ),
        ));
        $this->add(array(
            'name' => 'content',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Corps de l\'article',
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