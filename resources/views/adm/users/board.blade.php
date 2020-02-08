<table class="table table-striped table-condensed">
    <thead>
        <tr>
            <th>id</th>
            <th>제목</th>
            <th>댓글수</th>
            <th>작성일</th>
        </tr>
    </thead>
    <tbody>
        @foreach($boards as $board)
        <tr>
            <td>{{ $board->id }}</td>
            <td>
                <a href="{{ route('boards.show', ['id' => $board->id]) }}" target="_blank">{{ $board->title }}</a>
            </td>
            <td>{{ $board->comment_cnt }}</td>
            <td>{{ $board->created_at->format('Y.m.d') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
