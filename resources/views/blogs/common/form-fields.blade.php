{!! csrf_field() !!}

<div class="form-group">
  {!! Form::label('title', 'Title', ['class' => 'col-sm-1 control-label']) !!}
  <div class="col-sm-11">
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('content', 'Content', ['class' => 'col-sm-1 control-label']) !!}
  <div class="col-sm-11">
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
  </div>
</div>
