<?php
    
require __DIR__.'/../models/CustomerModel.php';
class CustomerController {
    
    private $model;
  
    public function __construct($db) {
      
        $this->model = new CustomerModel($db);
    }
    
    function index ()
    {
        
    }

    public function add() {
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
            var_dump($_POST);
            if ($this->model->addCustomer($data)) {
                header('Location:'.BASE_PATH);
                echo 'done' ;
            } else {
                echo "Failed to add customer.";
            }
        }
    }

    public function show() {
        $customers = $this->model->getCustomers();
        print_r(json_encode($customers));
    }

    public function delete($id) {
        if ($this->model->deleteCustomer($id)) {
            echo "customer deleted successfully!";
            header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete customer.";
        }
    }

    public function update($id) {
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

    public function edit($id) {
        $customer = $this->model->getCustomerById($id);
    }
}


?>