@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="content">

    @foreach($specialists as $specialist )

    <dt class="list-determination_definition">{{ $specialist->first_name }}</dt>

    <dt class="list-determination_definition">{{ $specialist->last_name }}</dt>

    <dt class="list-determination_definition">{{ $specialist->phone_number }}</dt>

    <dt class="list-determination_definition">{{ $specialist->email }}</dt>
    <p>
        <a href="{{ route('specialists.show', $specialist->id) }}" class="btn btn-info">View Task</a>
        <a href="{{ route('specialists.edit', $specialist->id) }}" class="btn btn-primary">Edit Task</a>
    </p>
@endforeach

</div>
</div>
@endsection