<!-- Checkout Page -->
<main class="min-h-screen bg-slate-50">
  <div class="mx-auto max-w-5xl px-4 py-8">
    <!-- Progress Steps -->
    <div class="flex items-center justify-center gap-0 mb-8">
      <div class="flex items-center gap-2">
        <div class="grid h-8 w-8 place-items-center rounded-full bg-emerald-600 text-xs font-bold text-white">১</div>
        <span class="text-sm font-semibold text-emerald-600 hidden sm:inline">কার্ট</span>
      </div>
      <div class="h-0.5 w-8 sm:w-16 bg-emerald-600"></div>
      <div class="flex items-center gap-2">
        <div class="grid h-8 w-8 place-items-center rounded-full bg-emerald-600 text-xs font-bold text-white">২</div>
        <span class="text-sm font-semibold text-emerald-600 hidden sm:inline">চেকআউট</span>
      </div>
      <div class="h-0.5 w-8 sm:w-16 bg-slate-300"></div>
      <div class="flex items-center gap-2">
        <div class="grid h-8 w-8 place-items-center rounded-full bg-slate-300 text-xs font-bold text-slate-500">৩</div>
        <span class="text-sm font-medium text-slate-400 hidden sm:inline">সম্পন্ন</span>
      </div>
    </div>

    <div class="flex flex-col gap-6 lg:flex-row">
      <!-- Checkout Form -->
      <div class="flex-1 space-y-6">
        <!-- Delivery Info -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
          <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            ডেলিভারি তথ্য
          </h3>
          <form id="checkoutForm" class="mt-4 space-y-4">
            <div class="grid gap-4 sm:grid-cols-2">
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">পুরো নাম</label>
                <input type="text" name="full_name" placeholder="আপনার পুরো নাম" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">ফোন নম্বর</label>
                <input type="tel" name="phone" placeholder="01XXXXXXXXX" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20" required />
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-1.5">সম্পূর্ণ ঠিকানা</label>
              <textarea name="address" rows="3" placeholder="বাড়ি নম্বর, রোড, এলাকা" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 resize-none" required></textarea>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">জেলা</label>
                <select name="district" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                  <option value="">জেলা নির্বাচন করুন</option>
                  <option>ঢাকা</option>
                  <option>চট্টগ্রাম</option>
                  <option>রাজশাহী</option>
                  <option>খুলনা</option>
                  <option>সিলেট</option>
                  <option>বরিশাল</option>
                  <option>রংপুর</option>
                  <option>ময়মনসিংহ</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">থানা</label>
                <input type="text" name="thana" placeholder="আপনার থানা" class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20" />
              </div>
            </div>
          </form>
        </div>

        <!-- Payment Method -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
          <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            পেমেন্ট পদ্ধতি
          </h3>
          <div class="mt-4 space-y-3">
            <label class="payment-option flex items-center gap-3 rounded-xl border-2 border-emerald-600 bg-emerald-50 px-4 py-3 cursor-pointer transition" data-value="cod">
              <input type="radio" name="payment" value="cod" checked class="h-4 w-4 text-emerald-600 focus:ring-emerald-500" />
              <div>
                <p class="text-sm font-semibold text-slate-900">ক্যাশ অন ডেলিভারি</p>
                <p class="text-xs text-slate-500">ডেলিভারির সময় পেমেন্ট করুন</p>
              </div>
            </label>
            <label class="payment-option flex items-center gap-3 rounded-xl border border-slate-300 px-4 py-3 cursor-pointer hover:bg-slate-50 transition" data-value="bkash">
              <input type="radio" name="payment" value="bkash" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500" />
              <div class="flex items-center gap-2">
                <span class="text-sm font-semibold text-slate-900">বিকাশ</span>
                <span class="rounded bg-pink-500 px-1.5 py-0.5 text-[10px] font-bold text-white">শীঘ্রই</span>
              </div>
            </label>
            <label class="payment-option flex items-center gap-3 rounded-xl border border-slate-300 px-4 py-3 cursor-pointer hover:bg-slate-50 transition" data-value="nagad">
              <input type="radio" name="payment" value="nagad" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500" />
              <div class="flex items-center gap-2">
                <span class="text-sm font-semibold text-slate-900">নগদ</span>
                <span class="rounded bg-orange-500 px-1.5 py-0.5 text-[10px] font-bold text-white">শীঘ্রই</span>
              </div>
            </label>
          </div>
        </div>

        <!-- Order Note -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
          <h3 class="text-base font-bold text-slate-900">অতিরিক্ত নোট (ঐচ্ছিক)</h3>
          <textarea name="note" rows="2" placeholder="ডেলিভারি সম্পর্কে কোনো বিশেষ নির্দেশনা..." class="mt-3 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 resize-none"></textarea>
        </div>
      </div>

      <!-- Order Summary Sidebar -->
      <div class="lg:w-80">
        <div class="sticky top-24 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
          <h3 class="text-base font-bold text-slate-900">অর্ডার সারাংশ</h3>
          <!-- Dynamic Items -->
          <div id="checkoutItems" class="mt-4 space-y-3"></div>
          <hr class="my-4 border-slate-100" />
          <!-- Totals -->
          <div class="space-y-2 text-sm">
            <div class="flex justify-between text-slate-600"><span>সাবটোটাল</span><span id="checkoutSubtotal">৳ ০</span></div>
            <div class="flex justify-between text-slate-600"><span>ডেলিভারি</span><span id="checkoutDelivery" class="text-emerald-600">ফ্রি</span></div>
            <hr class="border-slate-100" />
            <div class="flex justify-between text-base font-bold text-slate-900"><span>মোট</span><span id="checkoutTotal">৳ ০</span></div>
          </div>

          <button id="placeOrderBtn" type="button" class="mt-6 w-full rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white hover:bg-emerald-700 transition shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
            অর্ডার নিশ্চিত করুন
          </button>
          <p class="mt-3 text-center text-xs text-slate-400">অর্ডার করলে আপনি শর্তাবলী মেনে নিচ্ছেন</p>
        </div>
      </div>
    </div>

    <!-- Empty Cart State -->
    <div id="checkoutEmpty" class="hidden flex-col items-center justify-center py-16 text-center">
      <svg class="h-20 w-20 text-slate-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
      <p class="mt-4 text-sm font-semibold text-slate-900">কার্ট খালি</p>
      <a href="<?php echo domain; ?>" class="mt-4 rounded-xl bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition">কেনাকাটা শুরু করুন</a>
    </div>
  </div>
