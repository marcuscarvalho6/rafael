<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TickerService;

class HomeController extends Controller
{
    private $tickerService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TickerService $tickerService)
    {
        $this->middleware('auth');
        $this->tickerService = $tickerService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $tickers = $this->tickerService->getTickers($request);
        return view('home')
            ->with('tickers', $tickers);
    }
}
