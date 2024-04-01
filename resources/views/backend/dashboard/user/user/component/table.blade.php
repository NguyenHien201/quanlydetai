<div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th width="50px" class="text-center">
              <input type="checkbox" value="" id="checkAll" class="form-check-input form-check-custom">
            </th>
            <th width="50px" class="text-center">STT</th>
            <th>Ảnh đại diện</th>
            <th>Tên đăng nhập</th>
            <th>Nhóm quyền</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">#</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $i = 1 ?>
          @foreach($users as $user)
            <tr>
              <td>
                <input type="checkbox" value="{{ $user->id }}" class="form-check-input checkBoxItem">
              </td>
              <td class="text-center"><?php echo $i++?></td>
              <td>
                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lilian Fuller">
                    <img src="{{ asset('storage/' . $user->avatar)}}" alt="Avatar" class="rounded-circle">
                  </li>
                </ul>
              </td>
              <td>
                {{$user->username}}
              </td>
              <td>
                {{$user->user_Catalogues->name}}
              </td>
              <td class="text-center">
                <div class="center">
                  <div class="form-check form-switch">
                      <input class="form-check-input status checkBoxSwitch-{{$user->id}}" data-field="publish" data-model="User" data-modelId="{{$user->id}}" value="{{$user->publish}}" type="checkbox" {{($user->publish == 2) ? 'checked' : ''}} />
                    </div>
                </div>
              <td class="text-center">
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="{{route('user.edit', $user->id)}}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{$user->id}}"><i class="bx bx-trash me-1"></i> Xóa</button>
                  </div>
                </div>
              </td>
            </tr>

            {{-- Modal Delete --}}
            <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h4>
                      </div>
                      <ul>
                          <li><strong>Họ tên: </strong>{{$user->name}}</li>
                      </ul>
                      <div class="modal-footer">
                          <a href="{{route('user.destroy', $user->id)}}" class="btn btn-small btn-danger">Xóa</a>
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
      {{ $users->links() }}
  </div>
</div>