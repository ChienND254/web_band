<?php
class OrderModel extends Model{
    protected $_table = 'order_table';

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
        return parent::delete_row($this->_table, $id);
    }

    public function getListModel($condition = '')
    {
        return parent::findAll($this->_table, $condition);
    }

    public function getDetailModel($id)
    {
        return parent::findById($this->_table, $id);
    }
    
    public function getLastModel()
    {
        return parent::findAll($this->_table, 'ORDER BY id DESC LIMIT 1;');
    }
}