<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function transactionDetails()
    {
        return $this->hasMany('App\Models\TransactionDetail', 'id_transaction', 'id');
    }
}
