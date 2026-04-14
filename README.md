# Static Tailwind eCommerce UI (Rebuild)

This folder contains a **clean, beginner-friendly static HTML** rebuild of an eCommerce UI using **Tailwind CSS** (CDN).

## Folder structure

```text
naafiun/
  index.php
  pages/
  components/
    header.php
    home.php
    footer.php
  assets/
    images/
```

## How to run

- Open `https://naafiun.test/` in your browser.
- Click a product card to open `https://naafiun.test/details`.

## Tailwind setup

This project uses the **Tailwind CDN** for simplicity:
  - `https://cdn.tailwindcss.com`

If you later want a production build (recommended), switch to a Tailwind build pipeline and compile a CSS file.
ajax.php for ajax code and always use jquery

database pull format
$db->getdata($sql) all data will be came

$db->getull('product',' and id =1'); this another format (getdata and getfull all same type return)

single data return
$ar = $db->getAll('product',' and id =1'); echo $ar['name']; no need to give 0 index

insert data
$db->adddata('product',['name'=>'test'])

update
$db->qedit('product',['name'=>'test1'],'id',1)

authentication
$db->aut($sql) return true false

url routing system
after domain url will be page name but will be check if have any product slug match in product table then will be open details.php

config/html_function.php
icon function for all svg path tag icon will be here then anywhere can be use $db->icon('icon_name')

config/operation.php page is for database save edit delete function will be here

customer table = ledger_name

