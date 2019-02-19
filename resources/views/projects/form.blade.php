<div class="form-group">
    <label for="title">Title</label>
    <input class="form-control" type="text" name="title" value="{{ $project->title }}">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <input class="form-control" type="text" name="description" value="{{ $project->description }}">
</div>
<button class="btn btn-primary">确认</button>
<a class="btn btn-secondary" href="/projects">取消</a>

@if ($errors->any())
    <div class="text-sm text-red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
