@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="col-md-9">
            <h1>Profile: {{ $user->first_name.' '.$user->last_name }}</h1>
            <h1>email: {{ $user->email }}</h1>
            <h1>created: {{ $user->created_at }}</h1>
            <h1>Останній захід: {{ $user->last_login }}</h1>
        </section>
    </div>
  <a href="{{ url('/profile/edit',Sentinel::getUser()->id) }}"><i class="fa fa-btn fa-sign-out"></i>Profile</a>
@stop


