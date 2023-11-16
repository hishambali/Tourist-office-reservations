<?php
require __DIR__.'/../models/CompanyModel.php';


class CompanyController {
    private $model;
  

    public function __construct($db) {
      
        $this->model = new CompanyModel($db);
    }
   

    public function index() {
        $company = $this->model->getCompany();
        include __DIR__.'/../views/Company_list.php';
    }

    public function addCompany() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $data = [
                'name' => $name,
                'phone' => $phone,
            ];

            if ($this->model->addCompany($data)) {
                header('Location:' . BASE_PATH);
                echo 'add succes' ;
            } else {
                echo "Failed to add company.";
            }
        }
    }

    public function showCompany() {
        $company = $this->model->getCompany();
        include '../views/Company_list.php';
    }

    public function deleteCompany($id) {
        if ($this->model->deleteCompany($id)) {
            echo "Company deleted successfully!";
            header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete Company.";
        }
    }

    public function updateCompany($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $data = [
                'name' => $name,
                'phone' => $phone,
            ];

            if ($this->model->updateCompany($id, $data)) {
                echo "company updated successfully!";
                header('Location:' . BASE_PATH);
            } else {
                echo "Failed to update company.";
            }
        } else {
            $company = $this->model->getCompanyById($id);
            include __DIR__.'/../views/edit_company.php';
        }
    }

    public function editCompany($id) {
        $company = $this->model->getCompanyById($id);
        include __DIR__.'/../views/edit_company.php';
    }

    public function searchCompany($searchTerm) {
        $company = $this->model->searchCompany($searchTerm);
        include '../views/company_list.php';
    }

    public function showSearchedCompany($searchTerm) {
        $company = $this->model->searchCompany($searchTerm);
        include '../views/company_list.php';
    }
}
?>
