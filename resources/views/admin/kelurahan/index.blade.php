@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Kelurahan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Kelurahan</a></li>
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
                    <a href="{{Route('kelurahanCetak')}}" class="btn btn-info pull-right" style="margin-right:5px;"><i class="fas fa-print"></i> cetak data</a>
                </div>
            </div>
              <div class="card-body">
                <br>
                <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                  <th>Kode Kelurahan</th>
                  <th>Nama Kelurahan</th>
                  <th>Kecamatan</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>B12</td>
                  <td>Mentaos</td>
                  <td>Banjarbaru Utara</td>
                  <td class="text-center"><a href="" class="btn btn-primary"> <i class="fas fa-edit"></i> </a> <a href="" class="btn btn-danger"> <i class="fas fa-trash"></i> </a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                <th>Kode Kelurahan</th>
                  <th>Nama Kelurahan</th>
                  <th>Kecamatan</th>
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
                    <div class="form-group"><label  class=" form-control-label">Kode Kelurahan</label><input type="text" id="kode_kelurahan" name="kode_kelurahan" placeholder="Uji ..." class="form-control" required></div>
                    <div class="form-group"><label  class=" form-control-label">Nama Kelurahan</label><input type="text" id="kelurahan" name="kelurahan" placeholder="" class="form-control"required></div>
                    <div class="form-group"><label  class=" form-control-label">Kecamatan</label>
                    <select name="kecamatan_id" id="kecamatan_id" class="form-control">
                        <option value="">-- pilih kecamatan --</option>
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
    //function get data kecamatan
    getKecamatan = () => {
        $.ajax({
                type: "GET",
                url: "{{ url('/api/kecamatan')}}",
                beforeSend: false,
                success : function(returnData) {
                    $.each(returnData.data, function (index, value) {
                    $('#kecamatan_id').append(
                        '<option value="'+value.uuid+'">'+value.kecamatan+'</option>'
                    )
                })
            }
        })
    }
    getKecamatan();

    //function hapus
    hapus = (uuid, nama)=> {
        let csrf_token=$('meta[name="csrf_token"]').attr('content');
        Swal.fire({
                    title: 'apa anda yakin?',
                    text: " Menghapus  Data kelurahan " + nama,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',  
                    confirmButtonText: 'hapus data',
                    cancelButtonText: 'batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url : "{{ url('/api/kelurahan')}}" + '/' + uuid,
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

    //event btn tambah 
    $('#tambah').click(function(){
        $('.modal-title').text('Tambah Data');
        $('#kode_kelurahan').val('');
        $('#kelurahan').val('');
        $('#kecamatan_id').val('');    
        $('#btn-form').text('Simpan Data');
        $('#mediumModal').modal('show');
    })

    //event btn edit click
    edit = uuid =>{
        $.ajax({
            type: "GET",
            url: "{{ url('/api/kelurahan')}}" + '/' + uuid,
            beforeSend: false,
            success : function(returnData) {
                $('.modal-title').text('Edit Data');
                $('#id').val(returnData.data.uuid);
                $('#kode_kelurahan').val(returnData.data.kode_kelurahan);
                $('#nama').val(returnData.data.nama);
                $('#kecamatan_id').val(returnData.data.kecamatan.uuid);    
                $('#btn-form').text('Ubah Data');
                $('#mediumModal').modal('show');
            }
        })
    }

    $(document).ready(function() {
        
        // function data table render 
        $('#datatable').DataTable( {
            responsive: true,
            processing: true,
            serverSide: false,
            searching: true,
            ajax: {
                "type": "GET",
                "url": "{{route('API.kelurahan.get')}}",
                "dataSrc": "data",
                "contentType": "application/json; charset=utf-8",
                "dataType": "json",
                "processData": true
            },
            columns: [
                {"data": "kode_kelurahan"},
                {"data": "kelurahan"},
                {"data": "kecamatan.kecamatan"},
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
                    url: "{{Route('API.kelurahan.create')}}",
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