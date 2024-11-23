<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if (auth()->user()->hasRole(['admin'])) {
            Alert::toast('<span class="toast-information">Anda telah berhasil masuk</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect('admin/dashboard');
        } elseif (auth()->user()->hasRole(['petugas'])) {
            Alert::toast('<span class="toast-information">Anda telah berhasil masuk</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect('petugas/dashboard');
        } elseif (auth()->user()->hasRole(['siswa'])) {
            Alert::toast('<span class="toast-information">Anda telah berhasil masuk</span>')->hideCloseButton()->padding('25px')->toHtml();
            return redirect('siswa/dashboard');
        } else {
            return redirect('/');
        }
    }
}
