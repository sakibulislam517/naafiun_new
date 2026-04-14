<?php
$isCustomerLoggedIn = isset($_SESSION['customer_id']) && (int)$_SESSION['customer_id'] > 0;
$customerId = $isCustomerLoggedIn ? (int)$_SESSION['customer_id'] : 0;
$flashType = '';
$flashMessage = '';

if (isset($_SESSION['change_password_flash']) && is_array($_SESSION['change_password_flash'])) {
  $flashType = isset($_SESSION['change_password_flash']['type']) ? (string)$_SESSION['change_password_flash']['type'] : '';
  $flashMessage = isset($_SESSION['change_password_flash']['message']) ? (string)$_SESSION['change_password_flash']['message'] : '';
  unset($_SESSION['change_password_flash']);
}

if ($isCustomerLoggedIn && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $newPassword = isset($_POST['new_password']) ? trim((string)$_POST['new_password']) : '';
  $confirmPassword = isset($_POST['confirm_password']) ? trim((string)$_POST['confirm_password']) : '';

  if ($newPassword === '' || $confirmPassword === '') {
    $_SESSION['change_password_flash'] = ['type' => 'error', 'message' => 'সব প্রয়োজনীয় তথ্য পূরণ করুন।'];
  } elseif (strlen($newPassword) < 6) {
    $_SESSION['change_password_flash'] = ['type' => 'error', 'message' => 'পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে।'];
  } elseif ($newPassword !== $confirmPassword) {
    $_SESSION['change_password_flash'] = ['type' => 'error', 'message' => 'পাসওয়ার্ড মিলেনি।'];
  } else {
    $customerExists = $db->row_count("SELECT id FROM ledger_name WHERE id = '$customerId' AND type = 'cus' LIMIT 1");
    if ($customerExists < 1) {
      $_SESSION['change_password_flash'] = ['type' => 'error', 'message' => 'অ্যাকাউন্ট খুঁজে পাওয়া যায়নি। আবার লগইন করুন।'];
    } else {
      $updated = $db->qedit('ledger_name', ['password' => $newPassword], 'id', $customerId, " AND type = 'cus'");
      if ($updated) {
        $_SESSION['change_password_flash'] = ['type' => 'success', 'message' => 'পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে।'];
      } else {
        $_SESSION['change_password_flash'] = ['type' => 'error', 'message' => 'পাসওয়ার্ড পরিবর্তন করা যায়নি। আবার চেষ্টা করুন।'];
      }
    }
  }
  $db->redirect($db->refpg());
}
?>
<!-- Change Password Page -->
<main class="min-h-screen bg-slate-50">
  <div class="mx-auto max-w-lg px-4 py-8">

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
      <!-- Security Icon -->
      <div class="flex justify-center mb-4">
        <div class="grid h-16 w-16 place-items-center rounded-full bg-emerald-50 text-emerald-600">
          <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
      </div>

      <?php if (!$isCustomerLoggedIn): ?>
        <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-700">
          পাসওয়ার্ড পরিবর্তন করতে হলে আগে লগইন করুন।
          <a href="login" class="font-semibold underline hover:no-underline">লগইন পেজে যান</a>
        </div>
      <?php else: ?>
      <form action="" method="post" class="space-y-4">
        <?php if ($flashMessage !== '' && $flashType === 'success'): ?>
          <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">
            <?php echo htmlspecialchars($flashMessage, ENT_QUOTES, 'UTF-8'); ?>
          </div>
        <?php endif; ?>
        <?php if ($flashMessage !== '' && $flashType === 'error'): ?>
          <div class="rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-700">
            <?php echo htmlspecialchars($flashMessage, ENT_QUOTES, 'UTF-8'); ?>
          </div>
        <?php endif; ?>

        <!-- New Password -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">নতুন পাসওয়ার্ড</label>
          <div class="relative">
            <input id="newPass" type="password" name="new_password" placeholder="কমপক্ষে ৬ অক্ষর" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition" required minlength="6" />
            <button type="button" class="toggle-pass absolute right-3 top-1/2 -translate-y-1/2 p-1 text-slate-400 hover:text-slate-600" data-target="newPass">
              <svg class="eye-open h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0Z"/></svg>
              <svg class="eye-closed hidden h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
            </button>
          </div>
        </div>

        <!-- Confirm Password -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">নতুন পাসওয়ার্ড নিশ্চিত করুন</label>
          <div class="relative">
            <input id="confirmPass" type="password" name="confirm_password" placeholder="আবার পাসওয়ার্ড লিখুন" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition" required minlength="6" />
            <button type="button" class="toggle-pass absolute right-3 top-1/2 -translate-y-1/2 p-1 text-slate-400 hover:text-slate-600" data-target="confirmPass">
              <svg class="eye-open h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0Z"/></svg>
              <svg class="eye-closed hidden h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
            </button>
          </div>
        </div>

        <!-- Password Tips -->
        <div class="rounded-xl bg-amber-50 p-3 text-xs text-amber-700">
          <p class="font-semibold">পাসওয়ার্ডের টিপস:</p>
          <ul class="mt-1 space-y-0.5 list-disc list-inside">
            <li>কমপক্ষে ৬ অক্ষর হতে হবে</li>
            <li>অক্ষর ও সংখ্যা মিশ্রণ করুন</li>
            <li>সহজ পাসওয়ার্ড ব্যবহার করবেন না</li>
          </ul>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end pt-4">
          <a href="<?php echo domain; ?>" class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 transition text-center">বাতিল</a>
          <button type="submit" class="rounded-xl bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition shadow-sm">পাসওয়ার্ড পরিবর্তন করুন</button>
        </div>
      </form>
      <?php endif; ?>
    </div>
  </div>
</main>

<script>
  document.querySelectorAll('.toggle-pass').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const target = document.getElementById(this.dataset.target);
      const open = this.querySelector('.eye-open');
      const closed = this.querySelector('.eye-closed');
      if (target.type === 'password') {
        target.type = 'text'; open.classList.add('hidden'); closed.classList.remove('hidden');
      } else {
        target.type = 'password'; open.classList.remove('hidden'); closed.classList.add('hidden');
      }
    });
  });
</script>
