@extends('admin.layouts.master')
@section('title','Add job type')
@section('css')
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
@endsection
@section('content')
    <div class="mt-5">
        <div class="row">
            <div class="col-8 offset-2 pt-3 ">
                <div class="card my-5 ">
                    <div class="card-header bg-secondary text-light">
                        <h4>Add job type</h4>
                    </div>
        <div class="card-body">
            <form action="{{route('jobTypes.store')}}" method='post' enctype='multipart/form-data'>
                @csrf
                <div class="form-group mx-auto">
                    <input type="text" name='name' class="form-control admin-input  mx-auto @error('name') error @enderror" value="{{old('name')}}">
                    @error('name')
                    <li class="text-error">{{$message}}</li>
                    @enderror
                </div>

                <button class="btn btn-success" type='submit'>Add job type</button>
                <a class="btn btn-danger ml-2" href="{{route('jobTypes.index')}}">Cancel</a>

            </form>
        </div>
    </div>

            </div>
        </div>
@endsection
