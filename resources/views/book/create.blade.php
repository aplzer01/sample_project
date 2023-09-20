<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>本の感想を登録</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css')}}" >
  </head>
  <body>
    <div>
      <div class="title">
        本を登録
      </div>
      @if ($errors->any())
        <div>
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
      @endif
      <form action="{{ route('book.store') }}" method="POST">
      @csrf
        <fieldset>
          <table>
            <tr>
              <th>タイトル</th>
              <td><input type="text" class="form-name" name="book_name" id="book_name"></td>
            </tr>
            <tr>
              <th>作者</th>
              <td><input type="text" class="form-author" name="book_author" id="book_author"></td>
            </tr>
            <tr>
              <th>感想</th>
              <td><textarea type="text" class="form-text" name="book_text" id="book_text"></textarea></td>
            </tr>
          </table>
          <button type="submit" class="btn01">登録</button>
        </fieldset>
      </form>
      <br>
      <a href="{{ route('book.index') }}" role="button" class="btn02">TOPへ</a>
    </div>
  </body>
</html>