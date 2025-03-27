@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

    @include('admin.pages.topbar')
    @include('admin.pages.sidebar')

    <div class="content">
        @yield('content')
    </div>

@endsection
