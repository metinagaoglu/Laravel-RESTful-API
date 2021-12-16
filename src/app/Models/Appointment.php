<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'appointment_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'contact_id',
        'appointment_address',
        'post_code',
        'latitude',
        'longitude',
        'origin_addresses',
        'appointment_date',
        'distance',
        'duration',
        'estimated_time_out_of_office',
        'available_time_at_the_office',
    ];

}
