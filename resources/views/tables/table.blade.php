<table class="table table-sm">
    <thead class="thead-dark">
    <tr>
        @each('tables.th', $columns, 'column')
        @isset($execute)
            <th scope="col">{{ __('Actions') }}</th>
        @endisset
    </tr>
    </thead>
    <tbody>
    @forelse($items as $item)
        <tr>
            @foreach($columns as $key => $value)
                <td>{{ $item->$value }}</td>
            @endforeach
            <td>
                @isset($execute)
                    <form action="{{ (url()->current() . '/' . $item->id . '/execute') }}" method="POST">
                        @method('POST')
                        @csrf
                        <button class="btn btn-sm btn-outline-secondary"
                                onclick="return confirm('Are you sure?')">{{ __('Execute') }}</button>
                    </form>
                @endisset
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="100%">{{ __('No data') }}</td>
        </tr>
    @endforelse
    </tbody>
</table>
