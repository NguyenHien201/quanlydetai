<div class="card">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr width="100%">
          <th width="50px;">STT</th>
          <th>Tên giản viên</th>
          <th class="text-center">Tên sinh viên</th>
          <th class="text-center">#</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php $i = 1 ?>
        @foreach($lecturersArray as $value)
          <tr>
            <td class="text-center"><?php echo $i++?></td>
            <td>{{ $value->lecturer_name }}</td>
            <td>{{ $value->student_names }}</td>
            <td class="text-center">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu" style="">
                  <a class="dropdown-item" href="{{route('student_group.edit', $value->lecturer_id)}}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                  <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{$value->lecturer_id}}"><i class="bx bx-trash me-1"></i> Xóa</button>
                </div>
              </div>
            </td>
          </tr>

          {{-- Modal Delete --}}
          <div class="modal fade" id="deleteModal{{$value->lecturer_id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h4>
                    </div>
                    <ul>
                        <li><strong>Họ tên: </strong>{{ $value->lecturer_id }}</li>
                    </ul>
                    <div class="modal-footer">
                        <a href="{{route('student_group.destroy', $value->lecturer_id)}}" class="btn btn-small btn-danger">Xóa</a>
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
      {{-- {{ $studentGroups->links() }} --}}
    </div>
  </div>
</div>
