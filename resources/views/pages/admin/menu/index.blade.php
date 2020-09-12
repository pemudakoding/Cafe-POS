@extends('layouts.admin')
@section('title','Daftar Menu')
@section('menu','active')
@section('content')
@include('includes.page-title',['title' => 'Menu','paragraph' => ' '])
<!-- Borderless table start -->
<div class="row" id="table-borderless">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Menu</h4>
                <a href="{{ route('menu.create') }}" class="btn btn-outline-success mt-2">Tambah</a>
            </div>
            <div class="card-content">
                @include('includes.alert')
                <!-- table with no border -->
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thumbnail</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $item)
                            <tr>
                                <td class="text-bold-500">{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $item->photo }}" width="50" height="50" class="rounded-lg"
                                        style="object-fit: cover">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>Rp. {{ number_format($item->price,0) }}</td>
                                <td>{{ $item->category }}</td>
                                <td>
                                    <a href="{{ route('menu.edit',$item->id) }}">
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
                {{ $menus->links() }}
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
                fetch('{{ route('menu.index')}}/'+id,{
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
                    if(result.msg == 'Menu berhasil dihapus'){
                        this.parentNode.parentNode.remove();
                        document.querySelector('.card-content').insertAdjacentHTML('afterbegin',`
                        <div class="card-body pt-0">
                            <div class="alert alert-success m-0">Data menu berhasil dihapus !!</div>
                        </div>
                        `)
                    }
                })
            }
        });
</script>
@endpush