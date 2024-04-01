@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
    @include('backend.components.breadcrumb')

    <!-- Basic Bootstrap Table -->
    @include('backend.dashboard.schoolYear.component.filter')
    @include('backend.dashboard.schoolYear.component.toolBox')
    @include('backend.dashboard.schoolYear.component.table')

    
</div>
@endsection