@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3">
        <h1 class="mr-auto text-grey text-sm font-normal">My Project</h1>
        <a href="/projects/create" class="button">New Project</a>
    </header>
    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($projects as $project)
        <div class="lg:w-1/3 px-3 pb-3">
            @include('projects.card')
        </div>
        @empty
            <p>No projects exists.</p>
        @endforelse
    </main>
@endsection
