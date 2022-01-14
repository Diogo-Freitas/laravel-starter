<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\UploadAvatarRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('panel.user.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('panel.user.show', compact('user'));
    }

    public function create()
    {
        return view('panel.user.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $request->file('avatar') ? $user->avatar = $this->upload($request->file('avatar')) : false;
            $user->email_verified_at = $request->input('email_verified_at');
            $user->approved = $request->input('approved');
            $user->is_admin = $request->input('is_admin');
            $user->save();

            return redirect()->route('panel.user.create')->with(['success' => 'Usuário cadastrado com sucesso!', 'user' => $user])->withInput();
        } catch (\Throwable $th) {
            return redirect()->route('panel.user.create')->with('error', 'Erro ao cadastrar usuário!')->withInput();
        }
    }

    public function edit(Request $request, User $user)
    {
        return view('panel.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $request->input('password') ? $user->password = bcrypt($request->input('password')) : null;
            $user->email_verified_at = $request->input('email_verified_at');
            $user->approved = $request->input('approved');
            $user->is_admin = $request->input('is_admin');
            $user->save();

            return redirect()->route('panel.user.edit', $user->id)->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('panel.user.edit', $user->id)->with('error', 'Erro ao atualizar usuário!');
        }
    }

    public function updateAvatar(UploadAvatarRequest $request, User $user)
    {
        try {

            $user->avatar = $this->upload($request->file('avatar'), $user->avatar);
            $user->save();

            return redirect()->route('panel.user.edit', $user->id)->with('success', 'Foto de perfil atualizada com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('panel.user.edit', $user->id)->with('error', 'Erro ao atualizar a foto de perfil!');
        }
    }

    public function destroyAvatar(User $user)
    {
        try {

            $user->avatar ? Storage::delete($user->avatar) : null;
            $user->avatar = null;
            $user->save();

            return redirect()->route('panel.user.edit', $user->id)->with('success', 'Foto de perfil removida com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('panel.user.edit', $user->id)->with('error', 'Erro ao remover a foto de perfil!');
        }
    }

    public function toggleTwoFactor(User $user)
    {
        try {

            $user->two_factor = !$user->two_factor;
            $user->two_factor_code       = null;
            $user->two_factor_expires_at = null;
            $user->save();

            $message = $user->two_factor ? 'Autenticação de dois fatores ativada!' : 'Autenticação de dois fatores desativada!';

            return redirect()->route('panel.user.edit', $user->id)->with('success', $message);
        } catch (\Throwable $th) {
            return redirect()->route('panel.user.edit', $user->id)->with('error', 'Não foi possível modificar a autenticação de dois fatores!');
        }
    }

    public function destroy(User $user)
    {
        try {

            $user->avatar ? Storage::delete($user->avatar) : null;
            $user->delete();

            return redirect()->route('panel.user')->with('success', 'Usuário excluido com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Erro ao remover usuário!');
        }
    }

    
    public function upload($store, $destroy = null)
    {
        $file = $store->store('storage/avatar');

        if (Image::make($file)->width() > 250) {
            Image::make($file)
                ->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($file, 100);
        }

        if ($destroy) {
            Storage::delete($destroy);
        }

        return $file;
    }
}
