@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="content">



                <dt class="list-determination_definition">{{ $specialists->first_name }}</dt>

                <dt class="list-determination_definition">{{ $specialists->last_name }}</dt>

                <dt class="list-determination_definition">{{ $specialists->phone_number }}</dt>

                <dt class="list-determination_definition">{{ $specialists->email }}</dt>
                <dt class="list-determination_term">linkvk</dt>
                <dt class="list-determination_definition">{{ $specialists->link_vk }}</dt>
                <dt class="list-determination_term">linkinstagram</dt>
                <dt class="list-determination_definition">{{ $specialists->link_instagram }}</dt>
                <dt class="list-determination_term">linkfb</dt>
                <dt class="list-determination_definition">{{ $specialists->link_fb }}</dt>
                <dt class="list-determination_term">Firt city</dt>
                <dt class="list-determination_definition">{{ $specialists->city_first }}</dt>
                <dt class="list-determination_term">Second city</dt>
                <dt class="list-determination_definition">{{ $specialists->city_second }}</dt>
                <dt class="list-determination_term">Third city</dt>
                <dt class="list-determination_definition">{{ $specialists->city_third }}</dt>
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