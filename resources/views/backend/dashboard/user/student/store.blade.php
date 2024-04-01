@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('backend.components.breadcrumb')

  @php
    $url = ($config['method'] == 'create') ? route('student.store') : route('student.update', $student->id);
  @endphp

  <form action="{{$url}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb30">
      <div class="col-lg-5">
        <div class="panel-head">
          <div class="panel-title">Thông tin sinh viên</div>
          <div class="panel-description">
            <p>Nhập thông tin chung của người sử dụng</p>
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
                <label for="code" class="control-label text-right">Mã sinh viên <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="code"
                  name="code"
                  class="form-control"
                  placeholder="Nhập mã sinh viên"
                  value="{{old('code', ($student->code) ?? '' )}}"
                >
              </div>
              @error('code')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-lg-6">
              <div class="form-row">
                <label for="name" class="control-label text-right">Tên sinh viên <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="name"
                  name="name"
                  class="form-control"
                  placeholder="Nhập tên sinh viên"
                  value="{{old('name', ($student->name) ?? '' )}}"
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
                <label for="" class="control-label text-right">Thuộc ngành <span class="text-danger">(*)</span></label>
                <select name="major_id" id="major_id" class="form-control setupSelect2">
                  <option value="" selected="selected">[Chọn ngành học]</option>
                  @foreach($majors as $major)
                    <option
                    {{
                      $major->id == old('major_id',
                      (isset($student->majors->id)) ?
                      $student->major_id : '') ? 'selected' : ''
                    }}
                    value="{{$major->id}}">{{ $major->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('major_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Niên khóa <span class="text-danger">(*)</span></label>
                <select name="school_year_id" id="school_year_id" class="form-control setupSelect2">
                  <option value="" selected="selected">[Chọn niên khóa]</option>
                  @foreach($schoolYears as $schoolYear)
                    <option
                    {{
                      $schoolYear->id == old('school_year_id',
                      (isset($student->school_years->id)) ?
                      $student->school_year_id : '') ? 'selected' : ''
                    }}
                    value="{{$schoolYear->id}}">{{ $schoolYear->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('school_year_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="row mb10">
            <div class="col-lg-6">
              <div class="form-row">
                <label fo="email" class="control-label text-right">Email <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="email"
                  name="email"
                  class="form-control"
                  placeholder="Nhập Email"
                  value="{{old('email', ($student->email) ?? '' )}}"
                >
              </div>
              @error('email')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Số điện thoại <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="phone"
                  name="phone"
                  class="form-control"
                  placeholder="Nhập số điện thoại"
                  value="{{old('phone', ($student->phone) ?? '' )}}"
                >
              </div>
              @error('phone')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="row mb10">
            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Ngày sinh <span class="text-danger">(*)</span></label>
                <input 
                  type="date"
                  id="birthday"
                  name="birthday"
                  class="form-control"
                  value="{{old('birthday', ($student->birthday) ?? '' )}}"
                >
              </div>
              @error('birthday')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-lg-6">
              <div class="form-row">
                <label fo="" class="control-label text-right">Địa chỉ <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="address"
                  name="address"
                  class="form-control"
                  placeholder="Nhập address"
                  value="{{old('address', ($student->address) ?? '' )}}"
                >
              </div>
              @error('address')
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
