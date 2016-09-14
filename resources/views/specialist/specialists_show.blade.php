@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="content">
                <dt class="list-determination_definition">{{ $specialists->first_name }}</dt>
                <dt class="list-determination_definition">{{ $specialists->last_name }}</dt>

                <dt class="list-determination_definition">{{ $specialists->phone_number }}</dt>
                <dt class="list-determination_term">Спеціальність</dt>
                <dt class="list-determination_definition"> {{$speciality}}</dt>
                <dt class="list-determination_definition">{{ $specialists->email }}</dt>
                <dt class="list-determination_term">linkvk</dt>
                <dt class="list-determination_definition">{{ $specialists->link_vk }}</dt>
                <dt class="list-determination_term">linkinstagram</dt>
                <dt class="list-determination_definition">{{ $specialists->link_instagram }}</dt>
                <dt class="list-determination_term">linkfb</dt>
                <dt class="list-determination_definition">{{ $specialists->link_fb }}</dt>
                @foreach($city as $item)
                <dt class="list-determination_definition">{{ $item->city_ua }}</dt>
                @endforeach
            <dt class="list-determination_term">Опис навичків роботи</dt>
            <dt class="list-determination_definition">{{ $specialists->description }}</dt>
            <div id="page">
                <div id="gallery">
                    <div id="panel">
                        <img id="largeImage" src="{{asset('../images/uploads/'.$images[0]->originalName)}}" height="auto" style="max-width:577px; width: 100%;" />
                        {{--<div id="description">1st image description</div>--}}
                    </div>
                    <div id="thumbs">
                        @foreach ($images as $key)
                        <img src="{{asset('../images/uploads/'.$key->originalName)}}" height="64" alt="1st image description" />
                        @endforeach
                    </div>
                </div>
            </div>
                <p>
                    <a href="{{ route('specialists.edit', $specialists->id) }}" class="btn btn-primary">Edit Task</a>
                </p>

            <div class="col-md-6 text-right">

                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['specialists.destroy', $specialists->id]
                ]) !!}
                {!! Form::submit('Delete ', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>

    </div>

@endsection