</main>

<script>
(function() {
  const CART_KEY = 'naafiun_cart';

  function getCart() {
    try { return JSON.parse(localStorage.getItem(CART_KEY)) || []; }
    catch { return []; }
  }

  function formatPrice(n) {
    return '৳ ' + n.toLocaleString('bn-BD');
  }

  function renderCheckoutItems() {
    const cart = getCart();
    const itemsContainer = document.getElementById('checkoutItems');
    const subtotalEl = document.getElementById('checkoutSubtotal');
    const totalEl = document.getElementById('checkoutTotal');
    const placeOrderBtn = document.getElementById('placeOrderBtn');
    const emptyState = document.getElementById('checkoutEmpty');

    if (cart.length === 0) {
      if (itemsContainer) itemsContainer.innerHTML = '';
      if (emptyState) emptyState.classList.remove('hidden');
      if (placeOrderBtn) placeOrderBtn.disabled = true;
      return;
    }

    if (emptyState) emptyState.classList.add('hidden');
    if (placeOrderBtn) placeOrderBtn.disabled = false;

    // Render items
    if (itemsContainer) {
      itemsContainer.innerHTML = cart.map(item => `
        <div class="flex items-center gap-3">
          <div class="relative">
            <img src="${item.image}" alt="${item.title}" class="h-14 w-10 rounded-lg bg-slate-100 object-cover" />
            <span class="absolute -right-1.5 -top-1.5 grid h-5 w-5 place-items-center rounded-full bg-emerald-600 text-[10px] font-bold text-white">${item.qty}</span>
          </div>
          <div class="min-w-0 flex-1">
            <p class="truncate text-xs font-medium text-slate-900">${item.title}</p>
            <p class="text-xs font-bold text-slate-900">${formatPrice(item.price * item.qty)}</p>
          </div>
        </div>
      `).join('');
    }

    // Calculate totals
    const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
    if (subtotalEl) subtotalEl.textContent = formatPrice(subtotal);
    if (totalEl) totalEl.textContent = formatPrice(subtotal);
  }

  // Render on load
  renderCheckoutItems();

  // Payment method styling
  document.querySelectorAll('.payment-option').forEach(option => {
    option.addEventListener('click', function() {
      document.querySelectorAll('.payment-option').forEach(o => {
        o.classList.remove('border-emerald-600', 'bg-emerald-50');
        o.classList.add('border-slate-300');
      });
      this.classList.remove('border-slate-300');
      this.classList.add('border-emerald-600', 'bg-emerald-50');
      this.querySelector('input[type="radio"]').checked = true;
    });
  });

  // Place order
  const placeOrderBtn = document.getElementById('placeOrderBtn');
  if (placeOrderBtn) {
    placeOrderBtn.addEventListener('click', function() {
      const form = document.getElementById('checkoutForm');
      if (!form.checkValidity()) {
        form.reportValidity();
        return;
      }
      // Clear cart and redirect to success
      localStorage.removeItem(CART_KEY);
      window.location.href = 'order-success';
    });
  }
})();
</script>
