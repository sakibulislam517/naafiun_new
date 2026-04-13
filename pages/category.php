<!-- Category / Product List Page with Filters -->
<main class="min-h-screen bg-slate-50">
  <!-- Breadcrumbs -->
  <nav aria-label="Breadcrumb" class="mx-auto max-w-7xl px-4 mt-4 pt-3">
    <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-500 pb-3">
      <li><a class="hover:text-slate-900 transition" href="<?php echo domain; ?>">হোম</a></li>
      <li>/</li>
      <li class="font-semibold text-slate-900" aria-current="page">ক্যাটাগরি</li>
    </ol>
  </nav>

  <div class="mx-auto max-w-7xl px-4 pb-12">

    <div class="flex gap-6">
      <!-- ===== SIDEBAR FILTERS ===== -->
      <aside class="hidden lg:block w-64 shrink-0">
        <div class="sticky top-24 space-y-5">
          <!-- Filter Card -->
          <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
              <svg class="h-4 w-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" stroke-linecap="round" stroke-linejoin="round"/></svg>
              ফিল্টার
            </h3>

            <!-- Subject Filter -->
            <div class="mt-4">
              <button type="button" class="filter-toggle w-full flex items-center justify-between text-xs font-semibold text-slate-700 uppercase tracking-wide hover:text-slate-900" data-target="subject-filter">
                <span>বিষয়</span>
                <svg class="filter-chevron h-4 w-4 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </button>
              <div id="subject-filter" class="filter-content mt-2 space-y-1.5">
                <div class="mb-2">
                  <input type="text" placeholder="অনুসন্ধান..." class="filter-search w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20" data-filter-list="subject-list" />
                </div>
                <div class="max-h-40 overflow-y-auto scrollbar-hide space-y-1.5" id="subject-list">
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                    <span class="text-sm text-slate-600">ইসলামিক</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                    <span class="text-sm text-slate-600">সীরাত</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                    <span class="text-sm text-slate-600">কুরআন</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                    <span class="text-sm text-slate-600">হাদীস</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                    <span class="text-sm text-slate-600">ঈমান</span>
                  </label>
                </div>
              </div>
            </div>

            <hr class="my-4 border-slate-100" />

            <!-- Writer Filter -->
            <div>
              <button type="button" class="filter-toggle w-full flex items-center justify-between text-xs font-semibold text-slate-700 uppercase tracking-wide hover:text-slate-900" data-target="writer-filter">
                <span>লেখক</span>
                <svg class="filter-chevron h-4 w-4 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </button>
              <div id="writer-filter" class="filter-content mt-2 space-y-1.5">
                <div class="mb-2">
                  <input type="text" placeholder="অনুসন্ধান..." class="filter-search w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20" data-filter-list="writer-list" />
                </div>
                <div class="max-h-40 overflow-y-auto scrollbar-hide space-y-1.5" id="writer-list">
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                    <span class="text-sm text-slate-600">ড. খোন্দকার আব্দুল্লাহ জাহাঙ্গীর</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                    <span class="text-sm text-slate-600">আরিফ আজাদ</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                    <span class="text-sm text-slate-600">মুহাম্মদ জাহিদুল ইসলাম</span>
                  </label>
                </div>
              </div>
            </div>

            <hr class="my-4 border-slate-100" />

            <!-- Publisher Filter -->
            <div>
              <button type="button" class="filter-toggle w-full flex items-center justify-between text-xs font-semibold text-slate-700 uppercase tracking-wide hover:text-slate-900" data-target="publisher-filter">
                <span>প্রকাশনী</span>
                <svg class="filter-chevron h-4 w-4 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </button>
              <div id="publisher-filter" class="filter-content mt-2 space-y-1.5">
                <div class="mb-2">
                  <input type="text" placeholder="অনুসন্ধান..." class="filter-search w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20" data-filter-list="publisher-list" />
                </div>
                <div class="max-h-40 overflow-y-auto scrollbar-hide space-y-1.5" id="publisher-list">
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                    <span class="text-sm text-slate-600">মাকতাবাতুল আযহার</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                    <span class="text-sm text-slate-600">আশরাফিয়া বুক হাউজ</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                    <span class="text-sm text-slate-600">ইসলামিক ফাউন্ডেশন</span>
                  </label>
                </div>
              </div>
            </div>

            <hr class="my-4 border-slate-100" />

            <!-- Price Range -->
            <div>
              <button type="button" class="filter-toggle w-full flex items-center justify-between text-xs font-semibold text-slate-700 uppercase tracking-wide hover:text-slate-900" data-target="price-filter">
                <span>মূল্য সীমা</span>
                <svg class="filter-chevron h-4 w-4 transform transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </button>
              <div id="price-filter" class="filter-content mt-2 space-y-1.5">
                <div class="mt-2 flex items-center gap-2">
                  <input type="number" placeholder="৳ ০" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20" />
                  <span class="text-slate-400">-</span>
                  <input type="number" placeholder="৳ ৫০০" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20" />
                </div>
              </div>
            </div>

            <!-- Apply Filter Button -->
            <button class="mt-4 w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition">
              ফিল্টার প্রয়োগ করুন
            </button>
            <button class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 transition">
              রিসেট করুন
            </button>
          </div>
        </div>
      </aside>

      <!-- ===== MAIN CONTENT ===== -->
      <div class="flex-1 min-w-0">
        <!-- Mobile Filter Toggle + Sort -->
        <div class="flex items-center justify-between gap-3 mb-4">
          <button id="mobileFilterBtn" class="lg:hidden flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" stroke-linecap="round" stroke-linejoin="round"/></svg>
            ফিল্টার
          </button>

          <div class="flex items-center gap-2 ml-auto">
            <span class="text-sm text-slate-500 hidden sm:inline">সাজান:</span>
            <select class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20">
              <option>নতুন থেকে পুরনো</option>
              <option>পুরনো থেকে নতুন</option>
              <option>মূল্য: কম থেকে বেশি</option>
              <option>মূল্য: বেশি থেকে কম</option>
              <option>জনপ্রিয়</option>
            </select>
          </div>
        </div>

        <!-- Mobile Filter Panel -->
        <div id="mobileFilterPanel" class="hidden lg:hidden mb-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
          <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-bold text-slate-900">ফিল্টার</h3>
            <button id="closeMobileFilter" class="p-1 text-slate-400 hover:text-slate-600">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-linecap="round"/></svg>
            </button>
          </div>
          <!-- Subject -->
          <div class="mb-3">
            <h4 class="text-xs font-semibold text-slate-700">বিষয়</h4>
            <div class="mt-1 flex flex-wrap gap-2">
              <button class="rounded-full border border-slate-300 px-3 py-1 text-xs font-medium text-slate-600 hover:border-emerald-500 hover:text-emerald-600 transition">ইসলামিক</button>
              <button class="rounded-full border border-slate-300 px-3 py-1 text-xs font-medium text-slate-600 hover:border-emerald-500 hover:text-emerald-600 transition">সীরাত</button>
              <button class="rounded-full border border-slate-300 px-3 py-1 text-xs font-medium text-slate-600 hover:border-emerald-500 hover:text-emerald-600 transition">কুরআন</button>
              <button class="rounded-full border border-slate-300 px-3 py-1 text-xs font-medium text-slate-600 hover:border-emerald-500 hover:text-emerald-600 transition">হাদীস</button>
            </div>
          </div>
          <!-- Writer -->
          <div class="mb-3">
            <h4 class="text-xs font-semibold text-slate-700">লেখক</h4>
            <div class="mt-1 flex flex-wrap gap-2">
              <button class="rounded-full border border-slate-300 px-3 py-1 text-xs font-medium text-slate-600 hover:border-emerald-500 hover:text-emerald-600 transition">ড. খোন্দকার</button>
              <button class="rounded-full border border-slate-300 px-3 py-1 text-xs font-medium text-slate-600 hover:border-emerald-500 hover:text-emerald-600 transition">আরিফ আজাদ</button>
            </div>
          </div>
          <button class="w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition">প্রয়োগ করুন</button>
        </div>

        <!-- Results count -->
        <p class="text-sm text-slate-500 mb-4">১-১২ / ১৫৬টি বই</p>

        <!-- Product Grid -->
        <div class="grid gap-3 grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4">
          <!-- Product Card 1 -->
          <a href="details?slug=allahr-sundor-namsomuho" class="group overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition">
            <div class="relative aspect-[4/5] bg-slate-100">
              <img src="https://api.naafiun.com/img/book/1761532082-allahr-sundor-namsomuho.jpg?w=512&h=790&fit=crop" alt="বই" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" />
              <span class="absolute left-2 top-2 rounded bg-rose-600 px-2 py-1 text-xs font-bold text-white">-20%</span>
            </div>
            <div class="p-3">
              <h3 class="line-clamp-2 text-sm font-bold text-slate-900">আল্লাহর সুন্দর নামসমূহ</h3>
              <p class="mt-1 text-xs text-slate-500">লেখক নাম</p>
              <div class="mt-2 flex items-baseline gap-2">
                <p class="text-sm font-extrabold text-slate-900">৳ 450</p>
                <p class="text-xs text-slate-400 line-through">৳ 560</p>
              </div>
            </div>
          </a>

          <!-- Product Card 2 -->
          <a href="details" class="group overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition">
            <div class="relative aspect-[4/5] bg-slate-100">
              <img src="https://api.naafiun.com/img/storage/book/thumb-1760470818.jpg?w=512&h=790&fit=crop" alt="বই" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" />
            </div>
            <div class="p-3">
              <h3 class="line-clamp-2 text-sm font-bold text-slate-900">সীরাতে খাতামুন নাবিয়্যীন</h3>
              <p class="mt-1 text-xs text-slate-500">লেখক নাম</p>
              <div class="mt-2 flex items-baseline gap-2">
                <p class="text-sm font-extrabold text-slate-900">৳ 315</p>
                <p class="text-xs text-slate-400 line-through">৳ 350</p>
              </div>
            </div>
          </a>

          <!-- Product Card 3 -->
          <a href="details" class="group overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition">
            <div class="relative aspect-[4/5] bg-slate-100">
              <img src="https://api.naafiun.com/img/storage/book/thumb-1739105984.jpeg?w=512&h=790&fit=crop" alt="বই" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" />
              <span class="absolute left-2 top-2 rounded bg-rose-600 px-2 py-1 text-xs font-bold text-white">-15%</span>
            </div>
            <div class="p-3">
              <h3 class="line-clamp-2 text-sm font-bold text-slate-900">কুরআনের আলোকে জীবন গঠন</h3>
              <p class="mt-1 text-xs text-slate-500">লেখক নাম</p>
              <div class="mt-2 flex items-baseline gap-2">
                <p class="text-sm font-extrabold text-slate-900">৳ 680</p>
                <p class="text-xs text-slate-400 line-through">৳ 800</p>
              </div>
            </div>
          </a>

          <!-- Product Card 4 -->
          <a href="details" class="group overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition">
            <div class="relative aspect-[4/5] bg-slate-100">
              <img src="https://api.naafiun.com/img/storage/book/thumb-1738748409.jpg?w=512&h=790&fit=crop" alt="বই" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" />
            </div>
            <div class="p-3">
              <h3 class="line-clamp-2 text-sm font-bold text-slate-900">ছোটদের ইসলামী গল্প</h3>
              <p class="mt-1 text-xs text-slate-500">লেখক নাম</p>
              <div class="mt-2 flex items-baseline gap-2">
                <p class="text-sm font-extrabold text-slate-900">৳ 285</p>
                <p class="text-xs text-slate-400 line-through">৳ 300</p>
              </div>
            </div>
          </a>

          <!-- Product Card 5 -->
          <a href="details" class="group overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition">
            <div class="relative aspect-[4/5] bg-slate-100">
              <img src="https://api.naafiun.com/img/storage/book/thumb-1738747800.webp?w=512&h=790&fit=crop" alt="বই" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" />
            </div>
            <div class="p-3">
              <h3 class="line-clamp-2 text-sm font-bold text-slate-900">দোয়া ও যিকিরের ফযীলত</h3>
              <p class="mt-1 text-xs text-slate-500">লেখক নাম</p>
              <div class="mt-2 flex items-baseline gap-2">
                <p class="text-sm font-extrabold text-slate-900">৳ 499</p>
                <p class="text-xs text-slate-400 line-through">৳ 560</p>
              </div>
            </div>
          </a>

          <!-- Product Card 6 -->
          <a href="details" class="group overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition">
            <div class="relative aspect-[4/5] bg-slate-100">
              <img src="https://api.naafiun.com/img/storage/book/thumb-1738747616.jpg?w=512&h=790&fit=crop" alt="বই" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" />
              <span class="absolute left-2 top-2 rounded bg-rose-600 px-2 py-1 text-xs font-bold text-white">-18%</span>
            </div>
            <div class="p-3">
              <h3 class="line-clamp-2 text-sm font-bold text-slate-900">তাওবা ও ইস্তেগফার</h3>
              <p class="mt-1 text-xs text-slate-500">লেখক নাম</p>
              <div class="mt-2 flex items-baseline gap-2">
                <p class="text-sm font-extrabold text-slate-900">৳ 520</p>
                <p class="text-xs text-slate-400 line-through">৳ 630</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex items-center justify-center gap-1">
          <button class="rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-400 cursor-not-allowed" disabled>
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <button class="rounded-lg bg-emerald-600 px-3.5 py-2 text-sm font-bold text-white">1</button>
          <button class="rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-600 hover:bg-slate-50 transition">2</button>
          <button class="rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-600 hover:bg-slate-50 transition">3</button>
          <span class="px-2 text-slate-400">...</span>
          <button class="rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-600 hover:bg-slate-50 transition">12</button>
          <button class="rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-600 hover:bg-slate-50 transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  // Mobile filter toggle
  const mobileFilterBtn = document.getElementById('mobileFilterBtn');
  const mobileFilterPanel = document.getElementById('mobileFilterPanel');
  const closeMobileFilter = document.getElementById('closeMobileFilter');
  if (mobileFilterBtn && mobileFilterPanel) {
    mobileFilterBtn.addEventListener('click', () => mobileFilterPanel.classList.remove('hidden'));
    if (closeMobileFilter) closeMobileFilter.addEventListener('click', () => mobileFilterPanel.classList.add('hidden'));
  }

  // Desktop filter toggle functionality
  document.querySelectorAll('.filter-toggle').forEach(toggle => {
    toggle.addEventListener('click', function() {
      const targetId = this.getAttribute('data-target');
      const targetContent = document.getElementById(targetId);
      const chevron = this.querySelector('.filter-chevron');
      
      if (targetContent) {
        targetContent.classList.toggle('hidden');
        if (chevron) {
          chevron.classList.toggle('rotate-180');
        }
      }
    });
  });

  // Filter search functionality
  document.querySelectorAll('.filter-search').forEach(searchInput => {
    searchInput.addEventListener('input', function() {
      const listId = this.getAttribute('data-filter-list');
      const list = document.getElementById(listId);
      const searchTerm = this.value.toLowerCase();
      
      if (list) {
        const labels = list.querySelectorAll('label');
        labels.forEach(label => {
          const text = label.querySelector('span').textContent.toLowerCase();
          if (text.includes(searchTerm)) {
            label.style.display = '';
          } else {
            label.style.display = 'none';
          }
        });
      }
    });
  });
</script>
