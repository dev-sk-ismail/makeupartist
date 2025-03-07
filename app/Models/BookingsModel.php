<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingsModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'service_id',
        'variant_id',
        'client_name',
        'client_phn',
        'client_email',
        'booking_date',
        'booking_hr',
        'remarks',
        'status',
        'payment_status',
        'updated_by'
    ];

    // Validation rules
    protected $validationRules = [
        'service_id' => 'required|numeric',
        'variant_id' => 'required|numeric',
        'client_name' => 'required|min_length[2]|max_length[255]',
        'client_phn' => 'required|min_length[10]|max_length[15]',
        'client_email' => 'required|valid_email',
        'booking_date' => 'required|valid_date[Y-m-d]',
        'booking_hr' => 'required',
        'remarks' => 'permit_empty|max_length[500]',
        'status' => 'permit_empty|in_list[pending,confirmed,cancelled,completed]',
        'payment_status' => 'permit_empty|in_list[unpaid,paid,refunded]'
    ];

    // Get all bookings with service and variant names
    public function getAllBookings()
    {
        return $this->select('bookings.*, services.name as service_name, variants.name as variant_name')
            ->join('services', 'bookings.service_id = services.id')
            ->join('variants', 'bookings.variant_id = variants.id')
            ->orderBy('bookings.booking_date', 'DESC')
            ->orderBy('bookings.booking_hr', 'DESC')
            ->findAll();
    }

    // Get booking details by ID
    public function getBookingDetails($id)
    {
        return $this->select('bookings.*, services.name as service_name, variants.name as variant_name')
            ->join('services', 'bookings.service_id = services.id')
            ->join('variants', 'bookings.variant_id = variants.id')
            ->where('bookings.id', $id)
            ->first();
    }

    // Get bookings for a specific service
    public function getBookingsByService($serviceId)
    {
        return $this->where('service_id', $serviceId)
            ->orderBy('booking_date', 'DESC')
            ->findAll();
    }

    // Get bookings for a specific date
    public function getBookingsByDate($date)
    {
        return $this->select('bookings.*, services.name as service_name, variants.name as variant_name')
            ->join('services', 'bookings.service_id = services.id')
            ->join('variants', 'bookings.variant_id = variants.id')
            ->where('booking_date', $date)
            ->orderBy('booking_hr', 'ASC')
            ->findAll();
    }

    // Get available hours for a specific date
    public function getAvailableHours($date, $serviceId = null)
    {
        // Define your business hours (can be moved to configuration)
        $businessHours = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];

        // Get booked hours for the date
        $bookedHours = $this->select('booking_hr')
            ->where('booking_date', $date)
            ->where('status !=', 'cancelled')
            ->findAll();

        $bookedHoursList = array_column($bookedHours, 'booking_hr');

        // Filter out booked hours
        $availableHours = array_diff($businessHours, $bookedHoursList);

        return $availableHours;
    }
}
