@extends('app')

@section('content')
<section style="text-align:center;" id="homemain">
  <h2>Welcome to ScreenZone</h2>
  <p>Your favorite cinema — book seats, watch trailers, and enjoy the show!</p>
<button onclick="window.location.href='{{ route('movies') }}'">Book your seat now!</button>
</section>
@endsection
