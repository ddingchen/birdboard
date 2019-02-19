@extends('layouts.app')

@section('content')
<form method="post" action="{{ $project->path() }}">
    @method('patch')
    @csrf
    @include('projects.form')
</form>

@endsection
