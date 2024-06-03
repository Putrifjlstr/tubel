@extends('master.master-admin')

@section('title')
    PMB PEI
@endsection

@section('header')
@endsection

@section('navbar')
    @parent
@endsection

@section('menunya')
    Form Pendaftaran
@endsection

@section('menu')
    @auth
        <ul class="metismenu" id="menu">
            <li><a href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Beranda</span>
                </a>
            </li>
            @if (auth()->user()->role == 'Administrator')
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa fa-book"></i>
                        <span class="nav-text">Data Master </span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('data-user') }}">Pengguna</a></li>
                        <li><a href="{{ route('data-sekolah') }}">Sekolah</a></li>
                        <li><a href="{{ route('data-prodi') }}">Program Studi</a></li>
                        <li><a href="{{ route('data-jadwal') }}">Jadwal Kegiatan</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa fa-database"></i>
                        <span class="nav-text">Data Transaksi</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('data-registration') }}">Pendaftaran</a></li>
                        <li><a href="{{ route('data-pembayaran') }}">Pembayaran</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('data-pengumuman') }}" aria-expanded="false">
                        <i class="fa fa-file"></i>
                        <span class="nav-text">Pengumuman</span>
                    </a>
                </li>
            @else
                <li class="mm-active"><a href="{{ route('data-registration') }}" aria-expanded="false">
                        <i class="fa fa-database"></i>
                        <span class="nav-text">Pendaftaran</span>
                    </a>
                </li>
            @endif
        </ul>
    @endauth
@endsection

