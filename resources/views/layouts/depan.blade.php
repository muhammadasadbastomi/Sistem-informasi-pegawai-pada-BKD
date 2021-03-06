<!DOCTYPE html>
<html lang="">
<head>
<title>Jeren</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="{{asset('depan\layout\styles\layout.css')}}" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<div class="wrapper row0">
  <div id="topbar" class="hoc clear"> 
    <div class="fl_left">
      <ul class="nospace">
        <li><i class="fa fa-phone"></i> +00 (123) 456 7890</li>
        <li><i class="fa fa-envelope-o"></i> info@domain.com</li>
      </ul>
    </div>
    <div class="fl_right">
      <ul class="nospace">
        <li><a href="#"><i class="fa fa-lg fa-home"></i></a></li>
        <li><a href="{{Route('login')}}">Login</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    <div id="logo" class="fl_left">
    <div class="group btmspace-30 demo">
        <div class="one_third first"><img src="{{asset('img/logo.png')}}" style="width:40px;margin-left:50px;" alt=""></div>
        <div class="one_half"><h3><a href="/">BKD KABUPATEN BALANGAN</a></h3></div>
      </div>
    </div>
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="/">Home</a></li>
        <li><a href="{{Route('beritaDepan')}}">Berita</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Kontak </a></li>
      </ul>
    </nav>
    <!-- ################################################################################################ -->
  </header>
</div>
@yield('content')
<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <div class="one_third first">
      <h6 class="heading">Risus lacus ut lectus</h6>
      <ul class="nospace btmspace-30 linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          Batu Piring, Paringin Sel., Kabupaten Balangan, Kalimantan Selatan 71662
          </address>
        </li>
        <li><i class="fa fa-phone"></i>(0526)2028060</li>
        <li><i class="fa fa-envelope-o"></i> info@domain.com</li>
      </ul>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="heading">Massa consequat tellus</h6>
      <ul class="nospace linklist">
        <li>
          <article>
            <h2 class="nospace font-x1"><a href="#">Non efficitur lacus elit</a></h2>
            <time class="font-xs block btmspace-10" datetime="2045-04-06">Friday, 6<sup>th</sup> April 2045</time>
            <p class="nospace">Metus mauris luctus lacinia posuere aenean nec cursus mi nunc ornare interdum [&hellip;]</p>
          </article>
        </li>
        <li>
          <article>
            <h2 class="nospace font-x1"><a href="#">Ut ipsum vestibulum et fringilla</a></h2>
            <time class="font-xs block btmspace-10" datetime="2045-04-05">Thursday, 5<sup>th</sup> April 2045</time>
            <p class="nospace">Nunc vitae porttitor ipsum in hac habitasse platea dictumst in quis arcu ac [&hellip;]</p>
          </article>
        </li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="heading">Praesent porttitor pulvinar</h6>
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15945.686967981523!2d115.4712341!3d-2.3643551!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x949ff1d2d7afc80a!2sBadan%20Kepegawaian%20Pendidikan%20dan%20Pelatihan%20Daerah%20(BKPPD)%20Kabupaten%20Balangan!5e0!3m2!1sid!2sid!4v1576724564176!5m2!1sid!2sid" width="400" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>
  </footer>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
  </div>
</div>
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="{{asset('depan/layout/scripts/jquery.min.js')}}"></script>
<script src="{{asset('depan/layout/scripts/jquery.backtotop.js')}}"></script>
<script src="{{asset('depan/layout/scripts/jquery.mobilemenu.js')}}"></script>
<script src="{{asset('depan/layout/scripts/jquery.flexslider-min.js')}}"></script>
</body>
</html>