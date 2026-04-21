<?php
function csv_to_int_array($value) {
    $parts = array_filter(array_map('trim', explode(',', (string)$value)));
    return array_values(array_filter(array_map('intval', $parts)));
} 

$selectedSubjects = isset($_GET['subject_ids']) ? csv_to_int_array($_GET['subject_ids']) : [];
$selectedWriters = isset($_GET['writer_ids']) ? csv_to_int_array($_GET['writer_ids']) : [];
$selectedPublishers = isset($_GET['publisher_ids']) ? csv_to_int_array($_GET['publisher_ids']) : [];
$minPrice = isset($_GET['min_price']) && $_GET['min_price'] !== '' ? (float)$_GET['min_price'] : null;
$maxPrice = isset($_GET['max_price']) && $_GET['max_price'] !== '' ? (float)$_GET['max_price'] : null;
$sort = isset($_GET['sort']) ? trim((string)$_GET['sort']) : 'newest';
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// Load filter data for sidebar
$subjects = $db->getFull('subject', ' ORDER BY name ASC');
$writers = $db->getFull('writer', ' ORDER BY name ASC');
$publishers = $db->getFull('publisher', ' ORDER BY name ASC');
?>

<main class="min-h-screen bg-white">
  <!-- Breadcrumb -->
  <nav aria-label="Breadcrumb" class="mx-auto max-w-[1400px] px-4 sm:px-6 mt-4 pt-3 pb-2">
    <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-500">
      <li><a class="hover:text-slate-900 transition" href="<?php echo domain; ?>">Home</a></li>
      <li>/</li>
      <li class="font-semibold text-slate-900" aria-current="page">Books</li>
    </ol>
  </nav>

  <div class="mx-auto max-w-[1400px] px-4 sm:px-6 pb-12">
    <div class="flex gap-6 lg:gap-8">

      <!-- ===== SIDEBAR FILTERS (Desktop) ===== -->
      <aside class="hidden lg:block w-72 xl:w-80 shrink-0">
        <div class="sticky top-20">
          <!-- Mobile Filter Button (visible on mobile only) -->
          <button id="mobileFilterBtn" class="lg:hidden fixed bottom-6 left-6 z-40 flex items-center gap-2 rounded-full bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-lg hover:bg-emerald-700 transition">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            Filters
          </button>

          <!-- Sidebar Card -->
          <div id="desktopFilterMount">
          <div id="booksFilterCard" class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <!-- Search -->
            <div class="p-4 border-b border-slate-100">
              <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input type="text" id="booksSearchInput" value="<?php echo htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Search books..." class="w-full rounded-xl border border-slate-200 bg-slate-50 pl-9 pr-3 py-2.5 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition" />
              </div>
            </div>

            <!-- Subject Filter -->
            <div class="border-b border-slate-100">
              <button class="filter-toggle w-full flex items-center justify-between px-4 py-3 text-sm font-bold text-slate-900 hover:bg-slate-50 transition" data-target="filter-subjects">
                <span>Subjects</span>
                <svg class="filter-icon h-4 w-4 text-slate-400 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
              </button>
              <div id="filter-subjects" class="filter-content px-4 pb-3">
                <input type="text" data-filter-search="subject-list" placeholder="Search subjects..." class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs mb-2 outline-none focus:border-emerald-500 transition" />
                <div id="subject-list" class="max-h-48 overflow-y-auto space-y-0.5">
                  <?php foreach ($subjects as $subject): ?>
                    <label class="flex items-center gap-2.5 rounded-lg px-2 py-1.5 hover:bg-slate-50 transition cursor-pointer">
                      <input type="checkbox" data-filter-group="subject" value="<?php echo (int)$subject['id']; ?>" class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 focus:ring-offset-0 cursor-pointer" <?php echo in_array((int)$subject['id'], $selectedSubjects, true) ? 'checked' : ''; ?> />
                      <span class="text-sm text-slate-700" data-label><?php echo htmlspecialchars($subject['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </label>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <!-- Writer Filter -->
            <div class="border-b border-slate-100">
              <button class="filter-toggle w-full flex items-center justify-between px-4 py-3 text-sm font-bold text-slate-900 hover:bg-slate-50 transition" data-target="filter-writers">
                <span>Writers</span>
                <svg class="filter-icon h-4 w-4 text-slate-400 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
              </button>
              <div id="filter-writers" class="filter-content px-4 pb-3">
                <input type="text" data-filter-search="writer-list" placeholder="Search writers..." class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs mb-2 outline-none focus:border-emerald-500 transition" />
                <div id="writer-list" class="max-h-48 overflow-y-auto space-y-0.5">
                  <?php foreach ($writers as $writer): ?>
                    <label class="flex items-center gap-2.5 rounded-lg px-2 py-1.5 hover:bg-slate-50 transition cursor-pointer">
                      <input type="checkbox" data-filter-group="writer" value="<?php echo (int)$writer['id']; ?>" class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 focus:ring-offset-0 cursor-pointer" <?php echo in_array((int)$writer['id'], $selectedWriters, true) ? 'checked' : ''; ?> />
                      <span class="text-sm text-slate-700" data-label><?php echo htmlspecialchars($writer['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </label>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <!-- Publisher Filter -->
            <div class="border-b border-slate-100">
              <button class="filter-toggle w-full flex items-center justify-between px-4 py-3 text-sm font-bold text-slate-900 hover:bg-slate-50 transition" data-target="filter-publishers">
                <span>Publishers</span>
                <svg class="filter-icon h-4 w-4 text-slate-400 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
              </button>
              <div id="filter-publishers" class="filter-content px-4 pb-3">
                <input type="text" data-filter-search="publisher-list" placeholder="Search publishers..." class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs mb-2 outline-none focus:border-emerald-500 transition" />
                <div id="publisher-list" class="max-h-48 overflow-y-auto space-y-0.5">
                  <?php foreach ($publishers as $publisher): ?>
                    <label class="flex items-center gap-2.5 rounded-lg px-2 py-1.5 hover:bg-slate-50 transition cursor-pointer">
                      <input type="checkbox" data-filter-group="publisher" value="<?php echo (int)$publisher['id']; ?>" class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 focus:ring-offset-0 cursor-pointer" <?php echo in_array((int)$publisher['id'], $selectedPublishers, true) ? 'checked' : ''; ?> />
                      <span class="text-sm text-slate-700" data-label><?php echo htmlspecialchars($publisher['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </label>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <!-- Price Range -->
            <div class="p-4">
              <h4 class="text-sm font-bold text-slate-900 mb-3">Price Range</h4>
              <div class="flex items-center gap-2">
                <input type="number" id="booksMinPrice" min="0" value="<?php echo $minPrice !== null ? htmlspecialchars((string)$minPrice, ENT_QUOTES, 'UTF-8') : ''; ?>" placeholder="৳ 0" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm outline-none focus:border-emerald-500 transition" />
                <span class="text-slate-400 text-sm">-</span>
                <input type="number" id="booksMaxPrice" min="0" value="<?php echo $maxPrice !== null ? htmlspecialchars((string)$maxPrice, ENT_QUOTES, 'UTF-8') : ''; ?>" placeholder="৳ 5000" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm outline-none focus:border-emerald-500 transition" />
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="p-4 border-t border-slate-100 space-y-2">
              <button id="applyFiltersBtn" class="w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition shadow-sm">
                Apply Filters
              </button>
              <button id="resetFiltersBtn" type="button" class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-center text-sm font-medium text-slate-600 hover:bg-slate-50 transition">
                Reset All
              </button>
            </div>
          </div>
          </div>
        </div>
      </aside>

      <!-- ===== MAIN CONTENT ===== -->
      <div class="flex-1 min-w-0">

        <!-- Top Bar: Sort + Results Count -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
          <div class="flex items-center gap-3">
            <button id="mobileFilterBtnInner" class="lg:hidden rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 transition">
              <svg class="inline h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
              Filters
            </button>
            <h1 class="text-lg font-bold text-slate-900">All Books</h1>
          </div>

          <div class="flex items-center gap-3">
            <span id="booksResultsInfo" class="text-sm text-slate-500"></span>
            <select id="booksSortSelect" class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-emerald-500 transition">
              <option value="newest" <?php echo $sort === 'newest' ? 'selected' : ''; ?>>Newest First</option>
              <option value="oldest" <?php echo $sort === 'oldest' ? 'selected' : ''; ?>>Oldest First</option>
              <option value="price_asc" <?php echo $sort === 'price_asc' ? 'selected' : ''; ?>>Price: Low to High</option>
              <option value="price_desc" <?php echo $sort === 'price_desc' ? 'selected' : ''; ?>>Price: High to Low</option>
            </select>
          </div>
        </div>

        <!-- Active Filter Tags -->
        <div id="activeFilterTags" class="mb-4 hidden"></div>

        <!-- Products Container (AJAX) -->
        <div id="booksProductsContainer">
          <!-- Initial render by PHP, then AJAX updates -->
        </div>

        <!-- Pagination Container (AJAX) -->
        <div id="booksPaginationContainer"></div>
      </div>
    </div>
  </div>

  <!-- Mobile Filter Overlay -->
  <div id="booksFilterOverlay" class="fixed inset-0 bg-black/50 z-50 hidden lg:hidden"></div>
  <!-- Mobile Filter Sidebar -->
  <div id="booksFilterSidebar" class="fixed inset-y-0 left-0 w-80 max-w-[85vw] bg-white z-50 transform -translate-x-full transition-transform duration-300 lg:hidden overflow-y-auto">
    <div class="p-4 border-b border-slate-100 flex items-center justify-between">
      <h2 class="text-lg font-bold text-slate-900">Filters</h2>
      <button id="closeMobileFilter" class="rounded-lg p-2 hover:bg-slate-100 transition">
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
      </button>
    </div>
    <div id="mobileFilterContent">
      <!-- Clone of desktop filters will be moved here on mobile -->
    </div>
    <div class="p-4 border-t border-slate-100 space-y-2 sticky bottom-0 bg-white">
      <button id="applyMobileFiltersBtn" class="w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition">Apply Filters</button>
      <button id="resetMobileFiltersBtn" type="button" class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-center text-sm font-medium text-slate-600 hover:bg-slate-50 transition">Reset All</button>
    </div>
  </div>
</main>

<script>
(function() {
  'use strict';

  // ===== State =====
  var state = {
    page: <?php echo $page; ?>,
    sort: '<?php echo htmlspecialchars($sort, ENT_QUOTES, "UTF-8"); ?>',
    subjectIds: <?php echo json_encode($selectedSubjects); ?>,
    writerIds: <?php echo json_encode($selectedWriters); ?>,
    publisherIds: <?php echo json_encode($selectedPublishers); ?>,
    minPrice: <?php echo $minPrice !== null ? json_encode((string)$minPrice) : '""'; ?>,
    maxPrice: <?php echo $maxPrice !== null ? json_encode((string)$maxPrice) : '""'; ?>,
    search: '<?php echo htmlspecialchars($searchQuery, ENT_QUOTES, "UTF-8"); ?>',
    debounceTimer: null,
    requestController: null,
    requestToken: 0,
    hasHistoryState: false
  };

  var containers = {
    products: document.getElementById('booksProductsContainer'),
    pagination: document.getElementById('booksPaginationContainer'),
    resultsInfo: document.getElementById('booksResultsInfo')
  };
  var sortSelect = document.getElementById('booksSortSelect');
  var searchInput = document.getElementById('booksSearchInput');
  var tagsContainer = document.getElementById('activeFilterTags');
  var desktopFilterMount = document.getElementById('desktopFilterMount');
  var mobileFilterContent = document.getElementById('mobileFilterContent');
  var filterCard = document.getElementById('booksFilterCard');

  // ===== Skeleton Loading =====
  function showSkeleton() {
    var html = '<div class="grid gap-4 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4">';
    for (var i = 0; i < 8; i++) {
      html += '<article class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm animate-pulse">' +
        '<div class="aspect-[3/4] bg-slate-200"></div>' +
        '<div class="p-3 space-y-3"><div class="h-4 bg-slate-200 rounded w-3/4"></div><div class="h-3 bg-slate-200 rounded w-1/2"></div><div class="h-5 bg-slate-200 rounded w-1/3"></div></div>' +
        '</article>';
    }
    html += '</div>';
    containers.products.innerHTML = html;
  }

  // ===== Collect Filters =====
  function collectFilters() {
    state.subjectIds = [];
    state.writerIds = [];
    state.publisherIds = [];
    document.querySelectorAll('input[data-filter-group="subject"]:checked').forEach(function(el) { state.subjectIds.push(parseInt(el.value)); });
    document.querySelectorAll('input[data-filter-group="writer"]:checked').forEach(function(el) { state.writerIds.push(parseInt(el.value)); });
    document.querySelectorAll('input[data-filter-group="publisher"]:checked').forEach(function(el) { state.publisherIds.push(parseInt(el.value)); });
    var minEl = document.getElementById('booksMinPrice');
    var maxEl = document.getElementById('booksMaxPrice');
    if (minEl) state.minPrice = minEl.value;
    if (maxEl) state.maxPrice = maxEl.value;
  }

  // ===== Build URL =====
  function buildUrl(p) {
    var q = {};
    if (state.sort && state.sort !== 'newest') q.sort = state.sort;
    if (state.subjectIds.length) q.subject_ids = state.subjectIds.join(',');
    if (state.writerIds.length) q.writer_ids = state.writerIds.join(',');
    if (state.publisherIds.length) q.publisher_ids = state.publisherIds.join(',');
    if (state.minPrice !== '') q.min_price = state.minPrice;
    if (state.maxPrice !== '') q.max_price = state.maxPrice;
    if (state.search) q.search = state.search;
    if (p > 1) q.page = p;
    var qs = new URLSearchParams(q).toString();
    return qs ? ('books?' + qs) : 'books';
  }

  function applyUrlState() {
    var params = new URLSearchParams(window.location.search || '');
    state.page = Math.max(1, parseInt(params.get('page') || '1', 10) || 1);
    state.sort = params.get('sort') || 'newest';
    state.subjectIds = (params.get('subject_ids') || '').split(',').map(function(v) { return parseInt(v, 10); }).filter(function(v) { return !isNaN(v); });
    state.writerIds = (params.get('writer_ids') || '').split(',').map(function(v) { return parseInt(v, 10); }).filter(function(v) { return !isNaN(v); });
    state.publisherIds = (params.get('publisher_ids') || '').split(',').map(function(v) { return parseInt(v, 10); }).filter(function(v) { return !isNaN(v); });
    state.minPrice = params.get('min_price') || '';
    state.maxPrice = params.get('max_price') || '';
    state.search = params.get('search') || '';

    if (sortSelect) sortSelect.value = state.sort;
    if (searchInput) searchInput.value = state.search;
    var minEl = document.getElementById('booksMinPrice');
    var maxEl = document.getElementById('booksMaxPrice');
    if (minEl) minEl.value = state.minPrice;
    if (maxEl) maxEl.value = state.maxPrice;

    document.querySelectorAll('input[data-filter-group="subject"]').forEach(function(el) {
      el.checked = state.subjectIds.indexOf(parseInt(el.value, 10)) > -1;
    });
    document.querySelectorAll('input[data-filter-group="writer"]').forEach(function(el) {
      el.checked = state.writerIds.indexOf(parseInt(el.value, 10)) > -1;
    });
    document.querySelectorAll('input[data-filter-group="publisher"]').forEach(function(el) {
      el.checked = state.publisherIds.indexOf(parseInt(el.value, 10)) > -1;
    });
  }

  function renderActiveTags(tagsHtml) {
    if (!tagsContainer) return;
    tagsContainer.innerHTML = tagsHtml || '';
    tagsContainer.classList.toggle('hidden', !tagsHtml || tagsHtml.trim() === '');
  }

  function resetAllFilters() {
    state.page = 1;
    state.sort = 'newest';
    state.subjectIds = [];
    state.writerIds = [];
    state.publisherIds = [];
    state.minPrice = '';
    state.maxPrice = '';
    state.search = '';
    applyUrlState();
    fetchBooks(true);
  }

  // ===== Fetch via AJAX =====
  function fetchBooks(pushHistory, scrollTop) {
    if (typeof pushHistory === 'undefined') pushHistory = true;
    if (typeof scrollTop === 'undefined') scrollTop = false;
    if (state.requestController) state.requestController.abort();

    var token = ++state.requestToken;
    state.requestController = new AbortController();
    showSkeleton();

    var fd = new URLSearchParams();
    fd.append('action', 'books_filter');
    fd.append('page', state.page);
    fd.append('sort', state.sort);
    if (state.subjectIds.length) fd.append('subject_ids', state.subjectIds.join(','));
    if (state.writerIds.length) fd.append('writer_ids', state.writerIds.join(','));
    if (state.publisherIds.length) fd.append('publisher_ids', state.publisherIds.join(','));
    if (state.minPrice !== '') fd.append('min_price', state.minPrice);
    if (state.maxPrice !== '') fd.append('max_price', state.maxPrice);
    if (state.search) fd.append('search', state.search);

    fetch('ajax.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
      body: fd.toString(),
      signal: state.requestController.signal
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
      if (token !== state.requestToken) return;
      if (data.status === 1) {
        containers.products.innerHTML = data.html;
        containers.pagination.innerHTML = data.pagination;
        renderActiveTags(data.tags_html || '');
        if (containers.resultsInfo) {
          containers.resultsInfo.textContent = data.total > 0 ? data.start + '-' + data.end + ' of ' + data.total + ' books' : 'No books found';
        }
        if (pushHistory) {
          window.history.pushState({page: state.page}, '', buildUrl(state.page));
        } else if (!state.hasHistoryState) {
          window.history.replaceState({page: state.page}, '', buildUrl(state.page));
        }
        state.hasHistoryState = true;
        if (scrollTop) {
          window.scrollTo({top: 0, behavior: 'smooth'});
        }
      }
    })
    .catch(function(err) {
      if (err && err.name === 'AbortError') return;
      console.error('[Books] Error:', err);
      containers.products.innerHTML = '<div class="text-center py-16"><h3 class="text-lg font-bold text-slate-700">Error loading books</h3><button onclick="location.reload()" class="mt-4 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-bold text-white">Reload</button></div>';
    });
  }

  // ===== Debounce =====
  function debounceFetch() {
    clearTimeout(state.debounceTimer);
    state.debounceTimer = setTimeout(function() {
      state.page = 1;
      fetchBooks(true, false);
    }, 300);
  }

  // ===== Toggle Filter Sections =====
  document.querySelectorAll('.filter-toggle').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var target = document.getElementById(btn.dataset.target);
      var icon = btn.querySelector('.filter-icon');
      if (target) {
        var isOpen = target.style.display !== 'none';
        target.style.display = isOpen ? 'none' : 'block';
        icon.style.transform = isOpen ? '' : 'rotate(180deg)';
      }
    });
  });

  // ===== Search within filter lists =====
  document.querySelectorAll('[data-filter-search]').forEach(function(input) {
    input.addEventListener('input', function() {
      var target = document.getElementById(this.dataset.filterSearch);
      if (!target) return;
      var q = this.value.toLowerCase();
      target.querySelectorAll('label').forEach(function(label) {
        var labelTextEl = label.querySelector('[data-label]');
        var txt = labelTextEl ? labelTextEl.textContent.toLowerCase() : '';
        label.style.display = txt.indexOf(q) > -1 ? '' : 'none';
      });
    });
  });

  // ===== Checkbox change =====
  document.querySelectorAll('input[data-filter-group]').forEach(function(cb) {
    cb.addEventListener('change', function() {
      collectFilters();
      debounceFetch();
    });
  });

  // ===== Sort change =====
  if (sortSelect) {
    sortSelect.addEventListener('change', function() {
      state.sort = this.value;
      state.page = 1;
      fetchBooks(true, false);
    });
  }

  // ===== Search input =====
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      state.search = this.value.trim();
      debounceFetch();
    });
  }

  // ===== Price inputs =====
  ['booksMinPrice', 'booksMaxPrice'].forEach(function(id) {
    var el = document.getElementById(id);
    if (el) el.addEventListener('input', function() { collectFilters(); debounceFetch(); });
  });

  // ===== Apply filters button =====
  var applyBtn = document.getElementById('applyFiltersBtn');
  if (applyBtn) applyBtn.addEventListener('click', function() { collectFilters(); state.page = 1; fetchBooks(true, false); });
  var resetBtn = document.getElementById('resetFiltersBtn');
  if (resetBtn) resetBtn.addEventListener('click', resetAllFilters);

  // ===== Pagination click (delegated) =====
  document.addEventListener('click', function(e) {
    var btn = e.target.closest('[data-books-page]');
    if (!btn || btn.disabled) return;
    e.preventDefault();
    var p = parseInt(btn.dataset.booksPage, 10);
    if (p !== state.page) { state.page = p; fetchBooks(true, true); }
  });

  document.addEventListener('click', function(e) {
    var remove = e.target.closest('[data-remove-filter]');
    if (!remove) return;
    e.preventDefault();
    var type = remove.getAttribute('data-remove-filter');
    var value = parseInt(remove.getAttribute('data-filter-value') || '0', 10);
    if (type === 'subject') state.subjectIds = state.subjectIds.filter(function(v) { return v !== value; });
    if (type === 'writer') state.writerIds = state.writerIds.filter(function(v) { return v !== value; });
    if (type === 'publisher') state.publisherIds = state.publisherIds.filter(function(v) { return v !== value; });
    if (type === 'price') { state.minPrice = ''; state.maxPrice = ''; }
    state.page = 1;
    fetchBooks(true, false);
  });

  document.addEventListener('click', function(e) {
    var clearBtn = e.target.closest('[data-clear-filters="1"]');
    if (!clearBtn) return;
    e.preventDefault();
    resetAllFilters();
  });

  // ===== Mobile filter =====
  function openMobile() {
    var sidebar = document.getElementById('booksFilterSidebar');
    var overlay = document.getElementById('booksFilterOverlay');
    if (filterCard && mobileFilterContent && filterCard.parentElement !== mobileFilterContent) {
      mobileFilterContent.appendChild(filterCard);
    }
    if (sidebar) { sidebar.classList.remove('-translate-x-full'); sidebar.classList.add('translate-x-0'); }
    if (overlay) overlay.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }
  function closeMobile() {
    var sidebar = document.getElementById('booksFilterSidebar');
    var overlay = document.getElementById('booksFilterOverlay');
    if (filterCard && desktopFilterMount && filterCard.parentElement !== desktopFilterMount) {
      desktopFilterMount.appendChild(filterCard);
    }
    if (sidebar) { sidebar.classList.add('-translate-x-full'); sidebar.classList.remove('translate-x-0'); }
    if (overlay) overlay.classList.add('hidden');
    document.body.style.overflow = '';
  }
  var mobBtn = document.getElementById('mobileFilterBtn') || document.getElementById('mobileFilterBtnInner');
  if (mobBtn) mobBtn.addEventListener('click', openMobile);
  var overlay = document.getElementById('booksFilterOverlay');
  if (overlay) overlay.addEventListener('click', closeMobile);
  var closeBtn = document.getElementById('closeMobileFilter');
  if (closeBtn) closeBtn.addEventListener('click', closeMobile);
  var applyMobileBtn = document.getElementById('applyMobileFiltersBtn');
  if (applyMobileBtn) applyMobileBtn.addEventListener('click', function() { collectFilters(); state.page = 1; fetchBooks(true, false); closeMobile(); });
  var resetMobileBtn = document.getElementById('resetMobileFiltersBtn');
  if (resetMobileBtn) resetMobileBtn.addEventListener('click', function() { resetAllFilters(); closeMobile(); });

  // ===== Pop state (browser back/forward) =====
  window.addEventListener('popstate', function() {
    applyUrlState();
    fetchBooks(false, false);
  });

  // ===== Initial load =====
  applyUrlState();
  fetchBooks(false, false);
})();
</script>
