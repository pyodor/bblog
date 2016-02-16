@extends('layouts.app')

@section('content')

<article>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        {{ $blog->content }}
      </div>
    </div>
  </div>
</article>
