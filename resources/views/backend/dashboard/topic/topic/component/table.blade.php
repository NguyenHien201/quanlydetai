<div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th width="50px" class="text-center">STT</th>
            <th>Mã đề tài</th>
            <th>Tên đề tài</th>
            <th>Thuộc nhóm</th>
            <th>Ngành</th>
            <th>Niên khóa</th>
            <th class="text-center">#</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $i = 1 ?>
          @foreach($topics as $topic)
            <tr>
              <td class="text-center"><?php echo $i++?></td>
              <td>
                {{$topic->code}}
              </td>
              <td>
                {{$topic->name}}
              </td>
              <td>
                {{$topic->topic_catalogues->name}}
              </td>
              <td>
                {{$topic->majors->name}}
              </td>
              <td>
                {{$topic->school_years->name}}
              </td>
              <td class="text-center">
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="{{route('topic.edit', $topic->id)}}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{$topic->id}}"><i class="bx bx-trash me-1"></i> Xóa</button>
                  </div>
                </div>
              </td>
            </tr>

            {{-- Modal Delete --}}
            <div class="modal fade" id="deleteModal{{$topic->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h4>
                      </div>
                      <ul>
                          <li><strong>Họ tên: </strong>{{$topic->name}}</li>
                      </ul>
                      <div class="modal-footer">
                          <a href="{{route('topic.destroy', $topic->id)}}" class="btn btn-small btn-danger">Xóa</a>
                          <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</a>
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="pagination mt-4 pb-4">
      {{ $topics->links() }}
  </div>
</div>