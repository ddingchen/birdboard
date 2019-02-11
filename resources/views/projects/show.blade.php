@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3">
        <div class="mr-auto text-grey text-sm font-normal">
            <a href="/projects" class="text-grey no-underline">My Projects</a> / {{ $project->title }}
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3">
                <div class="mb-6">
                    <h2 class="text-lg text-grey font-normal mb-3">Tasks</h2>
                    <div class="card mb-3">Lefwe wef</div>
                    <div class="card mb-3">Lefwe wef</div>
                    <div class="card mb-3">Lefwe wef</div>
                </div>

                <div>
                    <h2 class="text-lg text-grey font-normal mb-3">General Notes</h2>
                    <textarea class="card w-full" style="min-height: 200px;">Lefwe wef</textarea>
                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>
@endsection
