@extends('layouts.main') 
@section('title', 'Notes')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
    @endpush

        <div class="container">
            <h1>Hi!</h1>
        </div>
    
    @push('script') 
    @endpush
@endsection
