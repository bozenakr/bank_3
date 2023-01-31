<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    const SORT = [
        'asc_balance' => 'Balance 0-9',
        'desc_balance' => 'Balance 9-0',
        'asc_name' => 'Name A-Z',
        'desc_name' => 'Name Z-A',
        'asc_surname' => 'Surname A-Z',
        'desc_surname' => 'Surname Z-A',
    ];

    const FILTER = [
        'balanceZero' => 'Balance = 0',
        'balanceNotZero' => 'Balance > 0'
    ];

    const PER_PAGE = [
        'all', 5, 12, 21, 34
    ];
}