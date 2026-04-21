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
    $phoneInput = isset($_POST['phone']) ? trim((string)$_POST['phone']) : '';
    $phoneInput = preg_replace('/[^0-9]/', '', $phoneInput);
    $phone = '0' . $phoneInput;
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $password = isset($_POST['password']) ? (string)$_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? (string)$_POST['confirm_password'] : '';
    $terms = isset($_POST['terms']) ? 1 : 0;

    if ($name === '' || $email === '' || $phoneInput === '' || $password === '' || $confirmPassword === '') {
        echo json_encode(['status' => 0, 'message' => 'সব প্রয়োজনীয় তথ্য পূরণ করুন।']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 0, 'message' => 'সঠিক ইমেইল দিন।']);
        exit;
    }

    if (!preg_match('/^[0-9]{10}$/', $phoneInput)) {
        echo json_encode(['status' => 0, 'message' => 'ফোন নম্বর +880 এর পরে ১০ ডিজিট দিতে হবে।']);
        exit;
    }

    if ($terms !== 1) {
        echo json_encode(['status' => 0, 'message' => 'শর্তাবলী মেনে নিন।']);
        exit;
    }

    if (strlen($password) < 6) {
        echo json_encode(['status' => 0, 'message' => 'পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে।']);
        exit;
    }

    if ($password !== $confirmPassword) {
        echo json_encode(['status' => 0, 'message' => 'পাসওয়ার্ড মিলেনি।']);
        exit;
    }

    $safeEmail = addslashes($email);
    $safePhone = addslashes($phone);

    $emailExists = $db->row_count("SELECT id FROM ledger_name WHERE email = '$safeEmail' LIMIT 1");
    if ($emailExists > 0) {
        echo json_encode(['status' => 0, 'message' => 'এই ইমেইল দিয়ে আগে থেকেই অ্যাকাউন্ট আছে।']);
        exit;
    }

    $phoneExists = $db->row_count("SELECT id FROM ledger_name WHERE number = '$safePhone' LIMIT 1");
    if ($phoneExists > 0) {
        echo json_encode(['status' => 0, 'message' => 'এই ফোন নম্বর দিয়ে আগে থেকেই অ্যাকাউন্ট আছে।']);
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
        echo json_encode(['status' => 0, 'message' => 'অ্যাকাউন্ট তৈরি করা যায়নি। আবার চেষ্টা করুন।']);
        exit;
    }

    $_SESSION['customer_id'] = $db->lastid;
    echo json_encode(['status' => 1, 'message' => 'সাইনআপ সফল হয়েছে।']);
    exit;
}

if ($action == 'customer_login') {
    header('Content-Type: application/json; charset=utf-8');

    $identity = isset($_POST['email_or_phone']) ? trim($_POST['email_or_phone']) : '';
    $password = isset($_POST['password']) ? (string)$_POST['password'] : '';

    if ($identity === '' || $password === '') {
        echo json_encode(['status' => 0, 'message' => 'ইমেইল/ফোন এবং পাসওয়ার্ড দিন।']);
        exit;
    }

    $safeIdentity = addslashes($identity);
    $rows = $db->getdata("SELECT id, password FROM ledger_name WHERE (email = '$safeIdentity' OR number = '$safeIdentity') AND type = 'cus' ORDER BY id DESC LIMIT 1");

    if (empty($rows) || !isset($rows[0]['id'])) {
        echo json_encode(['status' => 0, 'message' => 'ইমেইল/ফোন অথবা পাসওয়ার্ড ভুল।']);
        exit;
    }

    $customer = $rows[0];
    $storedPassword = isset($customer['password']) ? (string)$customer['password'] : '';
    $isPasswordValid = $password === $storedPassword;

    if (!$isPasswordValid) {
        echo json_encode(['status' => 0, 'message' => 'ইমেইল/ফোন অথবা পাসওয়ার্ড ভুল।']);
        exit;
    }

    $_SESSION['customer_id'] = (int)$customer['id'];
    echo json_encode(['status' => 1, 'message' => 'লগইন সফল হয়েছে।']);
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
    echo json_encode(['status' => 1, 'message' => 'লগআউট সফল হয়েছে।']);
    exit;
}

