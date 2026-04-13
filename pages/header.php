<!doctype html>
<html lang="bn" class="h-full scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    <meta name="theme-color" content="#059669" />
    <title>Naafiun — বই ও ইসলামিক পণ্য</title>
    <base href="<?php echo domain; ?>">
    <meta name="description" content="Naafiun — ইসলামিক বই ও গিফট শপ" />

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ["ui-sans-serif", "system-ui", "Segoe UI", "Roboto", "Helvetica", "Arial", "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji"],
            },
          },
        },
      };
    </script>

    <style>
      .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
      .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
      .scrollbar-hide::-webkit-scrollbar { display: none; }
      body { padding-bottom: 0; }
      @supports (padding-bottom: env(safe-area-inset-bottom)) {
        .bottom-nav { padding-bottom: env(safe-area-inset-bottom); }
        body.has-bottom-nav { padding-bottom: calc(4rem + env(safe-area-inset-bottom)); }
      }
      /* AJAX search suggestion animation */
      #searchSuggestions { transition: opacity 0.2s ease, transform 0.2s ease; }
      #searchSuggestions.hidden { opacity: 0; transform: translateY(-8px); pointer-events: none; }
      #searchSuggestions:not(.hidden) { opacity: 1; transform: translateY(0); }
    </style>
  </head>

  <body class="min-h-full bg-white text-slate-900">

    <!-- ===== HEADER ===== -->
    <header class="sticky top-0 z-50 bg-white shadow-sm">

      <!-- ===== DESKTOP HEADER ===== -->
      <div class="hidden sm:block border-b border-slate-100">
        <div class="mx-auto flex max-w-7xl items-center gap-6 px-4 py-3">
          <!-- Logo - bigger -->
          <a class="shrink-0" href="<?php echo domain; ?>">
            <img src="assets/images/naafiun.webp" alt="Naafiun" class="h-12 w-auto" />
          </a>

          <!-- Search - centered in middle -->
          <div class="flex-1 max-w-2xl mx-auto relative">
            <form action="<?php echo domain; ?>" method="get" autocomplete="off">
              <div class="relative">
                <input
                  id="q" name="q" type="search"
                  placeholder="বই, লেখক বা প্রকাশনী খুঁজুন…"
                  class="w-full rounded-xl border-2 border-slate-200 bg-slate-50 py-3 pl-5 pr-12 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white transition"
                  autocomplete="off"
                />
                <button class="absolute right-2 top-1/2 -translate-y-1/2 rounded-lg bg-emerald-600 p-2 text-white hover:bg-emerald-700 transition" type="submit" aria-label="খুঁজুন">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35" stroke-linecap="round"/>
                  </svg>
                </button>
              </div>
            </form>

            <!-- AJAX Search Suggestions Dropdown -->
            <div id="searchSuggestions" class="hidden absolute left-0 right-0 top-full mt-2 rounded-xl border border-slate-200 bg-white shadow-xl z-50 overflow-hidden">
              <!-- Loading state -->
              <div id="searchLoading" class="hidden px-4 py-3 text-center">
                <svg class="animate-spin h-5 w-5 text-emerald-600 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                <p class="mt-1 text-xs text-slate-400">খুঁজছি…</p>
              </div>
              <!-- Results -->
              <div id="searchResults" class="max-h-80 overflow-y-auto scrollbar-hide"></div>
              <!-- No results -->
              <div id="searchNoResults" class="hidden px-4 py-6 text-center">
                <svg class="h-10 w-10 text-slate-300 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35" stroke-linecap="round"/></svg>
                <p class="mt-2 text-sm text-slate-500">কোনো ফলাফল পাওয়া যায়নি</p>
              </div>
            </div>
          </div>

          <!-- Actions - right side -->
          <div class="flex shrink-0 items-center gap-1 ml-auto">
            <!-- Wishlist -->
            <a class="group flex flex-col items-center rounded-xl px-3 py-2 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition" href="wishlist">
              <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="mt-0.5 text-[10px] font-medium">উইশলিস্ট</span>
            </a>

            <!-- Cart -->
            <button class="cart-trigger group relative flex flex-col items-center rounded-xl px-3 py-2 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition" type="button" aria-label="কার্ট">
              <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="mt-0.5 text-[10px] font-medium">কার্ট</span>
              <span class="cart-badge-count absolute -right-0.5 top-0.5 grid h-5 w-5 place-items-center rounded-full bg-emerald-600 text-[10px] font-bold text-white ring-2 ring-white">0</span>
            </button>

            <!-- Divider -->
            <div class="mx-2 h-10 w-px bg-slate-200"></div>

            <!-- Login Button -->
            <a class="flex items-center gap-2 rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-500 px-5 py-2.5 text-sm font-bold text-white hover:from-emerald-700 hover:to-emerald-600 transition shadow-sm hover:shadow-md" href="login">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span>লগইন</span>
            </a>
          </div>
        </div>
      </div>

      <!-- ===== MOBILE HEADER ===== -->
      <div class="sm:hidden">
        <div class="flex items-center gap-2 px-3 py-2.5">
          <!-- Logo -->
          <a class="shrink-0" href="<?php echo domain; ?>">
            <img src="assets/images/naafiun.webp" alt="Naafiun" class="h-8 w-auto" />
          </a>

          <!-- Search Icon -->
          <button id="mobileSearchBtn" type="button" class="flex h-10 w-10 items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 hover:text-emerald-600 transition" aria-label="খুঁজুন">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35" stroke-linecap="round"/>
            </svg>
          </button>

          <div class="flex-1"></div>

          <!-- Category Icon -->
          <button id="mobileCatBtn" type="button" class="flex h-10 w-10 items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 hover:text-emerald-600 transition" aria-label="ক্যাটাগরি">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"/>
            </svg>
          </button>

          <!-- Profile / Login -->
          <div class="relative">
            <button id="mobileProfileBtn" type="button" class="flex h-10 w-10 items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 hover:text-emerald-600 transition" aria-label="প্রোফাইল" aria-expanded="false">
              <svg id="profileIconGuest" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <img id="profileAvatarMobile" src="" alt="" class="hidden h-7 w-7 rounded-full object-cover ring-2 ring-emerald-500" />
            </button>

            <!-- Profile Dropdown -->
            <div id="profileDropdown" class="absolute right-0 top-full mt-1 hidden w-60 rounded-xl border border-slate-200 bg-white py-2 shadow-xl z-[60]">
              <div id="profileLoggedIn" class="hidden">
                <div class="px-4 py-3 border-b border-slate-100">
                  <div class="flex items-center gap-3">
                    <img src="" alt="" class="h-10 w-10 rounded-full bg-slate-100 object-cover ring-2 ring-emerald-500" id="dropdownAvatar" />
                    <div class="min-w-0">
                      <p class="text-sm font-semibold text-slate-900 truncate" id="dropdownName">আপনার নাম</p>
                      <p class="text-xs text-slate-500 truncate" id="dropdownEmail">user@email.com</p>
                    </div>
                  </div>
                </div>
                <a href="my-orders" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                  <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                  আমার অর্ডার
                </a>
                <a href="my-orders" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                  <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                  উইশলিস্ট
                </a>
                <a href="profile" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                  <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                  প্রোফাইল আপডেট
                </a>
                <a href="change-password" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                  <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                  পাসওয়ার্ড পরিবর্তন
                </a>
                <div class="border-t border-slate-100 mt-1 pt-1">
                  <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    লগআউট
                  </a>
                </div>
              </div>
              <div id="profileLoggedOut">
                <a href="wishlist" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                  <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                  উইশলিস্ট
                </a>
                <div class="border-t border-slate-100 mt-1 pt-1">
                  <a href="login" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-emerald-600 hover:bg-emerald-50 transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    লগইন / সাইনআপ
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Mobile Search Bar -->
        <div id="mobileSearchBar" class="hidden border-t border-slate-100 bg-white px-3 py-2.5">
          <form action="<?php echo domain; ?>" method="get">
            <div class="relative">
              <input
                id="q_mobile" name="q" type="search"
                placeholder="বই, লেখক বা প্রকাশনী খুঁজুন…"
                class="w-full rounded-xl border border-slate-300 bg-slate-50 py-3 pl-4 pr-12 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 focus:bg-white"
                autofocus
              />
              <button class="absolute right-2 top-1/2 -translate-y-1/2 rounded-lg bg-emerald-600 p-2 text-white hover:bg-emerald-700 transition" type="submit" aria-label="খুঁজুন">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35" stroke-linecap="round"/>
                </svg>
              </button>
            </div>
          </form>
        </div>

        <!-- Mobile Category Dropdown -->
        <div id="mobileCatBar" class="hidden border-t border-slate-100 bg-white px-3 py-3 max-h-64 overflow-y-auto scrollbar-hide">
          <div class="grid grid-cols-2 gap-2">
            <a href="<?php echo domain; ?>" class="flex items-center gap-2 rounded-xl bg-emerald-50 px-3 py-2.5 text-sm font-semibold text-emerald-700 transition active:scale-95">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1" stroke-linecap="round" stroke-linejoin="round"/></svg>
              হোম
            </a>
            <a href="category" class="flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition active:scale-95">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-linecap="round" stroke-linejoin="round"/></svg>
              ক্যাটাগরি
            </a>
            <a href="category" class="flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition active:scale-95">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
              নতুন বই
            </a>
            <a href="category" class="flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition active:scale-95">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
              ট্রেন্ডিং
            </a>
            <a href="category" class="flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition active:scale-95">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-linecap="round" stroke-linejoin="round"/></svg>
              বান্ডিল
            </a>
            <a href="category" class="flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition active:scale-95">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round"/></svg>
              প্রকাশনী
            </a>
          </div>
        </div>
      </div>

      <!-- Category Nav - desktop only -->
      <nav class="hidden sm:block shadow-sm text-sm" aria-label="Primary">
        <div class="mx-auto max-w-7xl px-4">
          <div class="flex items-center gap-2 overflow-x-auto pb-2 pt-2 scrollbar-hide">
            <a class="group flex shrink-0 items-center gap-1.5 rounded-full bg-emerald-600 px-3.5 py-1.5 font-semibold text-white hover:bg-emerald-700 transition" href="<?php echo domain; ?>">
              <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1" stroke-linecap="round" stroke-linejoin="round"/></svg>
              হোম
            </a>
            <a class="group flex shrink-0 items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="category">
              <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-linecap="round" stroke-linejoin="round"/></svg>
              বই
            </a>
            <a class="group flex shrink-0 items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="category">
              <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 6h.008v.008H6V6z" stroke-linecap="round" stroke-linejoin="round"/></svg>
              বিষয় সমূহ
            </a>
            <a class="group flex shrink-0 items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="category">
              <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" stroke-linecap="round" stroke-linejoin="round"/><path d="M19.5 21H4.5a2.25 2.25 0 01-2.25-2.25v-4.5a2.25 2.25 0 012.25-2.25h3" stroke-linecap="round" stroke-linejoin="round"/></svg>
              লেখক
            </a>
            <a class="group flex shrink-0 items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="category">
              <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" stroke-linecap="round" stroke-linejoin="round"/></svg>
              প্রকাশক
            </a>
            <a class="group flex shrink-0 items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="category">
              <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
              প্রি-অর্ডার
            </a>
            <a class="group flex shrink-0 items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="category">
              <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-linecap="round" stroke-linejoin="round"/></svg>
              প্যাকেজ
            </a>
            <a class="group flex shrink-0 items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="category">
              <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
              টি-শার্ট
            </a>
            <a class="group flex shrink-0 items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="category">
              <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" stroke-linecap="round" stroke-linejoin="round"/></svg>
              প্রসাধনী
            </a>
          </div>
        </div>
      </nav>
    </header>

    <!-- AJAX Search Script -->
    <script>
    (function() {
      const searchInput = document.getElementById('q');
      const suggestionsBox = document.getElementById('searchSuggestions');
      const searchResults = document.getElementById('searchResults');
      const searchLoading = document.getElementById('searchLoading');
      const searchNoResults = document.getElementById('searchNoResults');
      let debounceTimer = null;
      let productsCache = [];
      let activeIndex = -1;
      let suggestionLinks = [];

      // Load products cache
      fetch('data/products.json')
        .then(res => res.json())
        .then(data => { productsCache = data.products || []; })
        .catch(() => {});

      function setActiveItem(index) {
        suggestionLinks.forEach((link, i) => {
          if (i === index) {
            link.classList.add('bg-emerald-50', 'border-l-2', 'border-emerald-600');
            link.scrollIntoView({ block: 'nearest' });
          } else {
            link.classList.remove('bg-emerald-50', 'border-l-2', 'border-emerald-600');
          }
        });
        activeIndex = index;
      }

      function renderSuggestions(query) {
        if (!query || query.length < 2) {
          suggestionsBox.classList.add('hidden');
          activeIndex = -1;
          return;
        }

        searchLoading.classList.remove('hidden');
        searchResults.innerHTML = '';
        searchNoResults.classList.add('hidden');
        suggestionsBox.classList.remove('hidden');
        activeIndex = -1;

        setTimeout(() => {
          searchLoading.classList.add('hidden');

          const q = query.toLowerCase();
          const matched = productsCache.filter(p =>
            p.title.toLowerCase().includes(q) ||
            p.author.toLowerCase().includes(q) ||
            p.category.toLowerCase().includes(q) ||
            p.publisher.toLowerCase().includes(q)
          ).slice(0, 6);

          if (matched.length === 0) {
            searchNoResults.classList.remove('hidden');
            return;
          }

          searchResults.innerHTML = matched.map(p => `
            <a href="details?slug=${p.slug}" class="suggestion-link flex items-center gap-3 px-4 py-2.5 hover:bg-emerald-50 transition border-l-2 border-transparent">
              <img src="${p.image}" alt="${p.title}" class="h-12 w-9 rounded-lg bg-slate-100 object-cover shrink-0" />
              <div class="min-w-0 flex-1">
                <p class="text-sm font-semibold text-slate-900 truncate">${p.title}</p>
                <p class="text-xs text-slate-500 truncate">${p.author} • ${p.category}</p>
              </div>
              <p class="text-sm font-bold text-emerald-600 shrink-0">৳ ${p.price.toLocaleString('bn-BD')}</p>
            </a>
          `).join('');

          suggestionLinks = document.querySelectorAll('.suggestion-link');
        }, 200);
      }

      if (searchInput) {
        searchInput.addEventListener('input', function() {
          clearTimeout(debounceTimer);
          debounceTimer = setTimeout(() => renderSuggestions(this.value.trim()), 300);
        });

        searchInput.addEventListener('focus', function() {
          if (this.value.trim().length >= 2) renderSuggestions(this.value.trim());
        });

        // Keyboard navigation
        searchInput.addEventListener('keydown', function(e) {
          const links = document.querySelectorAll('.suggestion-link');
          if (links.length === 0) return;

          if (e.key === 'ArrowDown') {
            e.preventDefault();
            activeIndex = Math.min(activeIndex + 1, links.length - 1);
            setActiveItem(activeIndex);
          } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            activeIndex = Math.max(activeIndex - 1, -1);
            setActiveItem(activeIndex);
          } else if (e.key === 'Enter' && activeIndex >= 0) {
            e.preventDefault();
            links[activeIndex].click();
          } else if (e.key === 'Escape') {
            suggestionsBox.classList.add('hidden');
            activeIndex = -1;
          }
        });

        // Hover to set active index
        searchResults.addEventListener('mouseover', function(e) {
          const link = e.target.closest('.suggestion-link');
          if (link) {
            const idx = Array.from(suggestionLinks).indexOf(link);
            if (idx >= 0) activeIndex = idx;
          }
        });

        // Close on outside click
        document.addEventListener('click', function(e) {
          if (!suggestionsBox.contains(e.target) && e.target !== searchInput) {
            suggestionsBox.classList.add('hidden');
            activeIndex = -1;
          }
        });
      }
    })();
    </script>