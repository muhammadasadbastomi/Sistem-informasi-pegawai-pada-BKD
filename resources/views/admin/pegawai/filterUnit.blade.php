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
                <h5 class="card-title">Filter Cetak Data</h5>
            </div>
              <div class="card-body">
              <form action="" method="post">
                <div class="form-group"><label  class=" form-control-label">Pilih Instansi</label>
                        <select name="unit_kerja_id" id="unit_kerja_id" class="form-control">
                            <option value="">-- pilih intansi --</option>
                            @foreach($unit as $d)
                            <option value="{{$d->uuid}}">{{$d->nama}}</option>
                            @endforeach
                        </select>
                    </div>  
              </div>
              <div class="card-footer">
                <div class="text-right">
                    <a href="" class="btn btn-danger">Kembali</a>
                    <input class="btn btn-primary" type="submit" name="submit" value="cetak data">
                    {{csrf_field() }}
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection