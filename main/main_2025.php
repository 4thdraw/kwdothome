<?php 
define('_INDEX_',true);
//하단고객센터 노출관련 변수
define('_FC_', true);
include_once("../config.php");
 ?>
<?php include_once($kw_path."/inc/header_2025.php"); ?>
<?php include_once($kw_path."/inc/top_2025.php"); ?>

<!--메인상단-->		

<?php include $kw_path."/main/content/mainSwiper.php"; ?>

<div class='max-width d-xl-flex mx-auto  position-relative mainContentwrapper'  >
	<div class='kw_wrap d-xl-flex flex-column align-items-center max-width mx-auto'>
		<?php include $kw_path."/main/content/quration.php"; ?>
		<?php include $kw_path."/main/content/fiting.php"; ?>
		<?php include $kw_path."/main/content/qnaok.php"; ?>
		<?php include $kw_path."/main/content/allProduct.php"; ?>
		<?php include $kw_path."/main/content/designGallery.php"; ?>
		<?php include $kw_path."/main/content/privateQna.php"; ?>
	</div>
	<?php include $kw_path."/inc/quick_sticky.php"; ?>
</div>

<?php include_once($kw_path."/inc/footer_2025.php"); ?>