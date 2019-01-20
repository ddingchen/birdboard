<html>
    <body>
        @forelse ($projects as $project)
            <p><a href="{{ $project->path() }}">{{ $project->title }}</a></p>
        @empty
            <p>No projects exists.</p>
        @endforelse
    </body>
</html>
