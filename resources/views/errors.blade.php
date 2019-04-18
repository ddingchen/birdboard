@if($errors->{ $bag ?? 'default' }->any())
    <ul class="mt-3 list-reset text-red text-sm">
        @foreach($errors->{ $bag ?? 'default' }->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
