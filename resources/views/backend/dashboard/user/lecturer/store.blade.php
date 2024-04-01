@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('backend.components.breadcrumb')

  @php
    $url = ($config['method'] == 'create') ? route('lecturer.store') : route('lecturer.update', $lecturer->id);
  @endphp

  <form action="{{$url}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb30">
      <div class="col-lg-5">
        <div class="panel-head">
          <div class="panel-title">Thông tin tài khoản</div>
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
                <label for="code" class="control-label text-right">Mã giảng viên <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="code"
                  name="code"
                  class="form-control"
                  placeholder="Nhập mã giảng viên"
                  value="{{old('code', ($lecturer->code) ?? '' )}}"
                >
              </div>
              @error('code')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-lg-6">
              <div class="form-row">
                <label for="name" class="control-label text-right">Tên giảng viên <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="name"
                  name="name"
                  class="form-control"
                  placeholder="Nhập mã giảng viên"
                  value="{{old('name', ($lecturer->name) ?? '' )}}"
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
                <label for="" class="control-label text-right">Chức vụ <span class="text-danger">(*)</span></label>
                <select name="position_id" id="position_id" class="form-control setupSelect2">
                  <option value="" selected="selected">[Chọn chức vụ]</option>
                  @foreach($positions as $position)
                    <option
                    {{
                      $position->id == old('position_id',
                      (isset($lecturer->departments->id)) ?
                      $lecturer->position_id : '') ? 'selected' : ''
                    }}
                    value="{{$position->id}}">{{ $position->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('position_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Thuộc khoa <span class="text-danger">(*)</span></label>
                <select name="department_id" id="department_id" class="form-control setupSelect2">
                  <option value="" selected="selected">[Chọn khoa]</option>
                  @foreach($departments as $department)
                    <option
                    {{
                      $department->id == old('department_id',
                      (isset($lecturer->departments->id)) ?
                      $lecturer->department_id : '') ? 'selected' : ''
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
                  value="{{old('email', ($lecturer->email) ?? '' )}}"
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
                  value="{{old('phone', ($lecturer->phone) ?? '' )}}"
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
                  value="{{old('birthday', ($lecturer->birthday) ?? '' )}}"
                >
              </div>
              @error('birthday')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Quyền <span class="text-danger">(*)</span></label>
                <select name="user_cataloge_id" id="user_cataloge_id" class="form-control setupSelect2">
                  <option value="" selected="selected">[Chọn quyền]</option>
                  @foreach(config('apps.general.roles') as $item)
                    @foreach($usercatalogues as $usercatalogue)
                      @if($usercatalogue->name == $item)
                        <option 
                        {{
                          $usercatalogue->id == old('user_cataloge_id',
                          (isset($lecturer->user_id)) ?
                          $lecturer->users->user_Catalogues->id : '') ? 'selected' : ''
                        }}
                        value="{{$usercatalogue->id}}">{{$usercatalogue->name}}</option>
                      @endif
                    @endforeach
                  @endforeach
                </select>
              </div>
              @error('department_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          
          </div>

          <div class="row mb10">
            <div class="col-lg-12">
              <div class="form-row">
                <label fo="" class="control-label text-right">Địa chỉ <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="address"
                  name="address"
                  class="form-control"
                  placeholder="Nhập address"
                  value="{{old('address', ($lecturer->address) ?? '' )}}"
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
