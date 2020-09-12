<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cashier-Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    <div class="bg-blue">
        <div class="container pt-110">
            <div class="row">
                <!-- Left Container -->
                <div class="col-lg-3">
                    <div class="card rounded-lg border-0 shadow-blue">
                        <div class="card-body pt-5 pb-5 d-flex flex-column align-items-center justify-content-center">
                            <img src="{{ Auth::user()->photo }}" width="100px" height="100px" style="object-fit: cover"
                                class="rounded-circle border-primary border-lg" />
                            <h5 class="pt-3 pb-4 text-primary">{{ Auth::user()->name }}</h5>
                            <a href="{{ route('cashier.create') }}"
                                class="btn btn-block btn-primary shadow-blue mb-3 rounded-lg" target="__blank">Menu</a>
                            <form action="{{ route('auth.logout') }}" method="POST" id="logout">
                                @csrf

                            </form>
                            <a href="javascript:void(0)" class="btn btn-block btn-danger rounded-lg"
                                onclick="document.querySelector('#logout').submit()">Keluar</a>
                        </div>
                    </div>
                </div>
                <!-- END left Container -->

                <!-- Right Container -->
                <div class="col-lg-8 offset-lg-1">
                    <!-- Cards -->
                    <div class="row">
                        <!-- Card Pemasukan -->
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-blue rounded-lg p-2">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="left">
                                        <div class="card-title pl-1">
                                            <h5 class="text-gray">Pemasukan</h5>
                                            <h2 class="text-gray pt-3">{{ $income }}</h2>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <img src="{{ asset('img/money.svg') }}" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card Transaksi -->
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-blue rounded-lg p-2">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="left">
                                        <div class="card-title pl-1">
                                            <h5 class="text-gray">Transaksi</h5>
                                            <h2 class="text-gray pt-3">{{ $transaction_total }}</h2>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <img src="{{ asset('img/transaksi.svg') }}" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Cards -->

                    <!-- Header Orders -->
                    <div class="row mt-4 pt-4">
                        <div class="col">
                            <div class="card border-0 rounded-lg p-3">
                                <div class="row d-flex align-items-center">
                                    <h5 class="text-gray m-0 col-lg-6">Daftar Pesanan</h5>
                                    <div class="col-lg-6">
                                        <form action="" method="GET">
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control border-0 bg-gray form-control-sm outline-0 shadow-none"
                                                    placeholder="Nama Pemesan / Nomor Meja" name="s" />
                                                <button class="btn btn-success shadow-none">
                                                    <img src="{{ asset('img/search.svg') }}" alt="" />
                                                </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Headers -->

                <!-- Card Orders -->
                <div class="row mt-2">
                    @foreach ($transactions as $transaction)
                    <div class="col-lg-4 mb-3">
                        <div class="card border-0 rounded-lg shadow-blue mt-2">
                            <div class="card-body">
                                <h6 class="m-0 text-center text-primary transaction-name">
                                    {{ $transaction->name }}
                                </h6>
                                <h6 class="text-gray text-center mt-2 transaction-table">
                                    {{ $transaction->table_number }}</h6>
                                <div class="wrapper-btn mt-4 d-flex justify-content-around">
                                    <button class="btn btn-sm rounded btn-success" data-toggle="modal"
                                        data-target="#modal-detail" data-transaction_id='{{ $transaction->id }}'>
                                        <i data-feather="eye"></i>
                                    </button>
                                    <button class="btn btn-sm rounded btn-primary" data-toggle="modal"
                                        data-target="#modal-edit" data-transaction_id='{{ $transaction->id }}'>
                                        <i data-feather="edit"></i>
                                    </button>
                                    <button class="btn btn-sm rounded btn-danger" data-toggle="modal"
                                        data-target="#modal-delete" data-transaction_id='{{ $transaction->id }}'>
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <!-- End Card Orders -->
            </div>

            <!-- END Right Container -->
        </div>
    </div>
    </div>

    <!-- Modal Section -->

    <!-- Modal  Delete-->
    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        ....
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Pesanan yang dihapus tidak akan bisa dikembalikan kembali.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="button" class="btn btn-danger btn-delete">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Delete -->

    <!-- Modal Detail -->
    <div class="modal fade" id="modal-detail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">...</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td class="name">...</td>
                        </tr>
                        <tr>
                            <td>Nomor Meja</td>
                            <td>:</td>
                            <td class="table_number">...</td>
                        </tr>
                        <tr>
                            <td>Pesanan</td>
                            <td>:</td>
                            <td class="orders">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Nama Menu</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                    </thead>
                                    <tbody class="menu-table">

                                    </tbody>
                                    <tr>
                                        <td colspan="4" class="text-right total-price">75.000</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-success pl-5 pr-5 paid">
                                        Bayar
                                    </button>

                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Detail -->

    <!-- Modal Edit -->

    <div class="modal fade" id="modal-edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" id="name" />
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Nomor Meja:</label>
                            <input type="text" class="form-control" id="table-number" />
                        </div>
                        <div class="orders">
                            <label>Pesanan:</label>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Menu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="orders">

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary ubah">Ubah</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Edit -->

    <!-- End Modal Section -->

    <!-- Script Section -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        const modalDetail = document.querySelector('#modal-detail');
        let modalDetailInstance = new bootstrap.Modal(document.getElementById('modal-detail'),{});
        modalDetail.addEventListener('show.bs.modal',function(event){
            const modal = this;
            const button = event.relatedTarget;
            const transaction_id = button.dataset.transaction_id;
            
            fetch('{{ route('cashier.index') }}/'+transaction_id)
            .then(response => response.json())
            .then(result => {
                modal.querySelector('.modal-title').innerHTML = `Pesanan Meja ${result.table_number}`;
                modal.querySelector('.name').innerHTML = result.name;
                modal.querySelector('.table_number').innerHTML = result.table_number;

                const table = this.querySelector('.menu-table');
                table.innerHTML = '';

                let tableHTML = '';
                let i = 1;
                result.transaction_details.forEach(detail => {
                    tableHTML += `
                                <tr>
                                    <td>${i}</td>
                                    <td>${detail.menus.name}</td>
                                    <td>${detail.quantity}</td>
                                    <td>${detail.menus.price}</td>
                                </tr>
                    `;
                    i++;
                });
                table.insertAdjacentHTML('beforeend',tableHTML);
                modal.querySelector('.total-price').innerHTML = result.total_price;

                const paid_btn =modal.querySelector('.paid');
                paid_btn.onclick = function(){
                    
                    
                    fetch('{{ route("cashier.status") }}',{
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id:transaction_id,
                            status: 'bayar'
                        }),
                        method:'POST'
                    })
                    .then(response => response.json())
                    .then(result => {
                        
                        if(result.msg == 'Status transaksi berhasil diubah'){
                            modalDetailInstance.hide();
                            modal.addEventListener('hidden.bs.modal',function(){
                                setTimeout(function(){
                                    button.offsetParent.parentNode.remove()
                                    Swal.fire({
                                        icon:'success',
                                        title:'Sukses !!!',
                                        text:'Status transaksi berhasil diubah',
                                        timer:2000,
                                        timerProgressBar:true,
                                        onBeforeOpen: () => {
                                            Swal.showLoading();
                                        }
                                    });
                                },1000);
                            })
                        }
                    })
                }
            });
        });

        const modalDelete = document.querySelector('#modal-delete');
        let modalDeleteInstance = new bootstrap.Modal(document.getElementById('modal-delete'),{});
        modalDelete.addEventListener('show.bs.modal',function(event){
            const modal     = this;
            const button    = event.relatedTarget;
            const transaction_id = button.dataset.transaction_id;
            
            fetch('{{ route("cashier.index") }}/'+transaction_id)
            .then(response => response.json())
            .then(result => {
                modal.querySelector('.modal-title').innerHTML = `Hapus pesanan ${result.name} ?`;
            });

            const btnDelete = modal.querySelector('.btn-delete');
                btnDelete.onclick = function(){
                    fetch('{{ route("cashier.index") }}/'+transaction_id,{
                        headers:{
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": 'application/json',
                            "Content-Type": 'application/json'
                        },
                        method:"DELETE"
                    })
                    .then(response => response.json())
                    .then(result => {
                        
                        if(result.msg == 'Data Pesanan berhasil dihapus'){
                            modalDeleteInstance.hide();
                            setTimeout(function(){
                                button.offsetParent.parentNode.remove()
                                Swal.fire({
                                    icon:'success',
                                    title:'Sukses !!!',
                                    text:'Transaksi berhasil dihapus.',
                                    timer:2000,
                                    timerProgressBar:true,
                                    onBeforeOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                            },1000);
                        }
                    }).catch(err => console.log(err));
                }
            
        })

        const modalEdit = document.querySelector('#modal-edit');
        let modalEditInstance = new bootstrap.Modal(document.getElementById('modal-edit'),{});
        modalEdit.addEventListener('show.bs.modal',function(event){
            const modal     = this;
            const button    = event.relatedTarget;
            const transaction_id = button.dataset.transaction_id;
            const detailId = [];
            
            fetch('{{ route("cashier.index") }}/'+transaction_id)
            .then(response => response.json())
            .then(result => {
                modal.querySelector('.modal-title').innerHTML = `Ubah pesanan ${result.name}`;
                modal.querySelector('#name').value = result.name;
                modal.querySelector('#table-number').value = result.table_number;
                
                let tableData = '';
                let i = 1;
                result.transaction_details.forEach(detail => {
                    tableData += `
                                    <tr>
                                        <td>${i}</td>
                                        <td>${detail.menus.name}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger delete" data-id='${detail.menus.id}'>
                                                <i data-feather="trash-2" ></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;

                    i++;
                });
                modal.querySelector('table>.orders').innerHTML = tableData;
                feather.replace();


                const deleteBtn = document.querySelectorAll('.delete');           
                deleteBtn.forEach(btn => {
                    btn.onclick = function(){
                        if(!detailId.includes(this.dataset.id)){
                            detailId.push(this.dataset.id);
                        }
                        this.offsetParent.parentNode.remove();
                    }
                });
            });

            modal.querySelector('.ubah').onclick = function()
            {
                
                const name        = modal.querySelector('#name').value;
                const tableNumber = modal.querySelector('#table-number').value;
                const data = {
                    id:transaction_id,
                    name:name,
                    table_number:tableNumber,
                    orders:detailId
                }

                fetch('{{ route('cashier.index') }}/'+transaction_id,{
                    headers:{
                        'Accept':'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    method:'PUT',
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    console.log(result);
                    if(result.msg == 'Data berhasil diubah'){
                        modalEditInstance.hide();
                        setTimeout(function(){
                            button.offsetParent.querySelector('.transaction-name').innerHTML = name;
                            button.offsetParent.querySelector('.transaction-table').innerHTML = tableNumber;
                            Swal.fire({
                                icon:'success',
                                title:'Sukses !!!',
                                text:'Transaksi berhasil diubah.',
                                timer:2000,
                                timerProgressBar:true,
                                onBeforeOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            
                        },1000);
                    }
                });
            }
            
        });

    </script>

    <script>
        feather.replace();
    </script>
</body>

</html>