<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/payment.css') }}">
</head>

<body>
    <div class="container">
        <div class="row m-0">
            <div class="col-md-7 col-12">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="row box-right">
                            <div class="col-md-8 ps-0 ">
                                <p class="ps-3 textmuted fw-bold h6 mb-0">Total Pembayaran</p>
                                <p class="h1 fw-bold d-flex"> <span
                                        class=" fas  textmuted pe-1 h6 align-text-top mt-1"></span>Rp.84,254 </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-0">
                        <div class="box-right">
                            <div class="d-flex mb-2">
                                <p class="fw-bold">Isikan Data Diri</p>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <p class="textmuted h8">Nama Lengkap</p> <input class="form-control" type="text"
                                        placeholder="Nama Lengkap ex : Wildan Romiza F">
                                </div>
                                <div class="col-6">
                                    <p class="textmuted h8">Phone</p> <input class="form-control" type="number"
                                        placeholder="+6281231212121">
                                </div>
                                <div class="col-6">
                                    <p class="textmuted h8">Email</p> <input class="form-control" type="email"
                                        placeholder="wildan.steve@yahut.com">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" id="container-input">

            </div>

            <script>
                let items = []

                $(document).on('click', '#add-item', function() {
                    let id = $('#item').data('item-id')
                    let qty = $('#item-qty').val()

                    items.push({
                        id,
                        qty
                    })
                })

                var form = new FormData();

                items.forEach((v, i) => {
                    form.append(`items[${i}][id]`, v);
                })
            </script>



            <div class="col-md-5 col-12 ps-md-5 p-0 ">
                <div class="box-left">
                    <p class="fw-bold h7 mb-2">Detail Invoice</p>
                    <div class="h8">
                        <div class="row m-0 border mb-3">
                            <div class="col-6 h8 pe-0 ps-2">
                                <p class="textmuted py-2">Items</p> <span class="d-block py-2 border-bottom">Legal
                                    Advising</span> <span class="d-block py-2">Expert Consulting</span>
                            </div>
                            <div class="col-2 text-center p-0">
                                <p class="textmuted p-2">Qty</p> <span class="d-block p-2 border-bottom">2</span> <span
                                    class="d-block p-2">1</span>
                            </div>
                            <div class="col-2 p-0 text-center h8 border-end">
                                <p class="textmuted p-2">Price</p> <span class="d-block border-bottom py-2"><span
                                        class="fas fa-dollar-sign"></span>500</span> <span class="d-block py-2 "><span
                                        class="fas fa-dollar-sign"></span>400</span>
                            </div>
                            <div class="col-2 p-0 text-center">
                                <p class="textmuted p-2">Total</p> <span class="d-block py-2 border-bottom"><span
                                        class="fas fa-dollar-sign"></span>1000</span> <span class="d-block py-2"><span
                                        class="fas fa-dollar-sign"></span>400</span>
                            </div>
                        </div>
                        <div class="d-flex h7 mb-2">
                            <p class="">Total Amount</p>
                            <p class="ms-auto">Rp.10000</p>
                        </div>
                        <div class="d-flex h7 mb-2">
                            <p class="">Biaya Admin</p>
                            <p class="ms-auto">Rp.2000</p>
                        </div>
                        <div class="d-flex h7 mb-2">
                            <p class="">Total</p>
                            <p class="ms-auto">Rp.12000</p>
                        </div>
                        <div class="h8 mb-5">
                            <p class="textmuted">Check Email
                            </p>
                        </div>
                    </div>
                    <div class="">

                        <div class="btn btn-primary d-block h8">PAY <span
                                class="fas fa-dollar-sign ms-2"></span>1400<span class="ms-3 fas fa-arrow-right"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
