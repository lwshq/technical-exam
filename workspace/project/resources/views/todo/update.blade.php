@extends('layouts.main') 
@section('title', 'Todos')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
    @endpush

    <div id="todo-edit-page">
        <div class="container">

            <div class="row">
                <div class="page-header-title">
                    <h5>{{ __('Edit To do')}}</h5>
                    <span>{{ __('Update new to do')}}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                <form>
                    <input type="text" id="todo-id" value="{{$res->id}}" hidden>
                    <div class="form-group">
                        <label for="todo">Title</label>
                        <input type="input" class="form-control" id="todo" value="{{$res->title}}" value placeholder="Enter what do you want to do...">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submitBtn" style="margin-top: 15px;" class="btn btn-primary mb-2">Add To Do</button>
                        <a href="{{url('/todos')}}" style="margin-top: 15px;" class="btn btn-secondary mb-2">Back</a>
                    </div>

                </form>
                </div>
            </div>

        </div>

    </div>  
    
    @push('script') 
    @endpush
@endsection
