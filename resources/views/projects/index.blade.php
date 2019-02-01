@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-3">
        <h1 class="mr-auto">Birdboard</h1>
        <a href="/projects/create">New Project</a>
    </div>
    <div class="flex">
        @forelse ($projects as $project)
            <div class="bg-white mr-4 rounded shadow w-1/3 p-5">
                <h3 class="font-normal text-xl mb-5 py-5">{{ $project->title }}</h3>
                <div class="text-grey">{{ str_limit($project->description, 200) }}</div>
            </div>
        @empty
            <p>No projects exists.</p>
        @endforelse
    </div>
@endsection
