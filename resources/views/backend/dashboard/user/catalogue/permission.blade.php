@extends('admin.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
  @include('admin.components.breadcrumb')


  <form action="{{route('user.catalogue.updatePermission')}}" method="POST">
    @csrf
    <div class="row mb30">

        <div class="col-lg-12 card">
            <h5 class="card-header">Phân quyền</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <tr>
                        <th></th>
                        @foreach($userCatalogues as $userCatalogue)
                            <th class="text-center">{{$userCatalogue->name}}</th>
                        @endforeach
                    </tr>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <a href="" class="uk-flex uk-flex-middle uk-flex-space-between">
                                    {{$permission->name}} 
                                    <span style="color:red;">
                                        ({{$permission->canonical}})
                                    </span>
                                </a>
                            </td>
                            @foreach($userCatalogues as $userCatalogue)
                                <td class="text-center">
                                    <input
                                    {{
                                        (collect($userCatalogue->permissions)->contains
                                        ('id', $permission->id)) ? 'checked' : ''
                                    }}
                                    type="checkbox" name="permission[{{$userCatalogue->id}}][]" value="{{$permission->id}}" class="form-check-input">
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
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
