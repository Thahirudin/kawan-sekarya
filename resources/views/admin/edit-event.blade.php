@extends('admin.template.master')
@section('title')
    Tambah Event| {{ config('app.name') }}
@endsection
@section('event-active')
    bg-gray-200 text-blue-600 font-semibold
@endsection
@section('addCss')
    <style>
        .ck-content ul {
            list-style-type: disc !important;
            margin-left: 20px !important;
        }

        .ck-content ol {
            list-style-type: decimal !important;
            margin-left: 20px !important;
        }

        .ck-content h1 {
            font-size: 2rem !important;
            margin-bottom: 1rem !important;
        }

        .ck-content h2 {
            font-size: 1.75rem !important;
            margin-bottom: 0.75rem !important;
        }

        .ck-content h3 {
            font-size: 1.5rem !important;
            margin-bottom: 0.5rem !important;
        }
    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <section class="p-4 bg-white rounded-xl lg:p-5 mb-5 shadow-lg">
        <form action="{{ route('admin.update-event', $event->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Global Error Alert -->
            @if (session('error'))
                <div id="alert-2"
                    class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50"
                    role="alert">
                    <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('error') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                        data-dismiss-target="#alert-2" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
            @if (session('success'))
                <div id="alert-3"
                    class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50"
                    role="alert">
                    <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                        data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Nama Event -->
            <div class="mb-5">
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama
                    Event</label>
                <input type="text" id="nama" name="nama" value="{{ $event->nama }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                @error('nama')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Mulai -->
            <div class="mb-5">
                <label for="tanggal_mulai" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                    Mulai</label>
                <input type="datetime-local" id="tanggal_mulai" name="tanggal_mulai" value="{{ $event->tanggal_mulai }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
                @error('tanggal_mulai')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Selesai -->
            <div class="mb-5">
                <label for="tanggal_selesai" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                    Selesai</label>
                <input type="datetime-local" id="tanggal_selesai" name="tanggal_selesai"
                    value="{{ $event->tanggal_selesai }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
                @error('tanggal_selesai')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kapasitas -->
            <div class="mb-5">
                <label for="kapasitas"
                    class="block mb-2 text-sm font-medium text-gray-900">Kapasitas</label>
                <input type="number" id="kapasitas" name="kapasitas" value="{{ $event->kapasitas }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
                @error('kapasitas')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Harga -->
            <div class="mb-5">
                <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                <input type="number" id="harga" name="harga" value="{{ $event->harga }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required />
                @error('harga')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lokasi -->
            <div class="mb-5">
                <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" value="{{ $event->lokasi }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                @error('lokasi')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar -->
            <div class="mb-5">
                <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900">Gambar</label>
                <input type="file" id="gambar" name="gambar"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                @error('gambar')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-5">
                <label for="deskripsi_singkat"
                    class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Singkat</label>
                <textarea
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="deskripsi_singkat" name="deskripsi_singkat" oninput="updateSeoMeta()">{{ $event->deskripsi_singkat }}</textarea>

                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-3">
                    <div id="meta-progress" class="bg-red-500 h-2.5 rounded-full" style="width: 0%"></div>
                </div>

                <!-- Teks Indikator -->
                <p id="meta-score-text" class="mt-2 text-sm text-gray-700">Meta Deskripsi: Terlalu
                    Pendek</p>

                <!-- Feedback -->
                <p class="mt-1 text-xs text-gray-500" id="meta-feedback">Minimal 160 karakter, maksimal
                    300 karakter.</p>

                @error('deskripsi_singkat')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-5">
                <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Detail</label>
                <textarea
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="deskripsi" name="deskripsi">{!! $event->deskripsi !!}</textarea>
                @error('deskripsi')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                Edit Data
            </button>

        </form>
    </section>
@endsection
@section('addJs')
    <script>
        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file.then(file => new Promise((resolve, reject) => {
                    const formData = new FormData();
                    formData.append('upload', file);
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'));

                    fetch('/upload-image', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.url) {
                                resolve({
                                    default: result.url
                                });
                            } else {
                                reject(result.error || 'Upload failed');
                            }
                        })
                        .catch(error => reject(error));
                }));
            }

            abort() {
                // Called if the upload is aborted.
            }
        }

        function CustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#deskripsi'), {
                extraPlugins: [CustomUploadAdapterPlugin] // Tambahkan adapter custom
            })
            .catch(error => console.error(error));
    </script>
    <script>
        function updateSeoMeta() {
            let textarea = document.getElementById("deskripsi_singkat");
            let progressBar = document.getElementById("meta-progress");
            let scoreText = document.getElementById("meta-score-text");
            let feedback = document.getElementById("meta-feedback");

            let text = textarea.value;
            let length = text.length;

            let progress = Math.min((length / 300) * 100, 100); // Maksimal 100%
            progressBar.style.width = progress + "%";

            if (length < 160) {
                scoreText.textContent = "Meta Deskripsi: Terlalu Pendek";
                progressBar.classList.replace("bg-green-500", "bg-red-500");
                progressBar.classList.replace("bg-yellow-500", "bg-red-500");
                feedback.textContent = "Deskripsi terlalu pendek! Minimal 160 karakter.";
            } else if (length >= 160 && length <= 300) {
                scoreText.textContent = "Meta Deskripsi: Optimal ✅";
                progressBar.classList.replace("bg-red-500", "bg-green-500");
                progressBar.classList.replace("bg-yellow-500", "bg-green-500");
                feedback.textContent = "Panjang deskripsi sudah sesuai dengan standar SEO.";
            } else {
                scoreText.textContent = "Meta Deskripsi: Terlalu Panjang";
                progressBar.classList.replace("bg-green-500", "bg-yellow-500");
                progressBar.classList.replace("bg-red-500", "bg-yellow-500");
                feedback.textContent = "Deskripsi terlalu panjang! Maksimal 300 karakter.";
            }
        }
    </script>
@endsection
