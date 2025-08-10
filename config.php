	
<?php
    define('KW_PATH',$_SERVER['DOCUMENT_ROOT']);
    // 웹 브라우저용 URL 경로
	$host = $_SERVER['HTTP_HOST'];
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
	define('KW_URL', $protocol . $host);
	$kw_url = KW_URL."/document";
	$kw_path = KW_PATH."/document";

	
	$board_title = isset($_GET['board']) ? $_GET['board'] : '강화카페트매트';
	$board_title_en = isset($_GET['boarden']) ? $_GET['boarden'] : 'GangHwa Carpet Mat';

?>