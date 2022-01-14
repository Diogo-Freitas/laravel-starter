<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UploadAvatarRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('panel.profile.index');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        try {

            $user = auth()->user();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            return redirect()->route('panel.profile')->with('success', 'Perfil atualizado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('panel.profile')->with('error', 'Erro ao atualizar o perfil!');
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {

            $user = auth()->user();
            $user->password = bcrypt($request->input('password'));
            $user->save();

            return redirect()->route('panel.profile')->with('success', 'Senha atualizada com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('panel.profile')->with('error', 'Erro ao atualizar a senha!');
        }
    }

    public function updateAvatar(UploadAvatarRequest $request)
    {
        try {

            $user = auth()->user();
            $user->avatar ? Storage::delete($user->avatar) : null;
            $user->avatar = $request->file('avatar')->store('storage/avatar');
            $user->save();

            if (Image::make($user->avatar)->width() > 250) {
                Image::make($user->avatar)
                    ->resize(250, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($user->avatar, 100);
            }

            return redirect()->route('panel.profile')->with('success', 'Foto de perfil atualizada com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('panel.profile')->with('error', 'Erro ao atualizar a foto de perfil!');
        }
    }

    public function destroyAvatar()
    {
        try {

            $user = auth()->user();
            $user->avatar ? Storage::delete($user->avatar) : null;
            $user->avatar = null;
            $user->save();

            return redirect()->route('panel.profile')->with('success', 'Foto de perfil removida com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('panel.profile')->with('error', 'Erro ao remover a foto de perfil!');
        }
    }

    public function destroy()
    {
        try {

            $user = auth()->user();
            $user->avatar ? Storage::delete($user->avatar) : null;
            $user->delete();

            return redirect()->route('login')->with('success', 'Sua conta foi excluida com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('panel.profile')->with('error', 'Erro ao exluir a sua conta!');
        }
    }

    public function toggleTwoFactor()
    {
        try {

            $user = auth()->user();
            $user->two_factor = !$user->two_factor;
            $user->two_factor_code       = null;
            $user->two_factor_expires_at = null;
            $user->save();

            $message = $user->two_factor ? 'Autenticação de dois fatores ativada!' : 'Autenticação de dois fatores desativada!';

            return redirect()->route('panel.profile')->with('success', $message);
        } catch (\Throwable $th) {
            return redirect()->route('panel.profile')->with('error', 'Não foi possível modificar a autenticação de dois fatores!');
        }
    }
}