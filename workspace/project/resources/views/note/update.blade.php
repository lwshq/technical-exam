@extends('layouts.main') 
@section('title', 'Notes')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
    @endpush

    <div id="note-edit-page">
        <div class="container">

            <div class="row">
                <div class="page-header-title">
                    <h5>{{ __('Edit Note')}}</h5>
                    <span>{{ __('Update note')}}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                <form>
                    <input type="text" id="note-id" value="{{$res->id}}" hidden>
                    <div class="form-group">
                        <label for="note-title">Title</label>
                        <input type="input" class="form-control" id="note-title" placeholder="Enter Title here..." value="{{$res->title}}">
                    </div>
                    <div class="form-group">
                        <label for="note">Note:</label>
                        <textarea class="form-control" id="note" rows="3">{{$res->note}}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="submitBtn" style="margin-top: 15px;" class="btn btn-primary mb-2" >Update Note</button>
                        <a href="{{url('/notes')}}" style="margin-top: 15px;" class="btn btn-secondary mb-2">Back</a>
                    </div>

                </form>
                </div>
            </div>
        </div>



    </div>  
    
    @push('script') 
    @endpush
@endsection
