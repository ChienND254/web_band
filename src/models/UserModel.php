<?php
class UserModel extends Model
{

    protected $_table = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function createModel($data)
    {
        return parent::create($this->_table, $data);
    }

    public function updateModel($id, $data)
    {
        return parent::update($this->_table, $id, $data);
    }

    public function deleteModel($id)
    {
        return parent::delete($this->_table, $id);
    }

    public function getListModel($condition='')
    {
        return parent::findAll($this->_table,$condition);
    }

    public function getDetailModel($id)
    {
        return parent::findById($this->_table, $id);
    }
    
    public function findByEmail($email)
    {
        return parent::findAll($this->_table, "WHERE email = '".$email."'");
    }

    public function resetPassword($reset_token)
    {
        return parent::findAll($this->_table, "WHERE reset_token = '".$reset_token."'");
    }
}