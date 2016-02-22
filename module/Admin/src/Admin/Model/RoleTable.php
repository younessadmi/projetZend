<?php
namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class RoleTable
{
    protected $tableGateway;
    //    protected $salt = "F_8U44u/BtmbSh)94";

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getRoleById($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function getRoleByRole($role)
    {
        $rowset = $this->tableGateway->select(array('role' => $role));
        $row = $rowset->current();
        if(!$row){
            return false;
        }

        return $row;
    }

    //    public function saveRole(Role $role)
    //    {
    //        $data = array(
    //            'role' => $role->role,
    //        );
    //
    //        $id = (int) $role->id;
    //        if ($id == 0) {
    //            $this->tableGateway->insert($data);
    //        } else {
    //            if ($this->getRole($id)) {
    //                $this->tableGateway->update($data, ['id' => $id]);
    //            } else {
    //                throw new \Exception('Role id does not exist');
    //            }
    //        }
    //    }

    public function deleteRole($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}