@extends('layouts.app')

@section('content')
<form method="post" action="/projects">
    @csrf
    @include('projects.form', ['project' => new App\Project])
</form>
@endsection
