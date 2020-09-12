@extends('layouts.admin')
@section('title',"Ubah menu $menu->name")
@section('menu','active')

@section('content')
@include('includes.page-title',['title' => 'Ubah Menu','paragraph' => 'Silahkan ubah informasi menu sesuai form yang
disediakan'])

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Data Menu</h4>
    </div>
    <div class="card-content">
        <div class="card-body pt-0">
            <form class="form form-vertical" action="{{ route('menu.update',$menu->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Nama Menu
                                    @error('name')
                                    <span class="text-danger">({{ $message }})</span>
                                    @enderror
                                </label>
                                <div class="position-relative">
                                    <input type="text" class="form-control @error('name') border-danger @enderror"
                                        name="name" placeholder="Nama Menu" id="name"
                                        value="{{ old('name') ?? $menu->name }}" autocomplete="off">
                                    <div class="form-control-icon">
                                        <i data-feather="book-open" class="@error('name') text-danger @enderror"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Harga Menu
                                    @error('price')
                                    <span class="text-danger">({{ $message }})</span>
                                    @enderror
                                </label>
                                <div class="position-relative">
                                    <input type="text" class="form-control @error('price') border-danger @enderror"
                                        name="price" placeholder="Harga Menu" id="price"
                                        value="{{ old('price') ?? $menu->price }}" autocomplete="off">
                                    <div class="form-control-icon">
                                        <i data-feather="tag" class="@error('price') text-danger @enderror"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Jenis Menu
                                    @error('category')
                                    <span class="text-danger">({{ $message }})</span>
                                    @enderror
                                </label>
                                <div class="position-relative">
                                    <div class="input-group">
                                        <label class="input-group-text bg-white border-right-0 p-0 pl-2" for="category">
                                            <i data-feather="menu" class="@error('category') text-danger @enderror"></i>
                                        </label>
                                        <select class="form-select border-left-0  text-muted @error('category') border-danger
                                            @enderror" name="category" id="category">
                                            <option value="">Pilih Jenis Menu</option>
                                            <option value="Makanan"
                                                {{ ((old('category') ?? $menu->category)  == 'Makanan') ? 'selected' : ''  }}>
                                                Makanan
                                            </option>
                                            <option value="Minuman"
                                                {{ ((old('category') ?? $menu->category) == 'Minuman' )? 'selected' : ''  }}>
                                                Minuman
                                            </option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Foto Menu <span class="text-warning">Opsional</span>
                                    @error('photo')
                                    <span class="text-danger">({{ $message }})</span>
                                    @enderror
                                </label>
                                <div class="form-file">
                                    <input type="file" class="form-file-input @error('photo') border-danger @enderror"
                                        name="photo" id="photo">
                                    <label class="form-file-label" for="photo">
                                        <span
                                            class="form-file-button rounded-left border-right-0 pl-0 pl-2 bg-white "><i
                                                data-feather="image"
                                                class="@error('photo') text-danger @enderror"></i></span>
                                        <span class="form-file-text border-left-0 text-muted ">Pilih Foto...</span>
                                        <span class="form-file-button btn-primary ">
                                            <i data-feather="upload"></i>
                                        </span>

                                    </label>
                                </div>
                            </div>
                        </div>
                        @foreach ($menu->ingredients as $ingredient)
                        <div class='col-6'>
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">List bahan-bahan
                                </label>
                                <div class="position-relative">
                                    <div class="input-group">
                                        <label class="input-group-text bg-white border-right-0 p-0 pl-2" for="category">
                                            <i data-feather="feather"></i>
                                        </label>
                                        <select name="ingredients[]" class="form-select border-left-0">
                                            @foreach ($ingredients as $item)
                                            @if ($item->id == $ingredient->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Jumlah (gr)</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" name="quantity[]" placeholder="Jumlah"
                                        id="quantity"
                                        value="{{ $menu->ingredient_menus[$loop->iteration - 1]->quantity }}"
                                        autocomplete="off">
                                    <div class=" form-control-icon">
                                        <i data-feather="tag"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-12">
                            <button type="button" class="btn btn-warning mb-1 ingredient">Tambah Bahan</button>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success  mb-1">Ubah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const inputNode = document.querySelector('input[type="file"]');
        inputNode.onchange = (input) => input.target.labels[0].firstChild.nextElementSibling.nextElementSibling.innerHTML = input.target.files[0].name;
    
    const ingredientBtn = document.querySelector('.ingredient');
        ingredientBtn.onclick = (event) => {
            fetch('{{ route("ingredients.all") }}')
            .then(response => response.json())
            .then(result => {
                let selectNode = document.createElement('select');
                    selectNode.classList.add('form-select');
                    selectNode.classList.add('border-left-0');
                    selectNode.name = 'ingredients[]';
                for(let i = 0; i < result.length; i++){
                    let option = document.createElement('option');
                        option.value = result[i].id;
                        option.innerText = result[i].name;
                    selectNode.appendChild(option);
                }
                event.target.parentNode.insertAdjacentHTML('beforebegin',`
                    <div class='col-6'>
                        <div class="form-group has-icon-left">
                            <label for="first-name-icon">List bahan-bahan
                            </label>
                            <div class="position-relative">
                                <div class="input-group">
                                    <label class="input-group-text bg-white border-right-0 p-0 pl-2" for="category">
                                        <i data-feather="feather"></i>
                                    </label>
                                    ${selectNode.outerHTML}
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Jumlah (gr)</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control"
                                        name="quantity[]" placeholder="Jumlah" id="quantity" autocomplete="off">
                                    <div class="form-control-icon">
                                        <i data-feather="tag" ></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                `);
                
                feather.replace();
            });
           
            // console.log(event.target.parentNode);
        }
</script>
@endpush