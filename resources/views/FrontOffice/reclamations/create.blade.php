<!-- resources/views/reclamations/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create Reclamation</h1>
    <form action="{{ route('reclamations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
