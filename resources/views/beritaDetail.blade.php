@extends('layouts.depan')

@section('content')


<!-- ################################################################################################ -->
<div class="wrapper row3">
  <section class="hoc container clear"> 
    <img src="{{asset('/img/berita/'.$berita->foto)}}" alt="" style="width:970px !important;">
    <br>
    <br>
    <h1 style="font-size:40px">{{$berita->judul}}</h1>
    <hr>
    <br>
    @php
        $isi = $berita->isi;
    @endphp
    <p style="text-align:justify">{!! $isi !!}</p>
  </section>
</div>
<!-- ################################################################################################ -->
@endsection
