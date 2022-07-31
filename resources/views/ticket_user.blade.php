<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="author" content="templatemo">
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <title>Spectate FT UM</title>

    <link href=" https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel=”stylesheet”>
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-liberty-market.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tiket.css') }}">

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

    <div class="w-full h-screen p-4 lg:p-24 ">
        {{-- <form action="POST" class="flex my-auto "> --}}

            <div class="w-full h-auto lg:pt-5 lg:px-5 my-auto bgcard1 rounded-top lg:flex">
                <div class="w-full lg:w-5/12  bgcard2 rounded-left py-5 px-8 ">
                    <form method="post" name="installer" onsubmit="hideSubmit(); return false;">
                        <div class="flex justify-between ">
                            <p class="text-teks">Tiket Regular</p>
                            <p class="text-teks font-bold">Rp. 100.000</p>
                        </div>
                        <div class="flex justify-between ">
                            <input
                                id="tiket_reguler"
                                class="flow-root box-border h-12 w-48 lg:w-52  py-2 px-4 rounded-md bg-ungu caret-kuning text-white placeholder-white placeholder-opacity-80"
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
                                class="flow-root box-border h-12 w-48 lg:w-52 py-2 px-4 rounded-md bg-ungu caret-kuning text-white placeholder-white placeholder-opacity-80"
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
                            Cek Ketersediaan Tiket
                        </button>


                    </form>




                    {{-- <div id="hidden_div" style="display:none"> --}}




                        <div class="w-5/6 h-0.5 bg-teks items-center mx-auto my-10"></div>

                        <div class="flex justify-between" >
                            <p class="text-teks">Total Tiket</p>
                            <p
                            class="text-teks"
                            id="total_tiket">
                                0
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
                                0
                            </p>
                        </div>
                    {{-- </div> --}}
                </div>

                <div class="w-full lg:w-7/12 h-auto  bgcard2 rounded-right py-5 px-12 ">

                    <p>Nama</p>
                    <input
                        id="nama_pembeli"
                        class="flow-root box-border h-12 w-full  py-2 px-4 rounded-md bg-white caret-kuning text-teks placeholder-teks placeholder-opacity-50"
                        placeholder="  Miftakhul As'Adi"
                        {{-- onChange={e => setReferralCode(e.target.value)} --}}
                    />
                    <p class="mt-3">Email</p>
                    <input
                        id="email_pembeli"
                        class="flow-root box-border h-12 w-full  py-2 px-4 rounded-md bg-white caret-kuning text-teks placeholder-teks placeholder-opacity-50"
                        placeholder="  spectate.bemftum@gmail.com"
                        {{-- onChange={e => setReferralCode(e.target.value)} --}}
                    />
                    <p class="mt-3">Nomor HP</p>
                    <input
                        id="nomer_pembeli"
                        class="flow-root box-border h-12 w-full  py-2 px-4 rounded-md bg-white caret-kuning text-teks placeholder-teks placeholder-opacity-50"
                        placeholder="  0813 3333 3333"
                        {{-- onChange={e => setReferralCode(e.target.value)} --}}
                    />

                    <div id="hidden_div" style="display:none">
                        <button
                        class="bg-gradient-to-r from-biru1 to-biru2 h-12 w-full mt-8 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        type="button"
                        onclick="toggleModal('modal-id')">
                            Beli Tiket
                        </button>
                    </div>




                </div>

            </div>



        {{-- </form> --}}
        <div class="mt-8 lg:mt-0 h-20 w-full bg-white lg:flex justify-between px-2 lg:px-32 my-auto items-center rounded-bottom">
            <p class="text-xl text-center">a free space for sponsor</p>
            <p class="text-xl text-center">a free space for sponsor</p>
            <p class="text-xl text-center">a free space for sponsor</p>
        </div>
        {{-- <div class="static">

        </div> --}}
        <img class="invisible lg:visible absolute top-8 left-20 z-20 w-32 h-32" src="/assets/images/banner-card.png"/>
        <img class="invisible lg:visible absolute top-0 right-20 z-20 h-48 w-auto" src="/assets/images/banner-credit-card.png"/>

        </div>




    <!-- ***** Main Banner Area End ***** -->




    <!-- ***** Modal Area Start ***** -->

    <div
    class="hidden overflow-x-hidden overflow-y-auto fixed top-20 lg:inset-0 z-50 outline-none focus:outline-none justify-center items-center"
    id="modal-id">
        <div class="relative lg:w-auto my-6 mx-auto w-screen lg:max-w-6xl h-96 lg:h-auto px-3">
          <!--content-->
          <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none ">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
              <h3 class="text-3xl text-teks font-semibold">
                Choose
                <span class="text-kuning">
                    Payment
                  </span>
                  Option
              </h3>
              <button class="p-1 ml-auto bg-transparent border-0 text-black float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
                <span class="bg-transparent text-biru0  h-6 w-6 text-2xl block outline-none focus:outline-none">
                  ×
                </span>
              </button>
            </div>
            <!--body-->
            {{-- <div class="w-full h-auto p-6 lg:flex self-end mx-auto"> --}}
            <div class="w-full max-h-full p-6 self-end flex">


                {{-- iki kenek di looping --}}



                <div class="bg-ungumuda1 hover:bg-ungumuda w-64 h-auto  rounded-2xl text-center my-4 lg:my-0 mx-auto lg:mx-4">
                    <button class="p-2 mx-3">
                        <img
                        class="w-20 h-20 mx-auto mt-3"
                        src="/assets/images/logo-gopay.png"
                        alt="">
                        <h3 class=" my-3">Gopay</h3>
                        <p class="px-2 ">
                            this is for term and condition.
                            freely to use and change.
                            happy working!
                        </p>
                    </button>
                </div>

                {{-- iki kenek di looping --}}


            </div>
            <!--footer-->

            {{-- <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
              <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
                Close
              </button>
              <button class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
                Save Changes
              </button>
            </div> --}}

          </div>
        </div>
      </div>
      <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>


    <!-- ***** Modal Area Start ***** -->






    <!-- Scripts -->

    <script type="text/javascript">
        function toggleModal(modalID){
          document.getElementById(modalID).classList.toggle("hidden");
          document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
          document.getElementById(modalID).classList.toggle("flex");
          document.getElementById(modalID + "-backdrop").classList.toggle("flex");
        }
      </script>

    <script>
        // document.getElementById("tiket_reguler").addEventListener("change", myFunction);

        function hideSubmit(){
            var div = document.getElementById("hidden_div");
                if (div.style.display == 'none') {
                    div.style.display = '';
                }
                else {
                    div.style.display = 'none';
                }

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
            var div = document.getElementById("hidden_div");
                if (div.style.display == '') {
                    div.style.display = 'none';
                }
            document.getElementById("total_tiket").innerHTML = "None";
            document.getElementById("total_semua").innerHTML = "None";
            var x = document.getElementById("tiket_reguler");
            var y = x.value*100000;
            // console.log(x);
          document.getElementById("tiket_reguler_total").innerHTML =  y;
        }

        function functionVIP(val) {
            var div = document.getElementById("hidden_div");
                if (div.style.display == '') {
                    div.style.display = 'none';
                }
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
