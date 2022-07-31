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
                    <form id="form-data">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="selectTicketId">Nama Event</label>
                                <select class="form-control choices-single" id="selectTicketId" name="ticket_id">

                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="selectTicketType">Tipe Tiket</label>
                                <select class="form-control choices-single-type" id="selectTicketType" name="type_id">

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
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Tiket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td>Nama Event </td>
                                <td>:</td>
                                <td id="detail-ticket">2</td>
                            </tr>
                            <tr>
                                <td>Tipe Tiket </td>
                                <td>:</td>
                                <td id="detail-type">2</td>
                            </tr>
                            <tr>
                                <td>Nama Tiket </td>
                                <td>:</td>
                                <td id="detail-name">2</td>
                            </tr>
                            <tr>
                                <td>Stok</td>
                                <td>:</td>
                                <td id="detail-stock">2</td>
                            </tr>
                            <tr>
                                <td>Harga Tiket</td>
                                <td>:</td>
                                <td id="detail-price">2</td>
                            </tr>
                            <tr>
                                <td>Admin Fee</td>
                                <td>:</td>
                                <td id="detail-fee">2</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>

                                <td id="detail-desc" style="width: 50%">2</td>
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
                <form id="form-data-update">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Data Tiket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">

                        <div class="mb-1">
                            <label class="form-label" for="name">Nama Tiket</label>
                            <input type="text" class="form-control" id="input-name-update"
                                placeholder="nama tiket , ex:vip jos" name="name">
                        </div>
                        <div class="row">
                            <div class="mb-1 col-md-4">
                                <label class="form-label" for="price">Harga Tiket</label>
                                <input type="text" class="form-control" id="input-price-update"
                                    placeholder="Harga Tiket" name="price">
                            </div>
                            <div class="mb-1 col-md-4">
                                <label class="form-label" for="stock">Stok Tiket</label>
                                <input type="text" class="form-control" id="input-stock-update"
                                    placeholder="Stok Tiket" name="stock">
                            </div>

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Deskripsi</label>
                            <textarea class="form-control" rows="4" id="input-description-update" placeholder="Deskripsi"
                                name="description"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-update-modal"
                            data-bs-dismiss="modal">Save changes</button>
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
            // var settings = {
            //     "url": "http://127.0.0.1:8000/admin-api/v1/ticket",
            //     "method": "GET",
            //     "timeout": 0,
            //     "headers": {
            //         "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
            //     },
            // };
            // $.ajax(settings).done(function({data}) {
            //     let choices_ticket = new Choices(document.querySelector("#selectTicketId"), {searchFloor: 3, searchResultLimit: 15, renderChoiceLimit: 3});
            //     choices_ticket.setValue(data.map(function (v) {
            //         return {value: v.id, label: v.name}
            //     }))
            // });

            var config = {
                searchResultLimit: 15
            };

            var select = document.getElementById('selectTicketId');
            var choice = new Choices(select, config);
            
            choice.setChoices(function() {
                return fetch(
                    'http://127.0.0.1:8000/admin-api/v1/ticket'
                )
                .then(function(response) {
                    return response.json();
                })
                .then(function({data}) {
                    return data.map(function(v) {
                        return {value: v.id, label: v.name};
                    });
                });
            })

            var choices_type = new Choices(document.querySelector("#selectTicketType"));
            var settings = {
                "url": "http://127.0.0.1:8000/admin-api/v1/type",
                "method": "GET",
                "timeout": 0,
                "headers": {
                    "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
                },
            };
            $.ajax(settings).done(function(response) {
                var htmlSelect;
                var myDynamicItems = [];
                dataType = response.data.data;
                dataType.forEach((value, i) => {
                    myDynamicItems[i] = {
                        value: value.id,
                        label: value.name,
                        id: value.id
                    };
                });

                choices_type.setValue(myDynamicItems)

            });
        });
    </script>
    <script>
        var dataList = [];
        const setData = () => {
            let html = ''
            dataList[0].forEach((value, i) => {

                var ticket_name = "<td>" + value.ticket_name + "</td>"
                var type_name = "<td>" + value.type_name + "</td>"
                var name = "<td>" + value.name + "</td>"
                var stock = "<td>" + value.stock + "</td>"
                var editAct =
                    "<a href='#' class='me-3'><i class='align-middle' data-feather='edit-2' data-data-id='" +
                    value.id +
                    "' id='btn-edit-modal' data-bs-toggle='modal' data-bs-target='#updateModal'></i></a>"
                var deleteAct =
                    "<a href='#'><i class='align-middle me-2' data-feather='trash' data-bs-toggle='modal' data-data-id='" +
                    value.id + "' id='btn-delete-modal' data-bs-target='#deleteModal'></i></a>"
                var detailAct =
                    "      <a href='#'  data-bs-toggle='modal' data-bs-target='#detailModal' data-data-id='" +
                    value.id +
                    "' id='btn-detail-modal'><i class='align-middle' data-feather='alert-circle'></i></a>"
                var actions = "<td class='table-action'>" + editAct + deleteAct + detailAct + "</td> "

                html += '<tr data-data-id=' + value.id + '>' + ticket_name + type_name + name + stock +
                    actions + '</tr>'


            })

            $('#table-data tbody').html(html)
            feather.replace();
        }
        var settings = {
            "url": "http://127.0.0.1:8000/admin-api/v1/item",
            "method": "GET",
            "timeout": 0,
            "headers": {
                "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
            },
        };
        $.ajax(settings).done(function(response) {
            dataList.push(response.data.data)
            console.log(response.data.data);
            setData()
        });

        $(document).on('click', '#btn-detail-modal', function() {
            const id = $(this).data('data-id')
            var settings = {
                "url": "http://127.0.0.1:8000/admin-api/v1/item/19",
                "method": "GET",
                "timeout": 0,
                "dataType": "json",
                "headers": {
                    "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
                },
            };

            $.ajax(settings).done(function(response) {
                console.log(response.data);
                $('#detail-ticket').html(response.data.ticket_type.ticket.name)
                $('#detail-type').html(response.data.ticket_type.type.name)
                $('#detail-name').html(response.data.name)
                $('#detail-stock').html(response.data.stock)
                $('#detail-price').html(response.data.price)
                $('#detail-desc').html(response.data.description)
            });
        })
    </script>
    <script>
        $('#form-data').on('submit', function(e) {
            e.preventDefault()
            var formData = new FormData(document.querySelector('#form-data'))
            formData.append("status", "1");
            var settings = {
                "url": "http://127.0.0.1:8000/admin-api/v1/item",
                "method": "POST",
                "timeout": 0,
                "dataType": "json",
                "headers": {
                    "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
                },
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "beforeSend": function() {
                    var form = new FormData();
                    form.append("ticket_id", formData.get('ticket_id'));
                    form.append("type_id", formData.get('type_id'));

                    var settings = {
                        "url": "http://127.0.0.1:8000/admin-api/v1/ticket-type",
                        "method": "POST",
                        "timeout": 0,
                        "headers": {
                            "x-api-key": "UqK3adl3ZOGTiEMxpQPhovMY26ir3R6D26XY2fcqBe7usjkXsXOuchu3HI3CasQtD3LIArMvCxNaUAaBdW3orvOA1iYmyFVqw2h3"
                        },
                        "processData": false,
                        "mimeType": "multipart/form-data",
                        "contentType": false,
                        "data": form
                    };

                    $.ajax(settings).done(function(response) {
                        $('#form-data')[0].reset();
                    });
                },
                "data": formData
            };

            $.ajax(settings).done(function(response) {
                dataList[0].push(response.data)
                console.log(response.data);
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


            $('#btn-delete-data').data('data-id', id)
        })
        $(document).on('click', '#btn-delete-data', function() {
            const id = $(this).data('data-id');
            var settings = {
                "url": "http://127.0.0.1:8000/admin-api/v1/item/" + id,
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
            $('#updateModal #input-price-update').val(data.price)
            $('#updateModal #input-stock-update').val(data.stock)
            $('#updateModal #input-fee-update').val(data.fee)
            $('#updateModal #input-description-update').val(data.description)

            $('#btn-update-modal').data('data-id', id)
        })

        $(document).on('click', '#btn-update-modal', function() {
            const id = $(this).data('data-id')
            const data = dataList[0].find(data => data.id == id)
            var formData = new FormData(document.querySelector('#form-data-update'))

            var settings = {
                "url": "http://127.0.0.1:8000/admin-api/v1/item/" + id,
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
        })
    </script>
@endsection
