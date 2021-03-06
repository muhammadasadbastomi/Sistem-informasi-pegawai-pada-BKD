@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Intansi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Intansi</a></li>
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
                    <a href="{{Route('instansiCetak')}}" class="btn btn-info pull-right" style="margin-right:5px;"><i class="fas fa-print"></i> cetak data</a>
                    <a href="{{Route('instansiFilter')}}" class="btn btn-info pull-right" style="margin-right:5px;"><i class="fas fa-print"></i> cetak data filter</a>
                </div>
            </div>
              <div class="card-body">
                <br>
                <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                  <th>Kode instansi</th>
                  <th>Nama instansi</th>
                  <th>Alamat</th>
                  <th>Kelurahan</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode instansi</th>
                  <th>Nama instansi</th>
                  <th>Alamat</th>
                  <th>Kelurahan</th>
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
                <form  method="post" action="">
                    <div class="form-group"><input type="hidden" id="id" name="id"  class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Kode instansi</label><input type="text" id="kode_instansi" name="kode_instansi" placeholder="Kose instansi ..." class="form-control" required></div>
                    <div class="form-group"><label  class=" form-control-label">Nama instansi</label><input type="text" id="nama" name="nama" placeholder="nama instansi" class="form-control" required></div>
                    <div class="form-group"><label  class=" form-control-label">Alamat</label><textarea name="alamat" id="alamat" class="form-control" required></textarea></div>
                    <div class="form-group"><label  class=" form-control-label">Kelurahan</label>
                    <select name="kelurahan_id" id="kelurahan_id" class="form-control">
                        <option value="">-- pilih kelurahan --</option>
                    </select>
                    </div>
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

    //function get data kelurahan
    getKelurahan = () =>{
        $.ajax({
                type: "GET",
                url: "{{ url('/api/kelurahan')}}",
                beforeSend: false,
                success : function(returnData) {
                    $.each(returnData.data, function (index, value) {
                    $('#kelurahan_id').append(
                        '<option value="'+value.uuid+'">'+value.kelurahan+'</option>'
                    )
                })
            }
        })
    }
    getKelurahan()

    //function hapus
    hapus = (uuid, nama)=>{
        let csrf_token=$('meta[name="csrf_token"]').attr('content');
        Swal.fire({
                    title: 'apa anda yakin?',
                    text: " Menghapus  Data instansi " + nama,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'hapus data',
                    cancelButtonText: 'batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url : "{{ url('/api/instansi')}}" + '/' + uuid,
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

    //event btn tambah klik
    $('#tambah').click(function(){
        $('.modal-title').text('Tambah Data');
        $('#kode_instansi').val('');
        $('#nama').val('');
        $('#alamat').val('');
        $('#kelurahan_id').val('');
        $('#btn-form').text('Simpan Data');
        $('#mediumModal').modal('show');
    })

    //function btn edit klik
    edit = uuid =>{
        $.ajax({
            type: "GET",
            url: "{{ url('/api/instansi')}}" + '/' + uuid,
            beforeSend: false,
            success : function(returnData) {
                $('.modal-title').text('Edit Data');
                $('#id').val(returnData.data.uuid);
                $('#kode_instansi').val(returnData.data.kode_instansi);
                $('#nama').val(returnData.data.nama);
                $('#alamat').val(returnData.data.alamat);
                $('#kelurahan_id').val(returnData.data.kelurahan.uuid);
                $('#btn-form').text('Ubah Data');
                $('#mediumModal').modal('show');
            }
        })
    }

    // function datatable render
    $(document).ready(function() {
        $('#datatable').DataTable( {
            responsive: true,
            processing: true,
            serverSide: false,
            searching: true,
            ajax: {
                "type": "GET",
                "url": "{{route('API.instansi.get')}}",
                "dataSrc": "data",
                "contentType": "application/json; charset=utf-8",
                "dataType": "json",
                "processData": true
            },
            columns: [
                {"data": "kode_instansi"},
                {"data": "nama"},
                {"data": "alamat"},
                {"data": "kelurahan.kelurahan"},
                {data: null , render : function ( data, type, row, meta ) {
                    let uuid = row.uuid;
                    let nama = row.nama;
                    return type === 'display'  ?
                    '<button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="fas fa-edit"></i></button> <button onClick="hapus(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="fas fa-trash"></i></button>':
                data;
                }}
            ]
    });

    //event form submit
    $("form").submit(function (e) {
        e.preventDefault()
        let form = $('#modal-body form');
        if($('.modal-title').text() == 'Edit Data'){
            let url = '{{route("API.instansi.update", '')}}'
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
                url: "{{Route('API.instansi.create')}}",
                type: "post",
                data: $(this).serialize(),
                success: function (response) {
                    form.trigger('reset');
                    $('#mediumModal').modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                    if (response.Error) {

                            var array = $.map(response, function(value, index) {
                                                return [value];
                                            });
                            Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: response.Error,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }else{
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data Berhasil Disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
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
