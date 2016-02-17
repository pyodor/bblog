@if(session('message'))
    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('message') !!}</em></div>
@endif
