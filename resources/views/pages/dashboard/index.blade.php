@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mt-3">
            <div class="col-12 col-md-6 col-lg-4 d-flex">
                <input type="text" class="form-control" placeholder="Search by Customer Name" name="textCustomerName"
                    id="textCustomerName" />
                <button type="submit" class="btn btn-primary ms-2" name="btnSearch" id="btnSearch">Filter</button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 py-4 d-none d-md-block table-responsive">

                <table id="tickets-table" class="table table-success table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Ref No</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col"></th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="ticketBody">

                    </tbody>
                </table>

            </div>

            <div class="col-lg-12 py-4 d-block d-md-none">
                <div id="ticketBodyMobile">

                </div>
            </div>

            <span id="pagination"></span>
            
        </div>
    </div>
@endsection
