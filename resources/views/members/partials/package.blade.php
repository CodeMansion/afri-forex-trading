<div class="form-group">
    <label>Package</label>
    <select class="form-control" id="package_id">
        <option value="">-- Select Package  --</option>
        @forelse($packages as $package)
            <option value="{{ $package->id}}">{{ $package->name}} </option>
        @empty
            <option value="">-- No Active Package --</option>
        @endforelse
    </select>
</div>
<div class="form-group">
    <label>Package Type</label>
    <select class="form-control" id="package_type_id">
        <option value="">-- Select Package Type  --</option>
        @forelse($packagetypes as $type)
            <option value="{{ $type->id}}">{{ $type->name}} </option>
        @empty
            <option value="">-- No Package Type --</option>
        @endforelse
    </select>
</div>