@extends('layouts.app')

@section('content')
<div class="container-fluid mb-5">
    <div class="row justify-content-center mt-3">
        @guest
        <div class="col-5">
            <p class="fs-3">
            Зарегистрируйтесь и используйте VPN с тем логином и паролем, который вы использовали при регистрации.
            </p>
        </div>
        <div class="col-2 offset-2">
            <div class="row">
                <div class="col-8">
                    <p class="fs-4 text-center my-pink">
                    Количество мест:
                    </p>
                </div>
                <div class="col-4">
                    <p class="fs-4 text-center my-pink">
                        <b>{{$avail}}</b>
                    </p>
                </div>
            <div class="row">
            </div>
                <div class="col-8">
                    <p class="fs-4 text-center my-pink">
                    Стоимость:
                    </p>
                </div>
                <div class="col-4">
                    <p class="fs-4 text-center my-pink">
                        <b>{{$price}}</b> руб
                    </p>
                </div>
            </div>
        </div>
        @else
        <div class="col-8">
            <p class="fs-3 text-center">
                Теперь можете подключиться с вашего устройства как показано на рисунке ниже
            </p>
        </div>
        @endguest
    </div>

    @guest
    @else
    <div class="row justify-content-center mt-3">
        <div class="col-3">
            <h5><i>1) Настройки</i></h5>
            <h5><i>2) Основные</i></h5>
            <h5><i>3) VPN</i></h5>
            <h5><i>4) Добавить конфигурацию VPN</i></h5>
        </div>
        <div class="col-3">
            <h5><i>1) Параметры (Win + I)</i></h5>
            <h5><i>2) Сеть и Интернет</i></h5>
            <h5><i>3) VPN</i></h5>
            <h5><i>4) Добавить VPN</i></h5>
        </div>
        <div class="col-3">
            <h5><i>1) Скачайте strongSwan из Play Market</i></h5>
            <h5><i>2) Откройте приложение</i></h5>
            <h5><i>3) Добавить VPN профиль</i></h5>
            <h5><i>4) После этого нажмите на созданный профиль в списке</i></h5>
        </div>
    </div>
    @endguest

    <div class="row justify-content-center mt-5">
        <div class="col-3">
            <h5><b>iPhone</b></h5>
            <img src="{{asset('img/iphone-640-900.jpg')}}" class="rounded img-fluid img-thumbnail" alt="...">
        </div>
        <div class="col-3">
            <h5><b>Windows 10 / 11</b></h5>
            <img src="{{asset('img/windows-640-900.jpg')}}" class="rounded img-fluid img-thumbnail" alt="...">
        </div>
        <div class="col-3">
            <h5><b>Android</b></h5>
            <img src="{{asset('img/android-640-900.jpg')}}" class="rounded img-fluid img-thumbnail" alt="...">
        </div>
    </div>
</div>

@endsection
