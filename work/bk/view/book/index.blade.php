<!-- -->

<a href="{{ route('book.create') }}">本の登録へ</a>
<a href="{{ route('book.downloadCsv') }}">CSVダウンロード</a>

<h2>一覧</h2>
<table>
  <thead>
    <tr>
      <th>ブックナンバー</th>
      <th>ブック名</th>
      <th>作成日</th>
      <th>詳細</th>
      <th>編集</th>
      <th>削除</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($books as $book)
    <tr>
      <td>{{ $book->book_id }}</td>
      <td>{{ $book->book_name }}</td>
      <td>{{ $book->created_at }}</td>
      <td><a href="{{ route('book.detail', ['book_id'=>$book->book_id]) }}">詳細</a></td>
      <td><a href="{{ route('book.edit', ['book_id'=>$book->book_id]) }}">編集</a></td>
      <td>
        <form action="{{ route('book.delete', ['book_id'=>$book->book_id]) }}" method="POST">
            @csrf
            <button type="submit" onClick="delete_alert(event);return false;">削除</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>