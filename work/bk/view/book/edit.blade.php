
<div class="container small">
  <h1>本を編集</h1>
  <form action="{{ route('book.update', ['book_id'=>$book->book_id]) }}" method="POST">
  @csrf
    <fieldset>
      <div class="form-group">
        <label for="book_name">{{ __('本の名称') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="text" class="form-control" name="book_name" id="book_name">
      </div>
      <div class="d-flex justify-content-between pt-3">
        <a href="{{ route('book.index') }}" class="btn btn-outline-secondary" role="button">
            <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('一覧画面へ') }}
        </a>
        <button type="submit" class="btn btn-success">
            {{ __('更新') }}
        </button>
      </div>
    </fieldset>
  </form>
</div>





