<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') | Chikondi Organisation</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
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

    <style>
        body { 
            scroll-behavior: smooth; 
            overflow-x: hidden;
        }
        
        .sidebar-link {
            transition: all 0.2s ease;
        }
        .sidebar-link:hover {
            background: rgba(220, 38, 38, 0.08);
            color: #DC2626;
        }
        .sidebar-link.active {
            background: rgba(220, 38, 38, 0.1);
            color: #DC2626;
            border-left: 3px solid #DC2626;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -280px;
                transition: left 0.3s ease;
                z-index: 1050;
                height: 100%;
                width: 280px;
                overflow-y: auto;
            }
            .sidebar.open {
                left: 0;
            }
            .main-content {
                margin-left: 0 !important;
                width: 100%;
            }
            .mobile-menu-btn {
                display: block !important;
            }
            .sidebar-backdrop {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
            }
            .sidebar-backdrop.active {
                display: block;
            }
        }
        
        @media (min-width: 769px) {
            .mobile-menu-btn {
                display: none !important;
            }
            .sidebar-backdrop {
                display: none !important;
            }
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100%;
                z-index: 100;
            }
            .main-content {
                margin-left: 256px;
            }
        }

        .toast-notification {
            animation: slideInRight 0.3s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        .toast-notification.hide {
            animation: slideOutRight 0.3s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideOutRight {
            from { opacity: 1; transform: translateX(0); }
            to { opacity: 0; transform: translateX(100%); }
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .modal-content {
            transform: scale(0.95);
            transition: transform 0.3s ease;
            margin: 1rem;
            max-width: 90%;
        }
        .modal-overlay.active .modal-content {
            transform: scale(1);
        }
    </style>

    @yield('extra_styles')
</head>
<body class="bg-surface text-accent font-sans">

@php use App\Models\SiteSetting; @endphp

    <!-- Mobile Menu Toggle Button -->
    <button id="mobile-menu-btn" class="mobile-menu-btn fixed top-4 left-4 z-[1060] bg-accent text-white p-2 rounded-xl shadow-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Sidebar Backdrop -->
    <div id="sidebar-backdrop" class="sidebar-backdrop"></div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar w-64 bg-accent text-white flex flex-col">
            <button id="close-sidebar" class="mobile-menu-btn absolute top-4 right-4 text-white/70 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <div class="p-6 border-b border-white/10">
                <img src="{{ SiteSetting::get('logo', asset('images/tab-logo.png')) }}" alt="Chikondi Logo" class="h-10 w-auto brightness-0 invert opacity-80">
                <p class="text-white/30 text-[9px] font-black uppercase tracking-[0.2em] mt-2">Admin Panel</p>
            </div>

            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-3 px-3 py-2 rounded-xl text-white/70 text-xs font-bold uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.news.index') }}" class="sidebar-link {{ request()->routeIs('admin.news*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2 rounded-xl text-white/70 text-xs font-bold uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    News
                </a>
                <a href="{{ route('admin.contacts') }}" class="sidebar-link {{ request()->routeIs('admin.contacts') ? 'active' : '' }} flex items-center gap-3 px-3 py-2 rounded-xl text-white/70 text-xs font-bold uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Messages
                </a>
                <a href="{{ route('admin.progress.index') }}" class="sidebar-link {{ request()->routeIs('admin.progress*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2 rounded-xl text-white/70 text-xs font-bold uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Progress
                </a>
                <a href="{{ route('admin.settings') }}" class="sidebar-link {{ request()->routeIs('admin.settings') ? 'active' : '' }} flex items-center gap-3 px-3 py-2 rounded-xl text-white/70 text-xs font-bold uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Settings
                </a>
            </nav>

            <div class="p-4 border-t border-white/10">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-xl text-white/50 hover:text-brand text-xs font-bold uppercase tracking-widest transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main id="main-content" class="main-content flex-1 w-full min-h-screen">
            <div class="bg-white border-b border-accent/5 px-4 py-3 flex flex-wrap justify-between items-center gap-3">
                <h1 class="font-display font-black text-lg sm:text-xl text-accent uppercase tracking-tight page-title">@yield('page_title')</h1>
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-accent/40 uppercase tracking-widest hidden sm:block">{{ Auth::user()->name }}</span>
                    <div class="w-8 h-8 rounded-full bg-brand flex items-center justify-center text-white font-black text-xs">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-6 content-padding">
                @if(session('success'))
                    <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm font-bold">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal-overlay">
        <div class="modal-content bg-white rounded-2xl max-w-md w-full mx-4 p-6 shadow-2xl">
            <div class="text-center">
                <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-black text-accent mb-2">Are you sure?</h3>
                <p id="deleteModalMessage" class="text-accent/60 text-sm mb-6">This action cannot be undone.</p>
                <div class="flex gap-3">
                    <button id="cancelDeleteBtn" class="flex-1 px-3 py-2 bg-surface text-accent font-bold rounded-xl hover:bg-accent/10 transition text-sm">Cancel</button>
                    <button id="confirmDeleteBtn" class="flex-1 px-3 py-2 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition text-sm">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-16 right-4 z-[1070] space-y-2"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const closeSidebar = document.getElementById('close-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');

            function openSidebar() {
                sidebar.classList.add('open');
                if (backdrop) backdrop.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebarFunc() {
                sidebar.classList.remove('open');
                if (backdrop) backdrop.classList.remove('active');
                document.body.style.overflow = '';
            }

            if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openSidebar);
            if (closeSidebar) closeSidebar.addEventListener('click', closeSidebarFunc);
            if (backdrop) backdrop.addEventListener('click', closeSidebarFunc);

            function showToast(message, type = 'success') {
                const container = document.getElementById('toast-container');
                if (!container) return;

                const toast = document.createElement('div');
                toast.className = 'toast-notification flex items-center gap-2 px-4 py-3 rounded-xl shadow-lg border-l-4 min-w-[240px] max-w-sm text-sm';
                
                if (type === 'success') {
                    toast.classList.add('bg-green-50', 'border-green-500', 'text-green-800');
                    toast.innerHTML = `
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-bold">${message}</span>
                        <button class="ml-auto text-green-600 hover:text-green-800" onclick="this.parentElement.remove()">×</button>
                    `;
                } else if (type === 'error') {
                    toast.classList.add('bg-red-50', 'border-red-500', 'text-red-800');
                    toast.innerHTML = `
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="font-bold">${message}</span>
                        <button class="ml-auto text-red-600 hover:text-red-800" onclick="this.parentElement.remove()">×</button>
                    `;
                }

                container.appendChild(toast);
                setTimeout(() => {
                    toast.classList.add('hide');
                    setTimeout(() => { if (toast.parentElement) toast.remove(); }, 300);
                }, 3000);
            }

            @if(session('success'))
                showToast('{{ session('success') }}', 'success');
            @endif

            window.showToast = showToast;

            let pendingDeleteForm = null;
            const modal = document.getElementById('deleteModal');
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            const cancelBtn = document.getElementById('cancelDeleteBtn');

            window.confirmDelete = function(message, formElement) {
                pendingDeleteForm = formElement;
                const msgEl = document.getElementById('deleteModalMessage');
                if (msgEl) msgEl.textContent = message || 'This action cannot be undone.';
                modal.classList.add('active');
            };

            function closeModal() {
                modal.classList.remove('active');
                pendingDeleteForm = null;
            }

            if (confirmBtn) {
                confirmBtn.addEventListener('click', function() {
                    if (pendingDeleteForm) {
                        pendingDeleteForm.submit();
                    }
                    closeModal();
                });
            }

            if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
            if (modal) modal.addEventListener('click', function(e) { if (e.target === modal) closeModal(); });
        });
    </script>

    @yield('extra_scripts')

</body>
</html>