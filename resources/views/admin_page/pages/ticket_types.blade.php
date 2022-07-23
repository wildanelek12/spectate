@extends('admin_page.masters.index')
@section('title')
    Tambah Tipe Tiket
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Tipe Tiket</h5>
                    <h6 class="card-subtitle text-muted">Lihat tipe tiket anda disini</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width:50%;">Nama</th>
                                <th style="width:50%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Vanessa Tucker</td>
                                <td class="table-action">
                                    <a href="#"><i class="align-middle" data-feather="edit-2" data-bs-toggle="modal" data-bs-target="#updateModal"></i></a>
                                    <a href="#"><i class="align-middle" data-feather="trash" data-bs-toggle="modal" data-bs-target="#deleteModal"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Tambah Tipe Tiket</h5>
                    <h6 class="card-subtitle text-muted">Masukkan tipe tiket anda disini</h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label" for="inputEvent">Nama Event</label>
                            <input type="text" class="form-control" id="inputEvent" placeholder="event" name="name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data Tipe Tiket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="mb-3">
                            <label class="form-label" for="inputEvent">Nama Event</label>
                            <input type="text" class="form-control" id="inputEvent" placeholder="event" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Perhatian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <p class="mb-0">Apakah anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Save changes</button>
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
