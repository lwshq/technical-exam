@extends('layouts.main') 
@section('title', 'Todos')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
    @endpush

    <div id="todo-page">
        <div class="container">

            <div class="row">
                <div class="page-header-title">
                    <h5>{{ __('Add To do')}}</h5>
                    <span>{{ __('Create new to do')}}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <label for="todo">Title</label>
                        <input type="input" class="form-control" id="todo" placeholder="Enter what do you want to do...">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submitBtn" style="margin-top: 15px;" class="btn btn-primary mb-2">Add To Do</button>
                    </div>

                </form>
                </div>
            </div>

            <div class="row" style="margin-top: 30px;">
                <div class="col-md-12">
                    @if(count($todos) > 0)
                     @foreach ($todos as $todo)
                        @if(!$todo->is_deleted)
                        <div class="card w-100" style="margin-top: 10px;" id="todo-{{$todo->id}}">
                            <div class="card-body">
                                <h5 class="card-title" id="done-todo-{{$todo->id}}" style=" {{ ($todo->is_done == 1) ? 'text-decoration: line-through' : '' }}" >{{ $todo->title }}</h5>
                                <p class="button-group">
                                    @if(!$todo->is_done)
                                    <a href="#" id="done-btn-{{$todo->id}}" onclick="toggleTodo({{$todo->id}})">Mark as done</a>
                                    @endif
                                    <a href="{{url('todo/edit').'/'.$todo->id}}">Edit</a>
                                    <a href="javasscript:void(0)" onclick="deleteTodo({{$todo->id}})">Delete</a>
                                </p>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    @endif
                </div>
            </div>

        </div>

    </div>  
    
    @push('script') 
    @endpush
@endsection
