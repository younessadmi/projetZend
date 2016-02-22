<?php
namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class AdminTable
{
    protected $tableGateway;
    protected $salt = "F_8U44u/BtmbSh)94";

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getAdmin($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            return false;
            //            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function getAdminByIdmail($idmail)
    {
        $rowset = $this->tableGateway->select(array('idmail' => $idmail));
        $row = $rowset->current();
        if (!$row) {
            return false;
            //            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    private function cryptPwd($pwd)
    {
        return substr(hash("sha256", sha1($pwd.$this->salt)), 0, 50);   
    }

    public function getInfoAdmin($email, $pwd)
    {
        $where = [
            'idmail' => $email,
            'password' => $this->cryptPwd($pwd),
        ];

        $rowset = $this->tableGateway->select($where);
        $row = $rowset->current();
        if(!$row){
            return false;
        }
        return $row;
    }

    public function checkIfMailExist($mail){
        $where = [
            'idmail' => $mail
        ];

        $rowset = $this->tableGateway->select($where);
        $row = $rowset->current();
        if(!$row){
            return false;
        }
        return $row;
    }

    public function saveAdmin(Admin $admin)
    {
        $data = array(
            'name' => $admin->name,
            'firstname'  => $admin->firstname,
            'genre'  => $admin->genre,
            'status'  => $admin->status,
            'password'  => $this->cryptPwd($admin->password),
            'date_create'  => $admin->date_create,
            'date_edit'  => $admin->date_edit,
            'idmail'  => $admin->idmail,
            'idrole'  => $admin->idrole,
        );

        $id = (int) $admin->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getAdmin($id)) {
                $this->tableGateway->update($data, ['id' => $id]);
            } else {
                throw new \Exception('Admin id does not exist');
            }
        }
    }

    public function deleteAdmin($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}