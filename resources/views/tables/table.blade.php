<table class="table table-sm">
    <thead class="thead-dark">
    <tr>
        @each('tables.th', $columns, 'column')
    </tr>
    </thead>
    <tbody>
    @forelse($items as $item)
        <tr>
            @foreach($columns as $key => $value)
                <td>{{ $item->$value }}</td>
            @endforeach
        </tr>
    @empty
        <tr>
            <td colspan="100%">{{ __('No data') }}</td>
        </tr>
    @endforelse
    </tbody>
</table>
