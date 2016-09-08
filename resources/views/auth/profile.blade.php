@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
            <li><a data-toggle="tab" href="#menu1">Edit profile</a></li>
            <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <h3>Profile</h3>
                <img src="{{asset('../images/uploads/avatars/'.$user->avatar)}}" style="width:150px; height: 150px; float: left; border-radius: 50%; margin-right: 25px;">
                Користувач: {{ $user->first_name.' '.$user->last_name }}<br>
                email: {{ $user->email }}<br>
                Створення:<br> {{ $user->created_at }}<br>
                Останній захід: {{ $user->last_login }}
            </div>
            <div id="menu1" class="tab-pane fade">
                @include('auth.edit')

            </div>
            <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
        </div>
    </div>

@stop


