<?php

namespace Admin\Model;

class Admin
{
    public $id;
    public $name;
    public $firstname;
    public $genre;
    public $status;
    public $password;
    public $date_create;
    public $date_edit;
    public $idmail;
    public $idrole;

    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->name     = (!empty($data['name'])) ? $data['name'] : null;
        $this->firstname     = (!empty($data['firstname'])) ? $data['firstname'] : null;
        $this->genre     = (!empty($data['genre'])) ? $data['genre'] : null;
        $this->status     = (!empty($data['status'])) ? $data['status'] : null;
        $this->password     = (!empty($data['password'])) ? $data['password'] : null;
        $this->date_create     = (!empty($data['date_create'])) ? $data['date_create'] : null;
        $this->date_edit     = (!empty($data['date_edit'])) ? $data['date_edit'] : null;
        $this->idmail     = (!empty($data['idmail'])) ? $data['idmail'] : null;
        $this->idrole     = (!empty($data['idrole'])) ? $data['idrole'] : null;
    }
}