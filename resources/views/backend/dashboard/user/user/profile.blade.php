@extends('admin.main')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Forms/</span> Vertical Layouts</h4>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
          <li class="breadcrumb-item">
            <a href="javascript:void(0);">Home</a>
          </li>
          <li class="breadcrumb-item">
            <a href="javascript:void(0);">Library</a>
          </li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-80 center">
                <img class="card-img-top width" src="{{asset('storage/images/avatar/' . $user->avatar)}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><strong>{{$user->name}}</strong></h5>
                    <h5 class="card-title">{{$user->roleName}}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 mb-4">
            <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="false">
                Thông tin
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                Thay đổi
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="true">
                Đổi mật khẩu
                </button>
            </li>
            </ul>
            <div class="tab-content b-white">
            <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                <h5><strong>Lưu ý</strong></h5>
                <p class="fst-italic">
                Những thông tin sau sẽ được cập nhật tự động từ website, vui lòng chỉ chỉnh sửa các thông tin cần thiết
                </p>
                <div class="mt-4">
                    <h5><strong>Thông tin tài khoản</strong></h5>
                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label ">Họ và Tên</div>
                        <div class="col-lg-9 col-md-8">{{$user->name}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label ">Email</div>
                        <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label ">Số điện thoại</div>
                        <div class="col-lg-9 col-md-8">{{$user->phone}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label ">Địa chỉ</div>
                        <div class="col-lg-9 col-md-8">{{$user->address}}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label ">Trạng thái</div>
                        @if($user->active)
                            <div class="col-lg-9 col-md-8"><span class="badge bg-label-primary">Hoạt động</span></div>
                        @else
                        <div class="col-lg-9 col-md-8"><span class="badge bg-label-danger">Không hoạt động</span></div>
                        @endif
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-3 col-md-4 label ">Chức danh</div>
                        <div class="col-lg-9 col-md-8">{{$user->roleName}}</div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                <form action="{{route('suathongtin', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('storage/images/avatar/' . $user->avatar) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
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

                    <div class="mb-3">
                      <label class="form-label" for="basic-icon-default-fullname">Họ tên</label>
                      <div class="input-group input-group-merge">
                        <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                        <input value="{{$user->name}}" type="text" class="form-control" name="name" id="basic-icon-default-fullname" placeholder="Nhập tên" aria-describedby="basic-icon-default-fullname2">
                      </div>
                      @error('name')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="basic-icon-default-email">Email</label>
                      <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                        <input value="{{$user->email}}" type="text" id="basic-icon-default-email" name="email" class="form-control" placeholder="Nhập email" aria-describedby="basic-icon-default-email2">
                        <span id="basic-icon-default-email2" class="input-group-text">@gmail.com</span>
                      </div>
                      @error('email')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="basic-icon-default-phone">Điện thoại</label>
                      <div class="input-group input-group-merge">
                        <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                        <input value="{{$user->phone}}" type="text" id="basic-icon-default-phone" name="phone" class="form-control phone-mask" placeholder="0344375645" aria-label="0344375645" aria-describedby="basic-icon-default-phone2">
                      </div>
                      @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="basic-icon-default-company">Địa chỉ</label>
                      <div class="input-group input-group-merge">
                        <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                        <input value="{{$user->address}}" type="text" id="basic-icon-default-company" name="address" class="form-control" placeholder="Nhập địa chỉ" aria-label="Nhập địa chỉ" aria-describedby="basic-icon-default-company2">
                      </div>
                      @error('address')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">Lưu thay đổi</button>
                    </div>
                  </form>
            </div>
            <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                <h5><strong>Lưu ý</strong></h5>
                <p class="fst-italic">
                    Hãy ghi nhớ chắc chắn mật khẩu mới của bạn sau khi thực hiện đổi!
                </p>
                <div class="mt-4">
                    <h5><strong>Đổi mật khẩu</strong></h5>
                    <form action="{{route('doimatkhau', $user->id)}}" method="POST">
                        @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-phone">Mật khẩu cũ</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-password" class="input-group-text"><i class='bx bx-lock-alt'></i></span>
                          <input type="password" id="basic-icon-default-password" name="password" class="form-control password-mask" placeholder="Nhập mật khẩu" aria-label="Nhập mật khẩu " aria-describedby="basic-icon-default-password2">
                        </div>
                        @error('password')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-phone">Mật khẩu mới</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-password" class="input-group-text"><i class='bx bx-lock-alt'></i></span>
                          <input type="password" id="basic-icon-default-password" name="newPassword" class="form-control password-mask" placeholder="Nhập mật khẩu" aria-label="Nhập mật khẩu " aria-describedby="basic-icon-default-password2">
                        </div>
                        @error('newPassword')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-phone">Nhập lại mật khẩu</label>
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-password" class="input-group-text"><i class='bx bx-lock-alt'></i></span>
                          <input type="password" id="basic-icon-default-password" name="newPassword_confirmation" class="form-control password-mask" placeholder="Nhập mật khẩu" aria-label="Nhập mật khẩu " aria-describedby="basic-icon-default-password2">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">Lưu thay đổi</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
            </div>
        </div> 
    </div>
</div>
@endsection