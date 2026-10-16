<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Multivision Gear</title>
    <!-- Menggunakan Font dari Dashboard -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f4f4f5] flex items-center justify-center h-screen">
    
    <div class="bg-white p-10 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-[#e4e4e7] w-full max-w-md">
        
        <div class="text-center mb-8">
            <!-- Logo Custom -->
            <div class="flex justify-center mb-5">
                <img src="{{ asset('images/logo-saya.png') }}" alt="Logo Multivision" class="w-16 h-16 rounded-xl object-cover shadow-lg border border-[#e4e4e7]">
            </div>
            <h1 class="text-2xl font-extrabold text-[#18181b] tracking-tight mb-1">MULTIVISION <span class="text-[#a1a1aa]">GEAR</span></h1>
            <p class="text-[#71717a] text-sm font-medium">Sistem Manajemen Inventaris</p>
        </div>

        <!-- Tempat menampilkan pesan error -->
        @if($errors->any())
            <div class="bg-[#fff1f2] border border-[#fecdd3] text-[#9f1239] px-4 py-3 rounded-lg mb-6 text-sm font-semibold text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf 
            
            <div class="mb-5">
                <label for="email" class="block text-[#71717a] text-xs font-bold mb-2 uppercase tracking-wide">Email Akun</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                    class="border border-[#e4e4e7] rounded-lg w-full py-3 px-4 text-[#18181b] font-medium leading-tight focus:outline-none focus:border-[#18181b] focus:ring-1 focus:ring-[#18181b] transition bg-[#f4f4f5] focus:bg-white" 
                    placeholder="Contoh: admin@gmail.com">
            </div>
            
            <div class="mb-8">
                <label for="password" class="block text-[#71717a] text-xs font-bold mb-2 uppercase tracking-wide">Password</label>
                <input type="password" name="password" id="password" required 
                    class="border border-[#e4e4e7] rounded-lg w-full py-3 px-4 text-[#18181b] font-medium leading-tight focus:outline-none focus:border-[#18181b] focus:ring-1 focus:ring-[#18181b] transition bg-[#f4f4f5] focus:bg-white" 
                    placeholder="••••••••">
            </div>
            
            <div>
                <button type="submit" 
                    class="bg-[#18181b] hover:bg-[#27272a] text-white font-bold py-3 px-4 rounded-lg w-full focus:outline-none transition duration-200">
                    Masuk ke Sistem
                </button>
            </div>
        </form>
        
        <div class="mt-8 text-center">
            <p class="text-xs text-[#a1a1aa] font-medium">&copy; 2026 Multivision Gear</p>
        </div>

    </div>

</body>
</html>