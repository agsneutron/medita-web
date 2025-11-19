@php
    /** @var string $token */
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row text-left mt-2">
                <div class="col-sm-12">
                    <h4>
                        Recuperar contraseña
                    </h4>
                </div>
            </div>

            <div class="col text-center padding-top-16">
                Para recuperar tu contraseña has click en el siguiente enlace:
                <br><br>

                <a href="{{ route('password_reset', ['token' => $token]) }}"
                   role="button"
                   class="btn btn-primary" style="
                    color: white !important;
                    background-color: #11b26b !important;
                    border: none !important;
                    border-radius: 40px;
                    padding: 8px 50px;
                    font-weight: bold;
                    box-shadow: 0px 0px 28px -9px rgba(0, 0, 0, 0.75)">
                    Restablecer contraseña
                </a>
            </div>

            <div class="col text-center padding-top-64 padding-bottom-128" style="padding-top: 64px" >
                <i>Si tu no solicitaste restablecer tu contraseña. Por favor, ignora este mensaje.</i>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="footer">
    <div class="col text-center">
        &copy; {{ date('Y') }} | Todos los derechos reservados
    </div>
</div>
</body>
</html>
