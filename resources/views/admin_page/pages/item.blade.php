@extends('admin_page.masters.index')
@section('title')
    Tambah Tiket
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Tambah Tipe Tiket</h5>
                    <h6 class="card-subtitle text-muted">Masukkan tipe tiket anda disini</h6>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="selectTicketId">Nama Event</label>
                                <select class="form-control choices-single" id="selectTicketId" name="ticket_id">
                                    <optgroup label="Alaskan/Hawaiian Time Zone">
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="selectTicketType">Tipe Tiket</label>
                                <select class="form-control choices-single-type" id="selectTicketType" name="type_id">
                                    <optgroup label="Alaskan/Hawaiian Time Zone">
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="name">Nama Tiket</label>
                            <input type="text" class="form-control" id="name" placeholder="nama tiket , ex:vip jos"
                                name="name">
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="price">Harga Tiket</label>
                                <input type="text" class="form-control" id="price" placeholder="Harga Tiket"
                                    name="price">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="stock">Stok Tiket</label>
                                <input type="text" class="form-control" id="stock" placeholder="Stok Tiket"
                                    name="stock">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="fee">Admin Fee</label>
                                <input type="text" class="form-control" id="fee" placeholder="Stok Tiket"
                                    name="fee">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Deskripsi</label>
                            <textarea class="form-control" rows="4" id="description" placeholder="Deskripsi" name="description"></textarea>
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
                    <h5 class="card-title">Form Tambah Tipe Tiket</h5>
                    <h6 class="card-subtitle text-muted">Masukkan tipe tiket anda disini</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
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
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Tiket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3" >
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td>Nama Event </td>
                                <td>:</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Tipe Tiket </td>
                                <td>:</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Nama Tiket </td>
                                <td>:</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Stok</td>
                                <td>:</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Harga Tiket</td>
                                <td>:</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Admin Fee</td>
                                <td>:</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td style="width: 50%">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data Tiket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">

                        <div class="mb-1">
                            <label class="form-label" for="name">Nama Tiket</label>
                            <input type="text" class="form-control" id="name"
                                placeholder="nama tiket , ex:vip jos" name="name">
                        </div>
                        <div class="row">
                            <div class="mb-1 col-md-4">
                                <label class="form-label" for="price">Harga Tiket</label>
                                <input type="text" class="form-control" id="price" placeholder="Harga Tiket"
                                    name="price">
                            </div>
                            <div class="mb-1 col-md-4">
                                <label class="form-label" for="stock">Stok Tiket</label>
                                <input type="text" class="form-control" id="stock" placeholder="Stok Tiket"
                                    name="stock">
                            </div>
                            <div class="mb-1 col-md-4">
                                <label class="form-label" for="fee">Admin Fee</label>
                                <input type="text" class="form-control" id="fee" placeholder="Stok Tiket"
                                    name="fee">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Deskripsi</label>
                            <textarea class="form-control" rows="4" id="description" placeholder="Deskripsi" name="description"></textarea>
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
            new Choices(document.querySelector(".choices-single"));
            new Choices(document.querySelector(".choices-single-type"));
        });
    </script>
@endsection
