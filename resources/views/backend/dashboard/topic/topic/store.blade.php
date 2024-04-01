@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('backend.components.breadcrumb')

  @php
    $url = ($config['method'] == 'create') ? route('topic.store') : route('topic.update', $topic->id);
  @endphp

  <form action="{{$url}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb30">
      <div class="col-lg-5">
        <div class="panel-head">
          <div class="panel-title">Thông tin đề tài</div>
          <div class="panel-description">
            <p>Nhập thông tin chung của đề tà<i></i></p>
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
                <label for="code" class="control-label text-right">Mã đề tài <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="code"
                  name="code"
                  class="form-control"
                  placeholder="Nhập mã đề tài"
                  value="{{old('code', ($topic->code) ?? '' )}}"
                >
              </div>
              @error('code')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-lg-6">
              <div class="form-row">
                <label for="name" class="control-label text-right">Tên đề tài <span class="text-danger">(*)</span></label>
                <input 
                  type="text"
                  id="name"
                  name="name"
                  class="form-control"
                  placeholder="Nhập mã đề tài"
                  value="{{old('name', ($topic->name) ?? '' )}}"
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
                <label for="" class="control-label text-right">Loại đề tài <span class="text-danger">(*)</span></label>
                <select name="topic_catalogue_id" id="topic_catalogue_id" class="form-control setupSelect2">
                  <option value="" selected="selected">[Chọn loại đề tài]</option>
                  @foreach($catalogues as $catalogue)
                    <option
                    {{
                      $catalogue->id == old('catalogue_id',
                      (isset($topic->topic_catalogues->id)) ?
                      $topic->topic_catalogue_id : '') ? 'selected' : ''
                    }}
                    value="{{$catalogue->id}}">{{ $catalogue->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('catalogue_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Thuộc ngành <span class="text-danger">(*)</span></label>
                <select name="major_id" id="major_id" class="form-control setupSelect2">
                  <option value="" selected="selected">[Chọn khoa]</option>
                  @foreach($majors as $major)
                    <option
                    {{
                      $major->id == old('major_id',
                      (isset($topic->majors->id)) ?
                      $topic->major_id : '') ? 'selected' : ''
                    }}
                    value="{{$major->id}}">{{ $major->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('major_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="row mb10">
            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Niên khóa <span class="text-danger">(*)</span></label>
                <select name="school_year_id" id="school_year_id" class="form-control setupSelect2">
                  <option value="" selected="selected">[Chọn niên khóa]</option>
                  @foreach($schoolYears as $schoolYear)
                    <option
                    {{
                      $schoolYear->id == old('school_year_id',
                      (isset($topic->school_years->id)) ?
                      $topic->school_year_id : '') ? 'selected' : ''
                    }}
                    value="{{$schoolYear->id}}">{{ $schoolYear->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('major_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Ngày bắt đầu làm <span class="text-danger">(*)</span></label>
                <input 
                  type="date"
                  id="start_date"
                  name="start_date"
                  class="form-control"
                  value="{{old('start_date', ($topic->start_date) ?? '' )}}"
                >
              </div>
              @error('start_date')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="row mb10">
            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Ngày hoàn thành <span class="text-danger">(*)</span></label>
                <input 
                  type="date"
                  id="complate_date"
                  name="complate_date"
                  class="form-control"
                  value="{{old('complate_date', ($topic->complate_date) ?? '' )}}"
                >
              </div>
              @error('complate_date')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Ngày nắt đầu đề tài <span class="text-danger">(*)</span></label>
                <input 
                  type="date"
                  id="topic_start_date"
                  name="topic_start_date"
                  class="form-control"
                  value="{{old('topic_start_date', ($topic->topic_start_date) ?? '' )}}"
                >
              </div>
              @error('topic_start_date')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="row mb10">
            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Ngày kết thúc đề tài <span class="text-danger">(*)</span></label>
                <input 
                  type="date"
                  id="topic_end_date"
                  name="topic_end_date"
                  class="form-control"
                  value="{{old('topic_end_date', ($topic->topic_end_date) ?? '' )}}"
                >
              </div>
              @error('topic_end_date')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-lg-6">
              <div class="form-row">
                <label for="" class="control-label text-right">Ghi chú <span class="text-danger"></span></label>
                <input 
                  type="text"
                  id="comment"
                  name="comment"
                  class="form-control"
                  value="{{old('comment', ($topic->comment) ?? '' )}}"
                >
              </div>
              @error('comment')
                <div class="text-danger">{{ $message }}</div>
              @enderror
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
</div>
@endsection
