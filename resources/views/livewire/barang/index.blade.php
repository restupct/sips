<div>
    <div class="container mt-4">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row my-4">
            <div class="col-sm-4 text-center justify-content-center">
                <div class="input-group"
                    style="width: 300px; margin: 0 auto; border:2px solid #0d6efd; border-radius: 6px;">
                    <select wire:model="filter" name="kategori_id" id="kategori_id" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                        @endforeach
                    </select>
                    <input type="text" wire:model="search" name="cari" class="form-control"
                        placeholder="Cari barang...">
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($barangs as $barang)
                <div class="col-sm-12 col-xs-12 col-md-4 col-lg-3 mb-4">

                    <div class="card">
                        <img style="height: 200px" class="card-img-top img-fluid shadow"
                            src="{{ $barang->foto ? asset('/storage/' . $barang->foto) : 'http://placehold.it/150x150' }}"
                            alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                            <h6 class="text-black">Rp. {{ number_format($barang->harga, 0, ',', '.') }}</h6>
                            {{-- <button wire:click="addToCart({{ $barang->id }})" type="button"
                                class="btn btn-md btn-block btn-outline-primary text-black"
                                onmouseover="this.classList.add('text-white')"
                                onmouseout="this.classList.remove('text-white')">Pesan</button> --}}
                            <button wire:click="addToCart({{ $barang->id }})" type="button"
                                class="btn btn-md btn-block btn-primary text-white"
                                onmouseover="this.classList.add('text-white')"
                                onmouseout="this.classList.remove('text-white')">Pesan</button>
                        </div>
                    </div>
                    {{-- <div class="card h-80">
                        <img class="card-img-top img-fluid"
                            src="{{ $barang->foto ? asset('/storage/barang/' . $barang->foto) : 'http://placehold.it/150x150' }}"
                            alt="">
                        <div class="card-img-overlay" style="background-color: rgba(0,0,0,0.5);">
                            <h5 class="text-white">
                                <strong>{{ $barang->nama_barang }}</strong>
                            </h5>
                            <h6 class="text-white">Rp{{ number_format($barang->harga, 2, ',', '.') }}</h6>
                            <p class="text-white">
                                {{ @$barang->description }}
                            </p>
                            <button wire:click="addToCart({{ $barang->id }})" type="button"
                                class="btn btn-sm btn-block btn-outline-secondary text-white">Add to cart</button>
                        </div>
                    </div> --}}
                </div>
            @endforeach
        </div>
        {{-- {{ $products->links() }} --}}
    </div>

</div>
