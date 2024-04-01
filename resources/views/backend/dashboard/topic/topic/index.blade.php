@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
    @include('backend.components.breadcrumb')

    <!-- Basic Bootstrap Table -->
    @include('backend.dashboard.topic.topic.component.filter')
    @include('backend.dashboard.topic.topic.component.toolBox')
    @include('backend.dashboard.topic.topic.component.table')
  </div>
@endsection