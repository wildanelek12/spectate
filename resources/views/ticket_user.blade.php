<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="author" content="templatemo">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
    {{-- <meta charset="UTF-8" /> --}}
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <title>Spectate FT UM</title>

    <!-- Bootstrap core CSS -->
    {{-- <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}


    <!-- Additional CSS Files -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}"> --}}
    <link href=" https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel=”stylesheet”>
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-liberty-market.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tiket.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/tiket.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" /> --}}
    {{-- <link href="http://fonts.cdnfonts.com/css/monoton" rel="stylesheet"> --}}
    <!--

TemplateMo 577 Liberty Market

https://templatemo.com/tm-577-liberty-market

-->
</head>

<body class=" bg-ticket">

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    {{-- <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="{{ asset('assets/images/log.png') }}" alt="">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="index.html" class="active">Home</a></li>
                            <li><a href="explore.html">Explore</a></li>
                            <li><a href="details.html">Item Details</a></li>
                            <li><a href="author.html">Author</a></li>
                            <li><a href="create.html">Create Yours</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header> --}}
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->


    <div class="w-full h-screen p-24 ">
        {{-- <form action="POST" class="flex my-auto "> --}}

            <div class="w-full h-auto pt-5 px-5 my-auto bgcard1 rounded-top flex">
                <div class="w-5/12  bgcard2 rounded-left py-5 px-8 ">
                    <form method="post" name="installer" onsubmit="hideSubmit(); return false;">
                        <div class="flex justify-between ">
                            <p class="text-teks">Tiket Regular</p>
                            <p class="text-teks font-bold">Rp. 100.000</p>
                        </div>
                        <div class="flex justify-between ">
                            <input
                                id="tiket_reguler"
                                class="flow-root box-border h-12 w-52  py-2 px-4 rounded-md bg-ungu caret-kuning text-white placeholder-white placeholder-opacity-80"
                                placeholder="Masukkan jumlah tiket"
                                onchange="functionReguler(this.value)"
                                {{-- onChange={e => setReferralCode(e.target.value)} --}}
                            />
                            <p
                            class="text-teks font-bold text-xl my-auto text-end"
                            id="tiket_reguler_total">
                                None
                            </p>
                        </div>
                        <div class="flex justify-between mt-2">
                            <p class="text-teks">Tiket VIP</p>
                            <p class="text-teks font-bold">Rp. 150.000</p>
                        </div>
                        <div class="flex justify-between">
                            <input
                                id="tiket_vip"
                                class="flow-root box-border h-12 w-52  py-2 px-4 rounded-md bg-ungu caret-kuning text-white placeholder-white placeholder-opacity-80"
                                placeholder="Masukkan jumlah tiket"
                                onchange="functionVIP(this.value)"
                                {{-- onChange={e => setReferralCode(e.target.value)} --}}
                            />
                            <p class="text-teks font-bold text-xl my-auto text-end"
                            id="tiket_vip_total">
                                None
                            </p>
                        </div>

                        <button type="submit" value="" name="submit" class="bg-gradient-to-r from-biru1 to-biru2 h-12 w-full mt-8 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            Konfirmasi Tiket
                        </button>


                    </form>




                    {{-- <div id="hidden_div" style="display:none"> --}}




                        <div class="w-5/6 h-0.5 bg-teks items-center mx-auto my-10"></div>

                        <div class="flex justify-between" >
                            <p class="text-teks">Total Tiket</p>
                            <p
                            class="text-teks"
                            id="total_tiket">
                                None
                            </p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-teks">Biaya Admin</p>
                            <p class="text-teks">Rp.2.000</p>
                        </div>
                        <div class="w-5/6 h-0.5 bg-teks items-center mx-auto my-3"></div>
                        <div class="flex justify-between">
                            <p>Total</p>
                            <p
                            class="text-teks"
                            id="total_semua">
                                None
                            </p>
                        </div>
                    {{-- </div> --}}
                </div>

                <div class="w-7/12 h-auto  bgcard2 rounded-right py-5 px-12 ">

                    <p>Nama</p>
                    <input
                        id="nama_pembeli"
                        class="flow-root box-border h-12 w-full  py-2 px-4 rounded-md bg-white caret-kuning text-teks placeholder-teks placeholder-opacity-80"
                        placeholder="  Miftakhul As'Adi"
                        {{-- onChange={e => setReferralCode(e.target.value)} --}}
                    />
                    <p class="mt-3">Email</p>
                    <input
                        id="email_pembeli"
                        class="flow-root box-border h-12 w-full  py-2 px-4 rounded-md bg-white caret-kuning text-teks placeholder-teks placeholder-opacity-80"
                        placeholder="  spectate.bemftum@gmail.com"
                        {{-- onChange={e => setReferralCode(e.target.value)} --}}
                    />
                    <p class="mt-3">Nomor HP</p>
                    <input
                        id="nomer_pembeli"
                        class="flow-root box-border h-12 w-full  py-2 px-4 rounded-md bg-white caret-kuning text-teks placeholder-teks placeholder-opacity-80"
                        placeholder="  0813 3333 3333"
                        {{-- onChange={e => setReferralCode(e.target.value)} --}}
                    />


                    <button class="bg-gradient-to-r from-biru1 to-biru2 h-12 w-full mt-8 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        Beli Tiket
                      </button>



                </div>

            </div>



        {{-- </form> --}}
        <div class="h-20 w-full bg-white flex justify-between px-32 my-auto items-center rounded-bottom">
            <p class="text-xl">a free space for sponsor</p>
            <p class="text-xl">a free space for sponsor</p>
            <p class="text-xl">a free space for sponsor</p>
        </div>
        {{-- <div class="static">

        </div> --}}
        <img class="absolute top-8 left-20 z-20 w-32 h-32" src="/assets/images/banner-card.png"/>
        <img class="absolute top-0 right-20 z-20 h-48 w-auto" src="/assets/images/banner-credit-card.png"/>

        </div>




    <!-- ***** Main Banner Area End ***** -->


    <!-- Scripts -->

    <script>
        // document.getElementById("tiket_reguler").addEventListener("change", myFunction);

        function hideSubmit(){
            // var div = document.getElementById("hidden_div");
            //     if (div.style.display == 'none') {
            //         div.style.display = '';
            //     }
            //     else {
            //         div.style.display = 'none';
            //     }

            var a = document.getElementById("tiket_reguler_total");
            var b = document.getElementById("tiket_vip_total");

            var c =  a.innerText;
            var d =  b.innerText;

            var e = parseInt(c);
            var f = parseInt(d);

            var g = e + f;
            var h = (e+f) + 2000;

            document.getElementById("total_tiket").innerHTML = "Rp." + g;
            document.getElementById("total_semua").innerHTML = "Rp." + h;
            // console.log(x);
            // console.log(b);

            }

        function functionReguler(val) {
            document.getElementById("total_tiket").innerHTML = "None";
            document.getElementById("total_semua").innerHTML = "None";
            var x = document.getElementById("tiket_reguler");
            var y = x.value*100000;
            // console.log(x);
          document.getElementById("tiket_reguler_total").innerHTML =  y;
        }

        function functionVIP(val) {
            document.getElementById("total_tiket").innerHTML = "None";
            document.getElementById("total_semua").innerHTML = "None";
            var x = document.getElementById("tiket_vip");
            var y = x.value*150000;
            document.getElementById("tiket_vip_total").innerHTML = y;
            // document.getElementById("tiket_vip_total").innerHTML =  y;
        }




        </script>







    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/ta') }}bs.js"></script>
    <script src="{{ asset('assets/js/popup.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    {{-- <script>
        var form = new FormData();
        form.append("ticket_id", "1");
        form.append("type_id", "1");
        form.append("name", "lorem 2 (vip)");
        form.append("price", "50000");
        form.append("stock", "1000");
        form.append("fee", "2000");
        form.append("description", "lorem ipsum");
        form.append("status", "1");

        var settings = {
            "url": "http://127.0.0.1:8000/admin-api/v1/item",
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
            console.log(response);
        });
    </script> --}}
</body>



</html>
