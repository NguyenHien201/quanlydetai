@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('backend.components.breadcrumb')

  @php
    $url = ($config['method'] == 'create') ? route('major.store') : route('major.update', $major->id);
  @endphp

  <form action="{{$url}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb30">
      <div class="col-lg-5">
        <div class="panel-head">
          <div class="panel-title">Thông tin ngành học</div>
          <div class="panel-description">
            <p>Nhập thông tin chung của ngành học</p>
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
                <label for="code" class="control-label text-right">Mã ngành học <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="code"
                  name="code"
                  class="form-control"
                  placeholder="Nhập mã ngành học"
                  value="{{old('code', ($major->code) ?? '' )}}"
                >
              </div>
              @error('code')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-lg-6">
              <div class="form-row">
                <label for="name" class="control-label text-right">Tên ngành học <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="name"
                  name="name"
                  class="form-control"
                  placeholder="Nhập tên ngành học"
                  value="{{old('name', ($major->name) ?? '' )}}"
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
                <label for="" class="control-label text-right">Nhóm khoa <span class="text-danger">(*)</span></label>
                <select name="department_id" id="department_id" class="form-control setupSelect2">
                  <option value="" selected="selected">[Chọn nhóm khoa]</option>
                  @foreach($departments as $department)
                    <option
                    {{
                      $department->id == old('department_id',
                      (isset($major->departments->id)) ?
                      $major->department_id : '') ? 'selected' : ''
                    }}
                    value="{{$department->id}}">{{ $department->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('department_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>

    <hr>

    <div class="text-right mb10">
        <button type="submit" class="btn btn-primary" name="send" value="send">Lưu lại</button>
    </div>
  </form>
</div>
@endsection
