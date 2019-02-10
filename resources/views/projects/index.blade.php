@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3">
        <h1 class="mr-auto text-grey text-sm font-normal">My Project</h1>
        <a href="/projects/create" class="button">New Project</a>
    </header>
    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($projects as $project)
        <div class="lg:w-1/3 px-3 pb-3">
            <div class="bg-white rounded shadow p-5">
                <h3 class="font-normal text-xl mb-5 py-5 border-l-4 border-blue-light -ml-5 pl-4">
                    <a href="{{ $project->path() }}" class="text-black no-underline">{{ $project->title }}</a>
                </h3>
                <div class="text-grey">{{ str_limit($project->description, 200) }}</div>
            </div>
        </div>
        @empty
            <p>No projects exists.</p>
        @endforelse
    </main>
@endsection
