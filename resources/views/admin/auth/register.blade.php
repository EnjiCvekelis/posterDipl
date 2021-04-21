<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="{{ mix('/css/admin/vendor.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ mix('/css/admin/login.css') }}" type="text/css" rel="stylesheet"/>

    <script src="{{ mix('/js/admin/vendor.js') }}"></script>

    <title>Панель администрирования</title>
</head>
<body>
<div class="container">
    <div class="login-screen">
        <div class="left-item">
            <div class="login-panel">
                <div class="inner-login-panel">
                    <div class="content-panel register-panel">
                        <h3 class="title">Панель администрирования</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <form method="post" action="" role="login">
                            {{ csrf_field() }}
                            <input type="text" name="email" class="form-control input-lg" placeholder="Логин"  required />
                            <input type="password" name="password" class="form-control input-lg" placeholder="Пароль" required />
                            <button type="submit" value="Войти">Зарегистрироваться</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-item">
            <div class="slider-panel">
                <div class="inner-slider-panel">
                    <h1>Poster</h1>
                    <p>Панель администрирования</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>