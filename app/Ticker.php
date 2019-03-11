<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    protected $table = 'tickers';
    
    protected $fillable = [
        'symbol',
        'name',
        'market_cap',
        'price_usd',
        'volume_24h',
        'percent_change_24h'
    ];
}
