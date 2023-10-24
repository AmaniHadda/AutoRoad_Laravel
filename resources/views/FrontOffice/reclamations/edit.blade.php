<!-- resources/views/reclamations/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Reclamation</h1>
    <form action="{{ route('reclamations.update', $reclamation) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $reclamation->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $reclamation->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
