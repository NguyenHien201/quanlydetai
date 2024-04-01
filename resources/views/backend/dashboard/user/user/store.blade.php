@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('backend.components.breadcrumb')

  @php
    $url = ($config['method'] == 'create') ? route('user.store') : route('user.update', $user->id);
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
                <label for="username" class="control-label text-right">Tên tài khoản <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="username"
                  name="username"
                  class="form-control"
                  placeholder="Nhập tên tài khoản"
                  value="{{old('username', ($user->username) ?? '' )}}"
                >
              </div>
              @error('username')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Nhóm thành viên <span class="text-danger">(*)</span></label>
                <select name="user_catalogue_id" id="user_catalogue_id" class="form-control setupSelect2">
                  <option value="" selected="selected">[Chọn nhóm quyền]</option>
                  @foreach($user_catalogues as $user_catalogue)
                    <option
                    {{
                      $user_catalogue->id == old('user_catalogue_id',
                      (isset($user->user_catalogues->id)) ?
                      $user->user_catalogue_id : '') ? 'selected' : ''
                    }}
                    value="{{$user_catalogue->id}}">{{ $user_catalogue->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('user_catalogue_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          @if($config['method'] == 'create')
          <div class="row mb10">
            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Mật khẩu <span class="text-danger">(*)</span></label>
                <input 
                  type="password"
                  id="password"
                  name="password"
                  class="form-control"
                  placeholder="Nhập mật khẩu"
                  value=""
                  autocomplete="off"
                >
              </div>
              @error('password')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Nhập lại mật khẩu <span class="text-danger">(*)</span></label>
                <input 
                  type="password"
                  id=""
                  name="re_password"
                  class="form-control"
                  placeholder="Nhập Nhập lại mật khẩu"
                  value=""
                  autocomplete="off"
                >
              </div>
              @error('re_password')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          @endif

          <div class="row mb10">
            <div class="col-lg-12">
              <labe class="control-label" for="avatar">Ảnh đại diện <span class="text-danger"></span></label>
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                @if($config['method'] === 'edit')
                  @if($user->avatar == 'images/avatar/default.jpg')
                    src="{{asset('storage/images/avatar/default.jpg')}}"
                  @else
                  src="{{ asset('storage/' . $user->avatar) }}"
                  @endif
                @else
                  src="{{asset('storage/images/avatar/default.jpg')}}"
                @endif
                alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                <div class="button-wrapper">
                  <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Thay đổi ảnh</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input type="file" name="avatar" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                  </label>
                  <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                  </button>

                  <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                </div>
              </div>
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

  <script>
    var province_id = '{{ (isset($user->province_id)) ? $user->province_id : old('province_id') }}';
    var district_id = '{{ (isset($user->district_id)) ? $user->district_id : old('district_id') }}';
    var ward_id = '{{ (isset($user->ward_id)) ? $user->ward_id : old('ward_id') }}';
  </script>
</div>
@endsection
