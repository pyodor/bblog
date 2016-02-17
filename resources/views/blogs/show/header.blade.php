<header class="intro-header" style="background-image: url({{ URL::asset('img/post-bg.jpg') }})">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <div class="post-heading">
          <h1>{{ $blog->title }}</h1>
          <span class="meta">Posted by <a href="#">{{ $blog->user->name }}</a> on {{ $blog->created_at->format('F d, Y') }}</span>
        </div>
      </div>
    </div>
  </div>
</header>
