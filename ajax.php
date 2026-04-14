<?php
include 'main.php';

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

function json_fetch($url)
{
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 10,
            'ignore_errors' => true
        ]
    ]);
    $response = @file_get_contents($url, false, $context);
    if ($response === false) {
        return null;
    }
    $decoded = json_decode($response, true);
    return is_array($decoded) ? $decoded : null;
}

function find_or_create_social_customer($db, $name, $email)
{
    $safeEmail = addslashes($email);
    $rows = $db->getdata("SELECT id FROM ledger_name WHERE email = '$safeEmail' AND type = 'cus' ORDER BY id DESC LIMIT 1");
    if (!empty($rows) && isset($rows[0]['id'])) {
        return (int)$rows[0]['id'];
    }

    $insertStatus = $db->adddata('ledger_name', [
        'name' => $name,
        'email' => $email,
        'number' => '',
        'password' => '',
        'address' => '',
        'type' => 'cus',
        'date' => $db->cdate('Y-m-d H:i:s'),
        'created_by' => 0
    ]);

    if (!$insertStatus) {
        return 0;
    }

    return (int)$db->lastid;
}



if ($action == 'search_publishers') {
    $search = isset($_POST['search']) ? trim($_POST['search']) : '';
    $where = $db->build_search_where($search);
    $data = $db->getFull('publisher', ' AND id > 0' . $where . ' ORDER BY name ASC LIMIT 36');
    $html = '';
    if (!empty($data)) {
        $html .= '<div class="grid gap-3 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">';
        foreach ($data as $row) {
            $html .= '<a href="' . domain . 'publisher/' . htmlspecialchars($row['slug']) . '" class="group">';
            $html .= '<div class="flex items-center gap-3 rounded-lg border border-slate-200 bg-white px-4 py-3 hover:border-emerald-300 hover:shadow-sm transition">';
            $html .= '<span class="text-emerald-600 text-lg leading-none">›_</span>';
            $html .= '<span class="text-sm font-medium text-slate-900 group-hover:text-emerald-700 truncate">' . htmlspecialchars($row['name']) . '</span>';
            $html .= '</div></a>';
        }
        $html .= '</div>';
    } else {
        $html = '<div class="flex flex-col items-center justify-center py-12"><h3 class="text-base font-medium text-slate-700">কোনো প্রকাশনী পাওয়া যায়নি</h3></div>';
    }
    echo $html;
    exit;
}

if ($action == 'search_subjects') {
    $search = isset($_POST['search']) ? trim($_POST['search']) : '';
    $where = $db->build_search_where($search);
    $data = $db->getFull('subject', ' AND id > 0' . $where . ' ORDER BY name ASC LIMIT 36');
    $html = '';
    if (!empty($data)) {
        $html .= '<div class="grid gap-3 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">';
        foreach ($data as $row) {
            $html .= '<a href="' . domain . 'subject/' . htmlspecialchars($row['slug']) . '" class="group">';
            $html .= '<div class="flex items-center gap-3 rounded-lg border border-slate-200 bg-white px-4 py-3 hover:border-emerald-300 hover:shadow-sm transition">';
            $html .= '<span class="text-emerald-600 text-lg leading-none">›_</span>';
            $html .= '<span class="text-sm font-medium text-slate-900 group-hover:text-emerald-700 truncate">' . htmlspecialchars($row['name']) . '</span>';
            $html .= '</div></a>';
        }
        $html .= '</div>';
    } else {
        $html = '<div class="flex flex-col items-center justify-center py-12"><h3 class="text-base font-medium text-slate-700">কোনো বিষয় পাওয়া যায়নি</h3></div>';
    }
    echo $html;
    exit;
}

if ($action == 'search_writers') {
    $search = isset($_POST['search']) ? trim($_POST['search']) : '';
    $where = $db->build_search_where($search);
    $data = $db->getFull('writer', ' AND id > 0' . $where . ' ORDER BY name ASC LIMIT 36');
    $html = '';
    if (!empty($data)) {
        $html .= '<div class="grid gap-3 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">';
        foreach ($data as $row) {
            $html .= '<a href="' . domain . 'writer/' . htmlspecialchars($row['slug']) . '" class="group">';
            $html .= '<div class="flex items-center gap-3 rounded-lg border border-slate-200 bg-white px-4 py-3 hover:border-emerald-300 hover:shadow-sm transition">';
            $html .= '<span class="text-emerald-600 text-lg leading-none">›_</span>';
            $html .= '<span class="text-sm font-medium text-slate-900 group-hover:text-emerald-700 truncate">' . htmlspecialchars($row['name']) . '</span>';
            $html .= '</div></a>';
        }
        $html .= '</div>';
    } else {
        $html = '<div class="flex flex-col items-center justify-center py-12"><h3 class="text-base font-medium text-slate-700">কোনো লেখক পাওয়া যায়নি</h3></div>';
    }
    echo $html;
    exit;
}

