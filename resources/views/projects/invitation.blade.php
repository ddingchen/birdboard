<div class="card mt-3">
    <h3 class="font-normal text-xl mb-5 py-5 border-l-4 border-blue-light -ml-5 pl-4">
        Invite User
    </h3>
    <footer>
        <form action="{{ $project->path() . '/invitations' }}" method="post">
            @csrf
            <input type="text" class="border border-grey rounded w-full p-2 mb-3" name="email">
            <button class="button text-sm">Invite</button>
        </form>

        @include('errors', ['bag' => 'invitation'])
    </footer>
</div>
