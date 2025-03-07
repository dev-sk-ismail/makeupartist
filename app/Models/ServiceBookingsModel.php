<?php

namespace App\Models;

class ServiceBookingsModel extends BaseModel
{
    protected $table = 'service_bookings'; 
    protected $primaryKey = 'id';        

    protected $allowedFields = [
        'service_id', 'price_id', 'user_id', 'booking_date', 
        'slot_id', 'status', 'remarks', 'service_discount_id'
    ];

    protected $useTimestamps = true;

    public function getAllBooking()
    {
        return $this->findAll();
    }

    public function getUserBookings($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('booking_date', 'DESC')
                    ->findAll();
    }
    public function getServiceBookings($serviceId)
    {
        return $this->where('service_id', $serviceId)
                    ->orderBy('booking_date', 'DESC')
                    ->findAll();
    }


    public function getBookingById($id)
    {
        return $this->find($id);
    }
}