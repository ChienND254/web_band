<?php
class Tour extends Controller
{
    public $data = [];
    public $model_tour;

    public function __construct()
    {
        $this->model_tour = $this->model('TourModel');
    }

    public function index()
    {
        echo "Danh sách Tour diễn";
    }

    public function list()
    {
        $dataList  = $this->model_tour->getListModel("WHERE id = 2");
        $this->data['tour_list'] = $dataList;
        $this->render('tour/list', $this->data);
    }

    public function detail($id)
    {
        $dataDetail  = $this->model_tour->getDetailModel($id);
        $this->data['tour_detail'] = $dataDetail;
        $this->render('tour/detail', $this->data);
    }
}