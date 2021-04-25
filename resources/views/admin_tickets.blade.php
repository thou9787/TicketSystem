@extends('layouts.nav')

@section('admin_css_script')

    <style>
        .table_box_big {
            overflow-x: scroll;
            overflow-y: hidden;
            position: relative;
            height: 350px;
        }

        .table_box {
            overflow: hidden;
            position: absolute;
        }

        .table_tbody_box {
            height: 300px;
            overflow: scroll;
        }

        table {
            border: 1px solid #eeeeee;
        }

        table thead tr th {
            width: 75px;
            max-width: 75px;
            min-width: 70px;
            height: 50px;
            border-right: 1px solid #eeeeee;
            text-align: center;
            word-break: keep-all;
            padding: 2px 10px;
            background: skyblue;
        }

        table tbody tr td {
            width: 60px;
            height: 50px;
            border-right: 1px solid #eeeeee;
            text-align: center;
            border-bottom: 1px solid #eeeeee;
            word-break: keep-all;
            padding: 2px 10px;
        }

        .panel-title {
            display: inline;
            font-weight: bold;
        }

        .checkbox.pull-right {
            margin: 0;
        }

        .pl-ziro {
            padding-left: 0px;
        }

        .modal-content {
            margin: auto;
            width: 420px;
        }

    </style>

@endsection

@section('admin_tickets')
    @include('errorsMessages')
    @include('successMessages')
    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-sm">
        Add New   <span class="glyphicon glyphicon-chevron-right"></span>
    </button>
    <form action="{{ url('/admin/tickets') }}">
        <input type="text" name="filters">
        <button type="submit" class="btn btn-primary">查詢</button>
    </form>
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="container">
                        <form action="{{ url('/ticket/create') }}">
                            @csrf
                            @method('get')
                            <div class="form-group">
                                <label for="TrainNo">TrainNo</label>
                                <input type="text" class="form-control" id="TrainNo" name="trainNo" placeholder="0000"
                                    list="trainNoList">
                                <datalist id="trainNoList">
                                    @foreach ($trainNoList as $trainNo)
                                        <option value="{{ $trainNo }}"></option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for="originStationName">From</label>
                                <select class="form-control" id="originStationName" name="originStationName">
                                    @foreach ($placeList as $place)
                                        <option value="{{ $place }}">{{ $place }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="destinationStationName">To</label>
                                <select class="form-control" id="destinationStationName" name="destinationStationName">
                                    @foreach ($placeList as $place)
                                        <option value="{{ $place }}">{{ $place }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="departureTime">DepartureTime</label>
                                <input type="datetime" class="form-control" id="departureTime" name="departureTime"
                                    placeholder="5:00:00">
                            </div>
                            <div class="form-group">
                                <label for="arrivalTime">ArrivalTime</label>
                                <input type="datetime" class="form-control" id="arrivalTime" name="arrivalTime"
                                    placeholder="7:00:00">
                            </div>
                            <div class="form-group">
                                <label for="fare">Fare</label>
                                <input type="text" class="form-control" id="fare" name="fare" placeholder="1350">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="1">
                            </div>
                            <div class="form-group">
                                <label for="user_id">User_ID</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    @foreach (App\Models\User::get('id') as $user)
                                        <option value="{{ $user->id }}">{{ $user->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="trainDate">TrainDate</label>
                                <input type="date" class="form-control" id="trainDate" name="trainDate">
                            </div>
                            <div class="form-group">
                                <label for="paid">Paid</label>
                                <select class="form-control" id="paid" name="paid">
                                    <option value="0">Unpaid</option>
                                    <option value="1">Paid</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">新增</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table_box_big">
        <div class="table_box">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">TrainNo</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">DepartureTime</th>
                        <th scope="col">ArrivalTime</th>
                        <th scope="col">Fare</th>
                        <th scope="col">Amount</th>
                        <th scope="col">User_ID</th>
                        <th scope="col">TrainDate</th>
                        <th scope="col">Paid</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Updated_at</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
            <div class="table_tbody_box">
                <table>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <form action="{{ url('/ticket', ['id' => $ticket->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <th><input type="text" name="id" value="{{ $ticket->id }}" size="13"></th>
                                <td><input type="text" name="trainNo" value="{{ $ticket->trainNo }}" size="13"></td>
                                <td><input type="text" name="originStationName" value="{{ $ticket->originStationName }}"
                                        size="13"></td>
                                <td><input type="text" name="destinationStationName"
                                        value="{{ $ticket->destinationStationName }}" size="13"></td>
                                <td><input type="text" name="departureTime" value="{{ $ticket->departureTime }}"
                                        size="13"></td>
                                <td><input type="text" name="arrivalTime" value="{{ $ticket->arrivalTime }}" size="13">
                                </td>
                                <td><input type="text" name="fare" value="{{ $ticket->fare }}" size="13"></td>
                                <td><input type="text" name="amount" value="{{ $ticket->amount }}" size="13"></td>
                                <td><input type="text" name="user_id" value="{{ $ticket->user_id }}" size="13"></td>
                                <td><input type="text" name="trainDate" value="{{ $ticket->trainDate }}" size="13"></td>
                                <td><input type="text" name="paid" value="{{ $ticket->paid }}" size="13"></td>
                                <td><input type="text" name="created_at" value="{{ $ticket->created_at }}"
                                        disabled="disabled" size="13"></td>
                                <td><input type="text" name="created_at" value="{{ $ticket->updated_at }}"
                                        disabled="disabled" size="13"></td>
                                <td><button type="submit" class="btn btn-primary">更新</button></td>
                            </form>
                            <td>
                                <form action="{{ url('/ticket', ['id' => $ticket->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{ $ticket->id }}" size="13">
                                    <input type="hidden" name="trainNo" value="{{ $ticket->trainNo }}" size="13">
                                    <input type="hidden" name="originStationName"
                                        value="{{ $ticket->originStationName }}" size="13">
                                    <input type="hidden" name="destinationStationName"
                                        value="{{ $ticket->destinationStationName }}" size="13">
                                    <input type="hidden" name="departureTime" value="{{ $ticket->departureTime }}"
                                        size="13">
                                    <input type="hidden" name="arrivalTime" value="{{ $ticket->arrivalTime }}" size="13">
                                    <input type="hidden" name="fare" value="{{ $ticket->fare }}" size="13">
                                    <input type="hidden" name="amount" value="{{ $ticket->amount }}" size="13">
                                    <input type="hidden" name="user_id" value="{{ $ticket->user_id }}" size="13">
                                    <input type="hidden" name="trainDate" value="{{ $ticket->trainDate }}" size="13">
                                    <input type="hidden" name="paid" value="{{ $ticket->paid }}" size="13">
                                    <input type="hidden" name="created_at" value="{{ $ticket->created_at }}"
                                        disabled="disabled" size="13">
                                    <input type="hidden" name="created_at" value="{{ $ticket->updated_at }}"
                                        disabled="disabled" size="13">
                                    <button type="submit" class="btn btn-danger">刪除</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection
