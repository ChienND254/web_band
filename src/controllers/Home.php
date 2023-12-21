<?php
class Home extends Controller
{
    public $data = [];
    public $model_tour;

    public function __construct()
    {
        // $this->model_home = $this->model('HomeModel');
        $this->model_tour = $this->model('TourModel');
    }

    public function index()
    {
        $dataList  = $this->model_tour->getListModel();
        $this->data['tour_list'] = $dataList;

        $this->render('home/index',$this->data);
    }
}