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
    ]);

    // CEK LOGIN
    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();

        //REDIRECT KE DASHBOARD
        return redirect('/dashboard')->with('success', 'Login berhasil');
    }

    //GAGAL
    return back()->with('error', 'Email atau password salah')->withInput();
}