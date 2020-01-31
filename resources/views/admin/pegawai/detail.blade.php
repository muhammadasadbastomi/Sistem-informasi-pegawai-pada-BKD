@extends('layouts.admin')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Detail Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Detail Pegawai</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    
     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid "
                       src="{{asset('/img/karyawan/'.$karyawan->foto)}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$karyawan->nama}}</h3>

                <p class="text-muted text-center">{{$karyawan->NIP}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Status</b> <a class="float-right">{{$karyawan->status_pegawai}}</a>
                  </li>
                </ul>

                <a href="{{Route('pegawaiDetailCetak',$karyawan->uuid)}}" class="btn btn-warning btn-block"><i class="fas fa-print"></i> cetak profil</a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Kepegawaian</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i>Instansi</strong>

                <p class="text-muted">
                {{$karyawan->unit_kerja->nama}} -{{$karyawan->unit_kerja->instansi->nama}}
                </p>
                <hr>
                <hr>

                 </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#biodata" data-toggle="tab">Biodata</a></li>
                  <li class="nav-item"><a class="nav-link" href="#pendidikan" data-toggle="tab">Pendidikan formal</a></li>
                  <li class="nav-item"><a class="nav-link" href="#diklat" data-toggle="tab">DIklat yang diikuti</a></li>
                  <li class="nav-item"><a class="nav-link" href="#golongan" data-toggle="tab">Riwayat Golongan</a></li>
                  <li class="nav-item"><a class="nav-link" href="#jabatan" data-toggle="tab">Riwayat Jabatan</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="biodata">
                    <label for="">Biodata</label>
                    <div class="row">
                      <div class="col-xl-6">
                        <table class="table">
                          <tbody>
                            <tr>
                              <th>Nama</th>
                              <td>: {{$karyawan->nama}}</td>
                            </tr>
                            <tr>
                              <th>NIP</th>
                              <td>: {{$karyawan->NIP}}</td>
                            </tr>
                            <tr>
                              <th>Tempat - tanggal Lahir</th>
                              <td>: {{$karyawan->tempat_lahir}} - {{$karyawan->tanggal_lahir}} </td>
                            </tr>                            
                            <tr>
                              <th>Alamat</th>
                              <td>: {{$karyawan->alamat}}</td>
                            </tr>
                            </tr>                            
                            <tr>
                              <th>Jenis kelamin</th>
                              <td>: {{$karyawan->jk}}</td>
                            </tr>
                            <tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-xl-6">
                      <table class="table">
                          <tbody>
                          <th>Agama</th>
                              <td>: {{$karyawan->agama}}</td>
                            </tr>                            <tr>
                              <th>golongan Darah</th>
                              <td>: {{$karyawan->golongan_darah}}</td>
                            </tr>
                            <tr>
                              <th>Status Kepegawaian</th>
                              <td>: {{$karyawan->status_pegawai}}</td>
                            </tr>
                            <tr>
                              <th>unit / Dinas</th>
                              <td>: {{$karyawan->unit_kerja->nama}} / {{$karyawan->unit_kerja->instansi->nama}}</td>
                            </tr>                             
                            <tr>
                              <th>Status Pernikahan</th>
                              <td>: {{$karyawan->status_kawin}}</td>
                            </tr>
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="SKP">
                      <label for="">SKP</label>
                  </div>
                  <div class="tab-pane" id="golongan">
                      <label for="">Golongan</label>
                      <div class="text-right">
                        <a class="btn btn-sm btn-primary" href="{{Route('riwayatGolongan',['uuid'=> $karyawan->uuid])}}"> <i class="fa fa-print"></i> cetak riwayat golongan</a>
                        <button class="btn btn-sm btn-primary" id="tambahGolongan"> + Tambah Golongan</button>
                    </div>
                    <br>
                    <table id="tableGolongan" class="table table-bordered table-striped text-center" width="100%">
                        <thead>
                        <tr>
                            <th>gologan</th>
                            <th>Tahun Kenaikan Pangkat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>gologan</th>
                            <th>Tahun Kenaikan Pangkat</th>
                            <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                </table>
                  </div>                  
                  <div class="tab-pane" id="jabatan">
                      <label for="">Jabatan</label>
                      <div class="text-right">
                      <a class="btn btn-sm btn-primary" href="{{Route('riwayatJabatan',['uuid'=> $karyawan->uuid])}}"> <i class="fa fa-print"></i> cetak riwayat Jabatan</a>
                        <button class="btn btn-sm btn-primary" id="tambahJabatan"> + Tambah Jabatan</button>
                    </div>
                    <br>
                    <table id="tableJabatan" class="table table-bordered table-striped text-center" width="100%">
                        <thead>
                        <tr>
                            <th>jabatan</th>
                            <th>tahun Pra Jabatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>jabatan</th>
                            <th>tahun Pra Jabatan</th>
                            <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                </table>
                  </div>
                  <div class="tab-pane" id="pendidikan">
                    <label for=""> pendidikan Formal</label>
                    <div class="text-right">
                        <button class="btn btn-sm btn-primary" id="tambahPendidikan"> + Tambah Pendidikan</button>
                    </div>
                    <br>
                    <table id="tablePendidikan" class="table table-bordered table-striped text-center" width="100%">
                        <thead>
                        <tr>
                            <th>Pendidikan</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Pendidikan</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                </table>
                  </div>
                  <div class="tab-pane" id="diklat">
                    <label for=""> Diklat yang diikuti</label>
                    <div class="text-right">
                        <button class="btn btn-sm btn-primary" id="tambahDiklat"> + Tambah diklat</button>
                    </div>
                    <br>
                    <table id="tableDiklat" class="table table-bordered table-striped text-center" width="100%">
                        <thead>
                        <tr>
                            <th>Diklat</th>
                            <th>Waktu</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                              <th>Diklat</th>
                              <th>Waktu</th>
                              <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                </table>
                <p id="getUrl"></p>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
              <div class="card-footer">
                <div class="text-right">
                <a href="" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> kembali</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
    <div class="modal fade" id="pendidikanModal"  role="dialog" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPendidikan">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form2" method="post" action="" enctype="multipart/form-data">
                    <div class="form-group"><input type="hidden" id="id1" name="id"  class="form-control" value="{{$karyawan->uuid}}"></div>
                    <div class="form-group"><label  class=" form-control-label">Pendididan Formal</label>
                        <select name="pendidikan_id" id="pendidikan_id" class="form-control">
                            <option value="">-- pilih Pendidikan --</option>
                        </select>
                    </div>
                    <div class="form-group"><label  class=" form-control-label">Keterangan</label><input type="text" id="keterangan" name="keterangan" placeholder="" class="form-control"></div>
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
 <!-- modal diklat  -->
 <div class="modal fade" id="diklatModal"  role="dialog" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPendidikan">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="form1" method="post" action="" enctype="multipart/form-data">
                <div class="form-group"><input type="hidden" id="id2" name="id"  class="form-control" value="{{$karyawan->uuid}}"></div>
                    <div class="form-group"><label  class=" form-control-label">Program Diklat</label>
                        <select name="diklat_id" id="diklat_id" class="form-control">
                            <option value="">-- pilih Diklat --</option>
                        </select>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                <button id="btn-form-diklat" type="submit" class="btn btn-primary"><i class="fasr fa-save"></i> </button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>  
 </div>
 
 <!-- modal golongan  -->
 <div class="modal fade" id="golonganModal"  role="dialog" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPendidikan">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="form3" method="post" action="" enctype="multipart/form-data">
                <div class="form-group"><input type="hidden" id="id3" name="id"  class="form-control" value="{{$karyawan->uuid}}"></div>
                    <div class="form-group"><label  class=" form-control-label">Program Diklat</label>
                        <select name="golongan_id" id="golongan_id" class="form-control">
                            <option value="">-- pilih Golongan --</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label  class=" form-control-label">Tahun</label>
                    <input type="text" id="tahun1" name="tahun" class="form-control"/>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                <button id="btn-form-golongan" type="submit" class="btn btn-primary"><i class="fasr fa-save"></i> </button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>  
 </div>
 
 <!-- modal golongan  -->
 <div class="modal fade" id="jabatanModal"  role="dialog" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPendidikan">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="form4" method="post" action="" enctype="multipart/form-data">
                <div class="form-group"><input type="hidden" id="id4" name="id"  class="form-control" value="{{$karyawan->uuid}}"></div>
                    <div class="form-group"><label  class=" form-control-label">Jabatan</label>
                        <select name="jabatan_id" id="jabatan_id" class="form-control">
                            <option value="">-- pilih Jabatan --</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label  class=" form-control-label">Tahun</label>
                    <input type="text" id="tahun2" name="tahun" class="form-control"/>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn " data-dismiss="modal"> <i class="ti-close"></i> Batal</button>
                <button id="btn-form-jabatan" type="submit" class="btn btn-primary"><i class="fasr fa-save"></i> </button>
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
    $("#tahun1").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
$("#tahun2").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
    //===PENDIDIKAN ===//
            getPendidikan = () => {
              $.ajax({
                      type: "GET",
                      url: "{{ url('/api/pendidikan')}}",
                      beforeSend: false,
                      success : function(returnData) {
                          $.each(returnData.data, function (index, value) {
                          $('#pendidikan_id').append(
                              '<option value="'+value.uuid+'">'+value.nama+'</option>'
                          )
                      })
                  }
              })
          }
          getDiklat = () => {
              $.ajax({
                      type: "GET",
                      url: "{{ url('/api/diklat')}}",
                      beforeSend: false,
                      success : function(returnData) {
                          $.each(returnData.data, function (index, value) {
                          $('#diklat_id').append(
                              '<option value="'+value.uuid+'">'+value.nama+'</option>'
                          )
                      })
                  }
              })
          }
          getDiklat();
          getGolongan = () => {
              $.ajax({
                      type: "GET",
                      url: "{{ url('/api/golongan')}}",
                      beforeSend: false,
                      success : function(returnData) {
                          $.each(returnData.data, function (index, value) {
                          $('#golongan_id').append(
                              '<option value="'+value.uuid+'">'+value.kode_golongan+'</option>'
                          )
                      })
                  }
              })
          }
          getJabatan = () => {
              $.ajax({
                      type: "GET",
                      url: "{{ url('/api/jabatan')}}",
                      beforeSend: false,
                      success : function(returnData) {
                          $.each(returnData.data, function (index, value) {
                          $('#jabatan_id').append(
                              '<option value="'+value.uuid+'">'+value.jabatan+'</option>'
                          )
                      })
                  }
              })
          }
          getDiklat();
          getJabatan();
          getPendidikan(); 
          getGolongan();
   
    
    //function hapus pendidikan
    hapusPendidikan = (uuid, nama)=>{
    let csrf_token=$('meta[name="csrf_token"]').attr('content');
    Swal.fire({
                title: 'apa anda yakin?',
                text: " Menghapus  Data pendidikan " + nama,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'hapus data',
                cancelButtonText: 'batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url : "{{ url('/api/pendidikan_karyawan')}}" + '/' + uuid,
                        type : "POST",
                        data : {'_method' : 'DELETE', '_token' :csrf_token},
                        success: function (response) {
                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Berhasil Dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    $('#tablePendidikan').DataTable().ajax.reload(null, false);
                },
            })
            } else if (result.dismiss === swal.DismissReason.cancel) {
                Swal.fire(
                'Dibatalkan',
                'data batal dihapus',
                'error'
                )
            }
        })
    }

    //function hapus diklat
    hapusDiklat = (uuid, nama)=>{
    let csrf_token=$('meta[name="csrf_token"]').attr('content');
    Swal.fire({
                title: 'apa anda yakin?',
                text: " Menghapus  Data Diklat " + nama,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'hapus data',
                cancelButtonText: 'batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url : "{{ url('/api/diklat_karyawan')}}" + '/' + uuid,
                        type : "POST",
                        data : {'_method' : 'DELETE', '_token' :csrf_token},
                        success: function (response) {
                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Berhasil Dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    $('#tableDiklat').DataTable().ajax.reload(null, false);
                },
            })
            } else if (result.dismiss === swal.DismissReason.cancel) {
                Swal.fire(
                'Dibatalkan',
                'data batal dihapus',
                'error'
                )
            }
        })
    }

      //function hapus pendidikan
    hapusPangkat = (uuid, nama)=>{
    let csrf_token=$('meta[name="csrf_token"]').attr('content');
    Swal.fire({
                title: 'apa anda yakin?',
                text: " Menghapus  Data Golongan " + nama,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'hapus data',
                cancelButtonText: 'batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url : "{{ url('/api/riwayat-pangkat')}}" + '/' + uuid,
                        type : "POST",
                        data : {'_method' : 'DELETE', '_token' :csrf_token},
                        success: function (response) {
                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Berhasil Dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    $('#tableGolongan').DataTable().ajax.reload(null, false);
                },
            })
            } else if (result.dismiss === swal.DismissReason.cancel) {
                Swal.fire(
                'Dibatalkan',
                'data batal dihapus',
                'error'
                )
            }
        })
    }

    //function hapus pendidikan
    hapusJabatan = (uuid, nama)=>{
    let csrf_token=$('meta[name="csrf_token"]').attr('content');
    Swal.fire({
                title: 'apa anda yakin?',
                text: " Menghapus  Data jabatan " + nama,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'hapus data',
                cancelButtonText: 'batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url : "{{ url('/api/riwayat-jabatan')}}" + '/' + uuid,
                        type : "POST",
                        data : {'_method' : 'DELETE', '_token' :csrf_token},
                        success: function (response) {
                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Berhasil Dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    $('#tableJabatan').DataTable().ajax.reload(null, false);
                },
            })
            } else if (result.dismiss === swal.DismissReason.cancel) {
                Swal.fire(
                'Dibatalkan',
                'data batal dihapus',
                'error'
                )
            }
        })
    }

        //fungsi render datatable        
        $(document).ready(function() {
            let karyawan_id = $('#id1').val();
            $('#tablePendidikan').DataTable( {
                responsive: true,
                processing: true,
                serverSide: true,
                searching : true,
                paging    : true,
                ajax: {
                    "type": "GET",
                    "url": "{{ url('/api/pendidikan_karyawan')}}" + '/' + karyawan_id,
                    "dataSrc": "data",
                    "contentType": "application/json; charset=utf-8",
                    "dataType": "json",
                    "processData": true
                },
                columns: [
                    {"data": "pendidikan.nama"},
                    {"data": "keterangan"},
                    {data: null , render : function ( data, type, row, meta ) {
                        let uuid = row.uuid;
                        let nama = row.pendidikan.nama;
                        return type === 'display'  ?
                        '<button onClick="hapusPendidikan(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="fas fa-trash"></i></button>':
                    data;
                    }}
                ]
            });

            $('#tableDiklat').DataTable( {
                responsive: true,
                processing: true,
                serverSide: true,
                searching : true,
                paging    : true,
                ajax: {
                    "type": "GET",
                    "url": "{{ url('/api/diklat_karyawan')}}" + '/' + karyawan_id,
                    "dataSrc": "data",
                    "contentType": "application/json; charset=utf-8",
                    "dataType": "json",
                    "processData": true
                },
                columns: [
                    {"data": "diklat.nama"},
                    {"data": "diklat.waktu"},
                    {data: null , render : function ( data, type, row, meta ) {
                        let uuid = row.uuid;
                        let nama = row.diklat.nama;
                        return type === 'display'  ?
                        '<button onClick="hapusDiklat(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="fas fa-trash"></i></button>':
                    data;
                    }}
                ]
            });

            $('#tableGolongan').DataTable( {
                responsive: true,
                processing: true,
                serverSide: true,
                searching : true,
                paging    : true,
                ajax: {
                    "type": "GET",
                    "url": "{{ url('/api/riwayat-pangkat')}}" + '/' + karyawan_id,
                    "dataSrc": "data",
                    "contentType": "application/json; charset=utf-8",
                    "dataType": "json",
                    "processData": true
                },
                columns: [
                    {"data": "golongan.kode_golongan"},
                    {"data": "tahun"},
                    {data: null , render : function ( data, type, row, meta ) {
                        let uuid = row.uuid;
                        let nama = row.golongan.golongan;
                        return type === 'display'  ?
                        '<button onClick="hapusPangkat(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="fas fa-trash"></i></button>':
                    data;
                    }}
                ]
            });

            $('#tableJabatan').DataTable( {
                responsive: true,
                processing: true,
                serverSide: true,
                searching : true,
                paging    : true,
                ajax: {
                    "type": "GET",
                    "url": "{{ url('/api/riwayat-jabatan')}}" + '/' + karyawan_id,
                    "dataSrc": "data",
                    "contentType": "application/json; charset=utf-8",
                    "dataType": "json",
                    "processData": true
                },
                columns: [
                    {"data": "jabatan.jabatan"},
                    {"data": "tahun"},
                    {data: null , render : function ( data, type, row, meta ) {
                        let uuid = row.uuid;
                        let nama = row.jabatan.nama;
                        return type === 'display'  ?
                        '<button onClick="hapusJabatan(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="fas fa-trash"></i></button>':
                    data;
                    }}
                ]
            });

         });

        //event btn klik
        $('#tambahPendidikan').click(function(){
            $('.modal-title').text('Tambah Data Pendidikan');
            $('#pendidikan_id').val('');
            $('#keterangan').val('');            
            $('#btn-form').text('Simpan Data');
            $('#pendidikanModal').modal('show');
        })

            //event btn klik
            $('#tambahDiklat').click(function(){
            $('.modal-title').text('Tambah Data Diklat');
            $('#diklat_id').val(''); 
            $('#btn-form-diklat').text('Simpan Data');
            $('#diklatModal').modal('show');
        })

        //event btn klik
        $('#tambahGolongan').click(function(){
            $('.modal-title').text('Tambah Data Golongan');
            $('#golongan_id').val(''); 
            $('#tahun').val(''); 
            $('#btn-form-golongan').text('Simpan Data');
            $('#golonganModal').modal('show');
        })

         //event btn klik
         $('#tambahJabatan').click(function(){
            $('.modal-title').text('Tambah Data Jabatan');
            $('#jabatan_id').val(''); 
            $('#tahun').val(''); 
            $('#btn-form-jabatan').text('Simpan Data');
            $('#jabatanModal').modal('show');
        })

            //event form submit
            $("#form1").submit(function (e) {
            e.preventDefault()
            let form = $('#modal-body form');
                $.ajax({
                    url: "{{Route('API.diklat_karyawan.create')}}",
                    type: "post",
                    data: $(this).serialize(),
                    success: function (response) {
                        form.trigger('reset');
                        $('#diklatModal').modal('hide');
                        $('#tableDiklat').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Berhasil Disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error:function(response){
                        console.log(response);
                    }
                })
        } );

          //event form submit
          $("#form2").submit(function (e) {
            e.preventDefault()
            let form = $('#modal-body form');
                $.ajax({
                    url: "{{Route('API.pendidikan_karyawan.create')}}",
                    type: "post",
                    data: $(this).serialize(),
                    success: function (response) {
                        form.trigger('reset');
                        $('#pendidikanModal').modal('hide');
                        $('#tablePendidikan').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Berhasil Disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error:function(response){
                        console.log(response);
                    }
                })
        } );
         //event form submit
         $("#form3").submit(function (e) {
            e.preventDefault()
            let form = $('#modal-body form');
                $.ajax({
                    url: "{{Route('API.riwayat-pangkat.create')}}",
                    type: "post",
                    data: $(this).serialize(),
                    success: function (response) {
                        form.trigger('reset');
                        $('#golonganModal').modal('hide');
                        $('#tableGolongan').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Berhasil Disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error:function(response){
                        console.log(response);
                    }
                })
        } );
         //event form submit
         $("#form4").submit(function (e) {
            e.preventDefault()
            let form = $('#modal-body form');
                $.ajax({
                    url: "{{Route('API.riwayat-jabatan.create')}}",
                    type: "post",
                    data: $(this).serialize(),
                    success: function (response) {
                        form.trigger('reset');
                        $('#jabatanModal').modal('hide');
                        $('#tableJabatan').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Berhasil Disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error:function(response){
                        console.log(response);
                    }
                })
        } );
    </script>
@endsection