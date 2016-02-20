<?php

namespace Mail\Model;

class Mail
{
    public $id;
    public $mail;
    public $status;
    public $suscribed;
    public $date_mail_validation;

    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->mail     = (!empty($data['mail'])) ? $data['mail'] : null;
        $this->status     = (!empty($data['status'])) ? $data['status'] : null;
        $this->suscribed     = (!empty($data['suscribed'])) ? $data['suscribed'] : null;
        $this->date_mail_validation     = (!empty($data['date_mail_validation'])) ? $data['date_mail_validation'] : null;
    }
}