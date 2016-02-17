@extends('layouts.app')

@section('content')

    <div class="container">
        @include('common.errors')

        <div class="well">
            <h4>Create a Post:</h4>
            <form action="{{ url('blog') }}" method="POST" class="form-horizontal">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="blog-title" class="col-sm-1 control-label">Title</label>
                    <div class="col-sm-11">
                        <input type="text" name="title" id="blog-title" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="blog-content" class="col-sm-1 control-label">Content</label>
                    <div class="col-sm-11">
                        <textarea rows="8" name="content" id="blog-content" class="form-control textarea"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-1">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> Save Blog
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
