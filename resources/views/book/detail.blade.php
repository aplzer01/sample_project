<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>詳細</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css')}}" >
  </head>
  <body>
    <div class="container small">
      <div class="title">
          登録情報詳細
      </div>
      <table class="table_detail">
        <tr>
         <th>No.</th>
         <td>{{ $book->book_id }}</td>
       </tr>
      <th>タイトル</th>
              <td>{{ $book->book_name }}</td>
            </tr>
            <tr>
              <th>作者</th>
              <td>{{ $book->book_author }}</td>
            </tr>
            <tr>
              <th>作成日</th>
              <td>{{ $book->created_at }}</td>
            </tr>
            <tr>
              <th>感想</th>
              <td>{{ $book->book_text }}</td>
            </tr>
       </table>
  </body>
</html>