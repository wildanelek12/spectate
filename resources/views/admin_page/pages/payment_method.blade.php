@extends('admin_page.masters.index')
@section('title')
    Metode Pembayaran
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Metode Pembayaran</h5>
                    <h6 class="card-subtitle text-muted">Metode Pembayaran</h6>
                </div>
                <div class="card-body">
                    <form id="form-data">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="selectTicketId">Channel Code</label>
                                <input type="number" class="form-control"  placeholder="Channel Code"
                                name="channel_code">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" >Name</label>
                                <input type="text" class="form-control"  placeholder="Name"
                                name="name">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputState">Rate</label>
                            <select class="form-control" name="rate">
                                <option selected value="nominal">Nominal</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="price">Fee</label>
                                <input type="number" class="form-control"  placeholder="Fee"
                                    name="fee">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Category</label>
                                <select class="form-control" name="category">
                                    <option selected value="virtual_account">Virtual Account</option>
                                    <option value="retail_outlet">Retail Outlet</option>
                                    <option value="e-wallet">E-Wallet</option>
                                </select>
                            </div>
            
                        </div>
                        <div class="mb-3 ">
                            <label class="form-label">Is Visible</label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_visible" value="1" checked>
                                <span class="form-check-label">
                                    Yes
                                </span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inline-radios-example" value="2">
                                <span class="form-check-label">
                                    No
                                </span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Payment Method</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table-data">
                        <thead>
                            <tr>
                                <th>Nama Event</th>
                                <th>Tipe Tiket </th>
                                <th>Nama Tiket</th>
                                <th>Stok </th>
                                <th>Action </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Vanessa Tucker</td>
                                <td>Vanessa Tucker</td>
                                <td>Vanessa Tucker</td>
                                <td>Vanessa Tucker</td>
                                <td class="table-action">
                                    <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#detailModal"><i
                                            class="align-middle" data-feather="alert-circle"></i></a>
                                    <a href="#" class="me-2"><i class="align-middle" data-feather="edit-2"
                                            data-bs-toggle="modal" data-bs-target="#updateModal"></i></a>
                                    <a href="#" class="me-2"><i class="align-middle" data-feather="trash"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"></i></a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr(".flatpickr-datetime", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
        });
    </script>
@endsection