if ($action == 'customer_signup') {
    header('Content-Type: application/json; charset=utf-8');

    $name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $email = isset($_POST['email']) ? trim(strtolower($_POST['email'])) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $password = isset($_POST['password']) ? (string)$_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? (string)$_POST['confirm_password'] : '';
    $terms = isset($_POST['terms']) ? 1 : 0;

    if ($name === '' || $email === '' || $phone === '' || $password === '' || $confirmPassword === '') {
        echo json_encode(['status' => 0, 'message' => 'সব প্রয়োজনীয় তথ্য পূরণ করুন।']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 0, 'message' => 'সঠিক ইমেইল দিন।']);
        exit;
    }

    if ($terms !== 1) {
        echo json_encode(['status' => 0, 'message' => 'শর্তাবলী মেনে নিন।']);
        exit;
    }

    if (strlen($password) < 6) {
        echo json_encode(['status' => 0, 'message' => 'পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে।']);
        exit;
    }

    if ($password !== $confirmPassword) {
        echo json_encode(['status' => 0, 'message' => 'পাসওয়ার্ড মিলেনি।']);
        exit;
    }

    $safeEmail = addslashes($email);
    $safePhone = addslashes($phone);

    $emailExists = $db->row_count("SELECT id FROM ledger_name WHERE email = '$safeEmail' LIMIT 1");
    if ($emailExists > 0) {
        echo json_encode(['status' => 0, 'message' => 'এই ইমেইল দিয়ে আগে থেকেই অ্যাকাউন্ট আছে।']);
        exit;
    }

    $phoneExists = $db->row_count("SELECT id FROM ledger_name WHERE number = '$safePhone' LIMIT 1");
    if ($phoneExists > 0) {
        echo json_encode(['status' => 0, 'message' => 'এই ফোন নম্বর দিয়ে আগে থেকেই অ্যাকাউন্ট আছে।']);
        exit;
    }

    $insertStatus = $db->adddata('ledger_name', [
        'name' => $name,
        'email' => $email,
        'number' => $phone,
        'password' => $password,
        'address' => $address,
        'type' => 'cus',
        'date' => $db->cdate('Y-m-d H:i:s'),
        'created_by' => 0
    ]);

    if (!$insertStatus) {
        echo json_encode(['status' => 0, 'message' => 'অ্যাকাউন্ট তৈরি করা যায়নি। আবার চেষ্টা করুন।']);
        exit;
    }

    $_SESSION['customer_id'] = $db->lastid;
    echo json_encode(['status' => 1, 'message' => 'সাইনআপ সফল হয়েছে।']);
    exit;
}

if ($action == 'customer_login') {
    header('Content-Type: application/json; charset=utf-8');

    $identity = isset($_POST['email_or_phone']) ? trim($_POST['email_or_phone']) : '';
    $password = isset($_POST['password']) ? (string)$_POST['password'] : '';

    if ($identity === '' || $password === '') {
        echo json_encode(['status' => 0, 'message' => 'ইমেইল/ফোন এবং পাসওয়ার্ড দিন।']);
        exit;
    }

    $safeIdentity = addslashes($identity);
    $rows = $db->getdata("SELECT id, password FROM ledger_name WHERE (email = '$safeIdentity' OR number = '$safeIdentity') AND type = 'cus' ORDER BY id DESC LIMIT 1");

    if (empty($rows) || !isset($rows[0]['id'])) {
        echo json_encode(['status' => 0, 'message' => 'ইমেইল/ফোন অথবা পাসওয়ার্ড ভুল।']);
        exit;
    }

    $customer = $rows[0];
    $storedPassword = isset($customer['password']) ? (string)$customer['password'] : '';
    $isPasswordValid = $password === $storedPassword;

    if (!$isPasswordValid) {
        echo json_encode(['status' => 0, 'message' => 'ইমেইল/ফোন অথবা পাসওয়ার্ড ভুল।']);
        exit;
    }

    $_SESSION['customer_id'] = (int)$customer['id'];
    echo json_encode(['status' => 1, 'message' => 'লগইন সফল হয়েছে।']);
    exit;
}

