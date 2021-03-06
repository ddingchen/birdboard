<div class="card">
    <h3 class="font-normal text-xl mb-5 py-5 border-l-4 border-blue-light -ml-5 pl-4">
        <a href="{{ $project->path() }}" class="text-default no-underline">{{ $project->title }}</a>
    </h3>
    <div class="text-default">{{ str_limit($project->description, 200) }}</div>

    @can('manage', $project)
    <footer>
        <form action="{{ $project->path() }}" method="post" class="text-right">
            @csrf
            @method('delete')
            <button class="text-sm">Delete</button>
        </form>
    </footer>
    @endcan
</div>
