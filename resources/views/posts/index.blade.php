@extends('layout.app')
@section('title') Index page @endsection
@section('content')

    <div class="text-center mt-4">

        <a href="{{route('posts.create')}}" class="btn btn-success">Create Post</a>
    </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">slug</th>
      <th scope="col">Posted By</th>
      <th scope="col">Created At</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($posts as $post)
      {{--  @dd($post->user->name)  --}}
    {{--  @dd($post->user,$post->changeName)  --}}
      {{--  /$post->changeName)  --}}
      {{--  //,$post->changeName)
      //  --}}
      <tr>
      <th scope="row">{{$post->id}}</th>
      <td>{{$post->title}}</td>
      <td>{{$post->slug}}</td>
      <td>{{$post->user? $post->user->name:'not found'}}</td>
      <td>{{$post['created_at']}}</td>
      <td> <a href="{{route('posts.show',$post['id'])}}" class="btn btn-info">View</a></td>
      <td>  <a href="{{route('posts.edit', $post['id'])}}" class="btn btn-info">Edit</a></td>
      <td>
        <form  action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you dure?');">
            @method('delete')
            {{--  //add hidden input to protect form  --}}
            @csrf
            <input type="submit" class="btn btn-danger delete "  title='Delete'  value="Delete">

        </form>
    </td>
    </tr>

      @endforeach


  </tbody>

</table>
{{--  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>  --}}
  <div class="d-flex justify-content-center">
    {!! $posts->links() !!}
</div>


@endsection
