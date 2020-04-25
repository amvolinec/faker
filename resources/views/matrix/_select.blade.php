<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __($name) }} ({{$type}})</label>

    <div class="col-md-6">
        <select id="name" type="text" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
                autocomplete="off">

            @foreach($belongs as $item)
                <option value="{{ $item->id }}"{{ isset($data) && $data[$name] == $item->id ? ' selected' : '' }}>{{ $item->name }}</option>
            @endforeach

        </select>

        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>