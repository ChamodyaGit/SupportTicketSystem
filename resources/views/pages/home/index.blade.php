@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="loader"
            style="display: none; text-align: center; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="row mt-3 mt-lg-5 mb-3 mx-1">

            <div class="col-12 col-lg-7">
                <div class="row p-3 p-md-4 border border-5 border-white rounded-4 bg-body-secondary">
                    <div class="col-12 col-md-6 mb-3 text-center text-md-start">
                        <span class="text-black fs-5 text-black-50">Create New Ticket</span>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="input-group mb-3">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="text" class="form-control" placeholder="Search by Ref No" id="typeRefNo" name="typeRefNo" aria-describedby="btnSearch">
                            <button type="button" class="btn btn-outline-secondary bg-success text-black" type="button"
                                id="btnSearch" name="btnSearch">Search</button>
                        </div>
                    </div>
                    <hr />

                    <div class="col-12 mb-1">
                        <span class="text-black fs-6 text-black-50">Fill all details for open a new ticket</span>
                    </div>
                    <form class="form-horizontal" id="ticket_form" name="ticket_form">
                        {{ csrf_field() }}
                        <div class="col-12 mt-1">
                            <label class="text-black">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control mt-1" placeholder="Enter Name" name="name"
                                id="name" />
                            <div class="row print-error-msg1" style="display:none">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <label class="text-black">Problem Description <span class="text-danger">*</span></label>
                            <textarea class="form-control mt-1" placeholder="Enter your problem" name="description" rows="4" style="resize: none;"
                                id="description"></textarea>
                            <div class="row print-error-msg2" style="display:none">
                                <span class="text-danger"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6 mt-3">
                                <label class="text-black">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control mt-1" placeholder="Enter Email" name="email"
                                    id="email" />
                                <div class="row print-error-msg2" style="display:none">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mt-3">
                                <label class="text-black">Phone Number (Optional)</label>
                                <input type="text" class="form-control mt-1" placeholder="Enter Phone Number"
                                    name="phone_number" id="phone_number" />
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-success px-4">Send</button>
                            <button type="button" class="btn btn-warning px-4" id="btnClear"
                                name="btnClear">Clear</button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="row p-3 p-md-4 pt-3 border border-5 border-white rounded-4 bg-body-secondary h-100">
                    <div class="col-12">
                        <label class="fs-5">Status: <strong id="statusText"></strong></label>
                    </div>

                    <div class="col-12">
                        <label class="text-black">Reply</label>
                        <textarea class="form-control mt-1" placeholder="The reply is loaded here..." name="reply" rows="15"
                            style="resize: none;" id="reply" readonly></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
