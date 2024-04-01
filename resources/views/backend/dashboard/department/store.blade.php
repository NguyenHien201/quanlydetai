@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('backend.components.breadcrumb')

  @php
    $url = ($config['method'] == 'create') ? route('department.store') : route('department.update', $department->id);
  @endphp

  <form action="{{$url}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb30">
      <div class="col-lg-5">
        <div class="panel-head">
          <div class="panel-title">Thông tin khoa</div>
          <div class="panel-description">
            <p>Nhập thông tin liên quan đến khoa</p>
            <p>Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span>
            Là trường bắt buộc</p>
          </div>
        </div>
      </div>

      <div class="col-lg-7 card">
        <div class="card-body">
          <div class="row mb10">

            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Mã khoa <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id=""
                  name="code"
                  class="form-control"
                  placeholder="Nhập Mã khoa"
                  value="{{old('code', ($department->code) ?? '')}}"
                >
                @error('code')
                <div class="text-danger">{{ $message }}</div>
              @enderror
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Tên khoa <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id=""
                  name="name"
                  class="form-control"
                  placeholder="Nhập tên quyền"
                  value="{{old('name', ($department->name) ?? '' )}}"
                >
              </div>
              @error('name')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

          </div>

          <div class="row mb10">

            <div class="col-lg-6">
              <div class="form-row">
                <label for="start_time" class="control-label text-right">Ngày tạo <span class="text-danger"></span></label>
                <input 
                  type="date"
                  id="start_time"
                  name="start_time"
                  class="form-control"
                  value="{{old('start_time', isset($department->start_time) ?
                  date('Y-m-d', strtotime($department->start_time)) : '') }}"
                  autocomplete="off"
                >
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="text-right mb10">
        <button type="submit" class="btn btn-primary" name="send" value="send">Lưu lại</button>
    </div>
  </form>
</div>
@endsection
