<div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr width="100%">
            <th width="50px;">STT</th>
            <th>Mã ngành</th>
            <th>Tên ngành</th>
            <th>Thời gian tạo</th>
            <th class="text-center">#</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $i = 1 ?>
          @foreach($departments as $department)
            <tr>
              <td class="text-center"><?php echo $i++?></td>
              <td>
                {{$department->code}}
              </td>
              <td>
                {{$department->name}}
              </td>
              <td>
                {{$department->start_time}}
              </td>
              <td class="text-center">
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="{{route('department.edit', $department->id)}}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{$department->id}}"><i class="bx bx-trash me-1"></i> Xóa</button>
                  </div>
                </div>
              </td>
            </tr>

            {{-- Modal Delete --}}
            <div class="modal fade" id="deleteModal{{$department->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h4>
                      </div>
                      <ul>
                          <li><strong>Họ tên: </strong>{{$department->name}}</li>
                      </ul>
                      <div class="modal-footer">
                          <a href="{{route('department.destroy', $department->id)}}" class="btn btn-small btn-danger">Xóa</a>
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
      {{ $departments->links() }}
    </div>
  </div>
</div>