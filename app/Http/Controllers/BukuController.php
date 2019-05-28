<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Buku;
class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $bukus = Buku::latest()->paginate(5);
      return view('buku.index', compact('bukus'))
          ->with('i', (request()->input('page',1)-1)*5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'judul' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required',
        'pengarang' => 'required'
      ]);
      Buku::create($request->all());
      return redirect() -> route('buku.index')
                        -> with('success','New BookList Succesfully Created');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $buku = Buku::find($id);
      return view ('buku.detail', compact('buku'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $buku = Buku::find($id);
      return view ('buku.edit', compact('buku'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'judul' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required',
        'pengarang' => 'required'
      ]);
      $buku = Buku::find($id);
      $buku->judul = $request->get('judul');
      $buku->penerbit = $request->get('penerbit');
      $buku->tahun_terbit = $request->get('tahun_terbit');
      $buku->pengarang = $request->get('pengarang');
      return redirect() -> route('buku.index')
                        -> with('success','New BookList Succesfully Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $buku = Buku::find($id);
      $buku->delete();
      return redirect() -> route('buku.index')
                        -> with('success','BookList Succesfully Deleted');
    }
}