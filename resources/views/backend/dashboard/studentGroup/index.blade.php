@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
    @include('backend.components.breadcrumb')

    <!-- Basic Bootstrap Table -->
    @include('backend.dashboard.studentGroup.component.filter')
    @include('backend.dashboard.studentGroup.component.toolBox')
    @include('backend.dashboard.studentGroup.component.table')

    
</div>
@endsection