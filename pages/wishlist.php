<!-- Wishlist Page -->
<main class="min-h-screen bg-slate-50">
  <div class="mx-auto max-w-5xl px-4 py-8">
    <a href="<?php echo domain; ?>" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-emerald-600 transition mb-4">
      <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
      হোমে ফিরুন
    </a>
    <h1 class="text-2xl font-bold text-slate-900">উইশলিস্ট</h1>
    <p class="mt-1 text-sm text-slate-500">আপনার পছন্দের বই সমূহ</p>

    <!-- Wishlist Items -->
    <div id="wishlistContainer" class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
      <!-- Wishlist items will be rendered here by JS -->
    </div>

    <!-- Empty State -->
    <div id="wishlistEmpty" class="hidden flex-col items-center justify-center py-16 text-center">
      <svg class="h-20 w-20 text-slate-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
        <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <p class="mt-4 text-sm font-semibold text-slate-900">উইশলিস্ট খালি</p>
      <p class="mt-1 text-xs text-slate-500">পছন্দের বই যোগ করুন!</p>
      <a href="<?php echo domain; ?>" class="mt-4 rounded-xl bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition">কেনাকাটা শুরু করুন</a>
    </div>
  </div>
</main>

<script>
(function() {
  const WISHLIST_KEY = 'naafiun_wishlist';
  const container = document.getElementById('wishlistContainer');
  const emptyState = document.getElementById('wishlistEmpty');

  function getWishlist() {
    try {
      return JSON.parse(localStorage.getItem(WISHLIST_KEY)) || [];
    } catch { return []; }
  }

  function formatPrice(n) {
    return '৳ ' + n.toLocaleString('bn-BD');
  }

  function renderWishlist(products) {
    const wishlist = getWishlist();
    if (!container || wishlist.length === 0) {
      if (container) container.innerHTML = '';
      if (emptyState) emptyState.classList.remove('hidden');
      return;
    }

    if (emptyState) emptyState.classList.add('hidden');

    const wishlistProducts = products.filter(p => wishlist.includes(p.id));

    container.innerHTML = wishlistProducts.map(p => `
      <div class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition">
        <div class="relative">
          <a href="details?slug=${p.slug}" class="block">
            <div class="aspect-[4/5] bg-slate-100">
              <img src="${p.image}" alt="${p.title}" class="h-full w-full object-cover" loading="lazy" />
            </div>
          </a>
          <button onclick="window.removeWishlist(${p.id})" class="absolute right-2 top-2 rounded-full bg-white/90 p-2 text-rose-500 hover:bg-rose-500 hover:text-white transition shadow-sm" aria-label="Remove from wishlist">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
            </svg>
          </button>
        </div>
        <div class="p-4">
          <h3 class="line-clamp-2 text-sm font-bold text-slate-900">${p.title}</h3>
          <p class="mt-1 text-xs text-slate-500">${p.author}</p>
          <div class="mt-3 flex items-center justify-between gap-2">
            <div class="flex items-baseline gap-2">
              <p class="text-base font-extrabold text-slate-900">${formatPrice(p.price)}</p>
              ${p.originalPrice && p.originalPrice > p.price ? `<p class="text-xs text-slate-400 line-through">${formatPrice(p.originalPrice)}</p>` : ''}
            </div>
            <button onclick="window.addToCartFromWishlist(${p.id})" class="rounded-lg bg-emerald-600 px-3 py-2 text-xs font-bold text-white hover:bg-emerald-700 transition" ${!p.inStock ? 'disabled style="opacity:.5"' : ''}>
              ${p.inStock ? 'কার্টে যোগ করুন' : 'স্টক আউট'}
            </button>
          </div>
        </div>
      </div>
    `).join('');
  }

  // Load products and render
  fetch('data/products.json')
    .then(res => res.json())
    .then(data => renderWishlist(data.products || []))
    .catch(() => {
      if (emptyState) emptyState.classList.remove('hidden');
    });

  // Expose functions globally
  window.removeWishlist = function(productId) {
    let wishlist = getWishlist();
    wishlist = wishlist.filter(id => id !== productId);
    localStorage.setItem(WISHLIST_KEY, JSON.stringify(wishlist));
    fetch('data/products.json')
      .then(res => res.json())
      .then(data => renderWishlist(data.products || []));
  };

  window.addToCartFromWishlist = function(productId) {
    fetch('data/products.json')
      .then(res => res.json())
      .then(data => {
        const product = data.products.find(p => p.id === productId);
        if (product && window.NaafiunCart) {
          window.NaafiunCart.addToCart(product, 1);
        }
      });
  };
})();
</script>
