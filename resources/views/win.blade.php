@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 style="left: 50%;">Congratulations! You won {{ $prize->name }}!</h1>

                @if ($amount > 0)
                    <h3>Your win is: {{ $amount }}</h3>
                    @if ($prize->name === 'Money')
                        <form action="{{ route('convert-money', $amount) }}">
                            <button style="position: relative; left: 50%; top: 50%;" type="submit" class="btn btn-primary">Convert Money to Bonus</button>
                        </form>
                    @endif
                @endif

                <form action="{{ route('cancel-prize', $prize) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Cancel Prize</button>
                </form>
            </div>
        </div>
    </div>
@endsection