if ($action == 'google_login') {
    header('Content-Type: application/json; charset=utf-8');

    if (GOOGLE_CLIENT_ID === '') {
        echo json_encode(['status' => 0, 'message' => 'Google login configuration missing.']);
        exit;
    }

    $idToken = isset($_POST['id_token']) ? trim((string)$_POST['id_token']) : '';
    if ($idToken === '') {
        echo json_encode(['status' => 0, 'message' => 'Invalid Google token.']);
        exit;
    }

    $tokenInfo = json_fetch('https://oauth2.googleapis.com/tokeninfo?id_token=' . rawurlencode($idToken));
    if (empty($tokenInfo) || !isset($tokenInfo['aud']) || $tokenInfo['aud'] !== GOOGLE_CLIENT_ID) {
        echo json_encode(['status' => 0, 'message' => 'Google token verification failed.']);
        exit;
    }

    $email = isset($tokenInfo['email']) ? trim(strtolower($tokenInfo['email'])) : '';
    $name = isset($tokenInfo['name']) ? trim($tokenInfo['name']) : '';
    $isVerified = isset($tokenInfo['email_verified']) ? (string)$tokenInfo['email_verified'] : 'false';

    if ($email === '' || $isVerified !== 'true') {
        echo json_encode(['status' => 0, 'message' => 'Google account email not verified.']);
        exit;
    }

    if ($name === '') {
        $name = 'Google User';
    }

    $customerId = find_or_create_social_customer($db, $name, $email);
    if ($customerId <= 0) {
        echo json_encode(['status' => 0, 'message' => 'Google login failed. Try again.']);
        exit;
    }

    $_SESSION['customer_id'] = $customerId;
    echo json_encode(['status' => 1, 'message' => 'Google login successful.']);
    exit;
}

if ($action == 'facebook_login') {
    header('Content-Type: application/json; charset=utf-8');

    if (FACEBOOK_APP_ID === '' || FACEBOOK_APP_SECRET === '') {
        echo json_encode(['status' => 0, 'message' => 'Facebook login configuration missing.']);
        exit;
    }

    $accessToken = isset($_POST['access_token']) ? trim((string)$_POST['access_token']) : '';
    if ($accessToken === '') {
        echo json_encode(['status' => 0, 'message' => 'Invalid Facebook token.']);
        exit;
    }

    $appToken = FACEBOOK_APP_ID . '|' . FACEBOOK_APP_SECRET;
    $debugData = json_fetch('https://graph.facebook.com/debug_token?input_token=' . rawurlencode($accessToken) . '&access_token=' . rawurlencode($appToken));
    if (empty($debugData['data']) || empty($debugData['data']['is_valid']) || (string)$debugData['data']['app_id'] !== (string)FACEBOOK_APP_ID) {
        echo json_encode(['status' => 0, 'message' => 'Facebook token verification failed.']);
        exit;
    }

    $profile = json_fetch('https://graph.facebook.com/me?fields=id,name,email&access_token=' . rawurlencode($accessToken));
    $email = isset($profile['email']) ? trim(strtolower($profile['email'])) : '';
    $name = isset($profile['name']) ? trim($profile['name']) : '';

    if ($email === '') {
        echo json_encode(['status' => 0, 'message' => 'Facebook email permission is required.']);
        exit;
    }

    if ($name === '') {
        $name = 'Facebook User';
    }

    $customerId = find_or_create_social_customer($db, $name, $email);
    if ($customerId <= 0) {
        echo json_encode(['status' => 0, 'message' => 'Facebook login failed. Try again.']);
        exit;
    }

    $_SESSION['customer_id'] = $customerId;
    echo json_encode(['status' => 1, 'message' => 'Facebook login successful.']);
    exit;
}

if ($action == 'customer_logout') {
    header('Content-Type: application/json; charset=utf-8');
    unset($_SESSION['customer_id']);
    echo json_encode(['status' => 1, 'message' => 'লগআউট সফল হয়েছে।']);
    exit;
}

exit;
