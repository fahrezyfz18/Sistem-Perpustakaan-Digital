use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

public function login()
{
    return view('login');
}

public function loginProcess(Request $request)
{
    // VALIDASI
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6'
        ], [
    'email.required' => 'Email wajib diisi',
    'email.email' => 'Format email tidak valid',
    'password.required' => 'Password wajib diisi',
    'password.min' => 'Password minimal 6 karakter'
    ]);

     // LOGIN
    if (Auth::attempt($request->only('email', 'password'))) {
        return redirect()->intended('/dashboard');
    }

    // CEK LOGIN
    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();

        //REDIRECT KE DASHBOARD
        return redirect('/dashboard')->with('success', 'Login berhasil');
    }

    //GAGAL
    return back()->with('error', 'Email atau password salah')->withInput();
}