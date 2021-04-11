<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
    <style>
        .container {
            padding: 0rem 0rem;
        }

        nav {
            margin-bottom: 0px;
        }
    </style>
    <nav class="navbar navbar-light" style="background-color: #fa0">
        <a class="navbar-brand" href="#">
            <img src="~/downloads/ticket.png" alt="BookingT">
        </a>
    </nav>
</head>

<body>
    <div class="container">
        @csrf
        <div class="row">
            <div class="col-12">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
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
                        @foreach (App\Models\TimeTable::all() as $table)
                        <tr >
                            <form action="{{ url('/ticket') }}" method="POST">
                            {{ csrf_field() }}
                                <th scope="row">{{ $table->id }}</th>
                                <td><input type="hidden" name="trainNo" value="{{ $table->trainNo}}">{{ $table->trainNo}}</td>
                                <td><input type="hidden" name="originStationName" value="{{ $table->originStationName }}">{{ $table->originStationName }}</td>
                                <td><input type="hidden" name="destinationStationName" value="{{ $table->destinationStationName }}">{{ $table->destinationStationName  }}</td>
                                <td><input type="hidden" name="departureTime" value="{{ $table->departureTime }}">{{ $table->departureTime }}</td>
                                <td><input type="hidden" name="arrivalTime" value="{{ $table->arrivalTime }}">{{ $table->arrivalTime }}</td>
                                <td><input type="hidden" name="duration" value="{{ $table->duration }}">{{ $table->duration }}</td>
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

    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
        </tbody>
    </table>

</body>

</html>