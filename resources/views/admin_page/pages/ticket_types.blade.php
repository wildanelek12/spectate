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
                    <table class="table table-striped" id="table-data">
                        <thead>
                            <tr>
                                <th style="width:50%;">Nama</th>
                                <th style="width:50%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

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
                    <form id="form-data">
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
                <form id="form-data-update">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data Tipe Tiket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="mb-3">
                            <label class="form-label" for="inputEvent">Nama Tipe Tiket</label>
                            <input type="text" class="form-control" placeholder="Tipe Tiket" name="name"
                                id="input-name-update">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-update-modal" data-bs-dismiss="modal">Save changes</button>
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
                    <button type="button" class="btn btn-danger" id="btn-delete-data" data-bs-dismiss="modal">Save
                        changes</button>
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
    <script>
        var dataList = [];


        const setData = () => {
            let html = ''

            dataList[0].forEach((value, i) => {

                var name = "<td>" + value.name + "</td>"

                var editAct =
                    "<a href='#' class='me-3'><i class='align-middle' data-feather='edit-2' data-data-id='" +
                    value.id +
                    "' id='btn-edit-modal' data-bs-toggle='modal' data-bs-target='#updateModal'></i></a>"
                var deleteAct =
                    "<a href='#'><i class='align-middle' data-feather='trash' data-bs-toggle='modal' data-data-id='" +
                    value.id + "' id='btn-delete-modal' data-bs-target='#deleteModal'></i></a>"
                var actions = "<td class='table-action'>" + editAct + deleteAct + "</td> "

                html += '<tr data-data-id=' + value.id + '>' + name + actions + '</tr>'


            })

            $('#table-data tbody').html(html)
            feather.replace();
        }
        var settings = {
            "url": "http://127.0.0.1:8000/admin-api/v1/type",
            "method": "GET",
            "timeout": 0,
            "headers": {
                "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
            },
        };
        $.ajax(settings).done(function(response) {
            dataList.push(response.data.data)
            setData()
        });
    </script>
    <script>
        $('#form-data').on('submit', function(e) {
            e.preventDefault()
            var formData = new FormData(document.querySelector('#form-data'))
            var settings = {
                "url": "http://127.0.0.1:8000/admin-api/v1/type",
                "method": "POST",
                "timeout": 0,
                "dataType": "json",
                "headers": {
                    "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
                },
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": formData
            };

            $.ajax(settings).done(function(response) {
                dataList[0].push(response.data)
                setData()
                var message = "Tambah Event Sukses";
                var type = 'default';
                var duration = 5000;
                var dismissible = 'Dismissible';
                var positionX = 'right';
                var positionY = 'top';
                window.notyf.open({
                    type,
                    message,
                    duration,
                    dismissible,
                    position: {
                        x: positionX,
                        y: positionY
                    }
                });
            }).fail(function(response) {
                var message = JSON.parse(response.responseText).message;
                var type = 'danger';
                var duration = 5000;
                var dismissible = 'Dismissible';
                var positionX = 'right';
                var positionY = 'top';
                window.notyf.open({
                    type,
                    message,
                    duration,
                    dismissible,
                    position: {
                        x: positionX,
                        y: positionY
                    }
                });
            });
        });
    </script>
    <script>
        $(document).on('click', '#btn-delete-modal', function() {
            const id = $(this).data('data-id')
            console.log(id);

            $('#btn-delete-data').data('data-id', id)
        })
        $(document).on('click', '#btn-delete-data', function() {
            const id = $(this).data('data-id');
            var settings = {
                "url": "http://127.0.0.1:8000/admin-api/v1/type/" + id,
                "method": "DELETE",
                "timeout": 0,
                "dataType": "json",
                "headers": {
                    "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
                },
            };

            $.ajax(settings).done(function(response) {
                $(`#table-data tbody tr[data-data-id="${id}"]`).remove()
                var message = response.message;
                var type = 'default';
                var duration = 5000;
                var dismissible = 'Dismissible';
                var positionX = 'right';
                var positionY = 'top';
                window.notyf.open({
                    type,
                    message,
                    duration,
                    dismissible,
                    position: {
                        x: positionX,
                        y: positionY
                    }
                });
            });
        })
    </script>
    <script>
        $(document).on('click', '#btn-edit-modal', function() {
            const id = $(this).data('data-id')
            const data = dataList[0].find(data => data.id == id)
            $('#updateModal #input-name-update').val(data.name)
            $('#btn-update-modal').data('data-id', id)
        })

        $(document).on('click', '#btn-update-modal', function() {
            const id = $(this).data('data-id')
            const data = dataList[0].find(data => data.id == id)
            var formData = new FormData(document.querySelector('#form-data-update'))

            var settings = {
                "url": "http://127.0.0.1:8000/admin-api/v1/type/" + id,
                "method": "POST",
                "timeout": 0,
                "dataType": "json",
                "headers": {
                    "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
                },
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,

                "data": formData
            };

            $.ajax(settings).done(function(response) {
                dataList[0] = dataList[0].map(v => {
                    if (JSON.stringify(v) === JSON.stringify(data)) {
                        return response.data
                    } else {
                        return v
                    }
                })
                setData()
                var message = response.message;
                var type = 'success';
                var duration = 5000;
                var dismissible = 'Dismissible';
                var positionX = 'right';
                var positionY = 'top';
                window.notyf.open({
                    type,
                    message,
                    duration,
                    dismissible,
                    position: {
                        x: positionX,
                        y: positionY
                    }
                });

            });
        })
    </script>
@endsection
