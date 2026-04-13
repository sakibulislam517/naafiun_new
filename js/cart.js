/**
 * Naafiun - Cart System
 * Full cart management with localStorage, animations, and slide-out panel.
 */

(function () {
  "use strict";

  // ---------- Cart State ----------
  const CART_STORAGE_KEY = "naafiun_cart";

  function getCart() {
    try {
      const data = localStorage.getItem(CART_STORAGE_KEY);
      return data ? JSON.parse(data) : [];
    } catch {
      return [];
    }
  }

  function saveCart(cart) {
    try {
      localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
    } catch (e) {
      console.warn("[Cart] Failed to save cart:", e);
    }
  }

  function addToCart(product, qty = 1) {
    const cart = getCart();
    const existingIndex = cart.findIndex((item) => item.id === product.id);

    if (existingIndex > -1) {
      cart[existingIndex].qty += qty;
    } else {
      cart.push({
        id: product.id,
        title: product.title,
        price: product.price,
        originalPrice: product.originalPrice,
        image: product.image,
        author: product.author,
        qty: qty,
        inStock: product.inStock,
      });
    }

    saveCart(cart);
    updateCartBadge();
    return cart;
  }

  function removeFromCart(productId) {
    const cart = getCart().filter((item) => item.id !== productId);
    saveCart(cart);
    updateCartBadge();
    renderCartItems();
    return cart;
  }

  function updateQuantity(productId, qty) {
    const cart = getCart();
    const item = cart.find((item) => item.id === productId);
    if (item) {
      item.qty = Math.max(1, qty);
      saveCart(cart);
      updateCartBadge();
      renderCartItems();
    }
    return cart;
  }

  function getCartTotal() {
    return getCart().reduce((sum, item) => sum + item.price * item.qty, 0);
  }

  function getCartCount() {
    return getCart().reduce((sum, item) => sum + item.qty, 0);
  }

  function clearCart() {
    saveCart([]);
    updateCartBadge();
    renderCartItems();
  }

  // ---------- Cart Badge ----------
  function updateCartBadge() {
    const count = getCartCount();
    const badges = document.querySelectorAll(".cart-badge-count");
    badges.forEach((badge) => {
      badge.textContent = count > 0 ? count : "";
      badge.style.display = count > 0 ? "grid" : "none";
      // Pop animation
      badge.classList.add("scale-125");
      setTimeout(() => badge.classList.remove("scale-125"), 200);
    });
  }

  // ---------- Cart Panel ----------
  function openCartPanel() {
    const overlay = document.getElementById("cartOverlay");
    const panel = document.getElementById("cartPanel");
    if (overlay && panel) {
      renderCartItems();
      overlay.classList.remove("hidden");
      // Trigger reflow
      void overlay.offsetWidth;
      overlay.classList.add("opacity-100");
      panel.classList.add("translate-x-0");
      panel.classList.remove("translate-x-full");
      document.body.style.overflow = "hidden";
    }
  }

  function closeCartPanel() {
    const overlay = document.getElementById("cartOverlay");
    const panel = document.getElementById("cartPanel");
    if (overlay && panel) {
      overlay.classList.remove("opacity-100");
      overlay.classList.add("opacity-0");
      panel.classList.remove("translate-x-0");
      panel.classList.add("translate-x-full");
      setTimeout(() => {
        overlay.classList.add("hidden");
        document.body.style.overflow = "";
      }, 300);
    }
  }

  function renderCartItems() {
    const container = document.getElementById("cartItemsContainer");
    const totalEl = document.getElementById("cartTotal");
    const countEl = document.getElementById("cartItemCount");
    const emptyEl = document.getElementById("cartEmptyState");
    const checkoutBtn = document.getElementById("cartCheckoutBtn");

    if (!container) return;

    const cart = getCart();

    if (cart.length === 0) {
      container.innerHTML = "";
      if (emptyEl) emptyEl.classList.remove("hidden");
      if (totalEl) totalEl.textContent = "৳ 0";
      if (countEl) countEl.textContent = "0 items";
      if (checkoutBtn) {
        checkoutBtn.disabled = true;
        checkoutBtn.classList.add("opacity-50", "cursor-not-allowed");
      }
      return;
    }

    if (emptyEl) emptyEl.classList.add("hidden");
    if (countEl) countEl.textContent = cart.length + " item" + (cart.length !== 1 ? "s" : "");
    if (checkoutBtn) {
      checkoutBtn.disabled = false;
      checkoutBtn.classList.remove("opacity-50", "cursor-not-allowed");
    }

    container.innerHTML = cart
      .map(
        (item) => `
      <div class="flex gap-4 rounded-xl border border-slate-200 bg-white p-3 transition hover:shadow-sm" data-cart-item="${item.id}">
        <a href="details?slug=${item.id}" class="h-20 w-20 shrink-0 overflow-hidden rounded-lg bg-slate-100">
          <img src="${item.image}" alt="${item.title}" class="h-full w-full object-cover" loading="lazy" />
        </a>
        <div class="flex min-w-0 flex-1 flex-col">
          <div class="flex items-start justify-between gap-2">
            <div class="min-w-0 flex-1">
              <h4 class="line-clamp-2 text-sm font-semibold text-slate-900">${item.title}</h4>
              <p class="mt-0.5 text-xs text-slate-500">${item.author}</p>
            </div>
            <button 
              type="button" 
              class="shrink-0 rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition"
              onclick="window.NaafiunCart.removeFromCart(${item.id})"
              aria-label="Remove item"
            >
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </button>
          </div>
          <div class="mt-auto flex items-center justify-between">
            <div class="flex items-center rounded-lg border border-slate-200 bg-white">
              <button 
                type="button" 
                class="px-2.5 py-1.5 text-sm text-slate-600 hover:bg-slate-50 transition"
                onclick="window.NaafiunCart.updateQty(${item.id}, ${item.qty - 1})"
                ${item.qty <= 1 ? "disabled style=\"opacity:.4;cursor:not-allowed\"" : ""}
              >
                −
              </button>
              <span class="w-8 border-x border-slate-200 px-2 py-1.5 text-center text-xs font-semibold">${item.qty}</span>
              <button 
                type="button" 
                class="px-2.5 py-1.5 text-sm text-slate-600 hover:bg-slate-50 transition"
                onclick="window.NaafiunCart.updateQty(${item.id}, ${item.qty + 1})"
              >
                +
              </button>
            </div>
            <p class="text-sm font-bold text-slate-900">৳ ${(item.price * item.qty).toLocaleString("en-IN")}</p>
          </div>
        </div>
      </div>
    `
      )
      .join("");

    if (totalEl) {
      totalEl.textContent = "৳ " + getCartTotal().toLocaleString("en-IN");
    }
  }

  // ---------- Fly-to-Cart Animation ----------
  function flyToCartAnimation(button, product) {
    // Create flying image
    const flyingImg = button.closest("article").querySelector("img");
    if (!flyingImg) return;

    const rect = flyingImg.getBoundingClientRect();
    const cartBtn = document.querySelector(".cart-trigger");
    if (!cartBtn) return;

    const cartRect = cartBtn.getBoundingClientRect();

    // Create clone
    const clone = flyingImg.cloneNode(true);
    clone.style.cssText = `
      position: fixed;
      top: ${rect.top}px;
      left: ${rect.left}px;
      width: ${rect.width}px;
      height: ${rect.height}px;
      z-index: 9999;
      border-radius: 8px;
      object-fit: cover;
      pointer-events: none;
      transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    `;

    document.body.appendChild(clone);

    // Trigger animation
    requestAnimationFrame(() => {
      clone.style.top = cartRect.top + cartRect.height / 2 - 20 + "px";
      clone.style.left = cartRect.left + cartRect.width / 2 - 20 + "px";
      clone.style.width = "40px";
      clone.style.height = "40px";
      clone.style.opacity = "0.3";
      clone.style.borderRadius = "50%";
    });

    // Cleanup
    setTimeout(() => {
      clone.remove();
      // Cart badge bounce
      const badge = cartBtn.querySelector(".cart-badge-count");
      if (badge) {
        badge.classList.add("animate-bounce");
        setTimeout(() => badge.classList.remove("animate-bounce"), 1000);
      }
    }, 850);
  }

  // ---------- Toast Notification ----------
  function showToast(message, type = "success") {
    const toast = document.getElementById("toastContainer");
    if (!toast) return;

    const toastEl = document.createElement("div");
    const bgColor = type === "success" ? "bg-emerald-600" : "bg-rose-600";
    const icon =
      type === "success"
        ? `<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
             <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
             <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
           </svg>`
        : `<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
             <path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
           </svg>`;

    toastEl.className = `flex items-center gap-3 rounded-xl ${bgColor} px-4 py-3 text-sm font-medium text-white shadow-lg`;
    toastEl.innerHTML = `${icon}<span>${message}</span>`;

    toast.appendChild(toastEl);

    // Animate in
    requestAnimationFrame(() => {
      toastEl.style.opacity = "1";
      toastEl.style.transform = "translateY(0)";
    });

    // Remove after 3s
    setTimeout(() => {
      toastEl.style.opacity = "0";
      toastEl.style.transform = "translateY(-10px)";
      setTimeout(() => toastEl.remove(), 300);
    }, 3000);
  }

  // ---------- Event Listeners ----------
  function initEventListeners() {
    // Cart trigger button
    document.querySelectorAll(".cart-trigger").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        openCartPanel();
      });
    });

    // Close cart overlay
    const overlay = document.getElementById("cartOverlay");
    if (overlay) {
      overlay.addEventListener("click", (e) => {
        if (e.target === overlay || e.target.closest("#cartClose") || e.target.closest("#cartCloseBtn")) {
          closeCartPanel();
        }
      });
    }

    // Escape key to close cart
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") closeCartPanel();
    });

    // Add to cart buttons (delegated)
    document.addEventListener("click", (e) => {
      const addBtn = e.target.closest("[data-add-cart]");
      if (!addBtn) return;

      e.preventDefault();
      e.stopPropagation();

      // Check if it's a related product button with data-related-id
      const relatedId = addBtn.dataset.relatedId;
      const article = addBtn.closest("article");
      if (!article) return;

      const productId = relatedId ? parseInt(relatedId, 10) : parseInt(article.dataset.id, 10);

      // Fetch product from JSON if needed
      async function performAdd() {
        let product = article._productData;

        // Check global cache first
        if (!product && window._productsCache) {
          product = window._productsCache.find((p) => p.id === productId);
        }

        if (!product) {
          try {
            const res = await fetch("data/products.json");
            if (!res.ok) throw new Error("Failed to load products");
            const data = await res.json();
            product = data.products.find((p) => p.id === productId);

            // Cache on article for future use
            article._productData = product;
          } catch (err) {
            console.error("[Cart] Error loading product:", err);
            showToast("Failed to add item to cart", "error");
            return;
          }
        }

        if (!product) {
          showToast("Product not found", "error");
          return;
        }

        // Fly animation
        flyToCartAnimation(addBtn, product);

        // Add to cart after animation starts
        setTimeout(() => {
          addToCart(product, 1);
          showToast(`${product.title} added to cart`, "success");

          // Button feedback
          const originalText = addBtn.textContent;
          addBtn.textContent = "✓ Added!";
          addBtn.classList.add("bg-emerald-700");
          addBtn.disabled = true;

          setTimeout(() => {
            addBtn.textContent = originalText;
            addBtn.classList.remove("bg-emerald-700");
            addBtn.disabled = false;
          }, 1500);
        }, 200);
      }

      performAdd();
    });

    // Product detail page - Add to cart button
    const detailAddBtn = document.getElementById("detailAddToCart");
    if (detailAddBtn) {
      detailAddBtn.addEventListener("click", async (e) => {
        e.preventDefault();

        const productId = window._currentProductId;
        if (!productId) return;

        const qty = 1; // Always 1 on product details page

        try {
          const res = await fetch("data/products.json");
          if (!res.ok) throw new Error("Failed to load products");
          const data = await res.json();
          const product = data.products.find((p) => p.id === productId);

          if (!product) {
            showToast("Product not found", "error");
            return;
          }

          // Fly animation from main product image
          const mainImg = document.getElementById("main-image");
          if (mainImg) {
            const rect = mainImg.getBoundingClientRect();
            const cartBtn = document.querySelector(".cart-trigger");
            if (cartBtn) {
              const cartRect = cartBtn.getBoundingClientRect();
              const clone = mainImg.cloneNode(true);
              clone.style.cssText = `
                position: fixed;
                top: ${rect.top}px;
                left: ${rect.left}px;
                width: ${rect.width}px;
                height: ${rect.height}px;
                z-index: 9999;
                border-radius: 12px;
                object-fit: cover;
                pointer-events: none;
                transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
              `;
              document.body.appendChild(clone);

              requestAnimationFrame(() => {
                clone.style.top = cartRect.top + cartRect.height / 2 - 20 + "px";
                clone.style.left = cartRect.left + cartRect.width / 2 - 20 + "px";
                clone.style.width = "40px";
                clone.style.height = "40px";
                clone.style.opacity = "0.3";
                clone.style.borderRadius = "50%";
              });

              setTimeout(() => clone.remove(), 850);
            }
          }

          setTimeout(() => {
            addToCart(product, qty);
            showToast(`${product.title} (x${qty}) added to cart`, "success");

            // Button feedback
            const originalText = detailAddBtn.textContent;
            detailAddBtn.innerHTML = `
              <svg class="inline-block h-4 w-4" viewBox="0 0 24 24" fill="none">
                <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Added!
            `;
            detailAddBtn.classList.add("bg-emerald-700");
            detailAddBtn.disabled = true;

            setTimeout(() => {
              detailAddBtn.textContent = originalText;
              detailAddBtn.classList.remove("bg-emerald-700");
              detailAddBtn.disabled = false;
            }, 2000);
          }, 200);
        } catch (err) {
          console.error("[Cart] Error:", err);
          showToast("Failed to add item to cart", "error");
        }
      });
    }
  }

  // ---------- Init ----------
  function init() {
    updateCartBadge();
    initEventListeners();

    // Expose cart functions globally for inline onclick handlers
    window.NaafiunCart = {
      addToCart,
      removeFromCart,
      updateQuantity: updateQuantity,
      updateQty: updateQuantity,
      getCart,
      getCartTotal,
      getCartCount,
      openCartPanel,
      closeCartPanel,
    };
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
