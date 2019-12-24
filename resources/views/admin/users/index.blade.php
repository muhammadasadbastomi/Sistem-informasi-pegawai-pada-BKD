@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Users</a></li>
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
                    <a href="" class="btn btn-info pull-right" style="margin-right:5px;"><i class="fas fa-print"></i> cetak data</a>
                </div>
            </div>
              <div class="card-body">
                <br>
                <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                  <th>Username</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                  <th>Username</th>
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
                <form  method="post" action="" enctype="multipart/form-data">
                    <div class="form-group"><input type="hidden" id="id" name="id"  class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Username</label><input type="text" id="username" name="username" placeholder="Uji ..." class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">password</label><input type="text" id="password" name="password"  class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Foto</label><input type="file" id="foto" name="foto"  class="form-control"></div>
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
    //fungsi hapus
    hapus = (uuid, username)=>{
        let csrf_token=$('meta[name="csrf_token"]').attr('content');
        Swal.fire({
                    title: 'apa anda yakin?',
                    text: " Menghapus  Data user " + username,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'hapus data',
                    cancelButtonText: 'batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url : "{{ url('/api/user')}}" + '/' + uuid,
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
        
        //event btn klik
        $('#tambah').click(function(){
            $('.modal-title').text('Tambah Data');
            $('#username').val('');
            $('#password').val('');
            $('#btn-form').text('Simpan Data');
            $('#mediumModal').modal('show');
        })
        //event btn edit klik
        edit = uuid =>{
            $.ajax({
                type: "GET",
                url: "{{ url('/api/user')}}" + '/' + uuid,
                beforeSend: false,
                success : function(returnData) {
                    $('.modal-title').text('Edit Data');
                    $('#id').val(returnData.data.uuid);
                    $('#username').val(returnData.data.username);
                    $('#password').val(returnData.data.password);
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
                    "type": "GET",
                    "url": "{{route('API.user.get')}}",
                    "dataSrc": "data",
                    "contentType": "application/json; charset=utf-8",
                    "dataType": "json",
                    "processData": true
                },
                columns: [
                    {"data": "username"},
                    {data: null , render : function ( data, type, row, meta ) {
                        let uuid = row.uuid;
                        let username = row.username;
                        return type === 'display'  ?
                        '<button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="ti-pencil"> edit</i></button> <button onClick="hapus(\'' + uuid + '\',\'' + username + '\')" class="btn btn-sm btn-outline-danger" > <i class="ti-trash">hapus</i></button>':
                    data;
                    }}
                ]
            });

            //event form submit        
            $("form").submit(function (e) {
                e.preventDefault()
                let form = $('#modal-body form');
                if($('.modal-title').text() == 'Edit Data'){
                    let url = '{{route("API.user.update", '')}}'
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
                        url: "{{Route('API.user.create')}}",
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