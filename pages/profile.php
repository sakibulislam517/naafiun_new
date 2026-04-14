<?php
$isCustomerLoggedIn = isset($_SESSION['customer_id']) && (int)$_SESSION['customer_id'] > 0;
$customerId = $isCustomerLoggedIn ? (int)$_SESSION['customer_id'] : 0;
$flashType = '';
$flashMessage = '';
$fullName = '';
$email = '';
$phone = '';
$phoneInput = '';
$address = '';

if (isset($_SESSION['profile_flash']) && is_array($_SESSION['profile_flash'])) {
  $flashType = isset($_SESSION['profile_flash']['type']) ? (string)$_SESSION['profile_flash']['type'] : '';
  $flashMessage = isset($_SESSION['profile_flash']['message']) ? (string)$_SESSION['profile_flash']['message'] : '';
  unset($_SESSION['profile_flash']);
}

if ($isCustomerLoggedIn && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $fullName = isset($_POST['full_name']) ? trim((string)$_POST['full_name']) : '';
  $email = isset($_POST['email']) ? trim(strtolower((string)$_POST['email'])) : '';
  $phoneInput = isset($_POST['phone']) ? trim((string)$_POST['phone']) : '';
  $phone = '0' . $phoneInput;
  $address = isset($_POST['address']) ? trim((string)$_POST['address']) : '';

  if ($fullName === '' || $email === '' || $phoneInput === '') {
    $_SESSION['profile_flash'] = ['type' => 'error', 'message' => 'নাম, ইমেইল এবং ফোন নম্বর দিতে হবে।'];
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['profile_flash'] = ['type' => 'error', 'message' => 'সঠিক ইমেইল দিন।'];
  } elseif (!preg_match('/^[0-9]{10}$/', $phoneInput)) {
    $_SESSION['profile_flash'] = ['type' => 'error', 'message' => 'ফোন নম্বর শুধু সংখ্যা হবে এবং +880 এর পরে ১০ ডিজিট দিতে হবে (মোট ১১ ডিজিট)।'];
  } else {
    $safeEmail = addslashes($email);
    $safePhone = addslashes($phone);

    $emailExists = $db->row_count("SELECT id FROM ledger_name WHERE email = '$safeEmail' AND id != '$customerId' LIMIT 1");
    $phoneExists = $db->row_count("SELECT id FROM ledger_name WHERE number = '$safePhone' AND id != '$customerId' LIMIT 1");

    if ($emailExists > 0) {
      $_SESSION['profile_flash'] = ['type' => 'error', 'message' => 'এই ইমেইল অন্য অ্যাকাউন্টে ব্যবহার হচ্ছে।'];
    } elseif ($phoneExists > 0) {
      $_SESSION['profile_flash'] = ['type' => 'error', 'message' => 'এই ফোন নম্বর অন্য অ্যাকাউন্টে ব্যবহার হচ্ছে।'];
    } else {
      $updated = $db->qedit('ledger_name', [
        'name' => $fullName,
        'email' => $email,
        'number' => $phone,
        'address' => $address
      ], 'id', $customerId, " AND type = 'cus'");

      if ($updated) {
        $_SESSION['profile_flash'] = ['type' => 'success', 'message' => 'প্রোফাইল সফলভাবে আপডেট হয়েছে।'];
      } else {
        $_SESSION['profile_flash'] = ['type' => 'error', 'message' => 'প্রোফাইল আপডেট করা যায়নি। আবার চেষ্টা করুন।'];
      }
    }
  }
  $db->redirect($db->refpg());
}

if ($isCustomerLoggedIn) {
  $rows = $db->getdata("SELECT name, email, number, address FROM ledger_name WHERE id = '$customerId' AND type = 'cus' ORDER BY id DESC LIMIT 1");
  if (!empty($rows) && isset($rows[0])) {
    $fullName = isset($rows[0]['name']) ? (string)$rows[0]['name'] : '';
    $email = isset($rows[0]['email']) ? (string)$rows[0]['email'] : '';
    $phone = isset($rows[0]['number']) ? (string)$rows[0]['number'] : '';
    $phoneDigits = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($phoneDigits) === 11 && strpos($phoneDigits, '0') === 0) {
      $phoneInput = substr($phoneDigits, 1);
    } elseif (strlen($phoneDigits) >= 10) {
      $phoneInput = substr($phoneDigits, -10);
    } else {
      $phoneInput = $phoneDigits;
    }
    $address = isset($rows[0]['address']) ? (string)$rows[0]['address'] : '';
  }
}
?>
<!-- Update Profile Page -->
<main class="min-h-screen bg-slate-50">
  <div class="mx-auto max-w-2xl px-4 py-8">
  

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
      <?php if (!$isCustomerLoggedIn): ?>
        <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-700">
          প্রোফাইল আপডেট করতে হলে আগে লগইন করুন।
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
        <!-- Full Name -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">পুরো নাম</label>
          <input type="text" name="full_name" value="<?php echo htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8'); ?>" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition" required />
        </div>

        <!-- Email -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">ইমেইল</label>
          <input type="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition" required />
        </div>

        <!-- Phone -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">ফোন নম্বর</label>
          <div class="flex items-center rounded-xl border border-slate-300 bg-white focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-500/20 transition">
            <span class="px-4 py-3 text-sm font-medium text-slate-600 border-r border-slate-200">+880</span>
            <input type="tel" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" name="phone" value="<?php echo htmlspecialchars($phoneInput, ENT_QUOTES, 'UTF-8'); ?>" placeholder="1XXXXXXXXX" class="w-full rounded-r-xl bg-white px-4 py-3 text-sm text-slate-900 outline-none" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required />
          </div>
          <p class="mt-1 text-xs text-slate-500">+880 এর পরে ১০ ডিজিট দিন (মোট ১১ ডিজিট)।</p>
        </div>

        <!-- Address -->
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1.5">ঠিকানা</label>
          <textarea name="address" rows="3" placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition resize-none"><?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end pt-4">
          <a href="<?php echo domain; ?>" class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 transition text-center">বাতিল</a>
          <button type="submit" class="rounded-xl bg-emerald-600 px-6 py-2.5 text-sm font-bold text-white hover:bg-emerald-700 transition shadow-sm">সংরক্ষণ করুন</button>
        </div>
      </form>
      <?php endif; ?>
    </div>
  </div>
</main>
