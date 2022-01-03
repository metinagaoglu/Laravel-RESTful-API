<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory,HasEvents;

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

    /**
     * Get the user struct associated with the appointment.
     */
    public function User()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    /**
     * Get the contact struct associated with the appointment.
     */
    public function Contact()
    {
        return $this->hasOne(Contact::class,'contact_id','contact_id');
    }

}
