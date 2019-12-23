@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Pegawai</h1>
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
                    <button href="" class="btn btn-primary pull-right" id="tambah" ><i class="fas fa-plus"></i> tambah data</button>
                    <a href="{{Route('pegawaiCetak')}}" class="btn btn-info pull-right" style="margin-right:5px;"><i class="fas fa-print"></i> cetak data</a>
                </div>
            </div>
                <br>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>tanggal lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Status Pegawai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>tanggal lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Status Pegawai</th>
                                <th class="text-center">Aksi</th>
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
                    <div class="form-group"><label  class=" form-control-label">Unit Kerja</label>
                        <select name="unit_kerja_id" id="unit_kerja_id" class="form-control">
                            <option value="">-- pilih unit kerja --</option>
                        </select>
                    </div>
                    <div class="form-group"><label  class=" form-control-label">NIP</label><input type="text" id="NIP" name="NIP" placeholder="" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Nama</label><input type="text" id="nama" name="nama" placeholder="" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Tempat Lahir</label><input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Tanggal Lahir</label><input type="date" id="tanggal_lahir" name="tanggal_lahir" placeholder="penyelenggara Diklat" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Alamat</label><textarea name="alamat" id="alamat" class="form-control"></textarea></div>
                    <label class="form-control-label" for="jk">Jenis Kelamin</label> 

                        <div class="row" style="margin-left:15px">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-check-input" type="radio" name="jk" id="jk1" value="Laki-laki" checked>
                                    <label class="form-check-label" for="jk">
                                        Laki - laki
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-check-input" type="radio" name="jk" id="jk2" value="Perempuan" checked>
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

        //function get data kecamatan
        getUnit = () => {
        $.ajax({
                type: "GET",
                url: "{{ url('/api/unit')}}",
                beforeSend: false,
                success : function(returnData) {
                    $.each(returnData.data, function (index, value) {
                    $('#unit_kerja_id').append(
                        '<option value="'+value.uuid+'">'+value.nama+'</option>'
                    )
                })
            }
        })
    }
    getUnit();
    //fungsi hapus
    hapus = (uuid, nama)=>{
        let csrf_token=$('meta[name="csrf_token"]').attr('content');
        Swal.fire({
                    title: 'apa anda yakin?',
                    text: " Menghapus  Data diklat " + nama,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'hapus data',
                    cancelButtonText: 'batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url : "{{ url('/api/karyawan')}}" + '/' + uuid,
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
                        $('#datatable').DataTable().ajax.reload(null, false);
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
        
        //event btn klikx   
        $('#tambah').click(function(){
            $('.modal-title').text('Tambah Data');
            $('#unit_kerja_id').val('');
            $('#NIP').val('');
            $('#nama').val('');
            $('#tempat_lahir').val('');  
            $('#tanggal_lahir').val('');
            $('#alamat').val('');   
            $('#jk').val('');        
            $('#status_pegawai').val('');     
            $('#status_kawin').val('');    
            $('#golongan_darah').val('');                     
            $('#agama').val('');                     
            $('#foto').val('');                                     
            $('#btn-form').text('Simpan Data');
            $('#mediumModal').modal('show');
        })
        //event btn edit klik
        edit = uuid =>{
            $.ajax({
                type: "GET",
                url: "{{ url('/api/karyawan')}}" + '/' + uuid,
                beforeSend: false,
                success : function(returnData) {
                    $('.modal-title').text('Edit Data');
                    $('#id').val(returnData.data.uuid);
                    $('#unit_kerja_id').val(returnData.data.unit_kerja.uuid);
                    $('#NIP').val(returnData.data.NIP);
                    $('#nama').val(returnData.data.nama);
                    $('#tempat_lahir').val(returnData.data.tempat_lahir);  
                    $('#tanggal_lahir').val(returnData.data.tanggal_lahir);
                    $('#alamat').val(returnData.data.alamat);   
                    $('#status_pegawai').val(returnData.data.status_pegawai);     
                    $('#status_kawin').val(returnData.data.status_kawin);    
                    $('#golongan_darah').val(returnData.data.golongan_darah);                     
                    $('#agama').val(returnData.data.agama);                     
                    $('#btn-form').text('Ubah Data');
                    $('#mediumModal').modal('show'); 
                }
            })
        }

        //fungsi render datatable        
        $(document).ready(function() {
            $('#datatable').DataTable( {
                responsive: true,
                processing: true,
                serverSide: true,
                searching : true,
                paging    : true,
                ajax: {
                    "type"          : "GET",
                    "url"           : "{{route('API.karyawan.get')}}",
                    "dataSrc"       : "data",
                    "contentType"   : "false",
                    "enctype"       : 'multipart/form-data',
                    "dataType"      : "json",
                    "processData"   : true
                },
                columns: [
                    {"data": "NIP"},
                    {"data": "nama"},
                    {"data": "tempat_lahir"},
                    {"data": "tanggal_lahir"},
                    {"data": "jk"},
                    {"data": "status_pegawai"},
                    {data: null , render : function ( data, type, row, meta ) {
                        let uuid = row.uuid;
                        let nama = row.nama;
                        return type === 'display'  ?
                        ' <a href="/pegawai/detail/ '+uuid+'" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i><a> <button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="fas fa-edit"></i></button> <button onClick="hapus(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="fas fa-trash"></i></button>':
                    data;
                    }}
                ]
            });

            //event form submit        
            $("form").submit(function (e) {
                e.preventDefault()
                let form = $('#modal-body form');
                if($('.modal-title').text() == 'Edit Data'){
                    let url = '{{route("API.karyawan.update", '')}}'
                    let id = $('#id').val();
                    $.ajax({
                        url: url+'/'+id,
                        type: "post",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
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
                        url: "{{Route('API.karyawan.create')}}",
                        type: "post",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
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
            } );
    </script>
@endsection