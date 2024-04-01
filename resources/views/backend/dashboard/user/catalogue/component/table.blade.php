<div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr width="100%">
            <th width="50px;">
              <input type="checkbox" value="" id="checkAll" class="form-check-input form-check-custom">
            </th>
            <th width="50px;">STT</th>
            <th>Tên nhóm quyền</th>
            <th class="text-center">Số thành viên</th>
            <th>Ghi chú</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">#</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $i = 1 ?>
          @foreach($userCatalogues as $userCatalogue)
            <tr>
              <td>
                <input type="checkbox" value="{{ $userCatalogue->id }}" class="form-check-input checkBoxItem">
              </td>
              <td class="text-center"><?php echo $i++?></td>
              <td>
                {{$userCatalogue->name}}
              </td>
              <td class="text-center">
                {{ $userCatalogue->users_count }}
              </td>
              <td>
                {{$userCatalogue->description}}
              </td>
              <td class="text-center">
                <div class="center">
                  <div class="form-check form-switch">
                      <input class="form-check-input status checkBoxSwitch-{{$userCatalogue->id}}" data-field="publish" data-model="UserCatalogue" data-modelId="{{$userCatalogue->id}}" value="{{$userCatalogue->publish}}" type="checkbox" {{($userCatalogue->publish == 2) ? 'checked' : ''}} />
                    </div>
                </div>
              </td>
              <td class="text-center">
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="{{route('userCatalogue.edit', $userCatalogue->id)}}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{$userCatalogue->id}}"><i class="bx bx-trash me-1"></i> Xóa</button>
                  </div>
                </div>
              </td>
            </tr>

            {{-- Modal Delete --}}
            <div class="modal fade" id="deleteModal{{$userCatalogue->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h4>
                      </div>
                      <ul>
                          <li><strong>Họ tên: </strong>{{$userCatalogue->name}}</li>
                      </ul>
                      <div class="modal-footer">
                          <a href="{{route('userCatalogue.destroy', $userCatalogue->id)}}" class="btn btn-small btn-danger">Xóa</a>
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
      {{ $userCatalogues->links() }}
    </div>
  </div>
</div>