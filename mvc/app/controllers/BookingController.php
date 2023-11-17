<?php
class BookingController {
    private $model;
    public function __construct($model) {
        $this->model = $model;
    }
    public function addBooking() {
        $customer_id = $_POST['customer_id'];
        $ticket_id = $_POST['ticket_id'];
        $hotel_id= $_POST['hotel_id'];
        $date = $_POST['date'];
        $data = Array ( 
                        "customer_id" => $customer_id,
                        "ticket_id" => $ticket_id,
                        "hotel_id" => $hotel_id,
                        'date' => $date
                );
        if ($this->model->addBooking($data)) {
            echo "Booking added successfully!";
            header(" refresh: 2; url =/Tourist-office-reservations/mvc/ ");
        } else {
            echo "Failed to add Booking.";
        }
    }
    
}

?>