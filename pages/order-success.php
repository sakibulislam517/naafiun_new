<!-- Order Success Page -->
<main class="min-h-[calc(100vh-200px)] bg-slate-50 flex items-center justify-center">
  <div class="mx-auto max-w-lg px-4 py-12 text-center">
    <!-- Success Animation -->
    <div class="mb-6 flex justify-center">
      <div class="relative">
        <div class="grid h-24 w-24 place-items-center rounded-full bg-emerald-100">
          <svg class="h-12 w-12 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M9 12l2 2 4-4" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="12" cy="12" r="10"/>
          </svg>
        </div>
        <div class="absolute inset-0 animate-ping rounded-full bg-emerald-100 opacity-30"></div>
      </div>
    </div>

    <!-- Message -->
    <h1 class="text-2xl font-bold text-slate-900">অর্ডার সফল হয়েছে! 🎉</h1>
    <p class="mt-3 text-sm text-slate-500 leading-6">
      আপনার অর্ডারটি সফলভাবে গ্রহণ করা হয়েছে।<br />
      শীঘ্রই আমরা আপনার সাথে যোগাযোগ করব।
    </p>

    <!-- Order Details Card -->
    <div class="mt-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm text-left">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-bold text-slate-900">অর্ডার বিবরণ</h3>
        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">নিশ্চিত</span>
      </div>
      <div class="space-y-3 text-sm">
        <div class="flex justify-between">
          <span class="text-slate-500">অর্ডার নম্বর</span>
          <span class="font-bold text-slate-900">#NF-2025-004</span>
        </div>
        <div class="flex justify-between">
          <span class="text-slate-500">তারিখ</span>
          <span class="font-semibold text-slate-900">১৩ এপ্রিল, ২০২</span>
        </div>
        <div class="flex justify-between">
          <span class="text-slate-500">পেমেন্ট</span>
          <span class="font-semibold text-slate-900">ক্যাশ অন ডেলিভারি</span>
        </div>
        <hr class="border-slate-100" />
        <div class="flex justify-between text-base">
          <span class="font-semibold text-slate-900">মোট</span>
          <span class="font-bold text-emerald-600">৳ 1,080</span>
        </div>
      </div>
    </div>

    <!-- Info Box -->
    <div class="mt-6 rounded-xl bg-blue-50 p-4 text-left">
      <div class="flex gap-3">
        <svg class="mt-0.5 h-5 w-5 shrink-0 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <div>
          <p class="text-sm font-semibold text-blue-900">পরের ধাপ</p>
          <ul class="mt-1 space-y-1 text-xs text-blue-700">
            <li>• আমাদের টিম শীঘ্রই আপনাকে কল করবে</li>
            <li>• ডেলিভারি ৪৮-৭২ ঘণ্টার মধ্যে হবে</li>
            <li>• অর্ডার ট্র্যাক করতে "আমার অর্ডার" এ যান</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Actions -->
    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
      <a href="my-orders" class="rounded-xl border-2 border-emerald-600 px-6 py-3 text-sm font-bold text-emerald-600 hover:bg-emerald-50 transition">
        অর্ডার ট্র্যাক করুন
      </a>
      <a href="<?php echo domain; ?>" class="rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white hover:bg-emerald-700 transition shadow-sm">
        কেনাকাটা চালু রাখুন
      </a>
    </div>
  </div>
</main>
