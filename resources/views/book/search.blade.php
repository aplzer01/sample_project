<!-- -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>検索結果一覧</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css')}}" >
  </head>
  <body>
    <h2>検索結果</h2>
    <table>
      <thead>
        <tr>
          <th>No.</th>
          <th>本のタイトル</th>
          <th>作者</th>
          <th>登録日</th>
          <th>詳細</th>
          <th>編集</th>
          <th>削除</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($book as $book)
        <tr>
          <td>{{ $book->book_id }}</td>
          <td>{{ $book->book_name }}</td>
          <td>{{ $book->book_author }}</td>
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
  </body>
</html>