<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $primaryKey = 'contact_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'contact_id',
        'phonenumber',
        'email',
        'name',
        'surname'
    ];

    /**
     * Get the appointments list struct associated with the Contact.
     */
    public function Appointments()
    {
        return $this->HasMany(Appointment::class,'contact_id','contact_id');
    }
}
