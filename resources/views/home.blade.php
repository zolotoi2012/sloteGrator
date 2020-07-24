@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('get-prize') }}" method="POST">
                @csrf
                <button style="position: relative; left: 50%; top: 50%;" type="submit" class="btn btn-primary">Get Prize!</button>
            </form>
        </div>
    </div>
</div>
@endsection
