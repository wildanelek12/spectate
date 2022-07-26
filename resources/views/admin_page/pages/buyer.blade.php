@extends('admin_page.masters.index')
@section('title')
    Pembeli
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Pembeli</h5>
                    <h6 class="card-subtitle text-muted">Lihat data pembeli disini</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>No Telp</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>

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
            "url": "http://127.0.0.1:8000/admin-api/v1/buyer",
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
@endsection
