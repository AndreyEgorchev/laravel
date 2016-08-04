@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="content">

    @foreach($specialists as $specialist )

    <dt class="list-determination_definition">{{ $specialist->first_name }}</dt>

    <dt class="list-determination_definition">{{ $specialist->last_name }}</dt>

    <dt class="list-determination_definition">{{ $specialist->phone_number }}</dt>

    <dt class="list-determination_definition">{{ $specialist->email }}</dt>
    <dt class="list-determination_term">linkvk</dt>
    <dt class="list-determination_definition">{{ $specialist->link_vk }}</dt>
    <dt class="list-determination_term">linkinstagram</dt>
    <dt class="list-determination_definition">{{ $specialist->link_instagram }}</dt>
    <dt class="list-determination_term">linkfb</dt>
    <dt class="list-determination_definition">{{ $specialist->link_fb }}</dt>
    <dt class="list-determination_term">Firt city</dt>
    <dt class="list-determination_definition">{{ $specialist->city_first }}</dt>
    <dt class="list-determination_term">Second city</dt>
    <dt class="list-determination_definition">{{ $specialist->city_second }}</dt>
    <dt class="list-determination_term">Third city</dt>
    <dt class="list-determination_definition">{{ $specialist->city_third }}</dt>
    <p>
        <a href="{{ route('specialists.show', $specialist->id) }}" class="btn btn-info">View Task</a>
        <a href="{{ route('specialists.edit', $specialist->id) }}" class="btn btn-primary">Edit Task</a>
    </p>
@endforeach

</div>
</div>
@endsection