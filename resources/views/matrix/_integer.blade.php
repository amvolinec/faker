<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __($name) }}</label>

    <div class="col-md-6">
        <input id="name" type="number" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
               autocomplete="off" value="{{ $data[$name] ?? old($name) }}">

        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>