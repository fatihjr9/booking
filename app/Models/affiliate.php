<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class affiliate extends Model
{
    use HasFactory;
    protected $fillable = ['store_name','manager','email','category','fees','whatsapp','bank_name','account_numb','account_holder','url'];
}
