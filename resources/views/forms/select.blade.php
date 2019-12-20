<select name="{{ $name }}" id="{{ $name }}">
    @foreach($items as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
</select>