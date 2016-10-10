@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Profile</a></li>
            {{--<li><a data-toggle="tab" href="#menu1">Edit profile</a></li>--}}
            <li><a data-toggle="tab" href="#menu2">Show your page</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="profileimg">
                            <h3>Profile</h3>
                            <img src="{{asset('..'.$user->avatar)}}">
                            Користувач: {{ $user->first_name.' '.$user->last_name }}<br>
                            email: {{ $user->email }}<br>
                            Створення: {{ $user->created_at }}<br>
                            Останній захід: {{ $user->last_login }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile_edit">
                            <div class="panel panel-default">
                                <div class="panel-heading">Edit</div>
                                @include('auth.edit')
                                <div class="panel-body">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        {{--<div id="menu1" class="tab-pane fade">--}}


        {{--</div>--}}
        <div id="menu2" class="tab-pane fade">
            <h3>Show Specialists</h3>

            @if($specialists)
                @include('specialist.specialist')
                <div class="col-md-1 text-left">
                    <a href="{{ route('specialists.edit', $specialists->id) }}" class="btn btn-primary">Edit
                        Task</a>
                </div>
                <div class="col-md-1 text-right">
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['specialists.destroy', $specialists->id]
                    ]) !!}
                    {!! Form::submit('Delete ', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            @else
                <a href="{{ url('specialists/create') }}" class="btn btn-primary">Create</a>
            @endif
        </div>
    </div>
    </div>

@stop


