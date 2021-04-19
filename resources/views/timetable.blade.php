@extends('layouts.nav')
@section('css_timeTable')
<style>
    .container {
        padding: 0;
        margin-top: 0;
    }
</style>
@endsection
@section('timeTable')
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
                        <th scope="col">行車時間</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\TimeTable::orderBy('departureTime', 'ASC')->simplePaginate(10) as $table)
                    <tr>
                        <form action="{{ url('/ticket') }}" method="POST">
                            @csrf
                            <th>
                                <input type="hidden" name="trainNo" value="{{ $table->trainNo}}">
                                {{ $table->trainNo}}
                            </th>
                            <td>
                                <input type="hidden" name="originStationName" value="{{ $table->originStationName }}">
                                <input type="hidden" name="originStationId" value="{{ $table->originStationId }}">
                                {{ $table->originStationName }}
                            </td>
                            <td>
                                <input type="hidden" name="destinationStationName" value="{{ $table->destinationStationName }}">
                                <input type="hidden" name="destinationStationId" value="{{ $table->destinationStationId }}">
                                {{ $table->destinationStationName  }}
                            </td>
                            <td>
                                <input type="hidden" name="departureTime" value="{{ $table->departureTime }}">
                                {{ $table->departureTime }}
                            </td>
                            <td>
                                <input type="hidden" name="arrivalTime" value="{{ $table->arrivalTime }}">
                                {{ $table->arrivalTime }}
                            </td>
                            <td>
                                <input type="hidden" name="duration" value="{{ $table->duration }}">
                                {{ $table->duration }}
                            </td>
                            <input type="hidden" name="type" value="{{ $table->type }}">
                            <input type="hidden" name="amount" value="{{ $table->amount }}">
                            <input type="hidden" name="date" value="{{ $table->trainDate }}">
                            <td>
                                <button type="submit" class="btn btn-primary">確認訂票</button>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection