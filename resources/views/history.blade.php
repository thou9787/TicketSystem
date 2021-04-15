@extends('layouts.nav')
@section('css_history')
<style>
    .container {
        padding:0;
        margin-top: 0;
    }
</style>
@endsection
@section('history')
<div class="container">
    @csrf
    <div class="row">
        <div class="col-12">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">車次</th>
                        <th scope="col">啟程站</th>
                        <th scope="col">終點站</th>
                        <th scope="col">出發時間</th>
                        <th scope="col">到達時間</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $history)
                    <tr>
                        <form action="{{ url('/ticket', ['id' => $history->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <th>{{ $history->trainNo}}</th>
                            <td>{{ $history->originStationName }}</td>
                            <td>{{ $history->destinationStationName  }}</td>
                            <td>{{ $history->departureTime }}</td>
                            <td>{{ $history->arrivalTime }}</td>
                            <td><button type="submit" class="btn btn-primary">取消訂票</button></td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection