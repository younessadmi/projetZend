<?php

namespace Admin\Model;

//use Zend\InputFilter\InputFilter;
//use Zend\InputFilter\InputFilterAwareInterface;
//use Zend\InputFilter\InputFilterInterface;

class Role
{
//    protected $inputFilter;
    public $id;
    public $role;

    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->role     = (!empty($data['role'])) ? $data['role'] : null;
    }

    //    public function setInputFilter(InputFilterInterface $inputFilter)
    //    {
    //        throw new \Exception("Not used");
    //    }
    //
    //    public function getInputFilter($mode)
    //    {
    //        if(!$this->inputFilter){
    //            $inputFilter = new InputFilter();
    //            if($mode == 'login'){
    //                $inputFilter->add(array(
    //                    'name'     => 'email',
    //                    'required' => true,
    //                ));
    //
    //                $inputFilter->add(array(
    //                    'name'     => 'pwd',
    //                    'required' => true,
    //                ));
    //            }
    //            elseif($mode == 'addAdmin'){
    //                $inputFilter->add(array(
    //                    'name'     => 'name',
    //                    'required' => true,
    //                ));
    //                $inputFilter->add(array(
    //                    'name'     => 'firstname',
    //                    'required' => true,
    //                ));
    //                $inputFilter->add(array(
    //                    'name'     => 'genre',
    //                    'required' => true,
    //                ));
    //                $inputFilter->add(array(
    //                    'name'     => 'password',
    //                    'required' => true,
    //                ));
    //                $inputFilter->add(array(
    //                    'name'     => 'email',
    //                    'required' => true,
    //                ));
    //                $inputFilter->add(array(
    //                    'name'     => 'role',
    //                    'required' => true,
    //                ));
    //            }
    //            $this->inputFilter = $inputFilter;
    //        }
    //
    //        return $this->inputFilter;
    //    }
}