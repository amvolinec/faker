<table class="table table-sm">
    <thead class="thead-dark">
    <tr>
        @each('tables.th', $columns, 'column')
        <th scope="col">{{ __('Actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($items as $item)
        <tr>
            @foreach($columns as $key => $value)
                <td>{{ $item->$value }}</td>
            @endforeach
            <td>

                <form action="{{ (url()->current() . '/' . $item->id . '/') }}" method="GET">
                    <button class="btn btn-sm btn-outline-secondary">{{ __('Show') }}</button>
                </form>
                <form action="{{ (url()->current() . '/' . $item->id . '/destroy') }}" method="POST">
                    @method('POST')
                    @csrf
                    <button class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
                </form>

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="100%">{{ __('No data') }}</td>
        </tr>
    @endforelse
    </tbody>
</table>
