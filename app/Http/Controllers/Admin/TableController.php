<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTableRequest;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    private $repository;

    public function __construct(Table $table){
        $this->repository = $table;
    
        $this->middleware(['can:Mesas']); //LIMITANDO ACESSO ACL DE TODO O CONTROLLER
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->repository->latest()->paginate();

        return view('admin.pages.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateTableRequest;
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTableRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('tables.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$table = $this->repository->find($id)){
            return redirect()->back();
        }
        
        return view('admin.pages.tables.show', compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$table = $this->repository->find($id)){
            return redirect()->back();
        }
        return view('admin.pages.tables.edit', compact('table'));
    }

    /**
     * Update register by id
     * @param  int  $id
     * @param  App\Http\Requests\StoreUpdateTableRequest;
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTableRequest $request, $id)
    {
        if(!$table = $this->repository->find($id)){
            return redirect()->back();
        }

        $table->update($request->all());
        return redirect()->route('tables.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$table = $this->repository->find($id)){
            return redirect()->back();
        }

        $table->delete();

        return redirect()->route('tables.index');
    }


    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $tables = $this->repository
                                ->where(function($query) use($request){
                                    if ($request->filter)
                                    {
                                        $query->orWhere('description', 'LIKE', "%{$request->filter}%");
                                        $query->orWhere('identify', 'LIKE', "%{$request->filter}%");
                                    }
                                })
                                ->latest()
                                ->paginate();
        //SE PESQUISA FOR MAIOR, LEVAR PRO MODEL, COMO NOS PLANS

        return view('admin.pages.tables.index', compact('tables','filters'));
    }

    /**
     * Generate QrCode Table.
     *
     * @param  int  $identify
     * @return \Illuminate\Http\Response
     */
    public function qrcode($identify)
    {
        if(!$table = $this->repository->where('identify', $identify)->first()){
            return redirect()->back();
        }

        $tenant = auth()->user()->tenant;

        $uri = env('URI_CLIENT'). "/{$tenant->uuid}/{$table->uuid}";
        
        return view('admin.pages.tables.qrcode', compact('uri'));
    }
}
