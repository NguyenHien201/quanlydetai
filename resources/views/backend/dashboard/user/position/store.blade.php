@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('backend.components.breadcrumb')

  @php
    $url = ($config['method'] == 'create') ? route('position.store') : route('position.update', $position->id);
  @endphp

  <form action="{{$url}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb30">
      <div class="col-lg-5">
        <div class="panel-head">
          <div class="panel-title">Thông tin chức vụ</div>
          <div class="panel-description">
            <p>Nhập thông tin liên quan đến chức vụ</p>
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
                <label for="" class="control-label text-right">Tên chức vụ <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id=""
                  name="name"
                  class="form-control"
                  placeholder="Nhập tên chức vụ"
                  value="{{old('name', ($userCatalogue->name) ?? '' )}}"
                >
              </div>
              @error('name')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Ghi chú <span class="text-danger"></span></label>
                <input 
                  type="text"
                  id=""
                  name="description"
                  class="form-control"
                  placeholder="Nhập ghi chú"
                  value="{{old('description', ($userCatalogue->description) ?? '')}}"
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
