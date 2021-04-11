<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Style -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">  
    <title>BookPage</title>
    
</head>

<body>
    <!-- @include('errors') -->
    <table class="table">
        <thead>
            <tr>
                <th>Book Ticket HomePage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- <form action="{{ url("/login") }}" method="post">
                    {{ csrf_field() }}
                    使用者:<input type="text" name="username">
                    密碼:<input type="text" name="password">
                    <button type="submit">登入</button>
                </form> -->
                <form action="{{ url("/form")}}" method="POST">
                {{ csrf_field() }}
                    <td>Date:
                        <input type="date" name="date">
                    </td>
                    <td>From:
                        <select name= "from">
                            <option>Where you wanna go?</option>
                            <option value="1000">台北</option>
                            <option value="0990">南港</option>
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
                    </td>
                    <td>To:
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
                    </td>
                    <td>Time:
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
                    </td>
                    <td><input type="submit" value="Go"></td>
                </form>
            </tr>
        </tbody>
    </table>
</body>

</html>