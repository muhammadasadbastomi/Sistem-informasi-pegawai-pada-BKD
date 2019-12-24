@extends('layouts.depan')

@section('content')
<!-- ################################################################################################ -->
<div class="bgded overlay" style="background-image:url('depan/images/demo/backgrounds/01.png');">
  <div id="pageintro" class="hoc clear"> 
    <div class="flexslider basicslider">
      <ul class="slides">
        <li>
          <article>
            <p>Lacinia</p>
            <h3 class="heading">Eleifend tristique lacus</h3>
            <p>Eleifend sagittis cras convallis nisl eget</p>
            <footer><a class="btn" href="#">Nullam porttitor</a></footer>
          </article>
        </li>
        <li>
          <article>
            <p>Pulvinar</p>
            <h3 class="heading">Ornare tortor quisque</h3>
            <p>Odio semper sed euismod mi euismod curabitur</p>
            <footer><a class="btn inverse" href="#">Eget venenatis</a></footer>
          </article>
        </li>
        <li>
          <article>
            <p>Sagittis</p>
            <h3 class="heading">Feugiat blandit erat</h3>
            <p>Convallis nibh nulla nec dictum mi consequat vel</p>
            <footer><a class="btn" href="#">Facilisis vestibulum</a></footer>
          </article>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <h3 class="heading">Badan Kepegawaian, Pendidikan dan Pelatihan Daerah</h3>
    </div>
    <p class="btmspace-50 justified">Badan Kepegawaian, Pendidikan dan Pelatihan Daerah mempunyai tugas
    membantu Bupati dalam melaksanakan manajemen kepegawaian,
    pendidikan dan pelatihan serta pengelolaan kesekretariatan Korps
    Pegawai Republik Indonesia (KORPRI) Kabupaten.</p>
    <div class="clear"></div>
  </main>
</div>
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay" style="background-image:url('img/banner1.jpg');">
  <article class="hoc container clear"> 
    <div class="three_quarter first">
      <h6 class="nospace">Berita Kepegawaian</h6>
      <p class="nospace">Mencari berita dan Informasi dan Kepegawaian ? Click pada tombol berikut </p>
    </div>
    <footer class="one_quarter"><a class="btn" href="{{Route('beritaDepan')}}">lihat Berita &raquo;</a></footer>
    <!-- ################################################################################################ -->
  </article>
</div>
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay light" style="background-image:url('depan/images/demo/backgrounds/03.png');">
  <section class="hoc container clear"> 
    <div class="sectiontitle">
      <h3 class="heading">Tugas Pokok</h3>
    </div>
    <ul class="nospace group services">
      <li class="one_third first">
        <article><a href="#"><i class="icon fa fa-user"></i></a>
          <p>penyusunan kebijakan teknis manajemen kepegawaian, pendidikan dan pelatihan;&hellip;</p>
        </article>
      </li>
      <li class="one_third">
        <article><a href="#"><i class="icon fa fa-bank"></i></a>
          <p>pelaksanaan tugas manajemen kepegawaian, pendidikan dan pelatihan&hellip;</p>
        </article>
      </li>
      <li class="one_third">
        <article><a href="#"><i class="icon fa fa-cny"></i></a>
          <p>pemantauan, evaluasi, dan pelaporan manajemen kepegawaian, pendidikan dan pelatihan</p>
        </article>
      </li>
      <li class="one_third first">
        <article><a href="#"><i class="icon fa fa-coffee"></i></a>
          <p>pembinaan teknis penyelenggaraan manajemen kepegawaian, pendidikan dan pelatihan&hellip;</p>
        </article>
      </li>
      <li class="one_third">
        <article><a href="#"><i class="icon fa fa-flask"></i></a>
          <p>pengelolaan kesekretariatan KORPRI Kabupaten;f. pelaksanaan administrasi badan&hellip;</p>
        </article>
      </li>
      <li class="one_third">
        <article><a href="#"><i class="icon fa fa-legal"></i></a>
          <p>pelaksanaan fungsi lain yang diberikan Bupati sesuai dengan tugas dan fungsinya.&hellip;</p>
        </article>
      </li>
    </ul>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </section>
</div>

<!-- ################################################################################################ -->
<div class="wrapper bgded overlay" style="background-image:url('img/banner2.jpg');">
  <article class="hoc container"> 
    <div class="sectiontitle">
      <h3 class="heading">Odio facilisis sagittis</h3>
      <p>Ante vehicula suscipit suscipit mauris varius proin sed libero ut.</p>
    </div>
    <ul class="nospace group">
      <li class="one_half first borderedbox inspace-15">
        <blockquote>Vivamus nec laoreet felis sed at enim est aenean ac diam ante nulla sit amet felis purus nulla molestie maximus volutpat etiam ullamcorper malesuada tristique quisque ac neque accumsan dictum mauris</blockquote>
        <p class="right bold">John Doe / CEO</p>
      </li>
      <li class="one_half borderedbox inspace-15">
        <blockquote>In condimentum risus in faucibus metus nec mi porta congue interdum mauris commodo nulla sit amet convallis nunc a neque a metus ullamcorper bibendum nec sed nunc a metus facilisis volutpat faucibus</blockquote>
        <p class="right bold">John Doe / CEO</p>
      </li>
    </ul>
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
    <ul class="nospace group">
    @if($berita != null)
        @foreach($berita as $p)
          <li class="one_third" style="margin: 5px 2px;">
            <article class="excerpt"><a href="#"><img class="inspace-10 borderedbox" src="{{asset('/img/berita/'.$p->foto)}}" alt="" style="height:250px !important;"></a>
              <div class="excerpttxt">
                <ul>
                  <li><i class="fa fa-calendar-o"></i>{{$p->created_at}}</li>
                </ul>
                <h6 class="heading font-x1">{{$p->judul}}</h6>
                <p><a class="btn" href="#">baca selengkapnya &raquo;</a></p>
              </div>
            </article>
          </li>
      @endforeach
    @endif
    </ul>
    <br>
    <p class="center"><a href="{{Route('beritaDepan')}}">berita Lain &raquo;</a></p>
  </section>
</div>
<!-- ################################################################################################ -->
@endsection
