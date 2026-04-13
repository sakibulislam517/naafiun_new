<!-- Contact Us Page -->
<main class="min-h-screen bg-slate-50">
  <div class="mx-auto max-w-5xl px-4 py-8">
    <a href="<?php echo domain; ?>" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-emerald-600 transition mb-4">
      <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
      হোমে ফিরুন
    </a>
    <h1 class="text-2xl font-bold text-slate-900">যোগাযোগ করুন</h1>
    <p class="mt-1 text-sm text-slate-500">আমাদের সাথে যোগাযোগ করুন, আমরা সাহায্য করতে প্রস্তুত</p>

    <div class="mt-8 grid gap-8 lg:grid-cols-5">
      <!-- Contact Form -->
      <div class="lg:col-span-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
          <h3 class="text-base font-bold text-slate-900 mb-6">মেসেজ পাঠান</h3>
          <form class="space-y-4">
            <div class="grid gap-4 sm:grid-cols-2">
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">আপনার নাম</label>
                <input type="text" placeholder="পুরো নাম" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">ফোন নম্বর</label>
                <input type="tel" placeholder="01XXXXXXXXX" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20" required />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-1.5">ইমেইল</label>
              <input type="email" placeholder="your@email.com" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20" />
            </div>
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-1.5">বিষয়</label>
              <select class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                <option>অর্ডার সম্পর্কে</option>
                <option>পণ্য সম্পর্কে</option>
                <option>ডেলিভারি সম্পর্কে</option>
                <option>রিফান্ড/রিটার্ন</option>
                <option>অন্যান্য</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-1.5">মেসেজ</label>
              <textarea rows="5" placeholder="আপনার মেসেজ লিখুন..." class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 resize-none" required></textarea>
            </div>
            <button type="submit" class="w-full rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white hover:bg-emerald-700 transition shadow-sm">
              মেসেজ পাঠান
            </button>
          </form>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="lg:col-span-2 space-y-4">
        <!-- Phone -->
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
          <div class="flex items-start gap-3">
            <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-emerald-50 text-emerald-600">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div>
              <p class="text-sm font-bold text-slate-900">ফোন</p>
              <a href="tel:+8801407700600" class="mt-1 text-sm text-slate-600 hover:text-emerald-600">+8801407700600</a>
              <p class="mt-0.5 text-xs text-slate-400">সকাল ৯টা - রাত ৯টা</p>
            </div>
          </div>
        </div>

        <!-- Email -->
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
          <div class="flex items-start gap-3">
            <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-sky-50 text-sky-600">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div>
              <p class="text-sm font-bold text-slate-900">ইমেইল</p>
              <a href="mailto:info@naafiun.com" class="mt-1 text-sm text-slate-600 hover:text-emerald-600">info@naafiun.com</a>
              <p class="mt-0.5 text-xs text-slate-400">২৪ ঘণ্টার মধ্যে উত্তর</p>
            </div>
          </div>
        </div>

        <!-- Address -->
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
          <div class="flex items-start gap-3">
            <div class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-rose-50 text-rose-600">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div>
              <p class="text-sm font-bold text-slate-900">ঠিকানা</p>
              <p class="mt-1 text-sm text-slate-600">House no. 906, Lane 02,<br />Shatarkul Road, North Badda</p>
            </div>
          </div>
        </div>

        <!-- Social -->
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
          <p class="text-sm font-bold text-slate-900 mb-3">সোশ্যাল মিডিয়া</p>
          <div class="flex gap-3">
            <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700 transition">
              <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M13.5 22v-8h2.7l.5-3H13.5V9.1c0-.8.3-1.4 1.5-1.4H16.9V5.1c-.3 0-1.3-.1-2.4-.1-2.5 0-4.2 1.5-4.2 4.3V11H7.7v3h2.6v8h3.2Z"/></svg>
            </a>
            <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-red-600 text-white hover:bg-red-700 transition">
              <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M21.6 7.2a3 3 0 0 0-2.1-2.1C17.7 4.6 12 4.6 12 4.6s-5.7 0-7.5.5A3 3 0 0 0 2.4 7.2 31 31 0 0 0 2 12a31 31 0 0 0 .4 4.8 3 3 0 0 0 2.1 2.1c1.8.5 7.5.5 7.5.5s5.7 0 7.5-.5a3 3 0 0 0 2.1-2.1A31 31 0 0 0 22 12a31 31 0 0 0-.4-4.8ZM10 15.5v-7l6 3.5-6 3.5Z"/></svg>
            </a>
            <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500 text-white hover:bg-green-600 transition">
              <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
