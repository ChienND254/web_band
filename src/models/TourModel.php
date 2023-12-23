<?php
class TourModel extends Model
{
    protected $_table = 'tour';

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

    public function getListModel($condition = '')
    {
        return parent::findAll($this->_table, $condition);
    }

    public function getDetailModel($id)
    {
        return parent::findById($this->_table, $id);
    }

    public function getNumTicket($id)
    {
        return parent::querySQL("SELECT COUNT(*) as number FROM tour 
        left join ticket on tour.id = ticket.tour_id
        WHERE ticket.status = 'IN_STOCK' and tour.id = $id
        GROUP by tour.id;");
    }
}