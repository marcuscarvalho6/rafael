<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\TickerService;
use App\Http\Controllers\Controller;

class TickerController extends Controller
{
    private $tickerService;

    public function __construct(TickerService $tickerService)
    {
        $this->tickerService = $tickerService;
    }

    public function index(Request $request)
    {
        return $this->tickerService->getTickers($request);
    }
}
