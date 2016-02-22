<?php

namespace Article\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Article
{
    public $id;
    public $title;
    public $content;
    public $date_publish;
    public $date_create;
    public $status;
    public $date_edit;
    public $url_picture;
    public $description;
    public $idadmin;
    public $idcategory;
    public $view;
    protected $inputFilter; 

    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->title     = (!empty($data['title'])) ? $data['title'] : null;
        $this->content     = (!empty($data['content'])) ? $data['content'] : null;
        $this->date_publish     = (!empty($data['date_publish'])) ? $data['date_publish'] : null;
        $this->date_create     = (!empty($data['date_create'])) ? $data['date_create'] : date('Y-m-d H:i:s');
        $this->status     = (!empty($data['status'])) ? $data['status'] : null;
        $this->date_edit     = (!empty($data['date_edit'])) ? $data['date_edit'] : null;
        $this->url_picture     = (!empty($data['url_picture'])) ? $data['url_picture'] : null;
        $this->description     = (!empty($data['description'])) ? $data['description'] : null;
        $this->idadmin     = (!empty($data['idadmin'])) ? $data['idadmin'] : null;
        $this->idcategory     = (!empty($data['idcategory'])) ? $data['idcategory'] : null;
        $this->view     = (!empty($data['view'])) ? $data['view'] : 0;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter($mode)
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            if($mode == 'addArticle'){
                
                $inputFilter->add(array(
                    'name'     => 'title',
                    'required' => true,
                ));
                $inputFilter->add(array(
                    'name'     => 'date_publish',
                    'required' => true,
                ));
                $inputFilter->add(array(
                    'name'     => 'url_picture',
                    'required' => true,
                ));
                $inputFilter->add(array(
                    'name'     => 'description',
                    'required' => true,
                ));
                $inputFilter->add(array(
                    'name'     => 'content',
                    'required' => true,
                ));
            }
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}