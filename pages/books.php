<?php
function csv_to_int_array($value) {
    $parts = array_filter(array_map('trim', explode(',', (string)$value)));
    return array_values(array_filter(array_map('intval', $parts)));
}

$selectedSubjects = isset($_GET['subject_ids']) ? csv_to_int_array($_GET['subject_ids']) : (isset($_GET['subject']) ? array_values(array_filter(array_map('intval', (array)$_GET['subject']))) : []);
$selectedWriters = isset($_GET['writer_ids']) ? csv_to_int_array($_GET['writer_ids']) : (isset($_GET['writer']) ? array_values(array_filter(array_map('intval', (array)$_GET['writer']))) : []);
$selectedPublishers = isset($_GET['publisher_ids']) ? csv_to_int_array($_GET['publisher_ids']) : (isset($_GET['publisher']) ? array_values(array_filter(array_map('intval', (array)$_GET['publisher']))) : []);
$minPrice = isset($_GET['min_price']) && $_GET['min_price'] !== '' ? (float)$_GET['min_price'] : null;
$maxPrice = isset($_GET['max_price']) && $_GET['max_price'] !== '' ? (float)$_GET['max_price'] : null;
$sort = isset($_GET['sort']) ? trim((string)$_GET['sort']) : 'newest';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$perPage = 12;

$subjects = $db->getFull('subject', ' ORDER BY name ASC');
$writers = $db->getFull('writer', ' ORDER BY name ASC');
$publishers = $db->getFull('publisher', ' ORDER BY name ASC');
$subjectMap = [];
$writerMap = [];
$publisherMap = [];
foreach ($subjects as $row) $subjectMap[(int)$row['id']] = $row['name'];
foreach ($writers as $row) $writerMap[(int)$row['id']] = $row['name'];
foreach ($publishers as $row) $publisherMap[(int)$row['id']] = $row['name'];

$columns = $db->getdata("SHOW COLUMNS FROM product");
$fields = [];
foreach ($columns as $column) {
    if (isset($column['Field'])) $fields[] = $column['Field'];
}
$hasSubjectId = in_array('subject_id', $fields, true);
$hasWriterId = in_array('writer_id', $fields, true);
$hasPublisherId = in_array('publisher_id', $fields, true);

$whereSql = " AND p.status = 1";
if (!empty($selectedSubjects)) {
    if ($hasSubjectId) {
        $whereSql .= " AND p.subject_id IN (" . implode(',', $selectedSubjects) . ")";
    } else {
        $names = [];
        foreach ($selectedSubjects as $id) if (isset($subjectMap[$id])) $names[] = addslashes($subjectMap[$id]);
        if (!empty($names)) $whereSql .= " AND p.subject IN ('" . implode("','", $names) . "')";
    }
}
if (!empty($selectedWriters)) {
    if ($hasWriterId) {
        $whereSql .= " AND p.writer_id IN (" . implode(',', $selectedWriters) . ")";
    } else {
        $names = [];
        foreach ($selectedWriters as $id) if (isset($writerMap[$id])) $names[] = addslashes($writerMap[$id]);
        if (!empty($names)) $whereSql .= " AND p.writer IN ('" . implode("','", $names) . "')";
    }
}
if (!empty($selectedPublishers)) {
    if ($hasPublisherId) {
        $whereSql .= " AND p.publisher_id IN (" . implode(',', $selectedPublishers) . ")";
    } else {
        $names = [];
        foreach ($selectedPublishers as $id) if (isset($publisherMap[$id])) $names[] = addslashes($publisherMap[$id]);
        if (!empty($names)) $whereSql .= " AND p.publisher IN ('" . implode("','", $names) . "')";
    }
}
if ($minPrice !== null) $whereSql .= " AND p.price >= " . (float)$minPrice;
if ($maxPrice !== null) $whereSql .= " AND p.price <= " . (float)$maxPrice;

$orderSql = " ORDER BY p.id DESC";
if ($sort === 'oldest') $orderSql = " ORDER BY p.id ASC";
elseif ($sort === 'price_asc') $orderSql = " ORDER BY p.price ASC, p.id DESC";
elseif ($sort === 'price_desc') $orderSql = " ORDER BY p.price DESC, p.id DESC";
elseif ($sort === 'popular') $orderSql = " ORDER BY p.id DESC";

