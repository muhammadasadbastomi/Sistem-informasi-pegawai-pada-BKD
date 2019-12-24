@extends('layouts.depan')

@section('content')


<!-- ################################################################################################ -->
<div class="wrapper row3">
  <section class="hoc container clear"> 
    <img src="{{asset('/img/berita/'.$berita->foto)}}" alt="" style="height:550px !important;">
    <br>
    <hr>
    <h1>{{$berita->judul}}</h1>
    <hr>
    <br>
    <p style="text-align:justify">{{$berita->isi}}</p>
  </section>
</div>
<!-- ################################################################################################ -->
@endsection
