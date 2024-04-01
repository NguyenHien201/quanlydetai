@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
    @include('backend.components.breadcrumb')

    <!-- Basic Bootstrap Table -->
    @include('backend.dashboard.department.component.filter')
    @include('backend.dashboard.department.component.toolBox')
    @include('backend.dashboard.department.component.table')

    
</div>
@endsection