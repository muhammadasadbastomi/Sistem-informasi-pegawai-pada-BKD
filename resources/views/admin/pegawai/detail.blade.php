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

                <p class="text-muted text-center">{{$karyawan->unit_kerja->nama}} -{{$karyawan->unit_kerja->instansi->nama}}</p>

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
                <h3 class="card-title">Riwayat Pendidikan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Pendidikan Formal</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>


                <strong><i class="fas fa-pencil-alt mr-1"></i> Diklat</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

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
                  <li class="nav-item"><a class="nav-link " href="#SKP" data-toggle="tab">SKP</a></li>
                  <li class="nav-item"><a class="nav-link" href="#pendidikan" data-toggle="tab">Pendidikan formal</a></li>
                  <li class="nav-item"><a class="nav-link" href="#diklat" data-toggle="tab">DIklat yang diikuti</a></li>
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
                              <th>Agama</th>
                              <td>: {{$karyawan->agama}}</td>
                            </tr>                            <tr>
                              <th>golongan Darah</th>
                              <td>: {{$karyawan->golongan_darah}}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-xl-6">
                      <table class="table">
                          <tbody>
                            <tr>
                              <th>Status Kepegawaian</th>
                              <td>: {{$karyawan->status_pegawai}}</td>
                            </tr>
                            <tr>
                              <th>golongan</th>
                              <td>: {{$karyawan->golongan->golongan}}</td>
                            </tr>
                            <tr>
                              <th>unit / Dinas</th>
                              <td>: {{$karyawan->unit_kerja->nama}} / {{$karyawan->unit_kerja->instansi->nama}}</td>
                            </tr> 
                            <tr>
                              <th>jabatan</th>
                              <td>: {{$karyawan->jabatan->jabatan}}</td>
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
                  <div class="tab-pane" id="pendidikan">
                    <label for=""> pendidikan Formal</label>
                    <div class="text-right">
                        <button class="btn btn-sm btn-primary" id="tambahPendidikan"> + Tambah Pendidikan</button>
                    </div>
                    <br>
                    <table id="tablependidikan" class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                            <th>Unit Kerja</th>
                            <th>NIP</th>
                            <th>Tempat Lahir</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Unit Kerja</th>
                                <th>NIP</th>
                                <th>Tempat Lahir</th>
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
                    <table id="tablediklat" class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                            <th>Unit Kerja</th>
                            <th>NIP</th>
                            <th>Tempat Lahir</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Unit Kerja</th>
                                <th>NIP</th>
                                <th>Tempat Lahir</th>
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
    <div class="modal fade" id="mediumModal"  role="dialog" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPendidikan">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  method="post" action="" enctype="multipart/form-data">
                    <div class="form-group"><input type="text" id="id" name="id"  class="form-control" value="{{$karyawan->uuid}}"></div>
                    <div class="form-group"><label  class=" form-control-label">Pendididan Formal</label>
                        <select name="pendidikan_id" id="pendidikan_id" class="form-control">
                            <option value="">-- pilih unit kerja --</option>
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
@endsection
@section('script')
    <script>
            getKecamatan = () => {
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
         //fungsi render datatable        
         $(document).ready(function() {
            $('#tablependidikan').DataTable( {
                responsive: true,
                processing: true,
                searching : true,
                paging    : true
            });

            $('#tablediklat').DataTable( {
                responsive: true,
                processing: true,
                searching : true,
                paging    : true
            });
         });

        //event btn klik
        $('#tambahPendidikan').click(function(){
            $('.modal-title').text('Tambah Data');
            $('#nama').val('');      
            $('#btn-form').text('Simpan Data');
            $('#mediumModal').modal('show');
        })

            //event btn klik
            $('#tambahDiklat').click(function(){
            $('.modal-title').text('Tambah Data'); 
            $('#btn-form').text('Simpan Data');
            $('#mediumModal').modal('show');
        })

            //event form submit
            $("form").submit(function (e) {
            e.preventDefault()
            let form = $('#modal-body form');
            if($('.modal-title').text() == 'Edit Data'){
                let url = '{{route("API.kelurahan.update", '')}}'
                let id = $('#id').val();
                $.ajax({
                    url: url+'/'+id,
                    type: "put",
                    data: $(this).serialize(),
                    success: function (response) {
                        form.trigger('reset');
                        $('#mediumModal').modal('hide');
                        $('#datatable').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Berhasil Tersimpan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    error:function(response){
                        console.log(response);
                    }
                })
            }else{
                $.ajax({
                    url: "{{Route('API.pendidikan_karyawan.create')}}",
                    type: "post",
                    data: $(this).serialize(),
                    success: function (response) {
                        form.trigger('reset');
                        $('#mediumModal').modal('hide');
                        $('#datatable').DataTable().ajax.reload();
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
            }
        } );
    </script>
@endsection