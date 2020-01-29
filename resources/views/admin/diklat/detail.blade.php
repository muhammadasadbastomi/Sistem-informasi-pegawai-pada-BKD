@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Detail Diklat - {{$diklat->nama}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pegawai</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tabel Data</h5>
                <div class="text-right">
                 <a href="{{Route('diklatDetailCetak',['id'=>$diklat->id])}}" class="btn btn-info pull-right" style="margin-right:5px;"><i class="fas fa-print"></i> cetak data</a>
                </div>
            </div>
                <br>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Waktu Diklat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($diklatKaryawan as $p)
                            <tr>
                                <td >{{$p->karyawan->nama}}</td>
                                <td >{{$p->karyawan->NIP}}</td>
                                <td >{{$p->diklat->waktu}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Tahun</th>
                            </tr>
                        </tfoot>
                </table>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="mediumModal"  role="dialog" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  method="post" action="" enctype="multipart/form-data">
                    <div class="form-group"><input type="hidden" id="id" name="id"  class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">NIP</label><input type="text" id="NIP" name="NIP" placeholder="" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Nama</label><input type="text" id="nama" name="nama" placeholder="" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Unit Kerja</label>
                        <select name="unit_kerja_id" id="unit_kerja_id" class="form-control">
                            <option value="">-- pilih unit kerja --</option>
                        </select>
                    </div>
                    <div class="form-group"><label  class=" form-control-label">Tempat Lahir</label><input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Tanggal Lahir</label><input type="date" id="tanggal_lahir" name="tanggal_lahir" placeholder="penyelenggara Diklat" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Alamat</label><textarea name="alamat" id="alamat" class="form-control"></textarea></div>
                    <label class="form-control-label" for="jk">Jenis Kelamin</label> 

                        <div class="row" style="margin-left:15px">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-check-input" type="radio" name="jk" id="jk1" value="Laki-laki" >
                                    <label class="form-check-label" for="jk">
                                        Laki - laki
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-check-input" type="radio" name="jk" id="jk2" value="Perempuan" >
                                    <label class="form-check-label" for="jk">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                    <div class="form-group"><label  class=" form-control-label">Agama</label><input type="text" id="agama" name="agama" placeholder="" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Status Kepegawaian</label>
                        <select name="status_pegawai" id="status_pegawai" class="form-control">
                            <option value="">-- pilih Status Kepegawaian --</option>
                            <option value="PNS">PNS</option>
                            <option value="PTT">PTT</option>
                            <option value="Kontrak">Kontrak</option>

                        </select>
                    </div>                    
                    <div class="form-group"><label  class=" form-control-label">Status Perkawinan</label>
                        <select name="status_kawin" id="status_kawin" class="form-control">
                            <option value="">-- pilih Status Perkawinan --</option>
                            <option value="Menikah">Menikah</option>
                            <option value="Belum Menikah">Belum Menikah</option>
                            <option value="janda/Duda"> janda / Duda</ optio n >
                        </select>
                    </div>
                    <div class="form-group"><label  class=" form-control-label">golongan Darah</label><input type="text" id="golongan_darah" name="golongan_darah" placeholder="" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Foto</label><input type="file" id="foto" name="foto" placeholder="" class="form-control"></div>
            <div class="modal-footer">
                <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                <button id="btn-form" type="submit" class="btn btn-primary"><i class="fasr fa-save"></i> </button>
                </form>
            </div>
        </div> 
    </div>
    </div>
    </div>  
 </div> 
@endsection
@section('script')
<script>

         //fungsi render datatable        
         $(document).ready(function() {
            $('#datatable').DataTable( {
                responsive: true,
                processing: true,
                searching : true,
                paging    : true,
            });
            } );
    </script>
@endsection