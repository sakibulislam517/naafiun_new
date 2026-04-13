<!doctype html>
<html lang="bn" class="h-full scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    </style>
  </head>

  <body class="min-h-full bg-white text-slate-900">

    <!-- ===== HEADER ===== -->
    <header class="sticky top-0 z-50 bg-white">
      <!-- Main Bar -->
      <div class="border-b border-slate-200">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-4 py-3">
          
          <!-- LEFT: Logo -->
          <a class="flex shrink-0 items-center gap-2.5" href="<?php echo domain; ?>">
            <span class="grid h-10 w-10 place-items-center rounded-xl bg-emerald-600 text-white">
              <span class="text-lg font-black">N</span>
            </span>
            <div class="hidden sm:block">
              <p class="text-lg font-bold text-slate-900 leading-tight">Naafiun</p>
              <p class="text-[10px] text-slate-400 leading-tight">ইসলামিক বই ও গিফট</p>
            </div>
          </a>

          <!-- CENTER: Search -->
          <div class="flex-1 max-w-xl">
            <form action="<?php echo domain; ?>" method="get">
              <div class="relative">
                <input
                  id="q" name="q" type="search"
                  placeholder="বই, লেখক বা প্রকাশনী খুঁজুন…"
                  class="w-full rounded-lg border border-slate-300 bg-white py-2 pl-4 pr-10 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20"
                />
                <button class="absolute right-1 top-1/2 -translate-y-1/2 rounded-md p-1.5 text-slate-400 hover:text-emerald-600 transition" type="submit" aria-label="খুঁজুন">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35" stroke-linecap="round"/>
                  </svg>
                </button>
              </div>
            </form>
          </div>

          <!-- RIGHT: Actions -->
          <div class="flex shrink-0 items-center gap-1">
            <!-- Wishlist -->
            <a class="group flex flex-col items-center rounded-lg px-3 py-1.5 text-slate-500 hover:text-emerald-600 transition" href="#">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="mt-0.5 text-[10px] font-medium">উইশলিস্ট</span>
            </a>

            <!-- Cart -->
            <button class="cart-trigger group relative flex flex-col items-center rounded-lg px-3 py-1.5 text-slate-500 hover:text-emerald-600 transition" type="button" aria-label="কার্ট">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="mt-0.5 text-[10px] font-medium">কার্ট</span>
              <span class="cart-badge-count absolute right-0.5 top-0 grid h-4 w-4 place-items-center rounded-full bg-emerald-500 text-[9px] font-bold text-white">0</span>
            </button>

            <!-- Divider -->
            <div class="mx-1 h-8 w-px bg-slate-200"></div>

            <!-- Login / Signup -->
            <a class="flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-emerald-600 transition" href="#">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="hidden sm:inline text-[11px]">লগইন / সাইনআপ</span>
            </a>

            <!-- Mobile Menu -->
            <button id="mobileMenuBtn" class="ml-1 flex items-center justify-center rounded-lg border border-slate-200 p-2 text-slate-600 hover:bg-slate-50 md:hidden transition" type="button" aria-label="মেনু">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"/>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Category Nav -->
      <nav class="items-center  text-sm border-b border-slate-200 " aria-label="Primary">
        <div class="gap-2 pb-1 pt-1   mx-auto flex max-w-7xl items-center px-4">
        <a class="group flex items-center gap-1.5 rounded-full bg-emerald-600 px-3.5 py-1.5 font-semibold text-white hover:bg-emerald-700 transition" href="<?php echo domain; ?>">
          <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1" stroke-linecap="round" stroke-linejoin="round"/></svg>
          হোম
        </a>
        <a class="group flex items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="<?php echo domain; ?>#categories">
          <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-linecap="round" stroke-linejoin="round"/></svg>
          ক্যাটাগরি
        </a>
        <a class="group flex items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="<?php echo domain; ?>#new">
          <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
          নতুন বই
        </a>
        <a class="group flex items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="<?php echo domain; ?>#trending">
          <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
          ট্রেন্ডিং
        </a>
        <a class="group flex items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="<?php echo domain; ?>#bundles">
          <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-linecap="round" stroke-linejoin="round"/></svg>
          বান্ডিল
        </a>
        <a class="group flex items-center gap-1.5 rounded-full px-3.5 py-1.5 font-medium text-slate-600 hover:bg-slate-100 transition" href="<?php echo domain; ?>#publishers">
          <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round"/></svg>
          প্রকাশনী
        </a>
    </div>
      </nav>

      <!-- Mobile Menu Dropdown -->
      <div id="mobileMenu" class="hidden border-t border-slate-100 bg-white px-4 py-3 md:hidden">
        <nav class="grid grid-cols-3 gap-2 text-xs">
          <a class="rounded-lg bg-emerald-50 px-3 py-2.5 font-semibold text-emerald-700" href="<?php echo domain; ?>">হোম</a>
          <a class="rounded-lg px-3 py-2.5 font-medium text-slate-700 hover:bg-slate-50" href="<?php echo domain; ?>#categories">ক্যাটাগরি</a>
          <a class="rounded-lg px-3 py-2.5 font-medium text-slate-700 hover:bg-slate-50" href="<?php echo domain; ?>#new">নতুন বই</a>
          <a class="rounded-lg px-3 py-2.5 font-medium text-slate-700 hover:bg-slate-50" href="<?php echo domain; ?>#trending">ট্রেন্ডিং</a>
          <a class="rounded-lg px-3 py-2.5 font-medium text-slate-700 hover:bg-slate-50" href="<?php echo domain; ?>#bundles">বান্ডিল</a>
          <a class="rounded-lg px-3 py-2.5 font-medium text-slate-700 hover:bg-slate-50" href="<?php echo domain; ?>#publishers">প্রকাশনী</a>
        </nav>
      </div>
    </header>
