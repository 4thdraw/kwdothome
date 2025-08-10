<?php 

include_once("../config.php"); ?>
<?php include_once($kw_path."/inc/header_2025.php"); ?>
<?php include_once($kw_path."/inc/top_2025.php"); ?>

<!--게시판 리스트-->		



<div class='max-width d-flex mx-auto  position-relative mainContentwrapper'  >
	<div class='kw_wrap d-flex flex-column align-items-center max-width mx-auto'>
		<h2 class='page_title'>
		<?php echo $board_title; ?>
		<strong>
			<?php echo $board_title_en; ?>
		</strong>
		</h2> 
	</div>
	<?php include $kw_path."/inc/quick_sticky.php"; ?>
</div>

<?php include_once($kw_path."/inc/footer_2025.php"); ?>