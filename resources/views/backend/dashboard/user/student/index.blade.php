@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
    @include('backend.components.breadcrumb')

    <!-- Basic Bootstrap Table -->
    @include('backend.dashboard.user.student.component.filter')
    @include('backend.dashboard.user.student.component.toolBox')
    @include('backend.dashboard.user.student.component.table')
  </div>
@endsection