mysql table sql query

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `branch_id` int(11) NOT NULL DEFAULT 0,
  `department_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_bn` varchar(255) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `official_number` varchar(50) DEFAULT NULL,
  `sms_number` varchar(50) DEFAULT NULL,
  `whatsapp_number` varchar(50) DEFAULT NULL,
  `urgent_contact_number` varchar(50) DEFAULT NULL,
  `martial_status` varchar(20) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `spouse_profession` varchar(255) DEFAULT NULL,
  `total_son` tinyint(4) DEFAULT NULL,
  `total_daughter` tinyint(4) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(20) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `blood_group` varchar(20) DEFAULT NULL,
  `nid` varchar(50) DEFAULT NULL,
  `home_district` varchar(50) DEFAULT NULL,
  `present_address` varchar(500) DEFAULT NULL,
  `permanent_address` varchar(500) DEFAULT NULL,
  `joining_date` varchar(20) DEFAULT NULL,
  `mejor_subject` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `job_status` varchar(30) DEFAULT NULL,
  `academic_info` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `coordinator_sig_status` tinyint(4) DEFAULT 0,
  `principle_sig_status` tinyint(4) DEFAULT 0,
  `class_teacher_id` int(11) DEFAULT NULL COMMENT 'class teacher',
  `section_teacher_id` int(11) DEFAULT NULL COMMENT 'class teacher',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `access` varchar(5000) DEFAULT NULL,
  `page_permission` text DEFAULT NULL,
  `is_staff` tinyint(4) NOT NULL DEFAULT 1,
  `view_type` enum('all','own','branch','') DEFAULT NULL,
  `inactive_reason` varchar(500) DEFAULT NULL,
  `inactive_date` varchar(30) DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `token` varchar(500) DEFAULT NULL,
  `token_updated_date` varchar(30) DEFAULT NULL,
  `device_id` varchar(500) DEFAULT NULL,
  `login_status` tinyint(4) DEFAULT 0,
  `app_code` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apps_info`
--

CREATE TABLE `apps_info` (
  `id` int(11) NOT NULL,
  `date` varchar(30) DEFAULT NULL,
  `student_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `device_name` varchar(500) DEFAULT NULL,
  `token` varchar(500) DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `app_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(2) NOT NULL,
  `division_id` int(1) NOT NULL,
  `name` varchar(25) NOT NULL,
  `bn_name` varchar(25) NOT NULL,
  `lat` varchar(15) DEFAULT NULL,
  `lon` varchar(15) DEFAULT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(1) NOT NULL,
  `name` varchar(25) NOT NULL,
  `bn_name` varchar(25) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `title` varchar(2000) DEFAULT NULL,
  `details` varchar(2000) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `parentid` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `type` varchar(20) DEFAULT NULL,
  `creation` tinyint(4) NOT NULL DEFAULT 1,
  `other` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `dates` varchar(50) DEFAULT NULL,
  `return_id` int(11) DEFAULT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `voucher_num` varchar(30) DEFAULT NULL,
  `ledger_name_id` int(11) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `delivery_address` varchar(500) DEFAULT NULL,
  `sub_total` float DEFAULT 0,
  `total_amount` float DEFAULT NULL,
  `discount_per` float DEFAULT NULL,
  `discount_amount` float DEFAULT NULL,
  `charge` float DEFAULT NULL,
  `less_amount` float DEFAULT NULL,
  `type` enum('sales','purchase','sales-return','purchase-return','req') DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `approved_date` varchar(30) DEFAULT NULL,
  `delivery_status` varchar(50) DEFAULT 'not_sent',
  `date` varchar(30) DEFAULT NULL,
  `updated_date` varchar(30) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `delivery_date` varchar(30) DEFAULT NULL,
  `courier` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `method_id` int(11) DEFAULT NULL,
  `products` varchar(5000) DEFAULT NULL,
  `paid` varchar(11) DEFAULT NULL,
  `consignment_id` varchar(30) DEFAULT NULL,
  `tracking_code` varchar(50) DEFAULT NULL,
  `sent_by` int(11) DEFAULT NULL,
  `sent_date` varchar(30) DEFAULT NULL,
  `print_status` tinyint(4) DEFAULT 0,
  `printed_by` int(11) DEFAULT NULL,
  `printed_date` varchar(30) DEFAULT NULL,
  `cancelled_by` int(11) DEFAULT NULL,
  `cancelled_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT 0,
  `des` varchar(500) DEFAULT NULL COMMENT 'its need when no product in product list but it can use other porpuse',
  `ledger_name_id` int(11) DEFAULT NULL,
  `pre_qty` float DEFAULT 0 COMMENT 'its only for when stock adjustment\r\n',
  `qty` float DEFAULT 0,
  `debit_qty` float DEFAULT 0,
  `credit_qty` float DEFAULT 0,
  `price` float DEFAULT 0,
  `amount` float DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `remarks` text DEFAULT NULL,
  `type` enum('sales','purchase','sales-return','purchase-return','in','out','req') DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `updated_date` varchar(30) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `id` bigint(20) NOT NULL,
  `ledger_name_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `cus_id` int(11) DEFAULT 0,
  `bill_no` varchar(50) DEFAULT NULL,
  `voucher_num` varchar(20) DEFAULT NULL,
  `debit` decimal(15,2) DEFAULT 0.00,
  `credit` decimal(15,2) DEFAULT 0.00,
  `discount` decimal(15,2) DEFAULT 0.00,
  `method_id` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT 0 COMMENT 'this id basically created by but this id will be user wise cash',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_info_id` int(11) DEFAULT 0,
  `invoice_id` int(11) DEFAULT 0,
  `created_time` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_name`
--

CREATE TABLE `ledger_name` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `groups_id` int(11) DEFAULT NULL,
  `type` enum('cus','sup','other') DEFAULT NULL,
  `data_assign` enum('user','student','','') DEFAULT NULL COMMENT 'this is for finding teacher or students',
  `date` varchar(30) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE `method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `other` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `sl` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `page_title` varchar(300) DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `option` varchar(100) DEFAULT NULL,
  `others_access` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(50) DEFAULT NULL,
  `tran_id` varchar(255) DEFAULT NULL,
  `bill_info` mediumtext DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `others_info` mediumtext DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 complete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name_bn` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `writer` varchar(50) DEFAULT NULL,
  `publisher` varchar(50) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `edition` varchar(100) DEFAULT NULL,
  `cover_type` varchar(100) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `purchase_price` float DEFAULT 0,
  `printed_price` float DEFAULT 0,
  `price` decimal(10,2) DEFAULT 0.00,
  `discount_price` decimal(10,2) DEFAULT 0.00,
  `short_des` varchar(500) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tags` varchar(5000) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 active, 0 inactive',
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL,
  `test_writer` varchar(255) DEFAULT NULL,
  `test_pub` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `top` tinyint(1) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `contact` varchar(500) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `fab` varchar(2555) DEFAULT NULL,
  `css` text DEFAULT NULL,
  `js` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_his`
--

CREATE TABLE `sms_his` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT 0,
  `branch_id` int(11) DEFAULT 0,
  `class_id` int(11) DEFAULT 0,
  `section_id` int(11) DEFAULT 0,
  `teacher_id` int(11) DEFAULT 0,
  `number` varchar(20) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `message` varchar(2000) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `type` enum('sms','app','','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_type`
--

CREATE TABLE `staff_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `access_permission` text DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_update_his`
--

CREATE TABLE `status_update_his` (
  `id` int(11) NOT NULL,
  `des` text DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unions`
--

CREATE TABLE `unions` (
  `id` int(4) NOT NULL,
  `upazilla_id` int(3) NOT NULL,
  `name` varchar(25) NOT NULL,
  `bn_name` varchar(25) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE `upazilas` (
  `id` int(3) NOT NULL,
  `district_id` int(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `bn_name` varchar(25) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `page_permission` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `page` varchar(50) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `writer`
--

CREATE TABLE `writer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `top` tinyint(1) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
