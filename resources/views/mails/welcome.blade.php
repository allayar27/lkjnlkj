@component('mail::message')

        <h2>Привет {{$data['name']}}, мы рады, что ты с нами! Ниже приведены данные вашего аккаунта:</h2>
        <br>
        <h3>Email: </h3>
        <p>{{$data['email']}}</p>
        <h3>Имя: </h3>
        <p>{{$data['name']}}</p>
        <h3>Пароль: </h3><p>{{$data['password']}}</p>

@component('mail::button', ['url' => 'http://127.0.0.1:8000/login'])
    Перейти на сайт
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
