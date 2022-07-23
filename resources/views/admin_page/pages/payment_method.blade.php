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
                Ini Halaman Metode Pembayaran
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
