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
                    <button type="button" class="btn btn-danger" id="btn-delete-ticket" data-bs-dismiss="modal">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var eventData = [];


        const setEvent = () => {
            let html = ''

            eventData[0].forEach((value, i) => {

                var name = "<td>" + value.name + "</td>"
                moment.utc('2019-11-03T05:00:00.000Z').format('MM/DD/YYYY')
                var expired_at = "<td>" + moment.utc(value.expired_at).format('MM/DD/YYYY') + "</td>"
                var editAct =
                    "<a href='#' class='me-3'><i class='align-middle' data-feather='edit-2' data-event-id='" +
                    value.id +
                    "' id='btn-edit-modal' data-bs-toggle='modal' data-bs-target='#updateModal'></i></a>"
                var deleteAct =
                    "<a href='#'><i class='align-middle' data-feather='trash' data-bs-toggle='modal' data-event-id='" +
                    value.id + "' id='btn-delete-modal' data-bs-target='#deleteModal'></i></a>"
                var actions = "<td class='table-action'>" + editAct + deleteAct + "</td> "

                html += '<tr data-ticket-id=' + value.id + '>' + name + expired_at + actions + '</tr>'


            })

            $('#table-event tbody').html(html)
            feather.replace();
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr(".flatpickr-datetime", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
        });
        $('#form-ticket').on('submit', function(e) {
            e.preventDefault()
            var formData = new FormData(document.querySelector('#form-ticket'))
            var settings = {
                "url": "http://127.0.0.1:8000/admin-api/v1/ticket",
                "method": "POST",
                "dataType": "json",
                "timeout": 0,
                "headers": {
                    "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
                },
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": formData
            };



            $.ajax(settings).done(function(response) {
                eventData[0].push(response.data)
                setEvent()
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
        //showData
        var settings = {
            "url": "http://127.0.0.1:8000/admin-api/v1/ticket",
            "method": "GET",
            "timeout": 0,
            "headers": {
                "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
            },
        };
        $.ajax(settings).done(function(response) {
            eventData.push(response.data.data)
            setEvent()

        });
    </script>
    <script>
        $(document).on('click', '#btn-edit-modal', function() {
            const id = $(this).data('event-id')
            const event = eventData[0].find(ticket => ticket.id == id)
            $('#updateModal #input-name-update').val(event.name)
            $('#updateModal #input-expired-update').val( moment.utc(event.expired_at).format('MM/DD/YYYY hh:mm'))
            $('#btn-update-modal').data('ticket-id', id)
        })
        $(document).on('click', '#btn-update-modal', function() {
            const id = $(this).data('ticket-id')
            const event = eventData[0].find(event => event.id == id)
            var formData = new FormData(document.querySelector('#form-ticket-update'))
   
            var settings = {
                "url": "http://127.0.0.1:8000/admin-api/v1/ticket/" + id,
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
                console.log(response);
                eventData[0] = eventData[0].map(v => {
                    if (JSON.stringify(v) === JSON.stringify(event)) {
                        return response.data
                    } else {
                        return v
                    }
                })
                setEvent()
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
    <script>
        //deleteData
        $(document).on('click', '#btn-delete-modal', function() {
            const id = $(this).data('event-id')


            $('#btn-delete-ticket').data('ticket-id', id)
        })
        $(document).on('click', '#btn-delete-ticket', function() {
            const id = $(this).data('ticket-id');
            var settings = {
                "url": "http://127.0.0.1:8000/admin-api/v1/ticket/" + id,
                "method": "DELETE",
                "timeout": 0,
                "dataType": "json",
                "headers": {
                    "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
                },
            };

            $.ajax(settings).done(function(response) {
                $(`#table-event tbody tr[data-ticket-id="${id}"]`).remove()
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
@endsection
