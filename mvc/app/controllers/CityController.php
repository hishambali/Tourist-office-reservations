<?php


require __DIR__.'/../models/CityModel.php';



class CityController {
    private $model;
  

    public function __construct($db) {
      
        $this->model = new CityModel($db);
    }
   

    public function index() {
        $cities = $this->model->getCities();
        
        include __DIR__.'/../views/cities_list.php';
    }

    public function addCity() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cityname = $_POST['name'];
            $country = $_POST['country'];
            $data = [
                'cityname' => $cityname,
                'password' => $country,
            ];

            if ($this->model->addCity($data)) {
                header('Location:' . BASE_PATH);
                echo 'done' ;
            } else {
                echo "Failed to add city.";
            }
        }
    }

    public function showCities() {
        $cities = $this->model->getCity();
        include '../views/city_list.php';
    }

    public function deleteCity($id) {
        if ($this->model->deleteCity($id)) {
            echo "City deleted successfully!";
            header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete city.";
        }
    }

    public function updateCity($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cityname = $_POST['cityname'];
            $country = $_POST['country'];
            $data = [
                'cityname' => $cityname,
                'country' => $country,
            ];

            if ($this->model->updateCity($id, $data)) {
                echo "City updated successfully!";
                header('Location:' . BASE_PATH);
            } else {
                echo "Failed to update city.";
            }
        } else {
            $city = $this->model->getCityById($id);
            include __DIR__.'/../views/edit_city.php';
        }
    }

    public function editCity($id) {
        $city = $this->model->getCityById($id);
        include __DIR__.'/../views/edit_city.php';
    }

    public function searchCities($searchTerm) {
        $cities = $this->model->searchCities($searchTerm);
        include '../views/city_list.php';
    }

    public function showSearchedCities($searchTerm) {
        $cities = $this->model->searchUsers($searchTerm);
        include '../views/user_list.php';
    }
}
