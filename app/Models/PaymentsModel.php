<?php

namespace App\Models;

class PaymentsModel extends BaseModel
{
    protected $table = 'payments'; 
    protected $primaryKey = 'id'; 

    protected $allowedFields = [
        'booking_id',
        'gross_amount',
        'discounted_amount',
        'waiver_amount',
        'amount_paid',
        'payment_date',
        'remarks',
        'payment_mode',
        'status'
    ];

    protected $useTimestamps = true;


    public function getAllPayments()
    {
        return $this->findAll();
    }

    public function getPaymentsForBooking($bookingId)
    {
        return $this->where('booking_id', $bookingId)->findAll();
    }


    public function getPaymentsById($id)
    {
        return $this->find($id);
    }
}