$joinSql = ($hasSubjectId ? " LEFT JOIN subject s ON s.id = p.subject_id " : "")
    . ($hasWriterId ? " LEFT JOIN writer w ON w.id = p.writer_id " : "")
    . ($hasPublisherId ? " LEFT JOIN publisher pub ON pub.id = p.publisher_id " : "");

$countRows = $db->getdata("SELECT COUNT(*) as total FROM product p {$joinSql} WHERE p.id > 0 {$whereSql}");
$totalProducts = isset($countRows[0]['total']) ? (int)$countRows[0]['total'] : 0;
$totalPages = (int)max(1, ceil($totalProducts / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$start = $totalProducts > 0 ? $offset + 1 : 0;
$end = min($offset + $perPage, $totalProducts);

$products = $db->getdata(
    "SELECT p.*"
    . ($hasSubjectId ? ", s.name AS subject_name" : "")
    . ($hasWriterId ? ", w.name AS writer_name" : "")
    . ($hasPublisherId ? ", pub.name AS publisher_name" : "")
    . " FROM product p {$joinSql} WHERE p.id > 0 {$whereSql}{$orderSql} LIMIT {$offset}, {$perPage}"
);

$baseQuery = [];
if (!empty($selectedSubjects)) $baseQuery['subject'] = $selectedSubjects;
if (!empty($selectedWriters)) $baseQuery['writer'] = $selectedWriters;
if (!empty($selectedPublishers)) $baseQuery['publisher'] = $selectedPublishers;
if (!empty($selectedSubjects)) $baseQuery['subject_ids'] = implode(',', $selectedSubjects);
if (!empty($selectedWriters)) $baseQuery['writer_ids'] = implode(',', $selectedWriters);
if (!empty($selectedPublishers)) $baseQuery['publisher_ids'] = implode(',', $selectedPublishers);
if ($minPrice !== null) $baseQuery['min_price'] = $minPrice;
if ($maxPrice !== null) $baseQuery['max_price'] = $maxPrice;
if ($sort !== '') $baseQuery['sort'] = $sort;

function books_page_url($targetPage, $query) {
    $query['page'] = max(1, (int)$targetPage);
    return 'books?' . http_build_query($query);
}
function books_image($image) {
    $file = basename((string)$image);
    $path = __DIR__ . '/../assets/images/product/' . $file;
    return ($file !== '' && file_exists($path)) ? ('assets/images/product/' . $file) : 'assets/images/product/1638727737.jpg';
}
?>

<main class="min-h-screen bg-slate-50">
  <nav aria-label="Breadcrumb" class="mx-auto max-w-7xl px-4 mt-4 pt-3">
    <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-500 pb-3">
      <li><a class="hover:text-slate-900 transition" href="<?php echo domain; ?>">হোম</a></li>
      <li>/</li>
      <li class="font-semibold text-slate-900" aria-current="page">বই</li>
    </ol>
  </nav>

  <div class="mx-auto max-w-7xl px-4 pb-12">
    <div class="flex gap-6">
      <aside class="hidden lg:block w-64 shrink-0">
        <form method="get" action="books" id="booksFilterForm" class="sticky top-24 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
          <input type="hidden" name="subject_ids" id="subjectIdsInput" value="<?php echo htmlspecialchars(implode(',', $selectedSubjects), ENT_QUOTES, 'UTF-8'); ?>" />
          <input type="hidden" name="writer_ids" id="writerIdsInput" value="<?php echo htmlspecialchars(implode(',', $selectedWriters), ENT_QUOTES, 'UTF-8'); ?>" />
          <input type="hidden" name="publisher_ids" id="publisherIdsInput" value="<?php echo htmlspecialchars(implode(',', $selectedPublishers), ENT_QUOTES, 'UTF-8'); ?>" />
          <h3 class="text-sm font-bold text-slate-900">ফিল্টার</h3>

          <div class="mt-4">
            <h4 class="text-xs font-semibold text-slate-700 uppercase">বিষয়</h4>
            <input type="text" data-filter-search="subject-filter-list" placeholder="অনুসন্ধান..." class="mt-2 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20" />
            <div class="mt-2 max-h-40 overflow-y-auto scrollbar-hide space-y-1.5">
              <div id="subject-filter-list" class="space-y-1.5">
              <?php foreach ($subjects as $subject): ?>
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="checkbox" data-filter-group="subject" value="<?php echo (int)$subject['id']; ?>" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" <?php echo in_array((int)$subject['id'], $selectedSubjects, true) ? 'checked' : ''; ?> />
                  <span class="text-sm text-slate-600" data-label><?php echo htmlspecialchars($subject['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                </label>
              <?php endforeach; ?>
              </div>
            </div>
          </div>

          <hr class="my-4 border-slate-100" />

          <div>
            <h4 class="text-xs font-semibold text-slate-700 uppercase">লেখক</h4>
            <input type="text" data-filter-search="writer-filter-list" placeholder="অনুসন্ধান..." class="mt-2 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20" />
            <div class="mt-2 max-h-40 overflow-y-auto scrollbar-hide space-y-1.5">
              <div id="writer-filter-list" class="space-y-1.5">
              <?php foreach ($writers as $writer): ?>
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="checkbox" data-filter-group="writer" value="<?php echo (int)$writer['id']; ?>" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" <?php echo in_array((int)$writer['id'], $selectedWriters, true) ? 'checked' : ''; ?> />
                  <span class="text-sm text-slate-600" data-label><?php echo htmlspecialchars($writer['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                </label>
              <?php endforeach; ?>
              </div>
            </div>
          </div>

          <hr class="my-4 border-slate-100" />

          <div>
            <h4 class="text-xs font-semibold text-slate-700 uppercase">প্রকাশনী</h4>
            <input type="text" data-filter-search="publisher-filter-list" placeholder="অনুসন্ধান..." class="mt-2 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20" />
            <div class="mt-2 max-h-40 overflow-y-auto scrollbar-hide space-y-1.5">
              <div id="publisher-filter-list" class="space-y-1.5">
              <?php foreach ($publishers as $publisher): ?>
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="checkbox" data-filter-group="publisher" value="<?php echo (int)$publisher['id']; ?>" class="h-3.5 w-3.5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" <?php echo in_array((int)$publisher['id'], $selectedPublishers, true) ? 'checked' : ''; ?> />
                  <span class="text-sm text-slate-600" data-label><?php echo htmlspecialchars($publisher['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                </label>
              <?php endforeach; ?>
              </div>
            </div>
          </div>

          <hr class="my-4 border-slate-100" />

          <div>
            <h4 class="text-xs font-semibold text-slate-700 uppercase">মূল্য সীমা</h4>
            <div class="mt-2 flex items-center gap-2">
              <input type="number" name="min_price" min="0" value="<?php echo $minPrice !== null ? htmlspecialchars((string)$minPrice, ENT_QUOTES, 'UTF-8') : ''; ?>" placeholder="৳ ০" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20" />
              <span class="text-slate-400">-</span>
              <input type="number" name="max_price" min="0" value="<?php echo $maxPrice !== null ? htmlspecialchars((string)$maxPrice, ENT_QUOTES, 'UTF-8') : ''; ?>" placeholder="৳ ৫০০০" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20" />
            </div>
          </div>

          <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort, ENT_QUOTES, 'UTF-8'); ?>">
          <button type="submit" class="mt-4 w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition">ফিল্টার প্রয়োগ করুন</button>
          <a href="books" class="mt-2 block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-center text-sm font-medium text-slate-600 hover:bg-slate-50 transition">রিসেট করুন</a>
        </form>
      </aside>

      <div class="flex-1 min-w-0 rounded-xl border border-slate-200 bg-white p-4 sm:p-6">
        <form method="get" action="books" class="mb-4 flex items-center justify-end">
          <input type="hidden" name="subject_ids" value="<?php echo htmlspecialchars(implode(',', $selectedSubjects), ENT_QUOTES, 'UTF-8'); ?>">
          <input type="hidden" name="writer_ids" value="<?php echo htmlspecialchars(implode(',', $selectedWriters), ENT_QUOTES, 'UTF-8'); ?>">
          <input type="hidden" name="publisher_ids" value="<?php echo htmlspecialchars(implode(',', $selectedPublishers), ENT_QUOTES, 'UTF-8'); ?>">
          <?php if ($minPrice !== null): ?><input type="hidden" name="min_price" value="<?php echo htmlspecialchars((string)$minPrice, ENT_QUOTES, 'UTF-8'); ?>"><?php endif; ?>
          <?php if ($maxPrice !== null): ?><input type="hidden" name="max_price" value="<?php echo htmlspecialchars((string)$maxPrice, ENT_QUOTES, 'UTF-8'); ?>"><?php endif; ?>
          <label class="text-sm text-slate-500 mr-2">সাজান:</label>
          <select name="sort" onchange="this.form.submit()" class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20">
            <option value="newest" <?php echo $sort === 'newest' ? 'selected' : ''; ?>>নতুন থেকে পুরনো</option>
            <option value="oldest" <?php echo $sort === 'oldest' ? 'selected' : ''; ?>>পুরনো থেকে নতুন</option>
            <option value="price_asc" <?php echo $sort === 'price_asc' ? 'selected' : ''; ?>>মূল্য: কম থেকে বেশি</option>
            <option value="price_desc" <?php echo $sort === 'price_desc' ? 'selected' : ''; ?>>মূল্য: বেশি থেকে কম</option>
            <option value="popular" <?php echo $sort === 'popular' ? 'selected' : ''; ?>>জনপ্রিয়</option>
          </select>
        </form>

      <p class="text-sm text-slate-500 mb-4">
        <?php echo $start; ?>-<?php echo $end; ?> / <?php echo $totalProducts; ?>টি বই
      </p>

      <?php if (!empty($products)): ?>
        <div class="grid gap-3 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4">
          <?php foreach ($products as $product): ?>
            <?php
            $title = (string)($product['name_bn'] ?: $product['name']);
            $authorName = isset($product['writer_name']) ? (string)$product['writer_name'] : (string)$product['writer'];
            $publisherName = isset($product['publisher_name']) ? (string)$product['publisher_name'] : (string)$product['publisher'];
            $subjectName = isset($product['subject_name']) ? (string)$product['subject_name'] : (string)$product['subject'];
            $price = (float)$product['price'];
            $printedPrice = (float)$product['printed_price'];
            $originalPrice = $printedPrice > 0 ? $printedPrice : $price;
            $discountPercent = $originalPrice > 0 ? (int)round((($originalPrice - $price) / $originalPrice) * 100) : 0;
            $image = books_image($product['image']);
            $cardProduct = [
                'id' => (int)$product['id'],
                'title' => $title,
                'author' => $authorName,
                'publisher' => $publisherName,
                'category' => $subjectName,
                'slug' => (string)$product['slug'],
                'price' => $price,
                'originalPrice' => $originalPrice,
                'discount' => max(0, $discountPercent),
                'image' => $image,
                'inStock' => !isset($product['stock']) || (int)$product['stock'] > 0,
                'reviews' => 0
            ];
            ?>
            <article class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition" data-id="<?php echo (int)$product['id']; ?>" data-product="<?php echo htmlspecialchars(json_encode($cardProduct), ENT_QUOTES, 'UTF-8'); ?>">
              <a href="details?slug=<?php echo urlencode((string)$product['slug']); ?>" class="block">
                <div class="relative aspect-[4/5] bg-slate-100">
                  <img src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>" class="h-full w-full object-cover" loading="lazy" />
                  <?php if ($discountPercent > 0): ?>
                    <span class="absolute left-2 top-2 rounded bg-rose-600 px-2 py-1 text-xs font-bold text-white">-<?php echo $discountPercent; ?>%</span>
                  <?php endif; ?>
                </div>
                <div class="p-3">
                  <h3 class="line-clamp-2 text-sm font-bold text-slate-900 min-h-[2.5rem]"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h3>
                  <p class="mt-1 text-xs text-slate-500"><?php echo htmlspecialchars($authorName, ENT_QUOTES, 'UTF-8'); ?></p>
                  <div class="mt-2 flex items-baseline gap-2">
                    <p class="text-sm font-extrabold text-slate-900">৳ <?php echo number_format($price, 0); ?></p>
                    <?php if ($originalPrice > $price): ?>
                      <p class="text-xs text-slate-400 line-through">৳ <?php echo number_format($originalPrice, 0); ?></p>
                    <?php endif; ?>
                  </div>
                </div>
              </a>
              <div class="px-3 pb-3">
                <button class="mt-1 w-full rounded-lg bg-emerald-600 px-3 py-2 text-xs font-bold text-white hover:bg-emerald-700 transition" type="button" data-add-cart>
                  কার্টে যোগ করুন
                </button>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="rounded-xl border border-slate-200 bg-slate-50 p-8 text-center">
          <h3 class="text-base font-semibold text-slate-700">কোনো বই পাওয়া যায়নি</h3>
        </div>
      <?php endif; ?>

      <?php if ($totalPages > 1): ?>
        <div class="mt-8 flex items-center justify-center gap-1">
          <?php
          $prevDisabled = $page <= 1;
          $nextDisabled = $page >= $totalPages;
          ?>
          <a
            href="<?php echo $prevDisabled ? '#' : books_page_url($page - 1, $baseQuery); ?>"
            class="rounded-lg border border-slate-300 px-3 py-2 text-sm <?php echo $prevDisabled ? 'text-slate-400 pointer-events-none' : 'text-slate-600 hover:bg-slate-50'; ?>"
          >‹</a>

          <?php
          $window = 2;
          $startPage = max(1, $page - $window);
          $endPage = min($totalPages, $page + $window);
          if ($startPage > 1): ?>
            <a href="<?php echo books_page_url(1, $baseQuery); ?>" class="rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-600 hover:bg-slate-50">1</a>
            <?php if ($startPage > 2): ?><span class="px-2 text-slate-400">...</span><?php endif; ?>
          <?php endif; ?>

          <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <a
              href="<?php echo books_page_url($i, $baseQuery); ?>"
              class="rounded-lg px-3.5 py-2 text-sm <?php echo $i === $page ? 'bg-emerald-600 font-bold text-white' : 'border border-slate-300 text-slate-600 hover:bg-slate-50'; ?>"
            ><?php echo $i; ?></a>
          <?php endfor; ?>

          <?php if ($endPage < $totalPages): ?>
            <?php if ($endPage < $totalPages - 1): ?><span class="px-2 text-slate-400">...</span><?php endif; ?>
            <a href="<?php echo books_page_url($totalPages, $baseQuery); ?>" class="rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-600 hover:bg-slate-50"><?php echo $totalPages; ?></a>
          <?php endif; ?>

          <a
            href="<?php echo $nextDisabled ? '#' : books_page_url($page + 1, $baseQuery); ?>"
            class="rounded-lg border border-slate-300 px-3 py-2 text-sm <?php echo $nextDisabled ? 'text-slate-400 pointer-events-none' : 'text-slate-600 hover:bg-slate-50'; ?>"
          >›</a>
        </div>
      <?php endif; ?>
      </div>
    </div>
  </div>
</main>

<script>
(function () {
  var cards = document.querySelectorAll('article[data-product]');
  var cache = [];
  cards.forEach(function (card) {
    try {
      var product = JSON.parse(card.getAttribute('data-product'));
      card._productData = product;
      cache.push(product);
    } catch (e) {}
  });
  window._productsCache = cache;
})();
</script>
<script>
(function () {
  var filterForm = document.getElementById('booksFilterForm');
  if (filterForm) {
    filterForm.addEventListener('submit', function () {
      function getCsv(group) {
        var values = [];
        filterForm.querySelectorAll('input[data-filter-group="' + group + '"]:checked').forEach(function (el) {
          values.push(el.value);
        });
        return values.join(',');
      }
      var subjectInput = document.getElementById('subjectIdsInput');
      var writerInput = document.getElementById('writerIdsInput');
      var publisherInput = document.getElementById('publisherIdsInput');
      if (subjectInput) subjectInput.value = getCsv('subject');
      if (writerInput) writerInput.value = getCsv('writer');
      if (publisherInput) publisherInput.value = getCsv('publisher');
    });
  }

  document.querySelectorAll('[data-filter-search]').forEach(function (input) {
    input.addEventListener('input', function () {
      var target = document.getElementById(input.getAttribute('data-filter-search'));
      if (!target) return;
      var q = (input.value || '').toLowerCase();
      target.querySelectorAll('label').forEach(function (label) {
        var txt = (label.querySelector('[data-label]')?.textContent || '').toLowerCase();
        label.style.display = txt.indexOf(q) > -1 ? '' : 'none';
      });
    });
  });
})();
</script>
