<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'full_name',
        'email',
        'phone',
        'special_requests',
        'check_in',
        'check_out',
        'guests',
        'parking',
        'welcome_set',
        'payment_plan',
        'total_amount',
        'amount_due',
        'payment_method',
        'proof_path',
        'status',
        'terms_accepted_at',
    ];

    protected function casts(): array
    {
        return [
            'check_in' => 'date',
            'check_out' => 'date',
            'parking' => 'boolean',
            'welcome_set' => 'boolean',
            'terms_accepted_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'reference';
    }
}
