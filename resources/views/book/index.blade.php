<!-- -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>登録データ一覧</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css')}}" >
    <script type="text/javascript" src="{{ asset('/js/app.js')}}"></script>
  </head>
  <body>
  <div class="title">
      一覧
  </div>
  <a href="{{ route('book.create') }}">本の登録へ</a>
    <a href="{{ route('book.downloadCsv') }}">CSVダウンロード</a>
    <!-- 検索機能 -->
    <div>
      <form action="{{ route('book.search') }}" method="GET">
      @csrf
        <input type="text" name="keyword" placeholder="本のタイトル、作者">
        <input type="submit" value="検索">
      </form>
    </div>

    <table class="index-table">
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
          <td>{{ $book->created_at->format('Y/m/d') }}</td>
          <td><a href="{{ route('book.detail', ['book_id'=>$book->book_id]) }}" class="btn01">詳細</a></td>
          <td><a href="{{ route('book.edit', ['book_id'=>$book->book_id]) }}" class="btn01">編集</a></td>
          <td>
            <form action="{{ route('book.delete', ['book_id'=>$book->book_id]) }}" method="POST">
                @csrf
                <button type="submit"  class="btn01" onClick="delete_alert(event);return false;">削除</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>