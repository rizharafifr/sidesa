@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Penduduk</h1>
    </div>
    <!-- End Page Heading -->

    <div class="row">
        <div class="col">
            <form action="/resident/{{ $resident->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" id="nik" maxlength="16" inputmode="numeric"
                                class="form-control @error('nik') is-invalid @enderror"
                                value="{{ old('nik', $resident->nik) }}" oninput="validateNIK(this)">

                            <p id="nik-error" class="text-danger mt-1" style="display: none;">NIK hanya boleh terdiri dari
                                angka (0-9)</p>

                            @error('nik')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name" class="">Nama Lengkap</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $resident->name) }}">
                            @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="gender" class="">Jenis Kelamin</label>
                            <select name="gender" id="gender"
                                class="form-control @error('gender') is-invalid @enderror">
                                @foreach ([
            (object)
    [
                'label' => 'Laki - Laki',
                'value' => 'male',
            ],
            (object) [
                'label' => 'Perempuan',
                'value' => 'female',
            ],
        ] as $item)
                                    <option value="{{ $item->value }}" @selected(old('gender', $resident->gender) == $item->value)>{{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('gender')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="birth_date" class="">Tanggal Lahir</label>
                            <input type="date" name="birth_date" id="birth_date"
                                class="form-control @error('birth_date') is-invalid @enderror"
                                value="{{ old('birth_date', $resident->birth_date) }}">
                            @error('birth_date')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="birth_place" class="">Tempat Lahir</label>
                            <input type="text" name="birth_place" id="birth_place"
                                class="form-control @error('birth_place') is-invalid @enderror"
                                value="{{ old('birth_place', $resident->birth_place) }}">
                            @error('birth_place')
                                ,
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="religion" class="">Agama</label>
                            <input type="text" name="religion" id="religion"
                                class="form-control @error('religion') is-invalid @enderror"
                                value="{{ old('religion', $resident->religion) }}">
                            @error('religion')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="address" class="">Alamat</label>
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="30"
                                rows="10">{{ old('address', $resident->address) }}</textarea>
                            @error('address')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="marital_status" class="">Status Perkawinan</label>
                            <select name="marital_status" id="marital_status"
                                class="form-control @error('marital_status') is-invalid @enderror">
                                @foreach ([
            (object)
    [
                'label' => 'Belum Menikah',
                'value' => 'single',
            ],
            (object) [
                'label' => 'Sudah Menikah',
                'value' => 'married',
            ],
            (object) [
                'label' => 'Cerai',
                'value' => 'divorced',
            ],
            (object) [
                'label' => 'Janda/Duda',
                'value' => 'widowed',
            ],
        ] as $item)
                                    <option value="{{ $item->value }}" @selected(old('marital_status', $resident->marital_status) == $item->value)>{{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('marital_status')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="occupation" class="">Pekerjaan</label>
                            <input type="text" name="occupation" id="occupation"
                                class="form-control @error('occupation') is-invalid @enderror"
                                value="{{ old('occupation', $resident->occupation) }}">
                            @error('occupation')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone" class="">No Telepon</label>
                            <input type="text" inputmode="numeric" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $resident->phone) }}">
                            @error('phone')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="status" class="">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                @foreach ([
            (object)
    [
                'label' => 'Aktif',
                'value' => 'active',
            ],
            (object) [
                'label' => 'Pindah',
                'value' => 'moved',
            ],
            (object) [
                'label' => 'almarhum',
                'value' => 'deceased',
            ],
        ] as $item)
                                    <option value="{{ $item->value }}" @selected(old('status', $resident->status) == $item->value)>{{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end" style="gap: 10px;">
                            <a href="/resident" class="btn btn-outline-secondary">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    function validateNIK(input) {
        const errorTag = document.getElementById('nik-error');
        const value = input.value;

        // Cegah huruf, hanya izinkan angka
        if (/[^0-9]/.test(value)) {
            errorTag.style.display = 'block';
            input.value = value.replace(/[^0-9]/g, '');
        } else {
            errorTag.style.display = 'none';
        }

        // Batasi maksimal 16 digit manual (kalau user copas angka panjang)
        if (value.length > 16) {
            input.value = value.slice(0, 16);
        }
    }
</script>
