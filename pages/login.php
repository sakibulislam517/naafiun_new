<?php
if ($db->is_customer()) {
  $db->redirect(domain);
}
?>
<!-- Login / Signup Page -->
<main class="min-h-[calc(100vh-200px)] bg-gradient-to-br from-emerald-50 via-white to-slate-50">
  <div class="mx-auto max-w-md px-4 py-8 sm:py-12">

    <!-- Card -->
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">

      <!-- Tabs -->
      <div class="flex border-b border-slate-200">
        <button id="tabLogin" type="button" class="flex-1 py-3.5 text-sm font-semibold text-emerald-700 border-b-2 border-emerald-600 bg-emerald-50/50 transition" data-tab="login">লগইন</button>
        <button id="tabSignup" type="button" class="flex-1 py-3.5 text-sm font-medium text-slate-500 border-b-2 border-transparent hover:text-slate-700 transition" data-tab="signup">সাইনআপ</button>
      </div>

      <!-- ===== LOGIN FORM ===== -->
      <div id="loginForm" class="p-6">
        <div id="loginAlert" class="hidden mb-4 rounded-lg border px-4 py-3 text-sm"></div>
        <form id="customerLoginForm" action="#" method="post" class="space-y-4">
          <input type="hidden" name="action" value="customer_login" />
          <!-- Email / Phone -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">ইমেইল বা ফোন নম্বর</label>
            <input
              type="text"
              name="email_or_phone"
              placeholder="আপনার ইমেইল বা ফোন নম্বর"
              class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition"
              required
            />
          </div>

          <!-- Password -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">পাসওয়ার্ড</label>
            <div class="relative">
              <input
                id="loginPassword"
                type="password"
                name="password"
                placeholder="আপনার পাসওয়ার্ড"
                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition"
                required
              />
              <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 p-1 text-slate-400 hover:text-slate-600 transition" data-target="loginPassword">
                <svg class="eye-open h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0Z"/></svg>
                <svg class="eye-closed hidden h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
              </button>
            </div>
          </div>

          <!-- Remember + Forgot -->
          <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" />
              <span class="text-sm text-slate-600">মনে রাখুন</span>
            </label>
            <a href="#" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 transition">পাসওয়ার্ড ভুলে গেছেন?</a>
          </div>

          <!-- Submit -->
          <button type="submit" class="w-full rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-600/30 transition">
            লগইন করুন
          </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
          <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
          <div class="relative flex justify-center text-xs"><span class="bg-white px-3 text-slate-400">অথবা</span></div>
        </div>

        <!-- Social Login -->
        <div class="space-y-3">
          <button type="button" data-social="google" class="flex w-full items-center justify-center gap-3 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">
            <svg class="h-5 w-5" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
            Google দিয়ে লগইন
          </button>
          <button type="button" data-social="facebook" class="flex w-full items-center justify-center gap-3 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">
            <svg class="h-5 w-5" fill="#1877F2" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            Facebook দিয়ে লগইন
          </button>
        </div>
      </div>

      <!-- ===== SIGNUP FORM ===== -->
      <div id="signupForm" class="hidden p-6">
        <div id="signupAlert" class="hidden mb-4 rounded-lg border px-4 py-3 text-sm"></div>
        <form id="customerSignupForm" action="#" method="post" class="space-y-4">
          <input type="hidden" name="action" value="customer_signup" />
          <!-- Full Name -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">পুরো নাম</label>
            <input
              type="text"
              name="full_name"
              placeholder="আপনার পুরো নাম"
              class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition"
              required
            />
          </div>

          <!-- Email -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">ইমেইল</label>
            <input
              type="email"
              name="email"
              placeholder="your@email.com"
              class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition"
              required
            />
          </div>

          <!-- Phone -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">ফোন নম্বর</label>
            <input
              type="tel"
              name="phone"
              placeholder="01XXXXXXXXX"
              class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition"
              required
            />
          </div>

          <!-- Address -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">ঠিকানা</label>
            <textarea
              name="address"
              rows="2"
              placeholder="আপনার ঠিকানা লিখুন"
              class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition"
              
            ></textarea>
          </div>

          <!-- Password -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">পাসওয়ার্ড</label>
            <div class="relative">
              <input
                id="signupPassword"
                type="password"
                name="password"
                placeholder="কমপক্ষে ৬ অক্ষর"
                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition"
                required
                minlength="6"
              />
              <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 p-1 text-slate-400 hover:text-slate-600 transition" data-target="signupPassword">
                <svg class="eye-open h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0Z"/></svg>
                <svg class="eye-closed hidden h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
              </button>
            </div>
          </div>

          <!-- Confirm Password -->
          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5">পাসওয়ার্ড নিশ্চিত করুন</label>
            <div class="relative">
              <input
                id="signupConfirm"
                type="password"
                name="confirm_password"
                placeholder="আবার পাসওয়ার্ড লিখুন"
                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition"
                required
                minlength="6"
              />
              <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 p-1 text-slate-400 hover:text-slate-600 transition" data-target="signupConfirm">
                <svg class="eye-open h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0Z"/></svg>
                <svg class="eye-closed hidden h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
              </button>
            </div>
          </div>

          <!-- Terms -->
          <label class="flex items-start gap-2 cursor-pointer">
            <input type="checkbox" name="terms" class="mt-0.5 h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500" required />
            <span class="text-sm text-slate-600">আমি <a href="#" class="font-medium text-emerald-600 hover:text-emerald-700 underline">শর্তাবলী</a> এবং <a href="#" class="font-medium text-emerald-600 hover:text-emerald-700 underline">গোপনীয়তা নীতি</a> মেনে নিচ্ছি</span>
          </label>

          <!-- Submit -->
          <button type="submit" class="w-full rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-600/30 transition">
            অ্যাকাউন্ট তৈরি করুন
          </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
          <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
          <div class="relative flex justify-center text-xs"><span class="bg-white px-3 text-slate-400">অথবা</span></div>
        </div>

        <!-- Social Signup -->
        <div class="space-y-3">
          <button type="button" data-social="google" class="flex w-full items-center justify-center gap-3 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">
            <svg class="h-5 w-5" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
            Google দিয়ে সাইনআপ
          </button>
          <button type="button" data-social="facebook" class="flex w-full items-center justify-center gap-3 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">
            <svg class="h-5 w-5" fill="#1877F2" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            Facebook দিয়ে সাইনআপ
          </button>
        </div>
      </div>

    </div>

    <!-- Bottom help -->
    <p class="mt-6 text-center text-xs text-slate-400">
      সমস্যা হলে <a href="#" class="text-emerald-600 hover:text-emerald-700 font-medium">যোগাযোগ করুন</a>
    </p>
  </div>
