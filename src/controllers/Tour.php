<?php
class Tour extends Controller
{
    public $data = [];
    public $model_tour;
    public $file;

    public function __construct()
    {
        $this->file = new FileUpload();
        $this->model_tour = $this->model('TourModel');
    }

    public function index()
    {
        echo "Danh sách Tour diễn";
    }

    public function list()
    {
        $dataList  = $this->model_tour->getListModel();
        $this->data['tour_list'] = $dataList;
        $this->render('tour/list', $this->data);
    }

    public function detail($id)
    {
        $dataDetail  = $this->model_tour->getDetailModel($id);
        $this->data['tour_detail'] = $dataDetail;
        $this->render('tour/detail', $this->data);
    }

    public function readfile($imgName)
    {
        $this->file->getFileContent('tour/' . $imgName);
    }
}