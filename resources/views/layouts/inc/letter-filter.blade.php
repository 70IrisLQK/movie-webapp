<div class="text-center letter-filter" id="letter-filter">
    <span class="toggle-pagination"><i class="hl-menu"></i> Danh sách từ A-Z</span>

    <ul class="pagination list-letter pagination-lg">
        <li>
            <span data-href="{{ route('az-list', ['all']) }}" class="letter-item" data-text="All"></span>
        </li>
        @foreach (range('A', 'Z') as $char)
            @php
                if (isset($az) && $az == $char) {
                    $letter = 'active';
                } else {
                    $letter = '';
                }
            @endphp
            <li>
                <span data-href="{{ route('az-list', [$char]) }}" class="letter-item {{ $letter }}">
                    {{ $char }}
                </span>
            </li>
        @endforeach
    </ul>
</div>
