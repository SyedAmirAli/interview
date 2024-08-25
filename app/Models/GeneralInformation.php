<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'image',
        'passport',
        'bank_name',
        'account_no',
        'ibn',
        'account_type',
        'nid',
        'country_name',
        'country_code',
    ];
}
