<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Exception;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->successResponse([
                'user' => new UserResource($user),
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 'Registrasi berhasil', 201);
        } catch (Exception $e) {
            return $this->errorResponse('Registrasi gagal: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Handle user login and token generation
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorResponse('Email atau password salah.', 401);
        }

        // Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse([
            'user' => new UserResource($user),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 'Login berhasil');
    }

    /**
     * Get authenticated user info
     */
    public function me(Request $request)
    {
        return $this->successResponse(new UserResource($request->user()));
    }

    /**
     * Handle user logout (revoke token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse(null, 'Logout berhasil');
    }

    /**
     * Send password reset link via email (lupa password)
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak ditemukan',
        ]);

        try {
            $status = Password::sendResetLink($request->only('email'));

            if ($status === Password::RESET_LINK_SENT) {
                return $this->successResponse(null, 'Link reset password telah dikirim ke email Anda');
            }

            return $this->errorResponse('Gagal mengirim link reset password', 500);
        } catch (Exception $e) {
            return $this->errorResponse('Gagal mengirim email: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Reset password with token (from email link)
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return $this->successResponse(null, 'Password berhasil direset');
        }

        return $this->errorResponse('Token reset password tidak valid', 400);
    }

    /**
     * Change password (user authenticated - ganti password)
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi',
            'password.required' => 'Password baru wajib diisi',
            'password.min' => 'Password baru minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->errorResponse('Password lama tidak cocok', 422);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return $this->successResponse(null, 'Password berhasil diubah');
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'phone' => 'nullable|string|max:20',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = $request->user();
        $data = $request->only(['name', 'phone']);

        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');
            // Delete old photo
            if ($user->foto_profile) {
                $oldPath = str_replace('/storage', 'public', $user->foto_profile);
                \Illuminate\Support\Facades\Storage::delete($oldPath);
            }
            $path = $file->store('public/users');
            $data['foto_profile'] = \Illuminate\Support\Facades\Storage::url($path);
        }

        $user->update($data);

        return $this->successResponse(new UserResource($user->fresh()), 'Profil berhasil diperbarui');
    }
}
