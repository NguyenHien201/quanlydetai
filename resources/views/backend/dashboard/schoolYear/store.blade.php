@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('backend.components.breadcrumb')

  @php
    $url = ($config['method'] == 'create') ? route('school_year.store') : route('school_year.update', $schoolYear->id);
  @endphp

  <form action="{{$url}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb30">
      <div class="col-lg-5">
        <div class="panel-head">
          <div class="panel-title">Thông tin niên khóa</div>
          <div class="panel-description">
            <p>Nhập thông tin liên quan đến niên khóa</p>
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
                <label for="" class="control-label text-right">Tên niên khóa <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id=""
                  name="name"
                  class="form-control"
                  placeholder="Nhập Mã niên khóa"
                  value="{{old('name', ($schoolYear->name) ?? '')}}"
                >
                @error('name')
                <div class="text-danger">{{ $message }}</div>
              @enderror
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-row">
                <label for="start_date" class="control-label text-right">Ngày bắt đầu <span class="text-danger"></span></label>
                <input 
                  type="date"
                  id="start_date"
                  name="start_date"
                  class="form-control"
                  value="{{old('start_date', isset($schoolYear->start_date) ?
                  date('Y-m-d', strtotime($schoolYear->start_date)) : '') }}"
                  autocomplete="off"
                >
              </div>
            </div>

          </div>

          <div class="row mb10">

            <div class="col-lg-6">
              <div class="form-row">
                <label for="end_date" class="control-label text-right">Ngày kêt thúc <span class="text-danger"></span></label>
                <input 
                  type="date"
                  id="end_date"
                  name="end_date"
                  class="form-control"
                  value="{{old('end_date', isset($schoolYear->end_date) ?
                  date('Y-m-d', strtotime($schoolYear->end_date)) : '') }}"
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
