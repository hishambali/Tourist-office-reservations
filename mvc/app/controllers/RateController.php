<?php


require __DIR__.'/../models/RateModel.php';



class RateController {
    private $model;
  

    public function __construct($db) {
      
        $this->model = new RateModel($db);
    }
   

    public function index() {
        $rates = $this->model->getRates();
        
        include __DIR__.'/../views/Rates_list.php';
    }

    public function addRate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $hotelname = $_POST['hotelname'];
            $comment=$_POST['comment'];
            $data = [
                'cityname' => $cityname,
                'password' => $country,
                'comment' => $comment
            ];

            if ($this->model->addRate($data)) {
                header('Location:' . BASE_PATH);
                echo 'done' ;
            } else {
                echo "Failed to add Rate.";
            }
        }
    }

    public function showRates() {
        $rates = $this->model->getRate();
        include '../views/rate_list.php';
    }

    public function deleteRate($id) {
        if ($this->model->deleteRate($id)) {
            echo "rate deleted successfully!";
            header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete rate.";
        }
    }

    public function updateRate($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $hotelname = $_POST['hotelname'];
            $comment=$_POST['comment'];
            $data = [
                'username' => $username,
                'hotel' => $hotelname,
                'comment' => $comment;
            ];

            if ($this->model->updateRate($id, $data)) {
                echo "rate updated successfully!";
                header('Location:' . BASE_PATH);
            } else {
                echo "Failed to update rate.";
            }
        } else {
            $rate = $this->model->getRateById($id);
            include __DIR__.'/../views/edit_rate.php';
        }
    }

    public function editRate($id) {
        $rate = $this->model->getRateById($id);
        include __DIR__.'/../views/rate_city.php';
    }

    public function searchRates($searchTerm) {
        $rates = $this->model->searchRates($searchTerm);
        include '../views/rate_list.php';
    }

    public function showSearchedRates($searchTerm) {
        $rates = $this->model->searchRates($searchTerm);
        include '../views/rate_list.php';
    }
}
