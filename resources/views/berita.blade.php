@extends('layouts.depan')

@section('content')
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay" style="background-image:url('img/banner1.jpg');">
  <article class="hoc container clear"> 
    <div class="three_quarter first">
      <h6 class="nospace">Berita Kepegawaian</h6>
    </div>
    <!-- ################################################################################################ -->
  </article>
</div>

<!-- ################################################################################################ -->
<div class="wrapper row3">
  <section class="hoc container clear"> 
    <div class="sectiontitle">
      <h3 class="heading">Berita dan Informasi</h3>
      <p>Berita dan Informasi Kepegawaian dari BKD Kabupaten Balangan</p>
    </div>
    <ul class="nospace group" style="margin-bottom:30px">
    @if($berita != null)
        @foreach($berita as $p)
          <li class="one_third" style="margin: 7px 2px;">
            <article class="excerpt"><a href="#"><img class="inspace-10 borderedbox" src="{{asset('/img/berita/'.$p->foto)}}" alt="" style="height:250px !important;"></a>
              <div class="excerpttxt">
                <ul>
                  <li><i class="fa fa-calendar-o"></i>{{$p->created_at}}</li>
                </ul>
                <h6 class="heading font-x1">{{$p->judul}}</h6>
                <p><a class="btn" href="{{Route('beritaDetail',$p->uuid)}}">baca selengkapnya &raquo;</a></p>
              </div>
            </article>
          </li>
      @endforeach
    @endif
    </ul>
    <br>
  </section>
</div>
<!-- ################################################################################################ -->
@endsection
