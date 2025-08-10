<?php
define('C_DIR', '../../../_global');
/*--- 템플릿 클래스 및 환경파일 호출 ===*/
include C_DIR.'/conf_basic.php';
$FUNC = new basicFunc();
//if($_SERVER['REMOTE_ADDR']=='211.32.149.136') {
//	ini_set('display_errors', 1);
//}
/*--- DB 클래스 호출 및 생성 ===*/
include C_DIR.'/class_db.php';
$SQL = new basicSql(C_DIR.'/ini_basic', false);
?>
<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0" />
	<meta name="format-detection" content="telephone=no, email=no">


	<meta property="og:type" content="website" />

	<meta property="og:title" content="강화카페트매트" />
	<meta property="og:description" content="신속한 납품과 깔끔한 시공에서 사후관리까지 완벽한 서비스" />

	<meta property="og:url" content="<?php echo $kw_url; ?>" />
	<meta property="og:image" content="<?php echo $kw_url; ?>/img/2025/seo/ogimg.png">


	<title>::강화카페트&amp;매트:: 신속한 납품과 깔끔한 시공에서 사후관리까지 완벽한 서비스로 고객만족을 추구합니다. </title>

	<!-- Icon & Favicon -->
	<link rel="shortcut icon" href="<?php echo $kw_url; ?>/img/2025/seo/favicon.ico" />
	<link rel="stylesheet" href="<?php echo $kw_url; ?>/css/2025/common.css">

	<!-- 커스텀 -->
	<link rel="stylesheet" href="<?php echo $kw_url; ?>/css/2025/v2025.min.css">

	<link rel="stylesheet" href="<?php echo $kw_url; ?>/vendor/swiper/swiper-bundle.min.css?ver=8" />
    <script src="<?php echo $kw_url; ?>/vendor/swiper/swiper-bundle.min.js?ver=8"></script>
	<script src="<?php echo $kw_url; ?>/vendor/bootstrap5/bootstrap.bundle.min.js"></script>

	<!-- 커스텀 -->
	<script src="<?php echo $kw_url; ?>/js/2025/common.js"></script>
	
</head>

<body  >