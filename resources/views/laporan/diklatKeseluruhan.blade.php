<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
        }
          table{
        border-collapse: collapse;
        width:100%;
      }
         table, th, td{
        border: 1px solid #708090;
      }
      th{
        background-color: darkslategray;
        text-align: center;
        color: aliceblue;
      }
      td{
        text-align: center;
      }
      br{
          margin-bottom: 5px !important;
      }
     .judul{
         text-align: center;
     }
     .header{
         margin-bottom: 0px;
         text-align: center;
         height: 150px;
         padding: 0px;
     }
     .pemko{
         width:60px;
     }
     .logo{
         float: left;
         margin-right: 0px;
         width: 15%;
         padding:0px;
         text-align: right;
     }
     .headtext{
         float:right;
         margin-left: 0px;
         width: 75%;
         padding-left:0px;
         padding-right:10%;
     }
     hr{
         margin-top: 10%;
         height: 3px;
         background-color: black;
     }
     .ttd{
         margin-left:70%;
         text-align: center;
         text-transform: uppercase;
     }
    </style>
</head>
<body>
    <div class="header">
            <div class="logo">
                <img  class="pemko" src="img/logo.png" >
            </div>
            <div class="headtext">
                <h3 style="margin:0px;">PEMERINTAH KABUPATEN BALANGAN</h3>
                <h1 style="margin:0px;">BADAN KEPEGAWAIAN DAERAH</h1>
                <p style="margin:0px;">Alamat : Batu Piring, South Paringin, Balangan Regency, South Kalimantan 71662</p>
            </div>
            <hr>
    </div>
    <div class="container">
        <div class="isi">
        <h2 style="text-align:center;text-transform: uppercase;">DATA DIKLAT</h2>
                <table  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode DIKLAT</th>
                                <th>Nama Diklat</th>
                                <th>Tempat</th>
                                <th>Penyelenggara </th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($diklat as $p)
                            <tr>
                                @php
                                $no=1;
                                @endphp
                                <td>{{ $no++ }}</td>
                                <td>{{ $p->Kode_diklat }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->tempat }}</td>
                                <td>{{ $p->penyelenggara }}</td>
                                <td>{{ $p->waktu }}</td>
                            </tr>
                            @endforeach
                        </tfoot>
                      </table>
                      <br>
                      <br>
                      <div class="ttd">
                      <h5> <p>Balangan, {{$tgl}}</p></h5>
                      <h5>Kepala badan kepegawaian Daerah</h5>
                      <br>
                      <br>
                      <h5 style="text-decoration:underline;">Sufriannor, S.sos, M.Ap</h5>
                      <h5>NIP. 19601012 198903 100 9</h5>
                      </div>
                    </div>
                </div>
            </body>
</html>