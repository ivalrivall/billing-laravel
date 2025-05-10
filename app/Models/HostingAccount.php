<?php

namespace App\Models;

use App\Traits\HasTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostingAccount extends Model
{
    use HasFactory;
    use HasTeam;

    protected $fillable = [
        'customer_id',
        'subscription_id',
        'control_panel',
        'username',
        'domain',
        'package',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function hasDomain()
    {
        return !empty($this->domain);
    }
}