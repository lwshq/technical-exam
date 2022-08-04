<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{url('/')}}">Tech Exam</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

@php
    $segment1 = request()->segment(1);
@endphp

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link {{ ($segment1 == 'notes') ? 'active' : '' }}" href="{{url('notes')}}" >Take Note <span class="sr-only"></span></a>
      <a class="nav-item nav-link {{ ($segment1 == 'todo') ? 'active' : '' }}" href="{{url('todos')}}">To do <span class="sr-only"></span></a>
    </div>
  </div>
</nav>