@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('backend.components.breadcrumb')

  @php
    $url = ($config['method'] == 'create') ? route('student_group.store') : route('student_group.update', $studentGroup->lecturer_id);
  @endphp

  <form action="{{$url}}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($config['method'] == 'edit')
      @method('PUT')
    @endif
    <div class="row mb30">
      <div class="col-lg-5">
        <div class="panel-head">
          <div class="panel-title">Thông tin nhóm sinh viên</div>
          <div class="panel-description">
            <p>Nhập thông tin liên quan đến nhóm sinh viên</p>
            <p>Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là trường bắt buộc</p>
          </div>
        </div>
      </div>

      <div class="col-lg-7 card">
        <div class="card-body">
          <div class="row mb10">
            <div class="col-lg-12">
              <div class="form-row">
                <label for="" class="control-label text-right">Giảng viên <span class="text-danger">(*)</span></label>
                <select name="lecturer_id" id="lecturer_id" class="form-control setupSelect2">
                  <option value="" selected="selected">[Chọn giảng viên]</option>
                  @foreach($lecturers as $lecturer)
                    @php
                      $isDisabled = isset($studentGroup) && $studentGroup->lecturer_id == $lecturer->id;
                    @endphp
                    <option value="{{$lecturer->id}}" {{ $isDisabled ? 'disabled' : '' }}>
                      {{ $lecturer->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              @error('lecturer_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="row mb10">
            <div class="col-lg-12">
              <div class="form-row">
                <label for="" class="control-label text-right">Sinh viên <span class="text-danger">(*)</span></label>
                <select multiple="multiple" name="student_id[]" id="" class="form-control setupSelect2">
                  @foreach($students as $student)
                    @if(isset($studentIds) && in_array($student->id, $studentIds))
                      <option value="{{$student->id}}" selected>{{ $student->name }}</option>
                    @else
                      <option value="{{$student->id}}">{{ $student->name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              @error('student_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
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
