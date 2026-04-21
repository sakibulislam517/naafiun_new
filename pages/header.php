<?php $isCustomer = $db->is_customer(); ?>
<!doctype html>
<html lang="bn" class="h-full scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    <meta name="theme-color" content="#059669" />
    <title>Naafiun — বই ও ইসলামিক পণ্য</title>
    <base href="<?php echo domain; ?>">
    <meta name="description" content="Naafiun — ইসলামিক বই ও গিফট শপ" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

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
                    <?php echo $db->icon('search'); ?>
                  </svg>
                </button>
              </div>
            </form>

            <!-- AJAX Search Suggestions Dropdown -->
            <div id="searchSuggestions" class="hidden absolute left-0 right-0 top-full mt-2 rounded-xl border border-slate-200 bg-white shadow-xl z-50 overflow-hidden">
              <!-- Loading state -->
              <div id="searchLoading" class="hidden px-4 py-3 text-center">
                <svg class="animate-spin h-5 w-5 text-emerald-600 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><?php echo $db->icon('spinner_segment'); ?></svg>
                <p class="mt-1 text-xs text-slate-400">খুঁজছি…</p>
              </div>
              <!-- Results -->
              <div id="searchResults" class="max-h-80 overflow-y-auto scrollbar-hide"></div>
              <!-- No results -->
              <div id="searchNoResults" class="hidden px-4 py-6 text-center">
                <svg class="h-10 w-10 text-slate-300 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><?php echo $db->icon('search'); ?></svg>
                <p class="mt-2 text-sm text-slate-500">কোনো ফলাফল পাওয়া যায়নি</p>
              </div>
            </div>
          </div>

          <!-- Actions - right side -->
          <div class="flex shrink-0 items-center gap-1 ml-auto">
            <!-- Wishlist -->
            <a class="group flex flex-col items-center rounded-xl px-3 py-2 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition" href="wishlist">
              <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <?php echo $db->icon('heart'); ?>
              </svg>
              <span class="mt-0.5 text-[10px] font-medium">উইশলিস্ট</span>
            </a>

            <!-- Cart -->
            <button class="cart-trigger group relative flex flex-col items-center rounded-xl px-3 py-2 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition" type="button" aria-label="কার্ট">
              <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <?php echo $db->icon('cart'); ?>
              </svg>
              <span class="mt-0.5 text-[10px] font-medium">কার্ট</span>
              <span class="cart-badge-count absolute -right-0.5 top-0.5 grid h-5 w-5 place-items-center rounded-full bg-emerald-600 text-[10px] font-bold text-white ring-2 ring-white">0</span>
            </button>

            <!-- Divider -->
            <div class="mx-2 h-10 w-px bg-slate-200"></div>

            <?php if ($isCustomer): ?>
              <!-- Profile Dropdown (Desktop) -->
              <div class="relative">
                <button id="desktopProfileBtn" type="button" class="group flex flex-col items-center rounded-xl px-3 py-2 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition" aria-label="প্রোফাইল" aria-expanded="false">
                  <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <?php echo $db->icon('user_circle'); ?>
                  </svg>
                  <span class="mt-0.5 text-[10px] font-medium">প্রোফাইল</span>
                </button>

                <div id="desktopProfileDropdown" class="absolute right-0 top-full mt-1 hidden w-56 rounded-xl border border-slate-200 bg-white py-2 shadow-xl z-[60]">
                  <a href="my-orders" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('order'); ?></svg>
                    আমার অর্ডার
                  </a>
                  <a href="wishlist" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><?php echo $db->icon('heart'); ?></svg>
                    উইশলিস্ট
                  </a>
                  <a href="change-password" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('key'); ?></svg>
                    পাসওয়ার্ড পরিবর্তন
                  </a>
                  <a href="profile" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('user_circle'); ?></svg>
                    প্রোফাইল আপডেট
                  </a>
                  <div class="border-t border-slate-100 mt-1 pt-1">
                    <a href="#" class="js-customer-logout flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                      <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('logout'); ?></svg>
                      লগআউট
                    </a>
                  </div>
                </div>
              </div>
            <?php else: ?>
              <a class="group flex flex-col items-center rounded-xl px-3 py-2 text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition" href="login">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                  <?php echo $db->icon('user_circle'); ?>
                </svg>
                <span class="mt-0.5 text-[10px] font-medium">লগইন</span>
              </a>
            <?php endif; ?>
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
              <?php echo $db->icon('search'); ?>
            </svg>
          </button>

          <div class="flex-1"></div>

          <!-- Category Icon -->
          <button id="mobileCatBtn" type="button" class="flex h-10 w-10 items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 hover:text-emerald-600 transition" aria-label="ক্যাটাগরি">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <?php echo $db->icon('menu'); ?>
            </svg>
          </button>

          <!-- Profile / Login -->
          <div class="relative">
            <?php if ($isCustomer): ?>
              <button id="mobileProfileBtn" type="button" class="flex h-10 w-10 items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 hover:text-emerald-600 transition" aria-label="প্রোফাইল" aria-expanded="false">
                <svg id="profileIconGuest" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                  <?php echo $db->icon('user_circle'); ?>
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
                  <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('order'); ?></svg>
                  আমার অর্ডার
                </a>
                <a href="my-orders" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                  <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><?php echo $db->icon('heart'); ?></svg>
                  উইশলিস্ট
                </a>
                <a href="profile" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                  <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('user_circle'); ?></svg>
                  প্রোফাইল আপডেট
                </a>
                <a href="change-password" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                  <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('key'); ?></svg>
                  পাসওয়ার্ড পরিবর্তন
                </a>
                <div class="border-t border-slate-100 mt-1 pt-1">
                  <a href="#" class="js-customer-logout flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('logout'); ?></svg>
                    লগআউট
                  </a>
                </div>
              </div>
              <div id="profileLoggedOut">
                <a href="wishlist" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                  <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><?php echo $db->icon('heart'); ?></svg>
                  উইশলিস্ট
                </a>
                <div class="border-t border-slate-100 mt-1 pt-1">
                  <a href="login" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-emerald-600 hover:bg-emerald-50 transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><?php echo $db->icon('user_circle'); ?></svg>
                    লগইন / সাইনআপ
                  </a>
                </div>
              </div>
            </div>
            <?php else: ?>
              <a href="login" class="flex h-10 w-10 items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 hover:text-emerald-600 transition" aria-label="লগইন">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                  <?php echo $db->icon('user_circle'); ?>
                </svg>
              </a>
            <?php endif; ?>
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
                  <?php echo $db->icon('search'); ?>
                </svg>
              </button>
            </div>
          </form>
        </div>

        <!-- Mobile Category Dropdown -->
        <div id="mobileCatBar" class="hidden border-t border-slate-100 bg-white px-3 py-3 max-h-64 overflow-y-auto scrollbar-hide">
          <div class="grid grid-cols-2 gap-2">
            <a href="<?php echo domain; ?>" class="flex items-center gap-2 rounded-xl bg-emerald-50 px-3 py-2.5 text-sm font-semibold text-emerald-700 transition active:scale-95">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('home'); ?></svg>
              হোম
            </a>
            <a href="category" class="flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition active:scale-95">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('book'); ?></svg>
              ক্যাটাগরি
            </a>
            <a href="category" class="flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition active:scale-95">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('clock'); ?></svg>
              নতুন বই
            </a>
            <a href="category" class="flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition active:scale-95">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('trend'); ?></svg>
              ট্রেন্ডিং
            </a>
            <a href="category" class="flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition active:scale-95">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('bundle'); ?></svg>
              বান্ডিল
            </a>
            <a href="publisher" class="flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition active:scale-95">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon('shop'); ?></svg>
              প্রকাশনী
            </a>
          </div>
        </div>
      </div>

      <!-- Category Nav - desktop only -->
      <?php
        $desktopNavItems = [
          [
            'href' => domain,
            'label' => 'হোম',
            'icon' => 'home',
            'is_active' => true,
          ],
          [
            'href' => 'books',
            'label' => 'বই',
            'icon' => 'book',
          ],
          [
            'href' => 'subject',
            'label' => 'বিষয় সমূহ',
            'icon' => 'subject',
          ],
          [
            'href' => 'writer',
            'label' => 'লেখক',
            'icon' => 'writer',
          ],
          [
            'href' => 'publisher',
            'label' => 'প্রকাশক',
            'icon' => 'publisher',
          ],
          [
            'href' => 'category',
            'label' => 'প্রি-অর্ডার',
            'icon' => 'pre_order',
          ],
          [
            'href' => 'category',
            'label' => 'প্যাকেজ',
            'icon' => 'bundle',
          ],
          [
            'href' => 'category',
            'label' => 'টি-শার্ট',
            'icon' => 'tshirt',
          ],
          [
            'href' => 'category',
            'label' => 'প্রসাধনী',
            'icon' => 'cosmetics',
          ],
        ];
      ?>
      <nav class="hidden sm:block shadow-sm text-sm" aria-label="Primary">
        <div class="mx-auto max-w-7xl px-4">
          <div class="flex items-center gap-2 overflow-x-auto pb-2 pt-2 scrollbar-hide">
            <?php foreach ($desktopNavItems as $item):
              $itemHref = trim((string)$item['href']);
              $currentPage = trim((string)$pg);
              $isHomeItem = rtrim($itemHref, '/') === rtrim(domain, '/');
              $isActive = $isHomeItem
                ? in_array($currentPage, ['', 'home', 'index'], true)
                : ($currentPage === trim($itemHref, '/'));
            ?>
              <a
                class="group flex shrink-0 items-center gap-1.5 rounded-full px-3.5 py-1.5 transition <?php
                 echo $isActive ? 'bg-emerald-600 font-semibold text-white hover:bg-emerald-700' : 'font-medium text-slate-600 hover:bg-slate-100'; ?>"
                href="<?php echo htmlspecialchars($item['href']); ?>"
              >
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><?php echo $db->icon($item['icon']); ?></svg>
                <?php echo $item['label']; ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </nav>
    </header>

    <!-- AJAX Search Script -->
    <script>
    $(function() {
      const $searchInput = $('#q');
      const $suggestionsBox = $('#searchSuggestions');
      const $searchResults = $('#searchResults');
      const $searchLoading = $('#searchLoading');
      const $searchNoResults = $('#searchNoResults');
      let debounceTimer = null;
      let activeIndex = -1;
      let $suggestionLinks = $();

      function setActiveItem(index) {
        $suggestionLinks.each(function(i, el) {
          const $link = $(el);
          if (i === index) {
            $link.addClass('bg-emerald-50 border-l-2 border-emerald-600');
            el.scrollIntoView({ block: 'nearest' });
          } else {
            $link.removeClass('bg-emerald-50 border-l-2 border-emerald-600');
          }
        });
        activeIndex = index;
      }

      function renderSuggestions(query) {
        if (!query || query.length < 2) {
          $suggestionsBox.addClass('hidden');
          activeIndex = -1;
          return;
        }

        $searchLoading.removeClass('hidden');
        $searchResults.html('');
        $searchNoResults.addClass('hidden');
        $suggestionsBox.removeClass('hidden');
        activeIndex = -1;

        // Fetch suggestions from AJAX
        $.ajax({
          url: 'ajax.php?action=search_suggestions',
          method: 'POST',
          dataType: 'json',
          data: { search: query },
          success: function(response) {
            $searchLoading.addClass('hidden');

            if (!response.suggestions || response.suggestions.length === 0) {
              $searchNoResults.removeClass('hidden');
              return;
            }

            const html = response.suggestions.map(function(p) {
              return `
                <a href="books?search=${encodeURIComponent(query)}" class="suggestion-link flex items-center gap-3 px-4 py-2.5 hover:bg-emerald-50 transition border-l-2 border-transparent">
                  <img src="<?php echo domain;?>assets/images/product/${p.image}" alt="${p.name}" class="h-12 w-9 rounded-lg bg-slate-100 object-cover shrink-0" />
                  <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-slate-900 truncate">${p.name}</p>
                    <p class="text-xs text-slate-500 truncate">৳ ${p.price.toLocaleString('bn-BD')}</p>
                  </div>
                </a>
              `;
            }).join('');

            $searchResults.html(html);
            $suggestionLinks = $searchResults.find('.suggestion-link');
          },
          error: function() {
            $searchLoading.addClass('hidden');
            $searchNoResults.removeClass('hidden');
          }
        });
      }

      if ($searchInput.length) {
        const $desktopProfileBtn = $('#desktopProfileBtn');
        const $desktopProfileDropdown = $('#desktopProfileDropdown');

        if ($desktopProfileBtn.length && $desktopProfileDropdown.length) {
          $desktopProfileBtn.on('click', function(e) {
            e.stopPropagation();
            $desktopProfileDropdown.toggleClass('hidden');
            const isExpanded = !$desktopProfileDropdown.hasClass('hidden');
            $(this).attr('aria-expanded', isExpanded ? 'true' : 'false');
          });

          $(document).on('click', function(e) {
            if (!$desktopProfileDropdown.is(e.target) &&
              $desktopProfileDropdown.has(e.target).length === 0 &&
              !$desktopProfileBtn.is(e.target) &&
              $desktopProfileBtn.has(e.target).length === 0) {
              $desktopProfileDropdown.addClass('hidden');
              $desktopProfileBtn.attr('aria-expanded', 'false');
            }
          });
        }

        $(document).on('click', '.js-customer-logout', function(e) {
          e.preventDefault();
          $.ajax({
            url: 'ajax.php',
            method: 'POST',
            dataType: 'json',
            data: { action: 'customer_logout' },
            complete: function() {
              window.location.href = '<?php echo domain; ?>';
            }
          });
        });

        $searchInput.on('input', function() {
          clearTimeout(debounceTimer);
          const value = $.trim($(this).val());
          debounceTimer = setTimeout(function() {
            renderSuggestions(value);
          }, 300);
        });

        $searchInput.on('focus', function() {
          const value = $.trim($(this).val());
          if (value.length >= 2) renderSuggestions(value);
        });

        // Keyboard navigation
        $searchInput.on('keydown', function(e) {
          const $links = $searchResults.find('.suggestion-link');
          if (!$links.length) return;

          if (e.key === 'ArrowDown') {
            e.preventDefault();
            activeIndex = Math.min(activeIndex + 1, $links.length - 1);
            setActiveItem(activeIndex);
          } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            activeIndex = Math.max(activeIndex - 1, -1);
            setActiveItem(activeIndex);
          } else if (e.key === 'Enter' && activeIndex >= 0) {
            e.preventDefault();
            $links.eq(activeIndex).trigger('click');
          } else if (e.key === 'Escape') {
            $suggestionsBox.addClass('hidden');
            activeIndex = -1;
          }
        });

        // Hover to set active index
        $searchResults.on('mouseover', '.suggestion-link', function() {
          const idx = $suggestionLinks.index(this);
          if (idx >= 0) activeIndex = idx;
        });

        // Close on outside click
        $(document).on('click', function(e) {
          if (!$suggestionsBox.is(e.target) && $suggestionsBox.has(e.target).length === 0 && !$searchInput.is(e.target)) {
            $suggestionsBox.addClass('hidden');
            activeIndex = -1;
          }
        });
      }
    });
    </script>