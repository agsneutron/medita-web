<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar Contraseña</title>
    <link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css
" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <style>
        .bg-purple{
            background: #573c72;
            color: white;

        }
        .bg-purple:hover{
            color: white;
        }
    </style>
</head>
<body>
@if($exist)
    <div class="row justify-content-center" >

            <div class="col-10 col-md-6">

                    <div style="text-align: center; height: 500px;">
                        <img src="{!! asset('assets/logo/logo.svg') !!}" alt="Lifefullness"
                             style="padding-top: 10px">
                        <br/>
                        <br/>
                        <h2 style="padding-bottom: 50px; padding-top: 10px; color: #FFFFFF; font-weight: bold">MEDITA MÉXICO A.C</h2>
                        <br/>
                        <input style="border-radius: 5px 5px 5px 5px;"  readonly name="email" value="{{$email}}" id="email">
                        <br>
                        <input style="border-radius: 5px 5px 5px 5px;"  type="password" name="password" id="password">
                        <input type="hidden" name="token" value="<?php echo csrf_token() ?>" id="token">
                        <br/>
                        <br/>
                        <button class="btn bg-purple" id="btnSubmit">Recuperar contraseña</button>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>

                    </div>

            </div>
        <div class="col-12">
            <p  style="padding-bottom: 10px; padding-top: 50px; color: #000000; font-weight: normal">
                MEDITA MÉXICO A.C - Todos los derechos reservados 2023</p>
        </div>


        <br/>


    </div>
@else
    <h1>No se encontro tu cuenta</h1>
@endif
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $("#btnSubmit").click(function (e) {
        e.preventDefault()
        let password = $('#password').val()
        let email = $('#email').val()
        let token = $('#token').val()
        let form = {
            password: password,
            email: email
        }
        if (password === '') {
            alert('Ingresa la contraseña')
        } else {
            $.ajax({
                url: '{{route('new_password')}}',
                data: form,
                method: 'POST',
                headers: {
                    'X-CSRF-Token': token
                },
                success: function (data) {
                    alert(data.message)
                },
                error: function (data) {
                    alert('Ocurrio un error, intentalo más tarde')
                }
            })
        }
    });
</script>
</html>
<script>
    import {Row} from "../../../public/js/admin/app";

    export default {
        components: {Row}
    }
</script>