</main>
<div id="toastContainer" class="pointer-events-none fixed right-4 top-4 z-[100] flex w-full max-w-xs flex-col gap-2"></div>

<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
<script src="https://accounts.google.com/gsi/client" async defer></script>
<script>
(function() {
  const GOOGLE_CLIENT_ID = '<?php echo htmlspecialchars(GOOGLE_CLIENT_ID, ENT_QUOTES, 'UTF-8'); ?>';
  const FACEBOOK_APP_ID = '<?php echo htmlspecialchars(FACEBOOK_APP_ID, ENT_QUOTES, 'UTF-8'); ?>';

  // Tab switching
  const tabLogin = document.getElementById('tabLogin');
  const tabSignup = document.getElementById('tabSignup');
  const loginForm = document.getElementById('loginForm');
  const signupForm = document.getElementById('signupForm');

  function switchTab(tab) {
    if (tab === 'login') {
      tabLogin.className = 'flex-1 py-3.5 text-sm font-semibold text-emerald-700 border-b-2 border-emerald-600 bg-emerald-50/50 transition';
      tabSignup.className = 'flex-1 py-3.5 text-sm font-medium text-slate-500 border-b-2 border-transparent hover:text-slate-700 transition';
      loginForm.classList.remove('hidden');
      signupForm.classList.add('hidden');
    } else {
      tabSignup.className = 'flex-1 py-3.5 text-sm font-semibold text-emerald-700 border-b-2 border-emerald-600 bg-emerald-50/50 transition';
      tabLogin.className = 'flex-1 py-3.5 text-sm font-medium text-slate-500 border-b-2 border-transparent hover:text-slate-700 transition';
      signupForm.classList.remove('hidden');
      loginForm.classList.add('hidden');
    }
  }

  tabLogin.addEventListener('click', () => switchTab('login'));
  tabSignup.addEventListener('click', () => switchTab('signup'));

  // Password toggle
  document.querySelectorAll('.toggle-password').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const targetId = this.getAttribute('data-target');
      const input = document.getElementById(targetId);
      const eyeOpen = this.querySelector('.eye-open');
      const eyeClosed = this.querySelector('.eye-closed');

      if (input.type === 'password') {
        input.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
      } else {
        input.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
      }
    });
  });

  function showAlert(el, message, isSuccess) {
    const successClass = 'border-emerald-200 bg-emerald-50 text-emerald-700';
    const errorClass = 'border-red-200 bg-red-50 text-red-700';
    el.classList.remove('hidden', ...successClass.split(' '), ...errorClass.split(' '));
    el.classList.add(...(isSuccess ? successClass : errorClass).split(' '));
    el.textContent = message;
  }

  function showToast(message, type = 'success') {
    const toast = document.getElementById('toastContainer');
    if (!toast) return;

    const toastEl = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-emerald-600' : 'bg-rose-600';
    const icon = type === 'success'
      ? `<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
           <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
           <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
         </svg>`
      : `<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
           <path d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
         </svg>`;

    toastEl.className = `pointer-events-auto flex items-center gap-3 rounded-xl ${bgColor} px-4 py-3 text-sm font-medium text-white shadow-lg`;
    toastEl.style.opacity = '0';
    toastEl.style.transform = 'translateY(-10px)';
    toastEl.style.transition = 'all 0.3s ease';
    toastEl.innerHTML = `${icon}<span>${message}</span>`;

    toast.appendChild(toastEl);

    requestAnimationFrame(() => {
      toastEl.style.opacity = '1';
      toastEl.style.transform = 'translateY(0)';
    });

    setTimeout(() => {
      toastEl.style.opacity = '0';
      toastEl.style.transform = 'translateY(-10px)';
      setTimeout(() => toastEl.remove(), 300);
    }, 3000);
  }

  const loginFormEl = document.getElementById('customerLoginForm');
  const signupFormEl = document.getElementById('customerSignupForm');
  const loginAlert = document.getElementById('loginAlert');
  const signupAlert = document.getElementById('signupAlert');
  const socialButtons = document.querySelectorAll('[data-social]');

  function loginViaGoogle() {
    if (!GOOGLE_CLIENT_ID || !window.google || !google.accounts || !google.accounts.id) {
      showToast('Google login এখন কনফিগার করা নেই।', 'error');
      return;
    }

    google.accounts.id.initialize({
      client_id: GOOGLE_CLIENT_ID,
      callback: function(response) {
        if (!response || !response.credential) {
          showToast('Google login ব্যর্থ হয়েছে।', 'error');
          return;
        }
        $.ajax({
          url: 'ajax.php',
          method: 'POST',
          dataType: 'json',
          data: {
            action: 'google_login',
            id_token: response.credential
          },
          success: function(res) {
            const ok = !!(res && parseInt(res.status, 10) === 1);
            showToast((res && res.message) ? res.message : 'অনুরোধ সম্পন্ন হয়েছে।', ok ? 'success' : 'error');
            if (ok) {
              setTimeout(function() {
                window.location.href = '<?php echo domain; ?>';
              }, 600);
            }
          },
          error: function() {
            showToast('সার্ভার সমস্যা হয়েছে। আবার চেষ্টা করুন।', 'error');
          }
        });
      }
    });
    google.accounts.id.prompt();
  }

  function loginViaFacebook() {
    if (!FACEBOOK_APP_ID || !window.FB) {
      showToast('Facebook login এখন কনফিগার করা নেই।', 'error');
      return;
    }

    FB.login(function(response) {
      if (!response || !response.authResponse || !response.authResponse.accessToken) {
        showToast('Facebook login বাতিল হয়েছে।', 'error');
        return;
      }

      $.ajax({
        url: 'ajax.php',
        method: 'POST',
        dataType: 'json',
        data: {
          action: 'facebook_login',
          access_token: response.authResponse.accessToken
        },
        success: function(res) {
          const ok = !!(res && parseInt(res.status, 10) === 1);
          showToast((res && res.message) ? res.message : 'অনুরোধ সম্পন্ন হয়েছে।', ok ? 'success' : 'error');
          if (ok) {
            setTimeout(function() {
              window.location.href = '<?php echo domain; ?>';
            }, 600);
          }
        },
        error: function() {
          showToast('সার্ভার সমস্যা হয়েছে। আবার চেষ্টা করুন।', 'error');
        }
      });
    }, { scope: 'email,public_profile' });
  }

  if (FACEBOOK_APP_ID) {
    window.fbAsyncInit = function() {
      FB.init({
        appId: FACEBOOK_APP_ID,
        cookie: true,
        xfbml: false,
        version: 'v19.0'
      });
    };
  }

  socialButtons.forEach(function(btn) {
    btn.addEventListener('click', function() {
      const provider = this.getAttribute('data-social');
      if (provider === 'google') {
        loginViaGoogle();
      } else if (provider === 'facebook') {
        loginViaFacebook();
      }
    });
  });

  if (loginFormEl) {
    loginFormEl.addEventListener('submit', function(e) {
      e.preventDefault();
      loginAlert.classList.add('hidden');

      $.ajax({
        url: 'ajax.php',
        method: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(res) {
          const ok = !!(res && parseInt(res.status, 10) === 1);
          showAlert(loginAlert, (res && res.message) ? res.message : 'অনুরোধ সম্পন্ন হয়েছে।', ok);
          if (ok) {
            showToast('লগইন সফল হয়েছে', 'success');
            setTimeout(function() {
              window.location.href = '<?php echo domain; ?>';
            }, 600);
          }
        },
        error: function() {
          showAlert(loginAlert, 'সার্ভার সমস্যা হয়েছে। আবার চেষ্টা করুন।', false);
        }
      });
    });
  }

  if (signupFormEl) {
    signupFormEl.addEventListener('submit', function(e) {
      e.preventDefault();
      signupAlert.classList.add('hidden');

      const pass = document.getElementById('signupPassword').value;
      const confirmPass = document.getElementById('signupConfirm').value;
      if (pass !== confirmPass) {
        showAlert(signupAlert, 'পাসওয়ার্ড মিলেনি।', false);
        return;
      }

      $.ajax({
        url: 'ajax.php',
        method: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(res) {
          const ok = !!(res && parseInt(res.status, 10) === 1);
          showAlert(signupAlert, (res && res.message) ? res.message : 'অনুরোধ সম্পন্ন হয়েছে।', ok);
          if (ok) {
            showToast('সাইনআপ সফল হয়েছে', 'success');
            setTimeout(function() {
              window.location.href = '<?php echo domain; ?>';
            }, 700);
          }
        },
        error: function() {
          showAlert(signupAlert, 'সার্ভার সমস্যা হয়েছে। আবার চেষ্টা করুন।', false);
        }
      });
    });
  }
})();
</script>
