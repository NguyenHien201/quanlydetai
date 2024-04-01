@extends('backend.layout')
@section('contents')
<div class="container-xxl flex-grow-1 container-p-y">
    @include('backend.components.breadcrumb')

    <!-- Basic Bootstrap Table -->
    @include('backend.dashboard.topic.catalogue.component.filter')
    @include('backend.dashboard.topic.catalogue.component.toolBox')
    @include('backend.dashboard.topic.catalogue.component.table')

    
</div>
@endsection