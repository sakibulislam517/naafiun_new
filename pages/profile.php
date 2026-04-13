<!-- Update Profile Page -->
<main class="min-h-screen bg-slate-50">
  <div class="mx-auto max-w-2xl px-4 py-8">
    <!-- Back + Title -->
    <a href="<?php echo domain; ?>" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-emerald-600 transition mb-4">
      <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
      হোমে ফিরুন
    </a>
    <h1 class="text-2xl font-bold text-slate-900">প্রোফাইল আপডেট</h1>
    <p class="mt-1 text-sm text-slate-500">আপনার ব্যক্তিগত তথ্য পরিবর্তন করুন</p>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
      <!-- Avatar -->
      <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
        <div class="relative">
          <img id="profileAvatar" src="https://ui-avatars.com/api/?name=Naafiun+User&background=059669&color=fff&size=128" alt="Avatar" class="h-20 w-20 rounded-full object-cover ring-2 ring-emerald-500" />
          <label class="absolute bottom-0 right-0 flex h-6 w-6 cursor-pointer items-center justify-center rounded-full bg-emerald-600 text-white shadow-sm hover:bg-emerald-700 transition">
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14m-7-7h14" stroke-linecap="round"/></svg>
            <input type="file" class="hidden" accept="image/*" />
          </label>
        </div>
        <div>
          <p class="text-sm font-semibold text-slate-900">প্রোফাইল ছবি</p>
          <p class="text-xs text-slate-500">JPG, PNG সর্বোচ্চ 2MB</p>
        </div>
      </div>

      <form action="#" method="post" class="space-y-4">
        <!-- Full Name -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">পুরো নাম</label>
          <input type="text" name="full_name" value="আপনার নাম" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition" required />
        </div>

        <!-- Email -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">ইমেইল</label>
          <input type="email" name="email" value="user@email.com" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition" required />
        </div>

        <!-- Phone -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">ফোন নম্বর</label>
          <input type="tel" name="phone" value="01XXXXXXXXX" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition" required />
        </div>

        <!-- Address -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">ঠিকানা</label>
          <textarea name="address" rows="3" placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition resize-none"></textarea>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end pt-4">
          <a href="#" class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 transition text-center">বাতিল</a>
          <button type="submit" class="rounded-xl bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition shadow-sm">সংরক্ষণ করুন</button>
        </div>
      </form>
    </div>
  </div>
</main>
