<?php

require __DIR__.'/../models/HotelModel.php';

class HotelController {

    private $model;
  
    public function __construct($db) {
      
        $this->model = new HotelModel($db);
    }
    public function index(){

    }

    public function add() {
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

    public function show() {
        $hotels = $this->model->getHotels();
        print_r(json_encode($hotels));
    }

    public function delete($id) {
        if ($this->model->deleteHotel($id)) {
            echo "hotel deleted successfully!";
            header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete hotel.";
        }
    }

    public function update($id) {
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

    public function edit($id) {
        $hotel = $this->model->getHotelById($id);
    }

}
?>