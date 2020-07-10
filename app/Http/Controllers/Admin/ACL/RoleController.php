<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateRoleRequest;

class RoleController extends Controller
{
    protected $repository;

    public function __construct(Role $role){
        $this->repository = $role; // depositar em repository, um objeto de PROFILE
    
        $this->middleware(['can:Cargos']); //LIMITANDO ACESSO ACL DE TODO O CONTROLLER
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Gate::allows('permissão'); ou || EM UM METODO
        //$this->authorize("permissão');

        $roles = $this->repository->paginate();

        return view('admin.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRoleRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$role = $this->repository->find($id))
        {
            return redirect()->back();
        }
        return view('admin.pages.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$role = $this->repository->find($id))
        {
            return redirect()->back();
        }

        return view('admin.pages.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateRoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRoleRequest $request, $id)
    {
        if(!$role = $this->repository->find($id))
        {
            return redirect()->back();
        }

        $role->update($request->all());
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$role = $this->repository->find($id))
        {
            return redirect()->back();
        }

        $role->delete();
        return redirect()->route('roles.index');
    
    }

     /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $roles = $this->repository
                                ->where(function($query) use($request){
                                    if ($request->filter)
                                    {
                                        $query->where('name', $request->filter)
                                                    ->orWhere('description', 'LIKE', "%{$request->filter}%");
                                    }
                                })
                                ->paginate();
        //SE PESQUISA FOR MAIOR, LEVAR PRO MODEL, COMO NOS PLANS

        return view('admin.pages.roles.index', compact('roles','filters'));
    }
}
