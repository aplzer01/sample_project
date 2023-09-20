<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Book;

class BookController extends Controller
{
    //
    public function __construct()
    {
        $this->book = new Book();
    }

    /**
     * 一覧画面
     */
    public function index()
    {
        $books = $this->book->findAllBooks();
        return view('book.index')->with('books',$books);

        //return view('book.index', compact('books'));
    }

    /**
     * 登録画面
     */
    public function create(Request $request)
    {        
        return view('book.create');
    }

    //登録
    public function store(Request $request)
    {
        $registerBook = $this->book->InsertBook($request);
        return redirect()->route('book.index');
    }

    //詳細表示
    public function detail($book_id)
    {
       // ddd($request);
        $book = Book::find($book_id);
        return view('book.detail')->with('book',$book);
    }
    
    //更新：編集画面を表示
    public function edit($book_id)
    {
        $book = Book::find($book_id);
        return view('book.edit')->with('book',$book);
    }
    //更新：登録処理
    public function update(Request $request, $book_id)
    {
        $book = Book::find($book_id);
        $updateBook = $this->book->updateBook($request,$book);
        return redirect()->route('book.index');
    }

    //１件削除
    public function delete($book_id)
    {
        $book = Book::find($book_id);
        $book->delete();
        return redirect()->route('book.index');
    }

    //CSVダウンロード
    public function downloadCsv()
    {
        $books = Book::all();
        $stream = fopen('php://temp', 'w');   //ストリームを書き込みモードで開く
        $arr = array('id', 'name');           //CSVファイルのカラム（列）名の指定
        
        fputcsv($stream, $arr);               //1行目にカラム（列）名のみを書き込む（繰り返し処理には入れない）
        foreach ($books as $book) {
            $arrInfo = array(
                'id' => $book->book_id,
                'name' => $book->book_name
                );
            fputcsv($stream, $arrInfo);       //DBの値を繰り返し書き込む
        }
        
        rewind($stream);                      //ファイルポインタを先頭に戻す
        $csv = stream_get_contents($stream);  //ストリームを変数に格納
        $csv = mb_convert_encoding($csv, 'sjis-win', 'UTF-8');   //文字コードを変換
        
        fclose($stream);                      //ストリームを閉じる
        
        $headers = array(                     //ヘッダー情報を指定する
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=test.csv'
        );
        
        return Response::make($csv, 200, $headers);   //ファイルをダウンロードする
    }
}
