@if('id' != $column->COLUMN_NAME)
    <div class="form-group">
        <label for="{{ $column->COLUMN_NAME }}">{{ $column->COLUMN_NAME }}</label>
        <input class="form-control" type="text" name="{{ $column->COLUMN_NAME }}"
               @if('NO' == $column->IS_NULLABLE) required @endif>

    </div>
@endif