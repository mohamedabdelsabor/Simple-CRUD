@extends('layout.app')

@section('title') Edit @endsection

@section('content')
<form method="POST" action="{{route('posts.update', ['post' => $post['id']])}}" class="mt-5">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="titleInput" class="form-label">Title</label>
        <input name="title" type="text" value="{{$post['title']}}" class="form-control" id="titleInput"
            aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="descriptionInput" class="form-label">Description</label>
        <textarea name="description" class="form-control" id="descriptionInput">{{$post['description']}}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Post Creator</label>
        <select name="post_creator" class="form-control">
            @foreach ($users as $user)
            
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
