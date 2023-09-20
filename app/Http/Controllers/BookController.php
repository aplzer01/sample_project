<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //
    public function __construct()
    {
        $this->book = new Book();
    }

    //一覧表示
    public function index()
    {
        $books = $this->book->findAllBooks();
        return view('book.index')->with('book',$books);

        //return view('book.index', compact('books'));
    }

    //検索
    public function search(Request $request)
    {
        #キーワード受け取り
        $keyword = $request->input('keyword');
        $book = Book::where('book_name','like','%'.$keyword.'%')->orWhere('book_author','like','%'.$keyword.'%')->get();
        return view('book.search')->with('book',$book);;   
    }

    //登録画面
    public function create(Request $request)
    {        
        return view('book.create');
    }

    //登録
    public function store(Request $request)
    {
        $request->validate([
            'book_name'=>'required|max:50',
            'book_author'=>'max:50',
            'book_text'=>'max:200',
        ]);
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
        $request->validate([
            'book_name'=>'required|max:50',
            'book_author'=>'max:50',
            'book_text'=>'max:200',
        ]);
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

    //CSVインポート
    public function upload(Request $request)
    {
        $book = new Book();
        // CSVファイルが存在するかの確認
        if ($request->hasFile('csvFile')) {
            //ファイルの保存
            $newCsvFileName = $request->csvFile->getClientOriginalName();
            $request->csvFile->storeAs('public/csv', $newCsvFileName);
        } else {
            throw new Exception('CSVファイルの取得に失敗しました。');
        }
        //保存したCSVファイルの取得
        $csv = Storage::disk('local')->get("public/csv/{$newCsvFileName}");
        // OS間やファイルで違う改行コードをexplode統一
        $csv = str_replace(array("\r\n", "\r"), "\n", $csv);
        // $csvを元に行単位のコレクション作成。explodeで改行ごとに分解
        $uploadedData = collect(explode("\n", $csv));

        $header = collect($book->csvHeader());
        $cnt=count($uploadedData);
        for ($i=1; $i < $cnt; $i++) {
        $insertData = explode(",",$uploadedData[$i]);
        
        DB::table('books')->insert([
            ['book_id' => $insertData[0],
            'book_name' => $insertData[1],
            'book_author' => $insertData[2],
            'book_text' => $insertData[3]]
        ]);
        }
        return view('book.done');
    }

    //CSVダウンロード
     public function download()
    {   
        $fileName = 'books.csv';
        $books = Book::all();
        $stream = fopen($fileName, 'c');   //ストリームを書き込みモードで開く
        $arr = array('book_id', 'book_name', 'book_author', 'book_text');           //CSVファイルのカラム（列）名の指定
        
        fputcsv($stream, $arr);               //1行目にカラム（列）名のみを書き込む（繰り返し処理には入れない）
        foreach ($books as $book) {
            $arrInfo = array(
                'book_id' => $book->book_id,
                'book_name' => $book->book_name,
                'book_author' => $book->book_author,
                'book_text' => $book->book_text
            );
            
            fputcsv($stream, $arrInfo);       //DBの値を繰り返し書き込む
        }
        rewind($stream);                      //ファイルポインタを先頭に戻す
        fclose($stream);                      //ストリームを閉じる
        return response()->download($fileName);
    }
}