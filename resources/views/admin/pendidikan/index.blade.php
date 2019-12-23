@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Pendidikan Formal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Pendidikan</a></li>
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
                    <a href="{{Route('pendidikanCetak')}}" class="btn btn-info pull-right" style="margin-right:5px;"><i class="fas fa-print"></i> cetak data</a>
                </div>
            </div>
              <div class="card-body">
                <br>
                <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Kode Pendidikan</th>
                  <th>Nama</th>
                  <th>Tahun Lulus</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                <th>Kode Pendidikan</th>
                  <th>Nama</th>
                  <th>Tahun Lulus</th>
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
                    <div class="form-group"><label  class=" form-control-label">Kode Pendidikan</label><input type="text" id="kode_pendidikan" name="kode_pendidikan" placeholder="" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Nama Pendidikan</label><input type="text" id="nama" name="nama" placeholder="" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Tahun</label>
                    <input type="date" name="tahun_lulus" id="tahun_lulus" class="form-control" >
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
    //function hapus
    hapus = (uuid, nama)=>{
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
                        url : "{{ url('/api/pendidikan')}}" + '/' + uuid,
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
        $('#kode_pendidikan').val('');
        $('#nama').val('');
        $('#tahun_lulus').val();    
        $('#btn-form').text('Simpan Data');
        $('#mediumModal').modal('show');
    })

    //event btn edit klik
    edit = uuid =>{
        $.ajax({
            type: "GET",
            url: "{{ url('/api/pendidikan')}}" + '/' + uuid,
            beforeSend: false,
            success : function(returnData) {
                $('.modal-title').text('Edit Data');
                $('#id').val(returnData.data.uuid);
                $('#kode_pendidikan').val(returnData.data.kode_pendidikan);
                $('#nama').val(returnData.data.nama);
                $('#tahun_lulus').val(returnData.data.nama);
                $('#btn-form').text('Ubah Data');
                $('#mediumModal').modal('show');
            }
        })
    }

    //function datatable render
    $(document).ready(function() {
        $('#datatable').DataTable( {
            responsive: true,
            processing: true,
            serverSide: true,
            searching : true,
            paging    : true,
            ajax: {
                "type": "GET",
                "url": "{{route('API.pendidikan.get')}}",
                "dataSrc": "data",
                "contentType": "application/json; charset=utf-8",
                "dataType": "json",
                "processData": true
            },
            columns: [
                {"data": "kode_pendidikan"},
                {"data": "nama"},
                {"data": "tahun_lulus"},
                {data: null , render : function ( data, type, row, meta ) {
                    let uuid = row.uuid;
                    let nama = row.nama;
                    return type === 'display'  ?
                    '<button onClick="edit(\''+uuid+'\')" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editmodal"><i class="fas fa-edit"> edit</i></button> <button onClick="hapus(\'' + uuid + '\',\'' + nama + '\')" class="btn btn-sm btn-outline-danger" > <i class="fas fa-trash">hapus</i></button>':
                data;
                }}
            ]
        });

    //event form submit    
    $("form").submit(function (e) {
        e.preventDefault()
        let form = $('#modal-body form');
        if($('.modal-title').text() == 'Edit Data'){
            let url = '{{route("API.pendidikan.update", '')}}'
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
                url: "{{Route('API.pendidikan.create')}}",
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
    } );
    </script>
@endsection