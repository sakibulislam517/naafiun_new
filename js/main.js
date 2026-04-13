/**
 * Naafiun - Dynamic Product Renderer
 * Fetches products from data/products.json and renders them on the page.
 */

(function () {
  "use strict";

  const JSON_PATH = "data/products.json";

  // ---------- helpers ----------
  function formatPrice(n) {
    return "৳ " + n.toLocaleString("bn-BD");
  }

  function createProductCard(p) {
    const article = document.createElement("article");
    article.className =
      "overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md";
    article.setAttribute("data-id", p.id);
    // Cache product data on element for cart access
    article._productData = p;

    article.innerHTML = `
      <a href="details?slug=${p.slug}" class="block">
        <div class="relative aspect-[4/5] bg-slate-100">
          <img src="${p.image}" alt="${p.title}" class="h-full w-full object-cover" loading="lazy" />
          ${p.discount ? `<span class="absolute left-2 top-2 rounded bg-rose-600 px-2 py-1 text-xs font-bold text-white">-${p.discount}%</span>` : ""}
          ${!p.inStock ? `<span class="absolute right-2 top-2 rounded bg-slate-800 px-2 py-1 text-xs font-bold text-white">স্টক আউট</span>` : ""}
        </div>
        <div class="p-3 flex flex-col">
          <h3 class="line-clamp-2 text-sm font-bold text-slate-900 min-h-[2.5rem]">${p.title}</h3>
          <p class="mt-1 text-xs text-slate-500">${p.author}</p>
          <div class="mt-2 flex items-baseline gap-2">
            <p class="text-sm font-extrabold text-slate-900">${formatPrice(p.price)}</p>
            ${p.originalPrice && p.originalPrice > p.price ? `<p class="text-xs text-slate-400 line-through">${formatPrice(p.originalPrice)}</p>` : ""}
          </div>
          <button class="mt-3 w-full rounded-lg bg-emerald-600 px-3 py-2 text-xs font-bold text-white hover:bg-emerald-700" type="button" data-add-cart ${!p.inStock ? "disabled style=\"opacity:.5;cursor:not-allowed\"" : ""}>
            ${p.inStock ? "কার্টে যোগ করুন" : "স্টক আউট"}
          </button>
        </div>
      </a>
    `;

    return article;
  }

  // ---------- render popular / featured ----------
  function renderPopular(products) {
    const grid = document.getElementById("popular-grid");
    if (!grid) return;

    const featured = products.filter((p) => p.featured);
    const items = featured.length >= 6 ? featured.slice(0, 6) : products.slice(0, 6);

    grid.innerHTML = "";
    items.forEach((p) => grid.appendChild(createProductCard(p)));
  }

  // ---------- render new arrivals ----------
  function renderNewArrivals(products) {
    const grid = document.getElementById("newarrival-grid");
    if (!grid) return;

    const newArrivals = products.filter((p) => p.newArrival);
    const items = newArrivals.length >= 6 ? newArrivals.slice(0, 6) : products.slice(0, 6);

    grid.innerHTML = "";
    items.forEach((p) => grid.appendChild(createProductCard(p)));
  }

  // ---------- init ----------
  async function init() {
    try {
      const res = await fetch(JSON_PATH);
      if (!res.ok) throw new Error("Failed to load products.json");
      const data = await res.json();
      const products = data.products || [];

      // Cache products globally for cart access
      window._productsCache = products;

      renderPopular(products);
      renderNewArrivals(products);
    } catch (err) {
      console.error("[Naafiun] Error loading products:", err);
      // Show fallback message
      const grids = document.querySelectorAll("#popular-grid, #newarrival-grid");
      grids.forEach((g) => {
        g.innerHTML = `<p class="col-span-full text-center text-sm text-slate-500 py-8">Unable to load products. Please run this on a local server.</p>`;
      });
    }
  }

  // Run on DOM ready
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
