<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cashier - Orders</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/style.css')}}" />
</head>

<body>
    <div class="bg-blue">
        <div class="container pt-110 mb-5">
            <div class="card border-0 rounded-lg shadow-blue p-4">
                <div class="row">
                    <!-- Left Section -->
                    <div class="col-lg-8">
                        <div class="col menus-container pr-3">
                            <!-- Food Section -->
                            <div class="row menus-create foods active-create">
                                @foreach ($foods as $menu)
                                <div class="col-3 mb-4 d-flex flex-column justify-content-around align-items-center position-relative"
                                    style="height: 150px">
                                    <h6 class="text-primary text-center">
                                        {{ $menu->name }}
                                    </h6>
                                    <button
                                        class="btn btn-sm rounded-lg btn-danger position-absolute btn-trash shadow-none">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                    <div class="box-menu rounded-lg d-flex align-items-end shadow-blue position-relative"
                                        style="
                                            background-image: url({{ asset($menu->photo) }});
                                            background-size: cover;
                                            overflow: hidden;
                                        ">
                                        <div class="order position-relative p-2 bg-blue-transparent rounded-lg">
                                            <input type="text" id="quantity"
                                                class="popup text-center form-control form-control-sm rounded-lg mb-1" />
                                            <button class="popup btn btn-sm btn-block btn-success rounded-lg orders-btn"
                                                data-productname="{{ $menu->name }}"
                                                data-productprice="{{ $menu->price }}" data-productid="{{ $menu->id }}">
                                                Pesan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            <!-- Food Section -->
                            <div class="row menus-create drinks">
                                @foreach ($drinks as $menu)
                                <div class="col-3 mb-4 d-flex flex-column justify-content-around align-items-center position-relative"
                                    style="height: 150px">
                                    <h6 class="text-primary text-center">
                                        {{ $menu->name }}
                                    </h6>
                                    <button
                                        class="btn btn-sm rounded-lg btn-danger position-absolute btn-trash shadow-none">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                    <div class="box-menu rounded-lg d-flex align-items-end shadow-blue position-relative"
                                        style="
                                            background-image: url({{ asset($menu->photo) }});
                                            background-size: cover;
                                            overflow: hidden;
                                        ">
                                        <div class="order position-relative p-2 bg-blue-transparent rounded-lg">
                                            <input type="text" id="quantity"
                                                class="popup text-center form-control form-control-sm rounded-lg mb-1" />
                                            <button class="popup btn btn-sm btn-block btn-success rounded-lg orders-btn"
                                                data-productname="{{ $menu->name }}"
                                                data-productprice="{{ $menu->price }}" data-productid="{{ $menu->id }}">
                                                Pesan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Right Section -->
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col">
                                <div class="card border-0 bg-gray rounded-lg">
                                    <div class="card-body">
                                        <h5 class="m-0 text-gray text-center">
                                            Add Customer
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card border-0 bg-gray mt-4 rounded-lg printPage">
                                    <div class="card-body">
                                        <h6 class="m-0 text-center text-gray">
                                            Struk Pembelian
                                        </h6>
                                        <hr />
                                        <div class="orders">
                                            <table class="table table-borderless text-gray">
                                                <tbody></tbody>
                                            </table>
                                            <table class="table borderless text-gray">
                                                <tr>
                                                    <td colspan="2">
                                                        Total
                                                    </td>
                                                    <td class="total"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mt-2">
                                <button class="btn btn-success btn-sm col-12 rounded savebill">
                                    Save Bill
                                </button>
                            </div>
                            <div class="col-lg-4 mt-2">
                                <button class="btn btn-primary btn-sm col-12 rounded print">
                                    Print Bill
                                </button>
                            </div>
                            <div class="col-lg-4 mt-2">
                                <button class="btn btn-danger btn-sm col-12 rounded clearbill">
                                    Clear Bill
                                </button>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="card border-0 rounded-lg bg-primary py-3">
                                    <h2 class="text-white text-center charge"></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Menu Section -->
                <div class="row" style="margin-top: -60px">
                    <div class="col-lg-7">
                        <div class="position-relative bottom-70 card bg-primary border-0 shadow-blue rounded-lg">
                            <div class="row nav">
                                <div class="col-lg-6 text-center">
                                    <a href="javascript:void(0)" class="foods text-white py-3 rounded-lg menuBtn">
                                        <i data-feather="pie-chart"></i>
                                    </a>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <a href="javascript:void(0)" class="drinks text-white py-3 rounded-lg  menuBtn">
                                        <i data-feather="coffee"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Script Section -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    <script>
        function createBill(names, quantitys, prices, appendTo) {
            let tableRow = document.createElement("tr");
            let name = document.createElement("td");
            let quantity = document.createElement("td");
            let price = document.createElement("td");
            name.innerHTML = names;
            quantity.innerHTML = "x" + quantitys;
            price.innerHTML = "Rp. " + prices;

            tableRow.appendChild(name);
            tableRow.appendChild(quantity);
            tableRow.appendChild(price);
            appendTo.prepend(tableRow);
        }

        function clearStruk(node) {
            node.innerHTML = "";
            document.querySelector(".total").innerHTML = "Rp. 0";
            document.querySelector(".charge").innerHTML = "Rp. 0";
            orders.splice(0, orders.length);
            products.splice(0, products.length);
            productId.splice(0, productId.length);
            totalPrice = 0;
            document
                .querySelectorAll(".btn-trash-open")
                .forEach((element) => {
                    element.classList.remove("btn-trash-open");
                });
        }
        const ordersBtn = document.querySelectorAll(".orders-btn");
        const strukNode = document.querySelector(".orders>table>tbody");

        const orders = [];
        const products = [];
        const productId = [];
        let totalPrice = 0;
        ordersBtn.forEach((element) => {
            element.onclick = function () {
                /**
                    Add product information to orders array
                */
                const number = /^[0-9]+/;
                if (
                    this.previousElementSibling.value == "" ||
                    this.previousElementSibling.value < 1 ||
                    !number.test(this.previousElementSibling.value)
                ) {
                    Swal.fire({
                        icon: "warning",
                        title: "Ups !!!",
                        text: "Jumlah menu silahkan diisi dulu ya kak !!!",
                    });
                } else {
                    if (!productId.includes(this.dataset.productid)) {
                        productId.push(this.dataset.productid);
                        orders.push({
                            id_menu: this.dataset.productid,
                            quantity: this.previousElementSibling.value,
                        });
                        products.push({
                            id: this.dataset.productid,
                            name: this.dataset.productname,
                            price: this.dataset.productprice,
                            quantity: this.previousElementSibling.value,
                        });

                        createBill(
                            this.dataset.productname,
                            this.previousElementSibling.value,
                            this.dataset.productprice,
                            strukNode
                        );

                        totalPrice += parseInt(
                            this.dataset.productprice *
                                this.previousElementSibling.value
                        );
                        document.querySelector(".total").innerHTML =
                            "Rp. " + totalPrice;
                        document.querySelector(".charge").innerHTML =
                            "Rp. " + totalPrice;
                    }
                    let btnTrash = this.offsetParent.parentNode.previousElementSibling.parentNode.querySelector(
                        ".btn-trash"
                    );
                    btnTrash.classList.add("btn-trash-open");
                }
            };
        });

        const trashBtn = document.querySelectorAll(".btn-trash");
        trashBtn.forEach((element) => {
            element.onclick = function () {
                const btnOrders = this.nextElementSibling.firstElementChild
                    .lastElementChild;

                let index = productId.indexOf(btnOrders.dataset.productid);
                products.splice(index, 1);
                orders.splice(index, 1);
                productId.splice(index, 1);

                element.classList.remove("btn-trash-open");

                strukNode.innerHTML = "";
                products.forEach((product) => {
                    createBill(
                        product.name,
                        product.quantity,
                        product.price,
                        strukNode
                    );
                });
                totalPrice -= parseInt(
                    btnOrders.dataset.productprice *
                        btnOrders.previousElementSibling.value
                );

                document.querySelector(".total").innerHTML =
                    "Rp. " + totalPrice;
                document.querySelector(".charge").innerHTML =
                    "Rp. " + totalPrice;
            };
        });

        const clearBill = document.querySelector(".clearbill");
        clearBill.onclick = function () {
            if (!productId.length < 1) {
                clearStruk(strukNode);
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Ups !!!",
                    text: "Bill nya masih kosong kak !!!",
                });
            }
        };

        const printBtn = document.querySelector(".print");
        printBtn.onclick = function () {
            window.print();
        };

        const saveBtn = document.querySelector(".savebill");
        saveBtn.onclick = function () {
            if (productId.length < 1) {
                Swal.fire({
                    icon: "warning",
                    title: "Ups !!!",
                    text: "Silahkan pilih menu dulu ya kak !!!",
                });
            } else {
                Swal.fire({
                    icon: "info",
                    title: "Informasi Pemesan",
                    html: `
                    <input type="text" id="name" class="swal2-input" placeholder="Nama Customer">
                    <input type="text" id="table_number" class="swal2-input " placeholder="Nomor Meja Customer">
                `,
                    focusConfirm: false,
                    backdrop: `
                    rgba(0, 0, 0, 0.80)
                    left top
                    no-repeat
                `,
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    cancelButtonColor: "#ff9797",
                    confirmButtonText: "Pesan",
                    confirmButtonColor: "#428dff",
                    reverseButtons: true,
                    preConfirm: (values) => {
                        if (values) {
                            const data = {
                                name: document.querySelector("#name").value,
                                table_number: document.querySelector(
                                    "#table_number"
                                ).value,
                                total_price: totalPrice,
                                orders: orders,
                            };
                            fetch("{{ route('cashier.store') }}", {
                                method: "POST",
                                headers: {
                                    Accept: "application/json",
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                    "Content-Type": "application/json",
                                },
                                body: JSON.stringify(data),
                            })
                                .then((response) => response.json())
                                .then((result) => {
                                    if (
                                        (result.msg = "Transaksi Berhasil")
                                    ) {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Transaksi Sukses",
                                            text:
                                                "Untuk langkah selanjutnya silahkan print bill atau clear bill.",
                                            backdrop: `
                                            rgba(0, 0, 0, 0.80)
                                            left top
                                            no-repeat
                                        `,
                                            confirmButtonText: "Selesai",
                                        });
                                    }
                                });
                        }
                    },
                });
            }
        };

        const menusBtn = document.querySelectorAll('.menuBtn');
            menusBtn.forEach( btn => {
                btn.onclick = function(){
                    
                    if(this.classList[0] == 'foods'){
                       const classMenu = document.querySelector(`.${this.classList[0]}`);
                        classMenu.classList.add('active-create');
                        classMenu.nextElementSibling.classList.remove('active-create');
                    
                    }else{
                        const classMenu = document.querySelector(`.${this.classList[0]}`);
                        classMenu.classList.add('active-create');
                        classMenu.previousElementSibling.classList.remove('active-create');
                    }
                }
            });
    </script>
</body>

</html>