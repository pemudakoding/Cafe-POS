@extends('layouts.admin')
@section('title','Tambah Pengguna')
@section('user','active')

@section('content')
@include('includes.page-title',['title' => 'Tambah Pengguna','paragraph' => 'Silahkan isi sesuai form yang
disediakan'])

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Data Pengguna</h4>
    </div>
    <div class="card-content">
        <div class="card-body pt-0">
            <form class="form form-vertical" action="{{ route('user.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Nama Lengkap
                                    @error('name')
                                    <span class="text-danger">({{ $message }})</span>
                                    @enderror
                                </label>
                                <div class="position-relative">
                                    <input type="text" class="form-control @error('name') border-danger @enderror"
                                        name="name" placeholder="Nama Lengkap" id="name" value="{{ old('name') ?? '' }}"
                                        autocomplete="off">
                                    <div class=" form-control-icon">
                                        <i data-feather="user" class="@error('name') text-danger @enderror"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Username
                                    @error('username')
                                    <span class="text-danger">({{ $message }})</span>
                                    @enderror
                                </label>
                                <div class="position-relative">
                                    <input type="text" class="form-control @error('username') border-danger @enderror"
                                        name="username" placeholder="Username" id="name"
                                        value="{{ old('username') ?? '' }}" autocomplete="off">
                                    <div class=" form-control-icon">
                                        <i data-feather="at-sign" class="@error('username') text-danger @enderror"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Password
                                    @error('password')
                                    <span class="text-danger">({{ $message }})</span>
                                    @enderror
                                </label>
                                <div class="position-relative">
                                    <input type="password"
                                        class="form-control @error('password') border-danger @enderror" name="password"
                                        placeholder="Kata Sandi" id="name" value="{{ old('password') ?? '' }}"
                                        autocomplete="off">
                                    <div class=" form-control-icon">
                                        <i data-feather="lock" class="@error('password') text-danger @enderror"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Jabatan
                                    @error('level')
                                    <span class="text-danger">({{ $message }})</span>
                                    @enderror
                                </label>
                                <div class="position-relative">
                                    <div class="input-group">
                                        <label class="input-group-text bg-white border-right-0 p-0 pl-2" for="category">
                                            <i data-feather="user-plus"
                                                class="@error('level') text-danger @enderror"></i>
                                        </label>
                                        <select class="form-select border-left-0  text-muted @error('level') border-danger
                                            @enderror" name="level" id="level">
                                            <option value="" selected>Pilih Jabatan</option>
                                            <option value="Administrator"
                                                {{ old('level') ?? '' == 'Administrator' ? 'Selected' : ''  }}>
                                                Administrator
                                            </option>
                                            <option value="Kasir" {{ old('level') ?? ''== 'Kasir' ? 'Selected' : ''  }}>
                                                Kasir
                                            </option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="first-name-icon">Foto Pengguna
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
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success  mb-1">Tambah</button>
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
        inputNode.onchange = (input) => input.target.labels[0].firstChild.nextElementSibling.nextElementSibling.innerHTML = 
        input.target.files[0].name;
</script>
@endpush