// Books AJAX filter endpoint
if ($action == 'books_filter') {
    header('Content-Type: application/json; charset=utf-8');

    $perPage = 12;
    $page = isset($_POST['page']) ? max(1, (int)$_POST['page']) : 1;
    $sort = isset($_POST['sort']) ? trim($_POST['sort']) : 'newest';
    $subjectIds = isset($_POST['subject_ids']) && $_POST['subject_ids'] !== '' ? array_filter(array_map('intval', explode(',', $_POST['subject_ids']))) : [];
    $writerIds = isset($_POST['writer_ids']) && $_POST['writer_ids'] !== '' ? array_filter(array_map('intval', explode(',', $_POST['writer_ids']))) : [];
    $publisherIds = isset($_POST['publisher_ids']) && $_POST['publisher_ids'] !== '' ? array_filter(array_map('intval', explode(',', $_POST['publisher_ids']))) : [];
    $minPrice = isset($_POST['min_price']) && $_POST['min_price'] !== '' ? (float)$_POST['min_price'] : null;
    $maxPrice = isset($_POST['max_price']) && $_POST['max_price'] !== '' ? (float)$_POST['max_price'] : null;
    $searchQuery = isset($_POST['search']) ? trim($_POST['search']) : '';

    $columns = $db->getdata("SHOW COLUMNS FROM product");
    $fields = [];
    foreach ($columns as $column) {
        if (isset($column['Field'])) $fields[] = $column['Field'];
    }
    $hasSubjectId = in_array('subject_id', $fields, true);
    $hasWriterId = in_array('writer_id', $fields, true);
    $hasPublisherId = in_array('publisher_id', $fields, true);
    $hasSubject = in_array('subject', $fields, true);
    $hasWriter = in_array('writer', $fields, true);
    $hasPublisher = in_array('publisher', $fields, true);

    $subjectColumn = $hasSubjectId ? 'subject_id' : ($hasSubject ? 'subject' : '');
    $writerColumn = $hasWriterId ? 'writer_id' : ($hasWriter ? 'writer' : '');
    $publisherColumn = $hasPublisherId ? 'publisher_id' : ($hasPublisher ? 'publisher' : '');

    $whereSql = " AND p.status = 1";
    if (!empty($subjectIds)) {
        if ($subjectColumn === 'subject_id') {
            $whereSql .= " AND p.subject_id IN (" . implode(',', $subjectIds) . ")";
        } elseif ($subjectColumn === 'subject') {
            $csvConditions = [];
            foreach ($subjectIds as $id) $csvConditions[] = "FIND_IN_SET(" . (int)$id . ", p.subject)";
            if (!empty($csvConditions)) $whereSql .= " AND (" . implode(' OR ', $csvConditions) . ")";
        }
    }
    if (!empty($writerIds)) {
        if ($writerColumn === 'writer_id') {
            $whereSql .= " AND p.writer_id IN (" . implode(',', $writerIds) . ")";
        } elseif ($writerColumn === 'writer') {
            $csvConditions = [];
            foreach ($writerIds as $id) $csvConditions[] = "FIND_IN_SET(" . (int)$id . ", p.writer)";
            if (!empty($csvConditions)) $whereSql .= " AND (" . implode(' OR ', $csvConditions) . ")";
        }
    }
    if (!empty($publisherIds)) {
        if ($publisherColumn === 'publisher_id') {
            $whereSql .= " AND p.publisher_id IN (" . implode(',', $publisherIds) . ")";
        } elseif ($publisherColumn === 'publisher') {
            $csvConditions = [];
            foreach ($publisherIds as $id) $csvConditions[] = "FIND_IN_SET(" . (int)$id . ", p.publisher)";
            if (!empty($csvConditions)) $whereSql .= " AND (" . implode(' OR ', $csvConditions) . ")";
        }
    }
    if ($minPrice !== null) $whereSql .= " AND p.price >= " . (float)$minPrice;
    if ($maxPrice !== null) $whereSql .= " AND p.price <= " . (float)$maxPrice;
    if ($searchQuery !== '') {
        $safeSearch = addslashes($searchQuery);
        $whereSql .= " AND (p.name LIKE '%{$safeSearch}%' OR p.name_bn LIKE '%{$safeSearch}%'";
        if ($writerColumn !== '') $whereSql .= " OR (w.name LIKE '%{$safeSearch}%')";
        if ($publisherColumn !== '') $whereSql .= " OR (pub.name LIKE '%{$safeSearch}%')";
        $whereSql .= ")";
    }

    $orderSql = " ORDER BY p.id DESC";
    if ($sort === 'oldest') $orderSql = " ORDER BY p.id ASC";
    elseif ($sort === 'price_asc') $orderSql = " ORDER BY p.price ASC, p.id DESC";
    elseif ($sort === 'price_desc') $orderSql = " ORDER BY p.price DESC, p.id DESC";

    $joinSql = ($subjectColumn === 'subject_id' ? " LEFT JOIN subject s ON s.id = p.subject_id " : "")
        . ($subjectColumn === 'subject' ? " LEFT JOIN subject s ON FIND_IN_SET(s.id, p.subject) " : "")
        . ($writerColumn === 'writer_id' ? " LEFT JOIN writer w ON w.id = p.writer_id " : "")
        . ($writerColumn === 'writer' ? " LEFT JOIN writer w ON FIND_IN_SET(w.id, p.writer) " : "")
        . ($publisherColumn === 'publisher_id' ? " LEFT JOIN publisher pub ON pub.id = p.publisher_id " : "")
        . ($publisherColumn === 'publisher' ? " LEFT JOIN publisher pub ON FIND_IN_SET(pub.id, p.publisher) " : "");
    $countRows = $db->getdata("SELECT COUNT(DISTINCT p.id) as total FROM product p {$joinSql} WHERE p.id > 0 {$whereSql}");
    $totalProducts = isset($countRows[0]['total']) ? (int)$countRows[0]['total'] : 0;
    $totalPages = (int)max(1, ceil($totalProducts / $perPage));
    $page = min($page, $totalPages);
    $offset = ($page - 1) * $perPage;
    $start = $totalProducts > 0 ? $offset + 1 : 0;
    $end = min($offset + $perPage, $totalProducts);
    $products = $db->getdata(
        "SELECT DISTINCT p.* FROM product p {$joinSql} WHERE p.id > 0 {$whereSql}{$orderSql} LIMIT {$offset}, {$perPage}"
    );

    

    $productsHtml = '';
    $paginationHtml = '';
    $tagsHtml = '';

    if (!empty($products)) {
        $productsHtml .= '<div class="grid gap-4 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4">';
        foreach ($products as $product) {
            $productsHtml .= $db->products($product);
        }
        $productsHtml .= '</div>';

        // Pagination
        if ($totalPages > 1) {
            $prevDisabled = $page <= 1;
            $nextDisabled = $page >= $totalPages;
            $paginationHtml .= '<nav class="mt-8 flex items-center justify-center gap-1.5" aria-label="Books pagination">';
            $paginationHtml .= '<button type="button" data-books-page="' . ($page - 1) . '" class="rounded-lg border border-slate-300 px-3 py-2 text-sm transition ' . ($prevDisabled ? 'cursor-not-allowed text-slate-400' : 'text-slate-600 hover:bg-slate-50') . '" ' . ($prevDisabled ? 'disabled' : '') . '>‹</button>';

            $window = 2;
            $startPage = max(1, $page - $window);
            $endPage = min($totalPages, $page + $window);
            if ($startPage > 1) {
                $paginationHtml .= '<button type="button" data-books-page="1" class="rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-600 transition hover:bg-slate-50">1</button>';
                if ($startPage > 2) $paginationHtml .= '<span class="px-2 text-slate-400">...</span>';
            }

            for ($i = $startPage; $i <= $endPage; $i++) {
                $paginationHtml .= '<button type="button" data-books-page="' . $i . '" class="rounded-lg px-3.5 py-2 text-sm transition ' . ($i === $page ? 'bg-emerald-600 font-bold text-white' : 'border border-slate-300 text-slate-600 hover:bg-slate-50') . '">' . $i . '</button>';
            }

            if ($endPage < $totalPages) {
                if ($endPage < $totalPages - 1) $paginationHtml .= '<span class="px-2 text-slate-400">...</span>';
                $paginationHtml .= '<button type="button" data-books-page="' . $totalPages . '" class="rounded-lg border border-slate-300 px-3.5 py-2 text-sm text-slate-600 transition hover:bg-slate-50">' . $totalPages . '</button>';
            }

            $paginationHtml .= '<button type="button" data-books-page="' . ($page + 1) . '" class="rounded-lg border border-slate-300 px-3 py-2 text-sm transition ' . ($nextDisabled ? 'cursor-not-allowed text-slate-400' : 'text-slate-600 hover:bg-slate-50') . '" ' . ($nextDisabled ? 'disabled' : '') . '>›</button>';
            $paginationHtml .= '</nav>';
        }
    } else {
        $productsHtml .= '<div class="flex flex-col items-center justify-center rounded-xl border border-slate-200 bg-slate-50 py-16">';
        $productsHtml .= '<svg class="h-16 w-16 text-slate-300 mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>';
        $productsHtml .= '<h3 class="text-lg font-bold text-slate-700">কোনো বই পাওয়া যায়নি</h3>';
        $productsHtml .= '<p class="mt-2 text-sm text-slate-500">অন্য ফিল্টার ব্যবহার করে দেখুন</p>';
        $productsHtml .= '</div>';
    }

    // Active tags HTML
    $subjectMap = [];
    if (!empty($subjectIds)) {
        $subjectRows = $db->getdata("SELECT id, name FROM subject WHERE id IN (" . implode(',', $subjectIds) . ")");
        foreach ($subjectRows as $row) $subjectMap[(int)$row['id']] = (string)$row['name'];
    }
    $writerMap = [];
    if (!empty($writerIds)) {
        $writerRows = $db->getdata("SELECT id, name FROM writer WHERE id IN (" . implode(',', $writerIds) . ")");
        foreach ($writerRows as $row) $writerMap[(int)$row['id']] = (string)$row['name'];
    }
    $publisherMap = [];
    if (!empty($publisherIds)) {
        $publisherRows = $db->getdata("SELECT id, name FROM publisher WHERE id IN (" . implode(',', $publisherIds) . ")");
        foreach ($publisherRows as $row) $publisherMap[(int)$row['id']] = (string)$row['name'];
    }

    $tagParts = [];
    foreach ($subjectIds as $id) {
        if (!isset($subjectMap[$id])) continue;
        $tagParts[] = '<button type="button" data-remove-filter="subject" data-filter-value="' . $id . '" class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-200 px-3 py-1 text-xs font-medium text-emerald-700 hover:bg-emerald-100 transition">' . htmlspecialchars($subjectMap[$id], ENT_QUOTES, 'UTF-8') . '<svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>';
    }
    foreach ($writerIds as $id) {
        if (!isset($writerMap[$id])) continue;
        $tagParts[] = '<button type="button" data-remove-filter="writer" data-filter-value="' . $id . '" class="inline-flex items-center gap-1.5 rounded-full bg-sky-50 border border-sky-200 px-3 py-1 text-xs font-medium text-sky-700 hover:bg-sky-100 transition">' . htmlspecialchars($writerMap[$id], ENT_QUOTES, 'UTF-8') . '<svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>';
    }
    foreach ($publisherIds as $id) {
        if (!isset($publisherMap[$id])) continue;
        $tagParts[] = '<button type="button" data-remove-filter="publisher" data-filter-value="' . $id . '" class="inline-flex items-center gap-1.5 rounded-full bg-violet-50 border border-violet-200 px-3 py-1 text-xs font-medium text-violet-700 hover:bg-violet-100 transition">' . htmlspecialchars($publisherMap[$id], ENT_QUOTES, 'UTF-8') . '<svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>';
    }
    if ($minPrice !== null || $maxPrice !== null) {
        $tagParts[] = '<button type="button" data-remove-filter="price" data-filter-value="0" class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-200 px-3 py-1 text-xs font-medium text-amber-700 hover:bg-amber-100 transition">৳' . ($minPrice !== null ? number_format($minPrice, 0) : '0') . ' - ৳' . ($maxPrice !== null ? number_format($maxPrice, 0) : '∞') . '<svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>';
    }
    if (!empty($tagParts)) {
        $tagsHtml = '<div class="flex flex-wrap items-center gap-2">' . implode('', $tagParts) . '<button type="button" data-clear-filters="1" class="text-xs font-medium text-rose-600 hover:text-rose-700 transition ml-1">Clear All</button></div>';
    }

    echo json_encode([
        'status' => 1,
        'html' => $productsHtml,
        'pagination' => $paginationHtml,
        'tags_html' => $tagsHtml,
        'total' => $totalProducts,
        'start' => $start,
        'end' => $end,
        'page' => $page,
        'total_pages' => $totalPages,
    ]);
    exit;
}

if ($action == 'search_suggestions') {
    header('Content-Type: application/json; charset=utf-8');
    
    $search = isset($_POST['search']) ? trim($_POST['search']) : '';
    
    if (strlen($search) < 2) {
        echo json_encode(['suggestions' => []]);
        exit;
    }
    
    $safeSearch = addslashes($search);
    $sql = "select * from product where name like '%{$safeSearch}%' or name_bn like '%{$safeSearch}%' or slug like '%{$safeSearch}%' limit 8";
    
    $products = $db->getdata($sql);
    
    $suggestions = [];
    if (!empty($products)) {
        foreach ($products as $product) {
            $suggestions[] = [
                'id' => (int)$product['id'],
                'name' => htmlspecialchars((string)($product['name_bn'] ?? ''), ENT_QUOTES, 'UTF-8'),
                'slug' => htmlspecialchars((string)($product['slug'] ?? ''), ENT_QUOTES, 'UTF-8'),
                'price' => (float)$product['price'],
                'image' => htmlspecialchars((string)($product['image'] ?? ''), ENT_QUOTES, 'UTF-8')
            ];
        }
    }
    
    echo json_encode(['suggestions' => $suggestions]);
    exit;
}

exit;
