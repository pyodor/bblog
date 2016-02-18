@extends('layouts.app')

@section('content')

  <div class="container">
    @include('common.errors')

    <div class="well">
      <h4>Edit a Post:</h4>
      {!! Form::model($blog, [
        'method' => 'PATCH',
        'route' => ['blog.update', $blog->id],
        'class' => 'form-horizontal'
      ]) !!}

        @include('blogs.common.form-fields')

        <div class="form-group">
          <div class="col-sm-offset-1 col-sm-1">
            <button type="submit" class="btn btn-default">
              <i class="fa fa-plus"></i> Upate Blog
            </button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>

@endsection
