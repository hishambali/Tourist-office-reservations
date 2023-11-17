<?php
require __DIR__.'/../models/TicketModel.php';


class TicketController {
    private $model;
  

    public function __construct($db) {
      
        $this->model = new TicketModel($db);
    }
   

    public function index() {
        $Ticket = $this->model->getTicket();
        include __DIR__.'/../views/Ticket_list.php';
    }

    public function addTicket() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $company_id = $_POST['comapny_id'];
            $city_id = $_POST['city_id'];
            $date_s = $_POST['date_s'];
            $date_e = $_POST['date_e'];
            $data = [
                'company_id' => $company_id,
                'city_id' => $city_id,
                'date_s' => $date_s,
                'date_e' => $date_e,
            ];

            if ($this->model->addTicket($data)) {
                header('Location:' . BASE_PATH);
                echo 'add succes' ;
            } else {
                echo "Failed to add Ticket.";
            }
        }
    }

    public function showTicket() {
        $Ticket = $this->model->getTicket();
        include '../views/Ticket_list.php';
    }

    public function deleteTicket($id) {
        if ($this->model->deleteTicket($id)) {
            echo "Ticket deleted successfully!";
            header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete Ticket.";
        }
    }

    public function updateTicket($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $company_id = $_POST['company_id'];
            $city_id = $_POST['city_id'];
            $date_s = $_POST['date_s'];
            $date_e = $_POST['date_e'];
            $data = [
                'company_id' => $company_id,
                'city_id' => $city_id,
                'date_s' => $date_s,
                'date_e' => $date_e,
            ];

            if ($this->model->updateTicket($id, $data)) {
                echo "ticket updated successfully!";
                header('Location:' . BASE_PATH);
            } else {
                echo "Failed to update ticket.";
            }
        } else {
            $ticket = $this->model->getticketById($id);
            include __DIR__.'/../views/edit_ticket.php';
        }
    }

    public function editticket($id) {
        $ticket = $this->model->getticketById($id);
        include __DIR__.'/../views/edit_ticket.php';
    }

    public function searchticket($searchTerm) {
        $ticket = $this->model->searchTicket($searchTerm);
        include '../views/ticket_list.php';
    }

    public function showSearchedticket($searchTerm) {
        $ticket = $this->model->searchticket($searchTerm);
        include '../views/ticket_list.php';
    }
}
?>
