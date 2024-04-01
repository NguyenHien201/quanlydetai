<div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr width="100%">
            <th width="50px;">STT</th>
            <th class="text-center">Tên niên khóa</th>
            <th class="text-center">Thời gian bắt đâu</th>
            <th class="text-center">Thời gian kết thúc</th>
            <th class="text-center">#</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php $i = 1 ?>
          @foreach($schoolYears as $schoolYear)
            <tr>
              <td class="text-center"><?php echo $i++?></td>
              <td class="text-center">
                {{$schoolYear->name}}
              </td>
              <td class="text-center">
                {{$schoolYear->start_date}}
              </td>
              <td class="text-center">
                {{$schoolYear->end_date}}
              </td>
              <td class="text-center">
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="{{route('school_year.edit', $schoolYear->id)}}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{$schoolYear->id}}"><i class="bx bx-trash me-1"></i> Xóa</button>
                  </div>
                </div>
              </td>
            </tr>

            {{-- Modal Delete --}}
            <div class="modal fade" id="deleteModal{{$schoolYear->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h4>
                      </div>
                      <ul>
                          <li><strong>name: </strong>{{$schoolYear->name}}</li>
                      </ul>
                      <div class="modal-footer">
                          <a href="{{route('school_year.destroy', $schoolYear->id)}}" class="btn btn-small btn-danger">Xóa</a>
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
      {{ $schoolYears->links() }}
    </div>
  </div>
</div>