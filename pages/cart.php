<!-- Cart Page -->
<main class="min-h-screen bg-slate-100/80">
  <div class="mx-auto max-w-5xl px-4 py-8">
    <a href="<?php echo domain; ?>" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-emerald-600 transition mb-4">
      <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
      কেনাকাটা চালু রাখুন
    </a>
    <h1 class="text-2xl font-bold text-slate-900">শপিং কার্ট</h1>
    <p class="mt-1 text-sm text-slate-500">২টি আইটেম</p>

    <div class="mt-6 rounded-3xl border border-slate-300 bg-white p-4 shadow-[0_12px_40px_-20px_rgba(15,23,42,0.35)] sm:p-5 lg:p-6">
      <div class="flex flex-col gap-6 lg:flex-row">
      <!-- Cart Items -->
      <div class="flex-1 space-y-4">
        <!-- Item 1 -->
        <div class="flex gap-4 rounded-2xl border border-slate-300 bg-slate-50/60 p-4 shadow-sm ring-1 ring-slate-200/70 transition hover:border-emerald-300 hover:ring-emerald-100">
          <a href="details" class="shrink-0">
            <img src="https://api.naafiun.com/img/book/1761532082-allahr-sundor-namsomuho.jpg?w=160&h=200&fit=crop" alt="বই" class="h-24 w-16 rounded-xl bg-slate-100 object-cover" />
          </a>
          <div class="flex min-w-0 flex-1 flex-col justify-between">
            <div>
              <a href="details" class="text-sm font-bold text-slate-900 hover:text-emerald-600 transition">আল্লাহর সুন্দর নামসমূহ</a>
              <p class="mt-0.5 text-xs text-slate-500">লেখক নাম • হاردকভার</p>
            </div>
            <div class="flex items-end justify-between mt-3">
              <!-- Qty Control -->
              <div class="flex items-center rounded-lg border border-slate-400 bg-white shadow-sm">
                <button class="px-3 py-1.5 text-sm text-slate-600 hover:bg-slate-50 transition">−</button>
                <span class="w-10 border-x border-slate-300 py-1.5 text-center text-sm font-semibold">১</span>
                <button class="px-3 py-1.5 text-sm text-slate-600 hover:bg-slate-50 transition">+</button>
              </div>
              <p class="text-base font-extrabold text-slate-900">৳ 450</p>
            </div>
          </div>
          <button class="shrink-0 self-start rounded-lg border border-slate-300 bg-white p-2 text-slate-400 hover:border-rose-300 hover:bg-rose-50 hover:text-rose-600 transition" aria-label="Remove">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
        </div>

        <!-- Item 2 -->
        <div class="flex gap-4 rounded-2xl border border-slate-300 bg-slate-50/60 p-4 shadow-sm ring-1 ring-slate-200/70 transition hover:border-emerald-300 hover:ring-emerald-100">
          <a href="details" class="shrink-0">
            <img src="https://api.naafiun.com/img/storage/book/thumb-1760470818.jpg?w=160&h=200&fit=crop" alt="বই" class="h-24 w-16 rounded-xl bg-slate-100 object-cover" />
          </a>
          <div class="flex min-w-0 flex-1 flex-col justify-between">
            <div>
              <a href="details" class="text-sm font-bold text-slate-900 hover:text-emerald-600 transition">সীরাতে খাতামুন নাবিয়্যীন</a>
              <p class="mt-0.5 text-xs text-slate-500">লেখক নাম • পেপারব্যাক</p>
            </div>
            <div class="flex items-end justify-between mt-3">
              <div class="flex items-center rounded-lg border border-slate-400 bg-white shadow-sm">
                <button class="px-3 py-1.5 text-sm text-slate-600 hover:bg-slate-50 transition">−</button>
                <span class="w-10 border-x border-slate-300 py-1.5 text-center text-sm font-semibold">২</span>
                <button class="px-3 py-1.5 text-sm text-slate-600 hover:bg-slate-50 transition">+</button>
              </div>
              <p class="text-base font-extrabold text-slate-900">৳ 630</p>
            </div>
          </div>
          <button class="shrink-0 self-start rounded-lg border border-slate-300 bg-white p-2 text-slate-400 hover:border-rose-300 hover:bg-rose-50 hover:text-rose-600 transition" aria-label="Remove">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
        </div>
      </div>

      <!-- Order Summary -->
      <div class="lg:w-80">
        <div class="sticky top-24 rounded-2xl border border-slate-300 bg-white p-6 shadow-sm ring-1 ring-slate-200/80">
          <h3 class="text-lg font-bold text-slate-900">অর্ডার সারাংশ</h3>
          <div class="mt-4 space-y-3 text-sm">
            <div class="flex justify-between text-slate-600">
              <span>সাবটোটাল</span>
              <span>৳ 1,080</span>
            </div>
            <div class="flex justify-between text-slate-600">
              <span>ডেলিভারি চার্জ</span>
              <span class="text-emerald-600">ফ্রি</span>
            </div>
            <div class="flex justify-between text-slate-600">
              <span>ডিসকাউন্ট</span>
              <span class="text-rose-600">- ৳ ০</span>
            </div>
            <hr class="border-slate-200" />
            <div class="flex justify-between text-base font-bold text-slate-900">
              <span>মোট</span>
              <span>৳ 1,080</span>
            </div>
          </div>

          <!-- Coupon -->
          <div class="mt-4">
            <div class="flex gap-2">
              <input type="text" placeholder="কুপন কোড" class="flex-1 rounded-lg border border-slate-400 px-3 py-2 text-sm outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20" />
              <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition">প্রয়োগ</button>
            </div>
          </div>

          <a href="checkout" class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white hover:bg-emerald-700 transition shadow-sm">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" stroke-linecap="round" stroke-linejoin="round"/></svg>
            চেকআউট করুন
          </a>

          <p class="mt-3 text-center text-xs text-slate-400">ক্যাশ অন ডেলিভারি উপলব্ধ</p>
        </div>
      </div>
      </div>
    </div>

    <!-- Empty Cart State -->
    <div class="hidden flex-col items-center justify-center py-16 text-center">
      <svg class="h-20 w-20 text-slate-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
      <p class="mt-4 text-sm font-semibold text-slate-900">আপনার কার্ট খালি</p>
      <p class="mt-1 text-xs text-slate-500">কিছু বই যোগ করুন!</p>
      <a href="<?php echo domain; ?>" class="mt-4 rounded-xl bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition">কেনাকাটা শুরু করুন</a>
    </div>
  </div>
</main>
