<div>
    <hr>
    <form action="#">
        <div class="form-grup">
            <div class="form-row">
                <div class="form-group" hidden>
                    <label>Tenant Id :</label>
                       <div class="input-group">
                        <input type="text" class="form-control" name="tenant_id" value="0" required>
                       </div>
                </div>
                <div class="form-group" hidden>
                    <label>Inventor Id :</label>
                       <div class="input-group">
                        <input type="text" class="form-control" name="inventor_id" value="0" required>
                       </div>
                </div>
                <div class="form-group" hidden>
                    <label>Priority Id :</label>
                       <div class="input-group">
                        <input type="text" class="form-control" name="priority_id" value="0" required>
                       </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <select name="user_id" class="form-control custom-select" required>
                             <option value="">Pilih User</option>
                            @foreach ($teamid as $row)
                                <option value="{{ $row->uid }}">{{ $row->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="input-container">
                    <i class="fas fa-money-bill-wave-alt icon"></i>
                    <input class="form-control" name="jabatan" type="text" placeholder="Jabatan" />
                </div>
                <div class="input-container">
                    <i class="fas fa-money-bill-wave-alt icon"></i>
                    <input class="form-control" name="divisi" type="text" placeholder="Divisi" />
                </div>
                <div class="input-container">
                    <i class="fas fa-money-bill-wave-alt icon"></i>
                    <input class="form-control" name="tugas" type="text" placeholder="Tugas" />
                </div> --}}
                <div class="col">
                    <input type="text" name="jabatan" id="" class="form-control" placeholder="Jabatan">
                </div>
                <div class="col">
                    <input type="text" name="divisi" id="" class="form-control" placeholder="Divisi">
                </div>
                <div class="col">
                    <input type="text" name="tugas" id="" class="form-control" placeholder="Tugas">
                </div>
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
    </form>
</div>
