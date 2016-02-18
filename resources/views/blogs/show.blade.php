@extends('layouts.app')

@section('content')
  @include('blogs.show.header')

  <div class="container">
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            {{ $blog->content }}
          </div>
        </div>
      </div>
    </article>
    <hr>

    @if (!Auth::guest())
      @if ($blog->user_id == Auth::user()->id)
        <div class="well well-sm">
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <a type="button" class="btn btn-info" href="{{ route('blog.edit', $blog->id) }}">Edit Post</a>
            </div>
            {!! Form::open([
              'method' => 'DELETE',
              'route' => ['blog.destroy', $blog->id],
              'class' => 'btn-group'
            ]) !!}
              {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            </div>
          </div>
          <hr>
        @endif

        @include('common.success')
        @include('common.errors')

        <div class="well">
          <h4>Leave a Comment:</h4>
          <form action="{{ url('comment/blog', $blog->id) }}" method="POST" role="form">
            {!! csrf_field() !!}
            <div class="form-group">
              <textarea name="content" id="comment-content" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <hr>

      @else

      @endif

      @foreach ($comments as $comment)

        <div class="media">
          <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
          </a>
          <div class="media-body">
            <h4 class="media-heading">{{ $comment->user->name }}
              <small>{{ $comment->created_at->diffForHumans() }}</small>
            </h4>
            {{ $comment->content }}
          </div>
        </div>

      @endforeach
    </div>
  @endsection
