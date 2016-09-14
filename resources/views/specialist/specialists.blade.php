@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                {!! Form::open() !!}
                <div id="filter1">
                    <a href="#">По прізвищу</a>
                </div>
                <div id="filter11" class="city_second">
                    <select size="1" name="region" class="filter1" required>
                        <option value="0">--Виберіть Прізвище--</option>
                        @foreach($specialists as $key )
                            <option value="{{ $key->id }}">
                                {{ $key->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div id="filter2">
                    <a href="#">По населеному пункту</a>
                </div>
                <div id="filter22" class="city_second">
                    <select size="1" name="region" class="filter2" required>
                        <option value="0">--Виберіть Населений пункт--</option>
                        @foreach($city as $key )
                            <option value="{{ $key->id }}">
                                {{ $key->city_ua }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div id="filter3">
                    <a href="#">По спеціальності</a>
                </div>
                <div id="filter33" class="city_second">
                    <select size="1" name="region" class="filter3" required>
                        <option value="0">--Виберіть спеціальність--</option>
                        @foreach($speciality as $key )
                            <option value="{{ $key->id }}">
                                {{ $key->specialty_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-sm-9">
                @foreach($specialists as $specialist )
                    <dt class="list-determination_definition">{{ $specialist->first_name }}</dt>
                    <dt class="list-determination_definition">{{ $specialist->last_name }}</dt>
                    <dt class="list-determination_definition">{{ $specialist->phone_number }}</dt>
                    <dt class="list-determination_definition">{{ $specialist->email }}</dt>
                    <dt class="list-determination_definition">{{ $specialist->FullCity }}</dt>
                    <p>
                        <a href="{{ route('specialists.show', $specialist->id) }}" class="btn btn-info">View
                            Task</a>
                        <a href="{{ route('specialists.edit', $specialist->id) }}" class="btn btn-primary">Edit
                            Task</a>
                    </p>
                @endforeach
            </div>
        </div>
    </div>





@endsection