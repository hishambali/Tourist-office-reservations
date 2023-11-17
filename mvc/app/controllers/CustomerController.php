<?php
    
namespace app\controllers;

require __DIR__.'/../models/CustomerModel.php';
use app\models\CustomerModel;
class CustomerController {
    
    private $model;
  
    public function __construct($db) {
      
        $this->model = new CustomerModel($db);
    }

    public function addCustomer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'gender' => $gender,
                'email' => $email
            ];

            if ($this->model->addCustomer($data)) {
                header('Location:'.BASE_PATH);
                echo 'done' ;
            } else {
                echo "Failed to add customer.";
            }
        }
    }

    public function showCustomers() {
        $customers = $this->model->getCustomers();
        echo $customers;
    }

    public function deleteCustomer($id) {
        if ($this->model->deleteCustomer($id)) {
            echo "customer deleted successfully!";
            header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete customer.";
        }
    }

    public function updateCustomer($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'gender' => $gender,
                'email' => $email
            ];
            if ($this->model->updateCustomer($id, $data)) {
                echo "customer updated successfully!";
                header('Location:'.BASE_PATH);
            } else {
                echo "Failed to update customer.";
            }
        } else {
            $customer = $this->model->getCustomerById($id);
        }
    }

    public function editCustomer($id) {
        $customer = $this->model->getCustomerById($id);
    }

    public function searchCustomers($searchTerm) {
        $customers = $this->model->searchCustomers($searchTerm);
    }
}


?>