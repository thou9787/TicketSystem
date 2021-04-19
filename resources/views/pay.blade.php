<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        body {
            margin-top: 20px;
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
</head>

<body>
    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="row">
            <div class="well col-xs-10 col-sm-10 col-md-8 col-xs-offset-1 col-sm-offset-1 col-md-offset-2">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <p>
                        <h4><i>104BookingTicket</i></h4>
                        </p>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <p>
                            <em>Date: {{ Carbon\Carbon::now('Asia/Taipei') }}</em>
                        </p>
                        <p>
                            <em>Receipt #: 34522677W</em> <!-- 車票編號hash -->
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center">
                        <h2>訂票明細</h2>
                    </div>
                    <br />
                    <br />
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>日期</th>
                                <th>車次</th>
                                <th>啟程站</th>
                                <th>到達站</th>
                                <th>出發時間</th>
                                <th>到達時間</th>
                                <th>張數</th>
                                <th>價錢</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                            <tr>
                                <td class="col-md-2"><em>{{ $ticket->trainDate }}</em></h4>
                                </td>
                                <td class="col-md-2">{{ $ticket->trainNo }}</td>
                                <td class="col-md-2">{{ $ticket->originStationName }}</td>
                                <td class="col-md-2">{{ $ticket->destinationStationName }}</td>
                                <td class="col-md-2">{{ $ticket->departureTime }}</td>
                                <td class="col-md-2">{{ $ticket->arrivalTime }}</td>
                                <td class="col-md-2">{{ $ticket->amount }}</td>
                                <td class="col-md-1">{{ $ticket->fare }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td class="text-right">
                                    <h4><strong>Total: </strong></h4>
                                </td>
                                <td class="text-center text-danger">
                                    <h4><strong>{{ $total_price }}</strong></h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">
                        Pay Now   <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-xs-10 col-md-4">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">
                                                            Payment Details
                                                        </h3>
                                                        <div class="checkbox pull-right">
                                                            <label>
                                                                <input type="checkbox" />
                                                                Remember
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <form role="form" action="{{ url('/success')}}">
                                                        @csrf
                                                            <div class="form-group">
                                                                <label for="cardNumber">
                                                                    CARD NUMBER</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="Valid Card Number" min="16" max="16" required autofocus />
                                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-7 col-md-7">
                                                                    <div class="form-group">
                                                                        <label for="expityMonth">
                                                                            EXPIRY DATE</label>
                                                                        <div class="col-xs-6 col-lg-6 pl-ziro">
                                                                            <input type="text" class="form-control" id="expityMonth" placeholder="MM" required />
                                                                        </div>
                                                                        <div class="col-xs-6 col-lg-6 pl-ziro">
                                                                            <input type="text" class="form-control" id="expityYear" placeholder="YY" required />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-5 col-md-5 pull-right">
                                                                    <div class="form-group">
                                                                        <label for="ccvCode">
                                                                            CCV CODE</label>
                                                                        <input type="password" class="form-control" id="cvCode" placeholder="CCV" required />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li class="active">
                                                                    <a href="#">
                                                                        <span class="badge pull-right">
                                                                            <span class="glyphicon glyphicon-usd">

                                                                            </span>
                                                                            {{ $total_price }}
                                                                        </span>
                                                                        Final Payment
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <br/>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-success btn-lg btn-block">Pay</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>