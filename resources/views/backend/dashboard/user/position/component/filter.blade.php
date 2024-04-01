<form action="{{route('position.index')}}">
  <div class="ibox-content">
    <div class="filter-wrapper">
      <div class="uk-flex uk-flex-middle uk-flex-space-between">
        <div class="perpage">
          @php
            $perPage = request('perpage') ?: old('perpage');
          @endphp
          <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <select name="perpage" class="form-control input-ms perpage filter-wrapper mr10">
              @for($i = 5; $i <= 30; $i+=5)
                <option {{($perPage == $i) ? 'selected' : ''}}  value="{{$i}}"> {{$i}} Bản ghi</option>
              @endfor
            </select>
          </div>
        </div>

        <div class="action">
          <div class="uk-flex uk-flex-middle">
            <div class="uk-search uk-flex uk-fkex-middle mr10">
              <div class="input-group">
                <input 
                type="text"
                name="keyword"
                value="{{ request('keyword') ?: old('keyword') }}"
                placeholder="Tìm kiếm..."
                class="form-control">

              <span class="input-group-btn">
                <button 
                type="submit" 
                name="search" 
                value="search" 
                class="btn btn-primary mb0 btn-sm">Tìm kiếm</button>
              </span>
              </div>
            </div>
            <div class="uk-flex uk-flex-middle">
              <div class="create-btn">
                <a href="{{route('position.create')}}" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>