<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $fillable = [
        'pid', 'name', 'address', 'gender', 'guardian', 'dob', 'age', 'status', 'contact_number'
    ];
}
