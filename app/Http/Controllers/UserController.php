<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-user|crear-user|editar-user|eliminar-user', ['only' => ['index']]);
        $this->middleware('permission:crear-user', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try{
            DB::beginTransaction();

            // Hashear la contraseña
            $fieldHash = Hash::make($request->password);

            // Modificar el valor del request
            $request->merge(['password' => $fieldHash]);

            // Filtrar los roles
            $permission = Role::where('id', $request->role)->pluck('name');

            // Utilizar la asignacion masiva para crear el usuario
            User::create($request->all())->assignRole($permission);
            

           DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('users.index')->with('success', 'Usuario registrado correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try{
            DB::beginTransaction();

            if (empty($request->password)){
                $request = Arr::except($request, array('password'));
            }else{
                $fielHash = Hash::make($request->password);
                $request->merge(['password' => $fielHash]);
            }

            // Actualizar al usuario
            $user->update($request->all());

            // Borrar sus roles previos y asignar uno nuevo
            $user->syncRoles([$request->role]);

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('users.index')->with('success', 'Usuario modificado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        
        $user = User::find($id);
        
        // Eliminar Rol asociado al usuario
        $rolUser = $user->getRoleNames()->first();

        $user->removeRole($rolUser);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente!');
    }
}
