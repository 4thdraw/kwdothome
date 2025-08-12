<?php 




include_once("../config.php"); ?>
<?php include_once($kw_path."/inc/header_2025.php"); ?>
<?php include_once($kw_path."/inc/top_2025.php"); ?>

<!--게시판 리스트-->		

 <!-- 제품하위카테고리 -->
 <div class='subMn py-5'>
			<div class="max-width mx-auto px-3 px-xl-0 d-flex w-100 justify-content-between align-items-center pt-0">
				<div>
					<h2 class='page_title fs-48 fw400 backgroundnone'>
							<span >
								<?php echo $board_title; ?>
							</span>
							
							<strong class='active-color fw400 text-uppercase'>
							    <?php echo $board_title_en; ?>
							</strong>
					</h2> 
					<p class='fs-20 gray-dark mt-3'>
						고객 공간에 최적화된 맞춤 시공으로 완성된<br>
                        다양한 카페트 사례를 만나보세요.
					</p>
				</div>
					
				<!--검색-->
				<div class='kw_gallery_searchdom'>
					<form name="frmSearch" id="frmSearch" class="d-flex align-items-center gap-3 "  method="GET" onSubmit="return searchForm();">
							
							

						
							<div class='border border-dark-gray  px-3 rounded-3 d-flex align-items-center h43 '>
								<input type="text" name="sbval" id="sbval" maxlength="50" class='border-0'  
								placeholder="검색어를 입력해주세요."   />
								<input type="image" src="../img/2025/ui/search_icon.png"  />
							</div>
							
					</form>
			  	</div>
			
				<!--//검색-->
			</div>
	 </div>


<div class='max-width d-flex mx-auto  position-relative mainContentwrapper mb-5'  >
	<div class='kw_wrap w-100'>
	<!-- 가상DB // 테이블이 같은 구조일 것으로 예상하여 하나로 매트상식,공지사항, 견적문의 스킨만 다르게 진행-->
	<?php 
	// 페이지 상단에 아래 코드 추가 (개발용)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	include_once($kw_path."/inc/db/inquiries_list.php"); ?>

		<ul class="inquiry-list board-list  fs-16 fw600 ">
		       <li class='d-flex  justify-content-between active-bg text-white px-3'>
					<div class="inquiry-header col-2 py-3">
						<span >NO.</span>
						<span>분류</span>						
					</div>

					<div class="inquiry-title flex-grow-1 line-height-1-6 d-flex align-items-center">제목</div>

					<div class="inquiry-meta d-flex col-4 align-items-center">
						
						<span>작성자</span>
						<span>작성일</span>
						<span>조회수</span>
						<span>상태</span>
					</div>
				</li>

			<?php  foreach ($inquiries as $inq): ?>
				<li class='d-flex justify-content-between px-3 border-bottom '>
					<div class="inquiry-header  col-2 py-3">
						<span><?php echo $inq['no']; ?></span>
						<span class="status <?php echo $inq['status']; ?>"><?php echo $inq['status']; ?></span>
					</div>

					<div class="inquiry-title inquiry-title flex-grow-1 line-height-1-6 "><?php echo $inq['title']; ?></div>

					<div class="inquiry-meta d-flex col-4">
						<span><?php echo $inq['category']; ?></span>
						<span>작성자: <?php echo $inq['author']; ?></span>
						<span>작성일: <?php echo $inq['date']; ?></span>
						<span>조회수: <?php echo $inq['views']; ?></span>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	  
	</div>
	<?php include $kw_path."/inc/quick_sticky.php"; ?>
</div>

<?php include_once($kw_path."/inc/footer_2025.php"); ?>