@extends('templates.layout')

@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <h1 class="mb-4">Verify Email</h1>
    <div class="container">
        <form action="/email/verification-notification" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Verify My Email</button>
        </form>
    </div>
</div>
@endSection