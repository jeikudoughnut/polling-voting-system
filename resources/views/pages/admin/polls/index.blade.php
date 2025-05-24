@extends('layouts.app')

@section('title', 'Poll Management')

@section('content')

<script>
    // Redirect to admin dashboard with poll management tab
    window.location.href = "{{ route('admin.dashboard') }}?page=poll-management";
</script>

@endsection 