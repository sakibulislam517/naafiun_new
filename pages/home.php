

<main>
      <!-- Hero slider (previous-style) -->
      <section class="mx-auto max-w-7xl px-4 py-6" aria-label="Hero promotions">
        <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
          <!-- Fixed hero height (max 250px) -->
          <div class="relative h-[160px] max-h-[250px] bg-slate-100 sm:h-[200px] md:h-[250px]">
            <div id="heroTrack" class="flex h-full transition-transform duration-500 ease-out">
            <!-- Slide 1 -->
            <a href="index.php?e=details&slug=${p.slug}" class="block h-full w-full shrink-0" aria-label="Go to delivery charge banner">
              <img
                src="https://www.naafiun.com/_next/image?url=https%3A%2F%2Fapi.naafiun.com%2Fstorage%2Fbanners%2Fdeliverychargebanner.jpg&w=1920&q=75"
                alt="Delivery charge banner"
                class="h-full w-full object-cover object-center"
                loading="eager"
              />
            </a>

            <!-- Slide 2 -->
            <a href="index.php" class="block h-full w-full shrink-0" aria-label="Go to featured offer">
              <img
                src="https://www.naafiun.com/_next/image?url=https%3A%2F%2Fapi.naafiun.com%2Fstorage%2Fbanners%2Fweb-banner-2.jpg&w=1920&q=75"
                alt="Web banner 2"
                class="h-full w-full object-cover object-center"
                loading="lazy"
              />
            </a>

            <!-- Slide 3 -->
            <a href="index.php" class="block h-full w-full shrink-0" aria-label="Go to editor upload">
              <img
                src="https://www.naafiun.com/_next/image?url=https%3A%2F%2Fapi.naafiun.com%2Fstorage%2Feditor%2Fupload-1643897608.jpg&w=640&q=75"
                alt="Editor upload banner"
                class="h-full w-full object-cover object-center"
                loading="lazy"
              />
            </a>
            </div>

            <!-- Soft edge gradient (adds a polished look) -->
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-r from-white/5 via-transparent to-white/5"></div>
          </div>

          <!-- Controls -->
          <button
            id="heroPrev"
            type="button"
            class="absolute left-3 top-1/2 -translate-y-1/2 rounded-full bg-white/90 p-2.5 text-slate-800 shadow-sm ring-1 ring-slate-900/10 backdrop-blur hover:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-600/20"
            aria-label="Previous slide"
          >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M15 6 9 12l6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
          <button
            id="heroNext"
            type="button"
            class="absolute right-3 top-1/2 -translate-y-1/2 rounded-full bg-white/90 p-2.5 text-slate-800 shadow-sm ring-1 ring-slate-900/10 backdrop-blur hover:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-600/20"
            aria-label="Next slide"
          >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>

          <!-- Dots -->
          <div class="absolute bottom-3 left-1/2 flex -translate-x-1/2 gap-2 rounded-full bg-white/85 px-3 py-1.5 shadow-sm ring-1 ring-slate-900/10 backdrop-blur">
            <button class="heroDot h-2.5 w-6 rounded-full bg-emerald-600 transition" type="button" aria-label="Go to slide 1" data-slide="0"></button>
            <button class="heroDot h-2.5 w-2.5 rounded-full bg-slate-300 transition" type="button" aria-label="Go to slide 2" data-slide="1"></button>
            <button class="heroDot h-2.5 w-2.5 rounded-full bg-slate-300 transition" type="button" aria-label="Go to slide 3" data-slide="2"></button>
          </div>
        </div>
      </section>

      <!-- Featured category blocks (like your screenshot) -->
      <section class="mx-auto max-w-7xl px-4 pb-6">
        <div class="grid gap-3 grid-cols-2 sm:grid-cols-3 lg:grid-cols-5">
          <a href="#" class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm hover:bg-slate-50">
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-emerald-50 text-emerald-700">
              <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2V5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M7 17h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </span>
            <div>
              <p class="text-sm font-bold text-slate-900">বই</p>
              <p class="text-xs text-slate-500">সব ক্যাটাগরি</p>
            </div>
          </a>
          <a href="#" class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm hover:bg-slate-50">
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-sky-50 text-sky-700">
              <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M7 10h10M7 14h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M6 20h12a2 2 0 0 0 2-2V8l-6-4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
              </svg>
            </span>
            <div>
              <p class="text-sm font-bold text-slate-900">নতুন প্রকাশ</p>
              <p class="text-xs text-slate-500">আজকের আপডেট</p>
            </div>
          </a>
          <a href="#" class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm hover:bg-slate-50">
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-rose-50 text-rose-700">
              <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M20 12a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z" stroke="currentColor" stroke-width="2"/>
                <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
            <div>
              <p class="text-sm font-bold text-slate-900">প্রি-অর্ডার</p>
              <p class="text-xs text-slate-500">আসছে শিগগির</p>
            </div>
          </a>
          <a href="#" class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm hover:bg-slate-50">
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-amber-50 text-amber-700">
              <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M20 7H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M7 7a5 5 0 0 1 10 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </span>
            <div>
              <p class="text-sm font-bold text-slate-900">অফার</p>
              <p class="text-xs text-slate-500">ডিসকাউন্ট ডিল</p>
            </div>
          </a>
          <a href="#" class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-4 shadow-sm hover:bg-slate-50">
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-indigo-50 text-indigo-700">
              <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 21s-7-4.4-7-10a4 4 0 0 1 7-2.4A4 4 0 0 1 19 11c0 5.6-7 10-7 10Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
              </svg>
            </span>
            <div>
              <p class="text-sm font-bold text-slate-900">গিফট</p>
              <p class="text-xs text-slate-500">প্যাকেজ/সেট</p>
            </div>
          </a>
        </div>
      </section>

      <!-- Service strip -->
      <section class="mx-auto max-w-7xl px-4 pb-8">
        <div class="grid gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm grid-cols-2 lg:grid-cols-4">
          <div class="flex items-start gap-3">
            <span class="mt-0.5 grid h-10 w-10 place-items-center rounded-xl bg-emerald-50 text-emerald-700">
              <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M3 7h13v10H3V7Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M16 10h3l2 3v4h-5v-7Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M7 19a1 1 0 1 0 0 2 1 1 0 0 0 0-2Zm12 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2Z" stroke="currentColor" stroke-width="2"/>
              </svg>
            </span>
            <div>
              <p class="text-sm font-bold text-slate-900">দ্রুত ডেলিভারি</p>
              <p class="text-xs text-slate-500">৪৮–৭২ ঘণ্টা (ডেমো)</p>
            </div>
          </div>
          <div class="flex items-start gap-3">
            <span class="mt-0.5 grid h-10 w-10 place-items-center rounded-xl bg-sky-50 text-sky-700">
              <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 1v22" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M17 5H9a4 4 0 0 0 0 8h6a4 4 0 0 1 0 8H7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
            <div>
              <p class="text-sm font-bold text-slate-900">ক্যাশ অন ডেলিভারি</p>
              <p class="text-xs text-slate-500">সহজ পেমেন্ট (ডেমো)</p>
            </div>
          </div>
          <div class="flex items-start gap-3">
            <span class="mt-0.5 grid h-10 w-10 place-items-center rounded-xl bg-amber-50 text-amber-700">
              <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 21s7-4.4 7-10V6l-7-3-7 3v5c0 5.6 7 10 7 10Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="m9 12 2 2 4-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
            <div>
              <p class="text-sm font-bold text-slate-900">বিশ্বস্ত সার্ভিস</p>
              <p class="text-xs text-slate-500">নিরাপদ অর্ডার (ডেমো)</p>
            </div>
          </div>
          <div class="flex items-start gap-3">
            <span class="mt-0.5 grid h-10 w-10 place-items-center rounded-xl bg-rose-50 text-rose-700">
              <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M4 4h16v12H5.5L4 17.5V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M7 8h10M7 11h7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </span>
            <div>
              <p class="text-sm font-bold text-slate-900">সাপোর্ট</p>
              <p class="text-xs text-slate-500">৭ দিন (ডেমো)</p>
            </div>
          </div>
        </div>
      </section>


      <?php foreach ($db->getdata("SELECT * FROM subject WHERE home_status = 1") as $subject): ?>
      <?php
        $sliderId = "subject-slider-" . (int)$subject['id'];
        $sql = "SELECT p.* FROM product p 
          WHERE p.id > 0 AND FIND_IN_SET({$subject['id']}, p.subject) ORDER BY p.id DESC LIMIT 0, 15";
        $products = $db->getdata($sql);
      ?>
      <section class="mx-auto max-w-7xl px-4 pb-10">
        <div class="flex items-center justify-between gap-3">
          <div>
            <h2 class="relative inline-block text-xl font-black text-slate-900 sm:text-2xl">
              <?php echo $subject['name']; ?>
              <span class="mt-1 block h-1 w-16 rounded-full bg-gradient-to-r from-emerald-500 to-sky-500"></span>
            </h2>
          </div>
          <div class="flex items-center gap-2">
            <button type="button" class="subject-slider-btn rounded-full border border-slate-200 bg-white p-2 text-slate-700 shadow-sm hover:bg-slate-50" data-slider-target="<?php echo $sliderId; ?>" data-direction="left" aria-label="Scroll left">
              <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M15 6 9 12l6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </button>
            <button type="button" class="subject-slider-btn rounded-full border border-slate-200 bg-white p-2 text-slate-700 shadow-sm hover:bg-slate-50" data-slider-target="<?php echo $sliderId; ?>" data-direction="right" aria-label="Scroll right">
              <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </button>
            <a class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50" href="#">সব দেখুন</a>
          </div>
        </div>

        <div id="<?php echo $sliderId; ?>" class="subject-slider mt-4 flex gap-3 overflow-x-auto scroll-smooth pb-1">
          <?php
          if (!empty($products)) {
            foreach ($products as $product) {
              echo '<div class="subject-slide w-[170px] shrink-0 sm:w-[190px] md:w-[210px]">';
              echo $db->products($product);
              echo '</div>';
            }
          }
          ?>
        </div>
      </section>
      <?php endforeach; ?>

      <style>
        .subject-slider{
          -ms-overflow-style: none;
          scrollbar-width: none;
          cursor: grab;
          user-select: none;
          touch-action: pan-y;
        }
        .subject-slider::-webkit-scrollbar{
          display: none;
        }
        .subject-slider.is-dragging{
          cursor: grabbing;
        }
      </style>

      <script>
        document.querySelectorAll('.subject-slider-btn').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var slider = document.getElementById(btn.getAttribute('data-slider-target'));
            if (!slider) return;

            var scrollAmount = Math.max(slider.clientWidth * 0.8, 260);
            var direction = btn.getAttribute('data-direction') === 'left' ? -1 : 1;
            slider.scrollBy({ left: scrollAmount * direction, behavior: 'smooth' });
          });
        });

        document.querySelectorAll('.subject-slider').forEach(function (slider) {
          var isDragging = false;
          var startX = 0;
          var startScrollLeft = 0;
          var draggedDistance = 0;

          slider.querySelectorAll('img, a').forEach(function (item) {
            item.setAttribute('draggable', 'false');
          });

          slider.addEventListener('pointerdown', function (e) {
            if (e.pointerType === 'mouse' && e.button !== 0) return;
            if (e.target.closest('[data-add-cart], button, a, input, select, textarea, label')) return;
            isDragging = true;
            draggedDistance = 0;
            startX = e.clientX;
            startScrollLeft = slider.scrollLeft;
            slider.classList.add('is-dragging');
            slider.setPointerCapture(e.pointerId);
          });

          slider.addEventListener('pointermove', function (e) {
            if (!isDragging) return;
            var walk = e.clientX - startX;
            draggedDistance = Math.max(draggedDistance, Math.abs(walk));
            slider.scrollLeft = startScrollLeft - walk;
          });

          slider.addEventListener('pointerup', function (e) {
            if (!isDragging) return;
            isDragging = false;
            slider.classList.remove('is-dragging');
            if (slider.hasPointerCapture(e.pointerId)) {
              slider.releasePointerCapture(e.pointerId);
            }
          });

          slider.addEventListener('pointercancel', function (e) {
            isDragging = false;
            slider.classList.remove('is-dragging');
            if (slider.hasPointerCapture(e.pointerId)) {
              slider.releasePointerCapture(e.pointerId);
            }
          });

          slider.addEventListener('click', function (e) {
            // Keep action controls clickable inside slider cards.
            if (e.target.closest('[data-add-cart], button, a, input, select, textarea, label')) {
              return;
            }
            if (draggedDistance > 6) {
              e.preventDefault();
              e.stopPropagation();
            }
          }, true);
        });
      </script>



     
    </main>

    