<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $primaryKey = 'book_id';
     // 登録・更新可能なカラムの指定
    protected $fillable = [
        'book_name',
        'created_at',
        'updated_at',
        'book_id'
    ];
    
    //一覧画面表示用にbooksテーブルから全てのデータを取得
    public function findAllBooks()
    {
        return Book::all();
    }

    // リクエストデータを基に管理マスターユーザーに登録する
    public function InsertBook($request){
        return $this->create([
            'book_name' => $request->book_name,
            'book_id' => $request->book_id,
        ]);
    }

    //リクエストデータを基に１件を取得
    public function SelectBook($request){
            return Book::select('book_id','book_name')->where('book_id',$request)->get();
    }
  
    //１件更新
    public function updateBook($request,$book){
        //$result = $book->fill([
            //'book_name' => $request->book_name
            //])->save();
            $book ->fill($request->all())->save();
        }

    //１件削除
    public function DeleteBook($request){

    }

}
