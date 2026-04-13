<!-- Breadcrumbs -->
<nav aria-label="Breadcrumb" class="mx-auto max-w-7xl px-4 mt-6 pt-4 border-b border-slate-100">
  <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-500 pb-3">
    <li><a class="hover:text-slate-900 transition" href="<?php echo domain; ?>">হোম</a></li>
    <li>/</li>
    <li><a class="hover:text-slate-900 transition" href="#" id="breadcrumb-category">ক্যাটাগরি</a></li>
    <li>/</li>
    <li class="font-semibold text-slate-900" aria-current="page" id="breadcrumb-title">বই</li>
  </ol>
</nav>

<!-- Product Section -->
<section class="mx-auto max-w-7xl px-4 py-6">
  <div class="grid gap-6 lg:grid-cols-[1fr_280px] xl:grid-cols-[1fr_320px]">
    <!-- Left+Center: Image + Product Info -->
    <div class="grid gap-6 md:grid-cols-[200px_1fr]">

      <!-- ===== LEFT: Product Image ===== -->
      <div>
        <div class="sticky top-24">
          <div class="overflow-hidden rounded-xl border border-slate-200 bg-white p-3 shadow-sm">
            <div class="aspect-[3/4] bg-slate-100">
              <img
                id="main-image"
                src=""
                alt="Book cover"
                class="h-full w-full object-contain"
                loading="lazy"
              />
            </div>
          </div>

          <!-- Thumbnails -->
          <div class="mt-3 grid grid-cols-4 gap-1.5" id="gallery-thumbnails">
            <button class="aspect-square overflow-hidden rounded-md border-2 border-emerald-600 bg-white" type="button" aria-label="Thumbnail 1">
              <img src="" alt="" class="h-full w-full object-cover thumbnail-img" loading="lazy" />
            </button>
            <button class="aspect-square overflow-hidden rounded-md border border-slate-200 bg-white opacity-70 hover:opacity-100" type="button" aria-label="Thumbnail 2">
              <img src="" alt="" class="h-full w-full object-cover thumbnail-img" loading="lazy" />
            </button>
            <button class="aspect-square overflow-hidden rounded-md border border-slate-200 bg-white opacity-70 hover:opacity-100" type="button" aria-label="Thumbnail 3">
              <img src="" alt="" class="h-full w-full object-cover thumbnail-img" loading="lazy" />
            </button>
            <button class="aspect-square overflow-hidden rounded-md border border-slate-200 bg-white opacity-70 hover:opacity-100" type="button" aria-label="Thumbnail 4">
              <img src="" alt="" class="h-full w-full object-cover thumbnail-img" loading="lazy" />
            </button>
          </div>
        </div>
      </div>

      <!-- ===== CENTER: Product Info ===== -->
      <div class="min-w-0">
        <h1 class="text-xl font-bold text-slate-900 sm:text-2xl leading-snug" id="product-title">বই</h1>

        <!-- Product Meta -->
        <div class="mt-4 space-y-2 text-sm">
          <div class="flex flex-wrap gap-x-2 gap-y-1">
            <span class="font-semibold text-slate-600">লেখক:</span>
            <span class="text-slate-900" id="product-author">—</span>
          </div>
          <div class="flex flex-wrap gap-x-2 gap-y-1">
            <span class="font-semibold text-slate-600">বিষয়:</span>
            <span class="text-red-600 font-medium" id="product-category">—</span>
          </div>
          <div class="flex flex-wrap gap-x-2 gap-y-1">
            <span class="font-semibold text-slate-600">প্রকাশনী:</span>
            <span class="text-red-600 font-medium" id="product-publisher">—</span>
          </div>
          <div class="flex flex-wrap gap-x-2 gap-y-1">
            <span class="font-semibold text-slate-600">পৃষ্ঠা:</span>
            <span class="text-slate-900" id="detail-pages">—</span>
          </div>
          <div class="flex flex-wrap gap-x-2 gap-y-1">
            <span class="font-semibold text-slate-600">ভাষা:</span>
            <span class="text-slate-900" id="detail-language">বাংলা</span>
          </div>
          <div class="flex flex-wrap gap-x-2 gap-y-1">
            <span class="font-semibold text-slate-600">কভার:</span>
            <span class="text-slate-900" id="detail-cover">—</span>
          </div>
          <div class="flex flex-wrap gap-x-2 gap-y-1">
            <span class="font-semibold text-slate-600">সংস্করণ:</span>
            <span class="text-slate-900">১ম প্রকাশ, ২০২৫</span>
          </div>
        </div>

        <!-- Description -->
        <div id="product-description" class="mt-5 text-sm leading-7 text-slate-600">
          <p>বই সম্পর্কে বিস্তারিত এখানে আসবে।</p>
        </div>

        <!-- Price -->
        <div class="mt-6 flex items-center gap-3">
          <span class="text-2xl font-bold text-slate-900" id="product-price">৳ ০</span>
          <span class="text-sm text-slate-400 line-through" id="product-original-price">৳ ০</span>
          <span class="rounded bg-emerald-50 px-2 py-0.5 text-xs font-bold text-emerald-600" id="discount-badge">০% ছাড়</span>
        </div>

        <!-- Action Buttons -->
        <div class="mt-5 flex flex-col gap-3 sm:flex-row">
          <button id="detailAddToCart" class="w-full rounded-lg bg-orange-500 px-6 py-2.5 text-sm font-bold text-white hover:bg-orange-600 transition focus:outline-none focus:ring-4 focus:ring-orange-500/30 sm:w-auto" type="button">
            অর্ডার করুন
          </button>
          <button class="w-full rounded-lg border-2 border-green-600 bg-white px-6 py-2.5 text-sm font-bold text-green-600 hover:bg-green-50 transition sm:w-auto" type="button">
            পছন্দের তালিকায় যুক্ত করুন
          </button>
        </div>

        <!-- Divider -->
        <hr class="mt-6 border-slate-200" />

        <!-- Social Share (bottom of center section) -->
        <div class="mt-4 flex items-center gap-2">
          <span class="text-xs font-semibold text-slate-500">শেয়ার করুন:</span>
          <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700 transition" aria-label="Facebook">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M13.5 22v-8h2.7l.5-3H13.5V9.1c0-.8.3-1.4 1.5-1.4H16.9V5.1c-.3 0-1.3-.1-2.4-.1-2.5 0-4.2 1.5-4.2 4.3V11H7.7v3h2.6v8h3.2Z"/></svg>
          </a>
          <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full bg-green-500 text-white hover:bg-green-600 transition" aria-label="WhatsApp">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
          </a>
          <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-700 text-white hover:bg-slate-800 transition" aria-label="Email">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </a>
          <button class="flex h-8 w-8 items-center justify-center rounded-full border border-slate-300 text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition" aria-label="Copy link" id="copyLinkBtn">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
          </button>
        </div>
      </div>

    </div>

    <!-- ===== RIGHT: Related Products Sidebar ===== -->
    <div class="hidden lg:block">
      <div class="sticky top-24">
        <h2 class="text-sm font-bold text-slate-900 border-b border-slate-200 pb-2">আরো দেখুন</h2>
        <div class="mt-3 space-y-2.5 max-h-[80vh] overflow-y-auto pr-1" id="related-products" style="scrollbar-width: thin;">
          <!-- Related products loaded dynamically -->
        </div>
      </div>
    </div>

  </div>
</section>

<!-- Mobile: Related Products (shown below on small screens) -->
<section class="lg:hidden mx-auto max-w-7xl px-4 pb-10">
  <h2 class="text-lg font-bold text-slate-900">আরো দেখুন...</h2>
  <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-3" id="related-products-mobile">
  </div>
</section>
