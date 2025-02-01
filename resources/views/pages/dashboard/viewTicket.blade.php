@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="loader"
            style="display: none; text-align: center; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="row mt-3">
            <a href="{{ route('dashboard') }}" class="text-decoration-none"><i class="bi bi-chevron-double-left"></i> back</a>
        </div>
        <div class="row p-3 border border-secondary-subtle rounded-3 mt-3 mb-3 mx-1">
            <div class="col-12">
                <label>Ref No: {{ $ticket->ref_no }}</label>
                <hr />
            </div>
            <div class="col-lg-4">
                <div class="row">

                    <div class="col-12">
                        <label>Customer Name</label>
                        <input type="text" class="form-control mt-1" placeholder="Name"
                            value="{{ $ticket->customer_name }}" name="name" id="name" disabled />
                    </div>

                    <div class="col-12 mt-2">
                        <label>Problem Description</label>
                        <textarea class="form-control mt-1" placeholder="Description" name="description" rows="4" style="resize: none;"
                            id="description" disabled>{{ $ticket->problem_description }}</textarea>
                    </div>

                    <div class="col-12 mt-2">
                        <label>Email</label>
                        <input type="email" class="form-control mt-1" placeholder="Email" value="{{ $ticket->email }}"
                            name="email" id="email" disabled />
                    </div>
                    <div class="col-12 mt-2">
                        <label>Phone Number</label>
                        <input type="text" class="form-control mt-1" placeholder="Phone Number"
                            value="{{ $ticket->phone_number }}" name="phone_number" id="phone_number" disabled />
                    </div>
                </div>
            </div>
            <div class="col-lg-8 border-start border-rep-box mt-2 mt-lg-0">
                <div class="row">
                    <form id="reply-form">
                        {{ csrf_field() }}
                        <div class="col-12">
                            <input type="hidden" class="form-control" id="postId" name="postId"
                                value='{{ $ticket->id }}'>
                            <label>Reply</label>
                            <textarea class="form-control mt-1" placeholder="Enter Reply" name="reply" rows="4" style="resize: none;"
                                id="reply"></textarea>
                            <div class="row print-error-msg4" style="display:none">
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-success px-4">Reply Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
