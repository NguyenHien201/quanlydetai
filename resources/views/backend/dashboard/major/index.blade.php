@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
    @include('backend.components.breadcrumb')

    <!-- Basic Bootstrap Table -->
    @include('backend.dashboard.major.component.filter')
    @include('backend.dashboard.major.component.toolBox')
    @include('backend.dashboard.major.component.table')

    
  </div>
@endsection