<?php
// Fetch writers from database
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$search_where = '';
if ($search != '') {
    $search_where = " AND (name LIKE '%$search%' OR slug LIKE '%$search%')";
}

$writers = $db->getFull('writer', ' AND id > 0' . $search_where . ' ORDER BY name ASC LIMIT 36');
?>

<main class="min-h-screen bg-slate-50">
  <!-- Breadcrumbs -->
  <nav aria-label="Breadcrumb" class="mx-auto max-w-7xl px-4 mt-4 pt-3">
    <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-500 pb-3">
      <li><a class="hover:text-slate-900 transition" href="<?php echo domain; ?>">Home</a></li>
      <li>/</li>
      <li class="font-semibold text-slate-900" aria-current="page">Writer</li>
    </ol>
  </nav>

  <div class="mx-auto max-w-7xl px-4 pb-12">
    <div class="bg-white rounded-xl border border-slate-200 p-6">

      <!-- Search Box -->
      <div class="mb-6">
        <div class="max-w-md mx-auto">
          <div class="flex">
            <input
              type="text"
              id="writerSearch"
              value="<?php echo htmlspecialchars($search); ?>"
              placeholder="লেখকসমূহ অনুসন্ধান করুন"
              class="flex-1 rounded-l-lg border border-slate-300 border-r-0 px-4 py-2.5 text-sm outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20"
            />
            <button
              id="writerSearchBtn"
              class="rounded-r-lg border border-slate-300 bg-white px-4 hover:bg-slate-50 transition"
            >
              <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Writers List -->
      <div id="writerResults">
        <?php if (!empty($writers)): ?>
        <div class="grid gap-3 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
          <?php foreach ($writers as $writer): ?>
          <a href="<?php echo domain; ?>writer/<?php echo htmlspecialchars($writer['slug']); ?>" class="group">
            <div class="flex items-center gap-3 rounded-lg border border-slate-200 bg-white px-4 py-3 hover:border-emerald-300 hover:shadow-sm transition">
              <span class="text-emerald-600 text-lg leading-none">›_</span>
              <span class="text-sm font-medium text-slate-900 group-hover:text-emerald-700 truncate">
                <?php echo htmlspecialchars($writer['name']); ?>
              </span>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="flex flex-col items-center justify-center py-12">
          <h3 class="text-base font-medium text-slate-700">কোনো লেখক পাওয়া যায়নি</h3>
        </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</main>

<script>
(function(){
  var debounceTimer=null;
  function searchWriters(q){
    $.post('ajax.php',{action:'search_writers',search:q},function(html){
      $('#writerResults').html(html);
    });
  }
  $('#writerSearch').on('input',function(){
    var self=this;
    clearTimeout(debounceTimer);
    debounceTimer=setTimeout(function(){searchWriters($.trim($(self).val()))},300);
  });
  $('#writerSearchBtn').on('click',function(){
    searchWriters($.trim($('#writerSearch').val()));
  });
})();
</script>
