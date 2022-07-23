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
                <table class="table table-striped" >
                    <thead>
                        <tr>
                            <th >Nama</th>
                            <th >No Telp</th>
                            <th >Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Vanessa Tucker</td>
                            <td>Vanessa Tucker</td>
                            <td>Vanessa Tucker</td>
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
