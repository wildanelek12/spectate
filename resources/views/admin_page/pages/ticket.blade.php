@extends('admin_page.masters.index')
@section('title')
    Tambah Event
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Event</h5>
                    <h6 class="card-subtitle text-muted">Lihat event anda disini</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table-event">
                        <thead>
                            <tr>
                                <th style="width:40%;">Nama</th>
                                <th style="width:25%;">Expired At</th>
                                <th style="width:35%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-sm" id="paginate">
       
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Tambah Event</h5>
                    <h6 class="card-subtitle text-muted">Masukkan Event anda disini</h6>
                </div>
                <div class="card-body">
                    <form id="form-ticket">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="inputEvent">Nama Event</label>
                            <input type="text" class="form-control" id="inputEvent" placeholder="event" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kadaluarsa</label>
                            <input type="text" class="form-control flatpickr-datetime" placeholder="Select date.."
                                name="expired_at" />
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
                <form id="form-ticket-update">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data Tiket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">

                        <div class="mb-3">
                            <label class="form-label" for="inputEvent">Nama Event</label>
                            <input type="text" class="form-control" placeholder="event" name="name"
                                id="input-name-update">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kadaluarsa</label>
                            <input type="text" class="form-control flatpickr-datetime" placeholder="Select date.."
                                id="input-expired-update" name="expired_at" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-update-modal" data-bs-dismiss="modal">Save
                            changes</button>
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
                    <button type="button" class="btn btn-danger" id="btn-delete-ticket" data-bs-dismiss="modal">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-js')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/helper.js') }}"></script>
    <script src="{{ asset('js/admin/ticket.js') }}"></script>
@endpush
