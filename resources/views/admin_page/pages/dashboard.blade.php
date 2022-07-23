@extends('admin_page.masters.index')
@section('title')
   Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Dashboard</h5>
                <h6 class="card-subtitle text-muted">Dashboard</h6>
            </div>
            <div class="card-body">
                Ini Halaman Dashboard
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
