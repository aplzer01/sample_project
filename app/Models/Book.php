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
        'book_author',
        'book_text',
        'created_at',
        'updated_at'
    ];
    
    //全てのデータを取得
    public function findAllBooks()
    {
        return Book::all();
    }
    
    //検索
    public function searchBook($request){
        return Book::select('book_id','book_name','book_author')->where('book_name',$request)->get();
    }

    //１件登録
    public function InsertBook($request){
        return $this->create([
            'book_name' => $request->book_name,
            'book_author' => $request->book_author,
            'book_text' => $request->book_text,
        ]);
    }

    //１件取得
    public function SelectBook($request){
            return Book::select('book_id','book_name','book_author')->where('book_id',$request)->get();
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

    //インポート
    public function csvHeader(): array
    {
        return [
            'book_id',
            'book_name',
            'book_author',
            'book_text',
            'created_at',
            'updated_at'
        ];
    }

    public function getCsvData(): \Illuminate\Support\Collection
    {
        $data = DB::table('books')->get();
        return $data;
    }
    public function insertRow($row): array
    {
        return [
            $row->book_id,
            $row->book_name,
            $row->book_author,
            $row->book_text,
            $row->created_at,
            $row->updated_at,
        ];
    }

}
