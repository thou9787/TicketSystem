<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>BookPage</title>
    <style>
        table,
        td {
            border: 1px solid #333;
        }

        thead,
        tfoot {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="4">The table header</th>
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
                @csrf
                    <td>From:
                        <select name= "From">
                            <option value="0000" name="options">Where you wanna go?</option>
                            <option value="1000" name="taipei">台北</option>
                            <option value="0990" name="nangung">南港</option>
                            <option value="1010" name="banchao">板橋</option>
                            <option value="1020" name="taoyun">桃園</option>
                            <option value="1030" name="hsinchu">新竹</option>
                            <option value="1035" name="meowli">苗栗</option>
                            <option value="1040" name="taichung">台中</option>
                            <option value="1043" name="chunghua">彰化</option>
                            <option value="1047" name="yunlin">雲林</option>
                            <option value="1050" name="chiayi">嘉義</option>
                            <option value="1060" name="tainan">台南</option>
                            <option value="1070" name="zhuyin">左營</option>
                        </select>
                    </td>
                    <td>To:
                        <select name="To">
                            <option value="0000">Where you wanna go?</option>
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
                        <select name="Time">
                            <option value="0000">00:00</option>
                            <option value="0100">01:00</option>
                            <option value="0200">02:00</option>
                            <option value="0300">03:00</option>
                            <option value="0400">04:00</option>
                            <option value="0500">05:00</option>
                            <option value="0600">06:00</option>
                            <option value="0700">07:00</option>
                            <option value="0800">08:00</option>
                            <option value="0900">09:00</option>
                            <option value="1000">10:00</option>
                            <option value="1100">11:00</option>
                            <option value="1200">12:00</option>
                        </select>
                    </td>
                    <td><input type="submit" value="Go"></td>
                </form>
            </tr>
        </tbody>
    </table>
</body>

</html>