@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
    @include('backend.components.breadcrumb')

    <!-- Basic Bootstrap Table -->
    @include('backend.dashboard.user.lecturer.component.filter')
    @include('backend.dashboard.user.lecturer.component.toolBox')
    @include('backend.dashboard.user.lecturer.component.table')
  </div>
@endsection