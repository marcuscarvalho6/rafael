@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>SYMBOL</th>
                                <th>NAME</th>
                                <th>MARKET CAP</th>
                                <th>PRICE USD</th>
                                <th>VOLUME 24H</th>
                                <th>VARIAÇÃO 24H</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickers as $ticker)
                                <tr>
                                    <td>{{ $ticker->symbol }}</td>
                                    <td>{{ $ticker->name }}</td>
                                    <td>{{ $ticker->market_cap }}</td>
                                    <td>{{ $ticker->price_usd }}</td>
                                    <td>{{ $ticker->volume_24h }}</td>
                                    @if($ticker->percent_change_24h > 0)
                                        <td class="text-success">+{{ $ticker->percent_change_24h }}</td>
                                    @else
                                        <td class="text-danger">{{ $ticker->percent_change_24h }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
