<?php
namespace app\controllers;

require __DIR__.'/../models/HotelModel.php';
use app\models\HotelModel;

class HotelController {

    private $model;
  
    public function __construct($db) {
      
        $this->model = new HotelModel($db);
    }

    public function addHotel() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $city_id = $_POST['city_id'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'city_id' => $city_id
            ];

            if ($this->model->addHotel($data)) {
                header('Location:'.BASE_PATH);
                echo 'done' ;
            } else {
                echo "Failed to add hotel.";
            }
        }
    }

    public function showHotels() {
        $hotels = $this->model->getHotels();
        echo $hotels;
    }

    public function deleteHotel($id) {
        if ($this->model->deleteHotel($id)) {
            echo "hotel deleted successfully!";
            header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete hotel.";
        }
    }

    public function updateHotel($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $city_id = $_POST['city_id'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'city_id' => $city_id
            ];
            if ($this->model->updateHotel($id, $data)) {
                echo "hotel updated successfully!";
                header('Location:'.BASE_PATH);
            } else {
                echo "Failed to update hotel.";
            }
        } else {
            $hotel = $this->model->getHotelById($id);
        }
    }

    public function editHotel($id) {
        $hotel = $this->model->getHotelById($id);
    }

    public function searchHotels($searchTerm) {
        $hotels = $this->model->searchHotels($searchTerm);
    }

}
?>