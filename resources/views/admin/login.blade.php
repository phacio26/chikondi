<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login | Chikondi Organisation</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand': '#DC2626',
                        'surface': '#F8FAFC',
                        'accent': '#1E293B',
                    },
                    fontFamily: {
                        'sans': ['Plus Jakarta Sans', 'sans-serif'],
                        'display': ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-accent min-h-screen flex items-center justify-center font-sans">

    <div class="w-full max-w-md px-4">
        <div class="text-center mb-10">
            <img src="{{ asset('images/logo.png') }}" alt="Chikondi Logo" class="h-16 w-auto brightness-0 invert opacity-80 mx-auto mb-6">
            <h1 class="font-display text-3xl font-black text-white uppercase tracking-tight">Admin Panel</h1>
            <p class="text-white/30 text-xs font-bold uppercase tracking-widest mt-2">Chikondi Organisation</p>
        </div>

        <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-2xl">
            <p class="text-brand font-black text-[10px] uppercase tracking-[0.3em] mb-8">Sign In</p>

            @if($errors->any())
                <div class="mb-6 px-6 py-4 bg-red-50 border border-red-200 text-brand rounded-2xl text-sm font-bold">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-6 py-4 bg-surface border-2 {{ $errors->has('email') ? 'border-brand' : 'border-transparent' }} focus:border-brand focus:bg-white transition-all rounded-2xl outline-none font-bold text-accent"
                           placeholder="admin@chikondi.com">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-accent/40 mb-3">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-6 py-4 bg-surface border-2 {{ $errors->has('password') ? 'border-brand' : 'border-transparent' }} focus:border-brand focus:bg-white transition-all rounded-2xl outline-none font-bold text-accent"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-accent/20 text-brand focus:ring-brand">
                    <label for="remember" class="text-xs font-bold text-accent/50 uppercase tracking-widest">Remember Me</label>
                </div>

                <button type="submit" class="w-full py-4 bg-brand text-white font-black text-xs uppercase tracking-[0.3em] rounded-2xl hover:bg-accent transition-all">
                    Sign In
                </button>
            </form>
        </div>

        <p class="text-center text-white/20 text-[10px] font-bold uppercase tracking-widest mt-8">
            &copy; 2026 Chikondi Organisation
        </p>
    </div>

</body>
</html>