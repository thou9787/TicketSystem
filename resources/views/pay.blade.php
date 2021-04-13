<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <!-- JavaScript -->

    <title>Document</title>
</head>

<body>
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard_theme_arrows.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.smartWizard.min.js"></script>
    <div class="container">
        <div class="row d-flex justify-content-center mt-200"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Launch multistep Wizard </button> </div> <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Smart Wizard modal</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <div id="smartwizard">
                            <ul>
                                <li> </li>
                                <li><a href="#step-1">Step 1<br />請輸入你要去的地方&nbsp&nbsp&nbsp</a></li>
                                <li><a href="#step-2">Step 2<br />請選擇你想要的時間&nbsp&nbsp&nbsp</a></li>
                                <li><a href="#step-3">Step 3<br />請輸入您的信用卡資料&nbsp&nbsp</a></li>
                                <li><a href="#step-4">Step 4<br />已完成訂票&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a></li>
                            </ul>
                            <div class="mt-4">
                                <div id="step-1">
                                    <form action="{{ url("/form")}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6"> Date:
                                                <input type="date" name="date" value="{{Carbon\Carbon::now()->toDateString()}}">
                                            </div>
                                            <div class="col-md-6">From:
                                                <select name="from">
                                                    <option>Where you wanna go?</option>
                                                    <option value="0990">南港</option>
                                                    <option value="1000">台北</option>
                                                    <option value="1010">板橋</option>
                                                    <option value="1020">桃園</option>
                                                    <option value="1030">新竹</option>
                                                    <option value="1035">苗栗</option>
                                                    <option value="1040">台中</option>
                                                    <option value="1043">彰化</option>
                                                    <option value="1047">雲林</option>
                                                    <option value="1050">嘉義</option>
                                                    <option value="1060">台南</option>
                                                    <option value="1070">左營</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6"> To:
                                                <select name="to">
                                                    <option>Where you wanna go?</option>
                                                    <option value="0990">南港</option>
                                                    <option value="1000">台北</option>
                                                    <option value="1010">板橋</option>
                                                    <option value="1020">桃園</option>
                                                    <option value="1030">新竹</option>
                                                    <option value="1035">苗栗</option>
                                                    <option value="1040">台中</option>
                                                    <option value="1043">彰化</option>
                                                    <option value="1047">雲林</option>
                                                    <option value="1050">嘉義</option>
                                                    <option value="1060">台南</option>
                                                    <option value="1070">左營</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6"> Time:
                                                <select name="time">
                                                    <option value="00:00:00">00:00</option>
                                                    <option value="01:00:00">01:00</option>
                                                    <option value="02:00:00">02:00</option>
                                                    <option value="03:00:00">03:00</option>
                                                    <option value="04:00:00">04:00</option>
                                                    <option value="05:00:00">05:00</option>
                                                    <option value="06:00:00">06:00</option>
                                                    <option value="07:00:00">07:00</option>
                                                    <option value="08:00:00">08:00</option>
                                                    <option value="09:00:00">09:00</option>
                                                    <option value="10:00:00">10:00</option>
                                                    <option value="11:00:00">11:00</option>
                                                    <option value="12:00:00">12:00</option>
                                                    <option value="13:00:00">13:00</option>
                                                    <option value="14:00:00">14:00</option>
                                                    <option value="15:00:00">15:00</option>
                                                    <option value="16:00:00">16:00</option>
                                                    <option value="17:00:00">17:00</option>
                                                    <option value="18:00:00">18:00</option>
                                                    <option value="19:00:00">19:00</option>
                                                    <option value="20:00:00">20:00</option>
                                                    <option value="21:00:00">21:00</option>
                                                    <option value="22:00:00">22:00</option>
                                                    <option value="23:00:00">23:00</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6"> Amount:
                                                <select name="amount">
                                                    <option value=1>1</option>
                                                    <option value=2>2</option>
                                                    <option value=3>3</option>
                                                    <option value=4>4</option>
                                                    <option value=5>5</option>
                                                    <option value=6>6</option>
                                                    <option value=7>7</option>
                                                    <option value=8>8</option>
                                                    <option value=9>9</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6"> Type:
                                                <select name="type">
                                                    <option value="business">商務艙</option>
                                                    <option value="economic">經濟艙</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="step-2">
                                    <div class="row">
                                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="Address" required> </div>
                                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="City" required> </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="State" required> </div>
                                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="Country" required> </div>
                                    </div>
                                </div>
                                <div id="step-3" class="">
                                    <div class="row">
                                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="Card Number" required> </div>
                                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="Card Holder Name" required> </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="CVV" required> </div>
                                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="Mobile Number" required> </div>
                                    </div>
                                </div>
                                <div id="step-4" class="">
                                    <div class="row">
                                        <div class="col-md-12"> <span>Thanks For submitting your details with BBBootstrap.com. we will send you a confirmation email. We will review your details and revert back.</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'arrows',
                autoAdjustHeight: true,
                transitionEffect: 'fade',
                showStepURLhash: false,

            });
        });
    </script>
    </div>
</body>

</html>