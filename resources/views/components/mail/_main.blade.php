<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <link rel="icon" href="{{asset('assets/icon/lifefullness-logo.svg')}}"/>
    <title>Medita México A.C</title>
    <style>
        .content .btn{
            background-color: #62457F;
            padding: 1vw 0.7vw;
            border-radius: 0.5vw;
            color: white;
            text-decoration: none;
            box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
            font-size: 1.5vw;
        }
    </style>
</head>
<body style="background-color: #62457F; margin: 0; font-family: Arial, Helvetica, sans-serif;">

@include('components.mail._header')

<div style="background-color: #dbdad9; padding: 2vw;">
    <div style="
        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        padding: 10px;
        background-color: white;
        border-radius: 5px;
    ">
        <table style="width: 100%; height: 44%;background-color:#ffffff; padding-bottom: 2vw;">
            <tr>
                <td colspan="2" style=" color:#000000; font-size: 1vw; padding: 10px;" class="content">
                    @yield('content')
                </td>
            </tr>
        </table>
    </div>
</div>

@include('components.mail._footer')

</body>
</html>
