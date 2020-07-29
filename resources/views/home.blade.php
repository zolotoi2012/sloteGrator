@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('get-prize') }}" method="POST">
                @csrf
                <button style="position: relative; left: 50%; top: 50%;" type="submit" class="btn btn-primary">Get Prize!</button>
            </form>

            @if (isset($user))
                <p>Your balance: {{ $user->balance }}</p>
                <p>Your bonus: {{ $user->bonus_count }}</p>
            @endif
        </div>
    </div>
</div>
@endsection
