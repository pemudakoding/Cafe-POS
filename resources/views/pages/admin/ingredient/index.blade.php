@extends('layouts.admin')
@section('title','Daftar Bahan-Bahan')
@section('ingredients','active')
@section('content')
@include('includes.page-title',['title' => 'Bahan','paragraph' => 'Bahan-bahan berfungsi sebagai resep menu,
agar bisa merekap pengeluaran dan pemasukan '])
<!-- Borderless table start -->
<div class="row" id="table-borderless">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Bahan</h4>
                <a href="{{ route('ingredients.create') }}" class="btn btn-outline-success mt-2">Tambah</a>
            </div>
            <div class="card-content">
                @include('includes.alert')
                <!-- table with no border -->
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Bahan</th>
                                <th>Kuantitas</th>
                                <th>Stock</th>
                                <th>Harga</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ingredients as $item)
                            <tr>
                                <td class="text-bold-500">{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->stock }}</td>
                                <td>Rp. {{ number_format($item->price,0) }}</td>
                                <td>
                                    <a href="{{ route('ingredients.edit',$item->id) }}">
                                        <i data-feather="edit" class="text-success"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="delete" data-id='{{ $item->id }}'>
                                        <i data-feather="trash-2" class="text-danger "></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $ingredients->links() }}
            </div>
        </div>
    </div>
</div>
<!-- Borderless table end -->
@endsection
@push('scripts')
<script>
    const deleteBtn = document.querySelectorAll('.delete');
        deleteBtn.forEach(btn => {
            btn.onclick = function(){
                const id = this.dataset.id;
                fetch('{{ route("ingredients.index")}}/'+id,{
                    headers:{
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    method:'DELETE'
                })
                .then(response =>response.json())
                .then(result => {
                    console.log(result);
                    if(document.querySelector('.card-body') != null){
                        document.querySelector('.card-body').remove()
                    }  
                    if(result.msg == 'Data bahan berhasil dihapus'){
                        this.parentNode.parentNode.remove();
                        document.querySelector('.card-content').insertAdjacentHTML('afterbegin',`
                        <div class="card-body pt-0">
                            <div class="alert alert-success m-0">Data bahan berhasil dihapus !!</div>
                        </div>
                        `)
                    }
                })
            }
        });
</script>
@endpush