@section('content')
    <div class="row">
        <form action="/save-registration" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
            <div class="col-xl-12">
                <div class="custom-accordion">
                    <div class="card">
                        <a href="#personal-data" class="text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Data Pribadi</h5>
                                        <p class="text-muted text-truncate mb-0">NIP, NIK, Nama, Jenis Kelamin, Pas
                                            Photo, TTL, dsb</p>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                            class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="personal-data" class="collapse show">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nisn">NIP</label>
                                            <input type="text" class="form-control" id="personal-data-nisn"
                                                name="nisn" placeholder="Masukkan NIP" value="{{ old('nisn') }}" required>
                                            @error('nisn')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nik">NIK</label>
                                            <input type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan NIK" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-name">Nama</label>

                                            @if ( auth()->user()->profile->nama  != null)
                                                <input type="text" class="form-control" id="basicpill" name="nama"
                                                    placeholder="Masukkan Nama Lengkap" value="{{ auth()->user()->profile->nama }}" required>
                                            @else
                                                <input type="text" class="form-control" id="personal-data-name"
                                                    name="nama" placeholder="Masukkan Nama Lengkap"
                                                    value="{{ old('nama') }}" required>
                                            @endif
                                            @error('nama')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-gender">Jenis
                                                Kelamin</label>
                                            @if (auth()->user()->profile->gender != null)
                                                @if (auth()->user()->profile->gender == 'Perempuan')
                                                    <select class="form-control wide" name="jk"
                                                        value="{{ old('jk') }}">
                                                        <option value="{{ auth()->user()->profile->gender }}" selected>
                                                            {{ auth()->user()->profile->gender }}</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                    </select>
                                                @else
                                                    <select class="form-control wide" name="jk"
                                                        value="{{ old('jk') }}">
                                                        <option value="{{ auth()->user()->profile->gender }}" selected>
                                                            {{ auth()->user()->profile->gender }}</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                @endif
                                            @else
                                                <select class="form-control wide" name="jk"
                                                    value="{{ old('jk') }}">
                                                    <option value="{{ old('jk') }}" disabled selected>Pilih
                                                        Jenis Kelamin </option>
                                                    <option value="Laki-laki">Laki-aki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            @endif

                                            @error('jk')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data">Agama</label>
                                            <select class="form-control wide" name="agama"
                                                value="{{ old('agama') }}">
                                                <option value="{{ old('agama') }}" disabled selected>Pilih agama
                                                </option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Kong Hu Chu ">Kong Hu Chu</option>
                                                <option value="Lainnya">Etc</option>
                                            </select>
                                            @error('agama')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-4 mb-lg-0">
                                            <label class="form-label">Tempat lahir</label>
                                            @if (auth()->user()->profile->tempat_lahir != null)
                                                <input type="text" class="form-control" id="basicpill"
                                                    name="tempatlahir" placeholder="Masukkan Tempat Lahir"
                                                    value="{{ auth()->user()->profile->tempat_lahir }}" required>
                                            @else
                                                <input type="text" class="form-control" id="basicpill"
                                                    name="tempatlahir" placeholder="Masukkan Tempat Lahir"
                                                    value="{{ old('tempatlahir') }}" required>
                                            @endif
                                            @error('tempatlahir')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-4 mb-lg-0">
                                            <label class="form-label" for="billing-city">Tanggal lahir</label>
                                            @if (auth()->user()->profile->tanggal_lahir != null)
                                                <input type="date" class="form-control" id="basicpill"
                                                    name="tanggallahir" placeholder="Masukkan Tanggal Lahir"
                                                    value="{{ auth()->user()->profile->tanggal_lahir }}" required>
                                            @else
                                                <input type="date" class="form-control" id="basicpill"
                                                    name="tanggallahir" placeholder="Masukkan Tanggal Lahir"
                                                    value="{{ old('tanggallahir') }}" required>
                                            @endif
                                            @error('tanggallahir')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <!--<input name="tanggallahir" class="datepicker-default form-control" id="datepicker" >-->
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <label class="form-label" for="zip-code">Pas Photo</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Upload</span>
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control"
                                                        name="foto" value="{{ old('foto') }}" accept="image/png, image/jpg, image/jpeg" required>
                                                </div>
                                            </div>
                                            @error('foto')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="billing-address">Alamat</label>

                                    @if (auth()->user()->profile->alamat != null)
                                        <textarea class="form-control" id="billing-address" rows="3" name="alamat" required
                                            placeholder="Masukkan alamat lengkap">{{ auth()->user()->profile->alamat }}</textarea>
                                    @else
                                        <textarea class="form-control" id="billing-address" rows="3" name="alamat" required
                                            placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                    @endif
                                    @error('alamat')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nisn">Email</label>
                                            <input type="email" class="form-control" id="personal-data-nisn"
                                                name="email" placeholder="Masukkan email"
                                                value="{{ auth()->user()->email }}" required readonly>
                                            @error('email')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nik">No
                                                Hp/WhatsApp</label>
                                            @if (auth()->user()->profile->no_hp != null)
                                                <input type="number" class="form-control" id="basicpill" name="nohp"
                                                    placeholder="Masukkan Tanggal Lahir" value="{{ auth()->user()->profile->no_hp }}" required>
                                            @else
                                                <input type="number" class="form-control" id="basicpill" name="nohp"
                                                    placeholder="Masukkan nomor telepon" value="{{ old('nohp') }}" required>
                                            @endif
                                            @error('nohp')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BATASSSSSSSSS -->

                    <div class="card">
                        <a href="#registration-data" class="collapsed text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-truck text-primary h2"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Data Jabatan</h5>
                                        <p class="text-muted text-truncate mb-0">Pilihan program studi </p>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                            class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="registration-data" class="collapse">
                            <div class="p-4 border-top">
                                <!-- BELUM UBAH DATABASE -->
                                <div class ="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nisn">Unit Organisasi</label>
                                            <input type="text" class="form-control" id="personal-data-nisn"
                                                name="nisn" placeholder="Masukkan Unit Organisasi" value="{{ old('nisn') }}" required>
                                            @error('nisn')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nik">Alamat Kantor</label>
                                            <input type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Alamat Kantor" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-name">Jabatan Sekarang</label>
                                            <input type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Jabatan Sekarang" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-gender">Pangkat/Golongan</label>
                                            <input type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Pangkat/Golongan" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data">Masa Kerja (Tahun)</label>
                                            <input type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Masa Kerja" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                         <label class="form-label" for="personal-data">Uraian Tugas</label>
                                            <textarea type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Uraian Tugas" value="{{ old('nik') }}" required></textarea>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                </div>
                                <div class ="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nisn">Pendidikan Terakhir</label>
                                            <input type="text" class="form-control" id="personal-data-nisn"
                                                name="nisn" placeholder="Masukkan Pendidikan Terakhir" value="{{ old('nisn') }}" required>
                                            @error('nisn')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nik">Sekolah/ Perguruan Tinggi</label>
                                            <input type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Sekolah" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-name">Program Studi</label>
                                            <input type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Program Studi" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-gender">Tahun kelulusan</label>
                                            <input type="year" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Tahun Lulus" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data">IPK</label>
                                            <input type="desimal" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan IPK" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>




                    <div class="card">
                        <a href="#parental-data" class="collapsed text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-bill text-primary h2"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Data Beasiswa</h5>
                                        <p class="text-muted text-truncate mb-0">Data Beasiswa yang dipilih</p>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                            class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="parental-data" class="collapse">
                            <div class="p-4 border-top">
                            <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data">Jenis Beasiswa</label>
                                            <select class="form-control wide" name="agama"
                                                value="{{ old('agama') }}">
                                                <option value="{{ old('agama') }}" disabled selected>Pilih jenis beasiwa
                                                </option>
                                                <option value="Islam">Luar Negeri</option>
                                                <option value="Kristen">Dalam Negeri</option>
                                            </select>
                                            @error('agama')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-gender">Universitas Tujuan</label>
                                            <input type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Tahun Lulus" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data">Rencana Usulan Status Tugas Belajar</label>
                                            <select class="form-control wide" name="agama"
                                                value="{{ old('agama') }}">
                                                <option value="{{ old('agama') }}" disabled selected>Status Tugas Belajar
                                                </option>
                                                <option value="Islam">Dibebaskan</option>
                                                <option value="Kristen">Tidak Dibebaskan</option>
                                            </select>
                                            @error('agama')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-gender">Program Studi yang dituju</label>
                                            <input type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Program Studi" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <!-- BATASSSSSSSS -->
                    <div class="card">
                        <a href="#school-data" class="collapsed text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-truck text-primary h2"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Essai </h5>
                                        <p class="text-muted text-truncate mb-0">Tulis rencana Program Studi pada jenjang Pendidikan tinggi yang akan saudara ikuti dalam essai paling banyak 500 kata</p>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                            class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="school-data" class="collapse">
                            <div class="p-4 border-top">
                                <div class="mb-4">
                                         <label class="form-label" for="personal-data">Latar Belakang Program Studi</label>
                                            <textarea type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Essai" value="{{ old('nik') }}" required></textarea>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                </div>
                                <div class="mb-4">
                                         <label class="form-label" for="personal-data">Pengalaman Kerja yang menerangkan tugas yang telah dilakukan</label>
                                            <textarea type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Essai" value="{{ old('nik') }}" required></textarea>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                </div>
                                <div class="mb-4">
                                         <label class="form-label" for="personal-data">Alasan memilih program studi dikaitkan dengan latar belakang pendidikan dan/atau tugas sehari-hari</label>
                                            <textarea type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Essai" value="{{ old('nik') }}" required></textarea>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                </div>
                                <div class="mb-4">
                                         <label class="form-label" for="personal-data">Rencana yang akan dilakukan jika telah menyelesaikan Pendidikan Tinggi dikaitkan dengan tugas sehari-hari, dampak pada kinerja organisasi dan negara</label>
                                            <textarea type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan Essai" value="{{ old('nik') }}" required></textarea>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                </div>
                                
                                
                                    
                                    
                                
                                    

                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col">
                            <div class="text-end mt-2 mt-sm-0">
                                <button type="submit" name="add" class="btn btn-primary">Buat Pendaftaran</button>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row-->
                </div>
        </form>
    </div>
    <!-- end row -->
@endsection

@section('footer')
@endsection
