<?php
namespace Mail\Model;

use Zend\Db\TableGateway\TableGateway;

class MailTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getMailById($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function getMailByMail($mail)
    {
        $id  = $mail;
        $rowset = $this->tableGateway->select(array('mail' => $mail));
        $row = $rowset->current();
        if (!$row) {
//            throw new \Exception("Could not find row $mail");
            return false;
        }
        return $row;
    }

    public function saveMail(Mail $mail)
    {
        $data = array(
            'mail' => $mail->mail,
            'status'  => $mail->status,
            'suscribed'  => $mail->suscribed,
            'date_mail_validation'  => $mail->date_mail_validation,
        );

        $id = (int) $mail->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getMail($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Mail id does not exist');
            }
        }
    }

    public function deleteMail($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}