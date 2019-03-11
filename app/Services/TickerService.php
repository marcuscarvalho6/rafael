<?php

namespace App\Services;

use App\Ticker;
use Illuminate\Support\Facades\DB;

class TickerService
{
    private $ticker;

    public function __construct(Ticker $ticker)
    {
        $this->ticker = $ticker;
    }

    public function readTicker()
    {
        $url = "https://api.coinmarketcap.com/v2/ticker/";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        if(isset($response->data)) {
            DB::beginTransaction();
            foreach($response->data as $item) {
                echo "Updating {$item->symbol}\n";
                $this->ticker->updateOrCreate(
                    ['symbol' => $item->symbol],
                    [
                        
                        'symbol' => $item->symbol,
                        'name' => $item->name,
                        'market_cap' => floatval($item->quotes->USD->market_cap),
                        'price_usd' => $item->quotes->USD->price,
                        'volume_24h' => $item->quotes->USD->volume_24h,
                        'percent_change_24h' => $item->quotes->USD->percent_change_24h
                    ]
                );
            }
            DB::commit();
        } else {
            throw new \Exception("Response data not found on the request!", 500);
        }
        return ['error' => false, 'messsage' => 'All tickers successfully updated'];
    }

    public function getTickers($filters)
    {
        $query = $this->ticker->select('*');
        if(isset($filters['symbol']) && $filters['symbol']) {
            $query = $query->where('symbol', $filters['symbol']);
        }
        return $query->get();
    }
}