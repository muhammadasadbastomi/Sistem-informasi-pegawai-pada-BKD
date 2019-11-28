@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Unit Kerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Unit Kerja</a></li>
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
                    <a href="#" class="btn btn-info pull-right" style="margin-right:5px;"><i class="fas fa-print"></i> cetak data</a>
                </div>
            </div>
              <div class="card-body">
                <br>
                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Kode Unit Kerja</th>
                  <th>Nama Unit Kerja</th>
                  <th>Instansi</th>
                  <th>Keterangan</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>B12</td>
                  <td>UPT Parkir</td>
                  <td>Dinas Perhubungan</td>
                  <td>Mengelola pajak retribusi parkir</td>
                  <td class="text-center"><a href="" class="btn btn-primary"> <i class="fas fa-edit"></i> </a> <a href="" class="btn btn-danger"> <i class="fas fa-trash"></i> </a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode Unit Kerja</th>
                  <th>Nama Unit Kerja</th>
                  <th>Instansi</th>
                  <th>Keterangan</th>
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
                    <div class="form-group"><label  class=" form-control-label">Kode Unit Kerja</label><input type="text" id="kd_kelurahan" name="kd_kelurahan" placeholder="Uji ..." class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Nama Unit Kerja</label><input type="text" id="nama_kelurahan" name="nama_kelurahan" placeholder="" class="form-control"></div>
                    <div class="form-group"><label  class=" form-control-label">Keterangan</label><textarea name="" id="" class="form-control"></textarea></div>
                    <div class="form-group"><label  class=" form-control-label">Instansi</label>
                    <select name="" id="" class="form-control">
                        <option value="">Ini ngambil dari data kecamatan</option>
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
    $('#tambah').click(function(){
        $('.modal-title').text('Tambah Data');
        $('#kd_kecamatan').val('');
        $('#nama_kecamatan').val('');  
        $('#btn-form').text('Simpan Data');
        $('#mediumModal').modal('show');
    })
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endsection