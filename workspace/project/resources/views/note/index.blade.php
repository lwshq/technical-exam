@extends('layouts.main') 
@section('title', 'Notes')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
    @endpush

    <div id="note-page">
        <div class="container">

            <div class="row">
                <div class="page-header-title">
                    <h5>{{ __('Add Note')}}</h5>
                    <span>{{ __('Create new note')}}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <label for="note-title">Title</label>
                        <input type="input" class="form-control" id="note-title" placeholder="Enter Title here...">
                    </div>
                    <div class="form-group">
                        <label for="note">Note:</label>
                        <textarea class="form-control" id="note" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="submitBtn" style="margin-top: 15px;" class="btn btn-primary mb-2">Add Note</button>
                    </div>

                </form>
                </div>
            </div>

            <div class="row" style="margin-top: 30px;">
                <div class="col-md-12">
                    @if(count($notes) > 0)
                     @foreach ($notes as $note)
                        @if(!$note->is_deleted)
                        <div class="card w-100" style="margin-top: 10px;" id="note-{{$note->id}}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $note->title }}</h5>
                                <p class="card-text">{{ $note->note }}</p>
                                <i style="color: #6c757d;">{{ date_format($note->created_at, "g:ia \o\n l jS F Y") }}</i>
                                <p class="button-group">
                                    <a href="{{url('note/edit').'/'.$note->id}}">Edit</a>
                                    <a href="javasscript:void(0)" onclick="deleteNote({{$note->id}})">Delete</a>
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
