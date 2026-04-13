<!-- My Orders Page -->
<main class="min-h-screen bg-slate-50">
  <div class="mx-auto max-w-4xl px-4 py-8">
    <a href="<?php echo domain; ?>" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-emerald-600 transition mb-4">
      <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
      হোমে ফিরুন
    </a>
    <h1 class="text-2xl font-bold text-slate-900">আমার অর্ডার</h1>
    <p class="mt-1 text-sm text-slate-500">আপনার সকল অর্ডারের তালিকা</p>

    <!-- Status Tabs -->
    <div class="mt-6 flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
      <button class="shrink-0 rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white">সব (৩)</button>
      <button class="shrink-0 rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">চলমান (১)</button>
      <button class="shrink-0 rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">ডেলিভারি হয়েছে (১)</button>
      <button class="shrink-0 rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">বাতিল (১)</button>
    </div>

    <!-- Order List -->
    <div class="mt-6 space-y-4">

      <!-- Order 1 - Pending -->
      <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <!-- Order Header -->
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-4 py-3 sm:px-6">
          <div>
            <p class="text-sm font-bold text-slate-900">অর্ডার #NF-2025-001</p>
            <p class="text-xs text-slate-500 mt-0.5">১২ এপ্রিল, ২০২ • ২:৩০ PM</p>
          </div>
          <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">প্রক্রিয়াধীন</span>
        </div>
        <!-- Order Items -->
        <div class="px-4 py-4 sm:px-6">
          <div class="flex gap-3">
            <img src="https://api.naafiun.com/img/book/1761532082-allahr-sundor-namsomuho.jpg?w=120&h=160&fit=crop" alt="বই" class="h-16 w-12 shrink-0 rounded-lg bg-slate-100 object-cover" />
            <div class="min-w-0 flex-1">
              <p class="text-sm font-semibold text-slate-900 truncate">আল্লাহর সুন্দর নামসমূহ</p>
              <p class="text-xs text-slate-500">পরিমাণ: ১</p>
            </div>
            <p class="text-sm font-bold text-slate-900 shrink-0">৳ 450</p>
          </div>
        </div>
        <!-- Order Footer -->
        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 bg-slate-50 px-4 py-3 sm:px-6">
          <p class="text-sm text-slate-600">মোট: <span class="font-bold text-slate-900">৳ 450</span></p>
          <div class="flex gap-2">
            <a href="#" class="rounded-lg border border-slate-300 px-4 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-100 transition">বিস্তারিত</a>
            <a href="#" class="rounded-lg bg-emerald-600 px-4 py-1.5 text-xs font-semibold text-white hover:bg-emerald-700 transition">ট্র্যাক করুন</a>
          </div>
        </div>
      </div>

      <!-- Order 2 - Delivered -->
      <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-4 py-3 sm:px-6">
          <div>
            <p class="text-sm font-bold text-slate-900">অর্ডার #NF-2025-002</p>
            <p class="text-xs text-slate-500 mt-0.5">৮ এপ্রিল, ২০২ • ১:১৫ AM</p>
          </div>
          <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">ডেলিভারি হয়েছে</span>
        </div>
        <div class="px-4 py-4 sm:px-6">
          <div class="flex gap-3">
            <img src="https://api.naafiun.com/img/storage/book/thumb-1760470818.jpg?w=120&h=160&fit=crop" alt="বই" class="h-16 w-12 shrink-0 rounded-lg bg-slate-100 object-cover" />
            <div class="min-w-0 flex-1">
              <p class="text-sm font-semibold text-slate-900 truncate">সীরাতে খাতামুন নাবিয়্যীন</p>
              <p class="text-xs text-slate-500">পরিমাণ: ২</p>
            </div>
            <p class="text-sm font-bold text-slate-900 shrink-0">৳ 630</p>
          </div>
        </div>
        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 bg-slate-50 px-4 py-3 sm:px-6">
          <p class="text-sm text-slate-600">মোট: <span class="font-bold text-slate-900">৳ 630</span></p>
          <div class="flex gap-2">
            <a href="#" class="rounded-lg border border-slate-300 px-4 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-100 transition">বিস্তারিত</a>
            <a href="#" class="rounded-lg border border-emerald-600 px-4 py-1.5 text-xs font-semibold text-emerald-600 hover:bg-emerald-50 transition">পুনরায় অর্ডার</a>
          </div>
        </div>
      </div>

      <!-- Order 3 - Cancelled -->
      <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden opacity-75">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-4 py-3 sm:px-6">
          <div>
            <p class="text-sm font-bold text-slate-900">অর্ডার #NF-2025-003</p>
            <p class="text-xs text-slate-500 mt-0.5">১ এপ্রিল, ২০২ • ৫:৪৫ PM</p>
          </div>
          <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700">বাতিল</span>
        </div>
        <div class="px-4 py-4 sm:px-6">
          <div class="flex gap-3">
            <img src="https://api.naafiun.com/img/storage/book/thumb-1739105984.jpeg?w=120&h=160&fit=crop" alt="বই" class="h-16 w-12 shrink-0 rounded-lg bg-slate-100 object-cover" />
            <div class="min-w-0 flex-1">
              <p class="text-sm font-semibold text-slate-900 truncate">কুরআনের আলোকে জীবন গঠন</p>
              <p class="text-xs text-slate-500">পরিমাণ: ১</p>
            </div>
            <p class="text-sm font-bold text-slate-900 shrink-0">৳ 680</p>
          </div>
        </div>
        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 bg-slate-50 px-4 py-3 sm:px-6">
          <p class="text-sm text-slate-600">মোট: <span class="font-bold text-slate-900">৳ 680</span></p>
          <a href="#" class="rounded-lg border border-slate-300 px-4 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-100 transition">বিস্তারিত</a>
        </div>
      </div>

    </div>

    <!-- Empty State (hidden by default) -->
    <div class="hidden flex-col items-center justify-center py-16 text-center">
      <svg class="h-20 w-20 text-slate-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      <p class="mt-4 text-sm font-semibold text-slate-900">কোনো অর্ডার নেই</p>
      <p class="mt-1 text-xs text-slate-500">আপনি এখনো কোনো অর্ডার করেননি</p>
      <a href="<?php echo domain; ?>" class="mt-4 rounded-xl bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition">কেনাকাটা শুরু করুন</a>
    </div>
  </div>
</main>
