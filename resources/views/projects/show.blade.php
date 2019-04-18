@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3">
        <div class="mr-auto text-grey text-sm font-normal">
            <a href="/projects" class="text-grey no-underline">My Projects</a> / {{ $project->title }}
        </div>

        <div class="flex items-center">
            @foreach($project->members as $member)
                <img class="rounded-full w-8 mr-2" src="{{ gravatar_path($member->email) }}" alt="{{ $member->name }}'s avatar">
            @endforeach
            <a href="{{ $project->path() . '/edit' }}" class="button ml-4">Edit Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3">
                <div class="mb-6">
                    <h2 class="text-lg text-grey font-normal mb-3">Tasks</h2>
                    @foreach($project->tasks as $task)
                    <form action="{{ $task->path() }}" method="post">
                        @method('patch')
                        @csrf
                        <div class="card mb-3 flex">
                            <input type="text" name="body" class="mr-auto w-full" value="{{ $task->body }}">
                            <input type="checkbox" name="completed" onclick="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                        </div>
                    </form>
                    @endforeach
                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="post">
                            @csrf
                            <input class="w-full" type="text" name="body" placeholder="Add a task ...">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg text-grey font-normal mb-3">General Notes</h2>
                    <form action="{{ $project->path() }}" method="post">
                        @csrf
                        @method('patch')
                        <textarea
                            name="notes"
                            class="card w-full"
                            style="min-height: 200px;"
                        >{{ $project->notes }}</textarea>
                        <button class="button mt-3">Save</button>
                    </form>
                </div>

                @include('errors')
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')

                @include('projects.activity.card')

                @can('manage', $project)
                    @include('projects.invitation')
                @endcan
            </div>
        </div>
    </main>
@endsection
