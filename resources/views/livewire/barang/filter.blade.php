<div>
    <div class="input-group" style="width: 600px">
        <select wire:model="filter" name="kategori_id" id="kategori_id" class="form-select">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
            @endforeach
        </select>
        <input type="text" wire:model="search" name="cari" class="form-control" placeholder="Cari barang...">
    </div>
</div>
