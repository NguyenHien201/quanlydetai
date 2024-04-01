<div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th width="50px" class="text-center">STT</th>
            {{-- <th>Ảnh đại diện</th> --}}
            <th>Mã giảng viên</th>
            <th>Tên giảng viên</th>
            <th>Chức vụ</th>
            <th>Thuộc khoa</th>
            <th>Quyền</th>
            <th class="text-center">#</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $i = 1 ?>
          @foreach($lecturers as $lecturer)
            <tr>
              <td class="text-center"><?php echo $i++?></td>
              {{-- <td>
                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lilian Fuller">
                    <img src="{{ asset('storage/' . $lecturer->avatar)}}" alt="Avatar" class="rounded-circle">
                  </li>
                </ul>
              </td> --}}
              <td>
                {{$lecturer->code}}
              </td>
              <td>
                {{$lecturer->name}}
              </td>
              <td>
                {{$lecturer->positions->name}}
              </td>
              <td>
                {{$lecturer->departments->name}}
              </td>
              <td>
                {{$lecturer->users->user_Catalogues->name}}
              </td>
              <td class="text-center">
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="{{route('lecturer.edit', $lecturer->id)}}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{$lecturer->id}}"><i class="bx bx-trash me-1"></i> Xóa</button>
                  </div>
                </div>
              </td>
            </tr>

            {{-- Modal Delete --}}
            <div class="modal fade" id="deleteModal{{$lecturer->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h4>
                      </div>
                      <ul>
                          <li><strong>Họ tên: </strong>{{$lecturer->name}}</li>
                      </ul>
                      <div class="modal-footer">
                          <a href="{{route('lecturer.destroy', $lecturer->id)}}" class="btn btn-small btn-danger">Xóa</a>
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
      {{ $lecturers->links() }}
  </div>
</div>