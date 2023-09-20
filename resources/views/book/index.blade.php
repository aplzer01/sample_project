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
  
<div class="title">トップページ</div>  
<hr>
  <table>
  <tr>
    <th>
      <!-- 登録画面へ -->
      <a href="{{ route('book.create') }}" class="btn02">本の登録</a>
    </th>
    <th><a href="{{ route('book.download') }}" class="btn02">CSVダウンロード</a></th>
  </tr>
  </table>
  <!-- 検索機能 -->
  <hr>
  <div class="sub-title">
      本を検索する
    </div>
  <div class="search">     
       <form action="{{ route('book.search') }}" method="GET">
        @csrf        
        <input type="text" name="keyword" placeholder="本のタイトル、作者">
        <input type="submit" value="検索" class="btn01">
        </form>
</div>
<hr>
   <!-- 一覧表 -->  
   <div class="sub-title">
      登録されている本の一覧
    </div>
   <div>
    <table border="1">
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
          <td>
            @if($book->created_at)
              {{$book->created_at->format('Y/m/d') }}
            @else
              {{null}}
            @endif
          </td>
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
    </div>
    <hr>

    <!-- インポート -->
    <div class="sub-title">
      csvインポート
    </div>
    <div class="upload">
      <form method="post" action="{{ route('book.upload') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csvFile"  id="csvFile"/>
        <input type="submit"></input>
      </form>
    </div>
  </body>
</html>