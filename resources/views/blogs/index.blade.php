@extends('layouts.app')

@section('content')
  <div class="container">
    @include('common.success')
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        @foreach ($blogs as $blog)

          <div class="post-preview">
            <a href="{!! route('blog.show', ['blog' => $blog->id]) !!}">
              <h2 class="post-title">
                {{ $blog->title }}
              </h2>
              <h3 class="post-subtitle">
                {{ str_limit($blog->content, $limit = 60, $end = '...') }}
              </h3>
            </a>
            <p class="post-meta">Posted by <a href="#">{{ $blog->user->name }}</a> {{ $blog->created_at->diffForHumans() }}</p>
          </div>
          <hr>

        @endforeach
      </div>
    </div>
  </div>

@endsection
