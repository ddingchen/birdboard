@extends('layouts.app')

@section('content')
<form method="post" action="/projects">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input class="form-control" type="text" name="description">
    </div>
    <button class="btn btn-primary">确认</button>
    <a class="btn btn-secondary" href="/projects">取消</a>
</form>
@endsection
