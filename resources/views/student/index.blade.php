@extends('layouts.app')

@section('content')
<div>
    <livewire:student-wire>
</div>

@endsection

@section('script')

<script>
    window.addEventListener('close-modal', event => {
        $('#addStudentModal').modal('hide');
        $('#editStudentModal').modal('hide');
        $('#deleteStudentModal').modal('hide');
    })
</script>
    
@endsection