

<div id="wrap" >
<!--상단-->


 <header id="hd" class='position-relative bg-white'>
        <div class="ad d-flex justify-content-center active-bg text-white fw400 fs-14  line-height-1 py-2">
            <p class="py-1 d-flex gap-2">
                Since 2004 <span class="bar bg-white"></span> 
                누적시공 4500건 이상 <span class="bar bg-white"></span> 
                <strong class="fw500">바닥재 판매 · 시공전문 </strong>
            </p>
        </div>
         <div class="max-width mx-auto d-none d-xl-flex justify-content-between align-items-center gnbwrap"> 
            <h1 class="w-0"><a href="<?php echo $kw_url; ?>/main/main_2025.php">                   
               
			<?php include($kw_path."/img/2025/logo/mainlogo.html"); ?>
				
            </a></h1>
            <div class="searchbox border rounded-3 px-3 py-2 border-gray bg-white shadow-sm">
                
				<form method="GET" id="topFrm" name="topFrm" class="d-flex align-items-center " action="../product/product_search.php" onSubmit="teSearch(); return false;">				
					<input type="text" name="ts" id="ts" class='border-0 flex-grow-1 ' placeholder="검색어를 입력해주세요" value="" maxlength="50">
					<a href="#none" onClick="teSearch()" class="d-flex">
						
						<svg viewBox="0 0 80.27 80.28">
							<path fill="currentColor" d="M50.49,59.58c-7.96,0-15.44-3.1-21.06-8.72-11.61-11.61-11.61-30.51,0-42.13C35.05,3.1,42.54,0,50.49,0s15.44,3.1,21.06,8.73c11.61,11.62,11.61,30.51,0,42.13-5.63,5.63-13.11,8.72-21.06,8.72M50.49,10.58c-5.13,0-9.96,2-13.59,5.63-7.49,7.49-7.49,19.68,0,27.17,3.63,3.63,8.45,5.63,13.59,5.63s9.96-2,13.59-5.63c7.49-7.49,7.49-19.68,0-27.17-3.63-3.63-8.45-5.63-13.59-5.63"/>
							<rect fill="currentColor" x="-1.23" y="54.75" width="40.3" height="13.22" transform="translate(-37.85 31.35) rotate(-45)"/>
						</svg>				
					</a>
				</form>
            </div>
             <h2 class="w-0 d-flex justify-content-end text-nowrap fs-30 fw500 align-items-center gap-1 letter-spacing-0-5">
                고객센터
                <strong class='fw800 active-sub-color fs-35'>
                    1661-8849
                </strong>
            </h2>
        </div>
	
			<div class="menu">
				<div class='border-top 
				<?php echo defined('_PROLIST_') ? "" : "border-bottom"; ?>
				py-2 py-xl-1 bg-white px-3 px-xl-0 gnb_dom'>
					<h1 class='m_logo h-0 d-flex d-xl-none justify-content-center align-items-center position-absolute top-50 start-0 w-100 z-up'>
						<a href="<?php echo $kw_url; ?>/main/main_2025.php" class='d-flex'>
							<?php include($kw_path."/img/2025/logo/mainlogo.html"); ?>
						</a>                         
					</h1>
					<ul class="mx-auto max-width py-2 navilist fw600 fs-18 d-flex justify-content-between align-items-center">
						<li id="allmenu" class="navili">
							<a href="#navi_open" onclick="toggleBodyClassFromElement(this)" data-body-cls="nav_open" class="d-flex flex-column align-items-center" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="allNavi">
								
								<svg xmlns="http://www.w3.org/2000/svg" class='o' width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<line x1="3" y1="12" x2="21" y2="12"></line>
									<line x1="3" y1="6" x2="21" y2="6"></line>
									<line x1="3" y1="18" x2="21" y2="18"></line>
								</svg>
								<svg xmlns="http://www.w3.org/2000/svg" class="x" width="24" height="24" viewBox="0 0 24 24" fill="none" 
									stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<line x1="18" y1="6" x2="6" y2="18"></line>
								<line x1="6" y1="6" x2="18" y2="18"></line>
								</svg>

									<span class="visually-hidden">전체메뉴</span>
								
							</a>
						</li>
						<li class="navili d-none d-xl-block"><a href="<?php echo $kw_url; ?>/page/prd_list.php?pronm=prd_all">제품보기</a></li>
						<li class="navili d-none d-xl-block"><a href="">공간별추천</a></li>
						<li class="navili d-none d-xl-block"><a href="<?php echo $kw_url; ?>/page/gallery_list.php?pronm=prd_all">시공갤러리</a></li>
						<!-- <li class="navili d-none d-xl-block"><a href="">시공가이드</a></li> -->
						<li class="navili d-none d-xl-block"><a href="">주문제작</a></li>
						<li class="navili d-none d-xl-block"><a href="<?php echo $kw_url; ?>/page/board_list.php?boarden=Inquiries&board=견적문의" class="orange-color">견적문의</a></li>
						<li class="navili searchicon d-xl-none">
							<a href="#searchModal"  class="d-flex " >						
								<svg xmlns="http://www.w3.org/2000/svg" class='searchsvg ' width="22" height="22" viewBox="0 0 22 22" fill="none">
									<circle cx="13.5" cy="8.75" r="7" stroke="currentColor" stroke-width="3"/>
									<path d="M7.5 14.75L1.5 20.75" stroke="currentColor" stroke-width="3"/>
								</svg>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class='closesvg ' viewBox="0 0 24 24" fill="none">
								<path d="M22 2L2 22" stroke="currentColor" stroke-width="3"/>
								<path d="M22 22L2 2" stroke="currentColor" stroke-width="3"/>
								</svg>
										
							</a>
						</li>
					</ul>
				</div>

				<?php if(defined('_PROLIST_')){ 
					// 제품페이지일때 노출
					?>
				<div class='subpage_submenu py-2 py-xl-1 bg-gray px-3 px-xl-0 top-100% position-absolute start-0 end-0 gray-bg '>
					<ul class="mx-auto max-width  navilist fw500 fs-17 d-flex justify-content-between align-items-center ">  
						
					
                      <li class="navili d-none d-xl-block">
						<a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=carpet" class='<?php echo ($skey1 === '001') ? 'border-bottom-active active-color' : 'gray-dark'; ?>  px-lg-4 py-2' >카페트</a>
					  </li>
                      <li class="navili d-none d-xl-block">
						<a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=003&skey2=003001&boarden=artificial_grass" class='<?php echo ($skey1 === '003') ? 'border-bottom-active active-color' : 'gray-dark'; ?>  px-lg-4 py-2'>인조잔디</a>
					  </li>
                      <li class="navili d-none d-xl-block">
						<a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=002&skey2=002001&boarden=entrance_mat" class='<?php echo ($skey1 === '002') ? 'border-bottom-active active-color' : 'gray-dark'; ?>  px-lg-4 py-2'>현관매트</a>
					  </li>
                      <!-- <li class="navili d-none d-xl-block"><a href="">시공가이드</a></li> -->
                      <li class="navili d-none d-xl-block">
						<a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=010&skey2=010001&boarden=rubber_pvc" class='<?php echo ($skey1 === '010') ? 'border-bottom-active active-color' : 'gray-dark'; ?>  px-lg-4 py-2'>고무/PVC</a>
					  </li>
                      <li class="navili d-none d-xl-block">
						<a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=009&skey2=009001&boarden=preventionmat" class='<?php echo ($skey1 === '009') ? 'border-bottom-active active-color' : 'gray-dark'; ?>  px-lg-4 py-2'>피로예방매트</a>
					  </li>
					  <li class="navili d-none d-xl-block">
						 <a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=013&skey2=013001&boarden=multipurpose_flooring" class='<?php echo ($skey1 === '013') ? 'border-bottom-active active-color' : 'gray-dark'; ?>  px-lg-4 py-2'>LX바닥재</a>
					  </li>
					  <li class="navili d-none d-xl-block">
						 <a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=016&skey2=016001&boarden=subsidiary" class='<?php echo ($skey1 === '016') ? 'border-bottom-active active-color' : 'gray-dark'; ?>  px-lg-4 py-2'>부자재</a>
					  </li>
					 
					 
                	</ul>
				</div>
				<?php } ?>
			
				<div id='searchModal' class='modal position-absolute fade bg-white top-100 start-0 border-top w-100 border-bottom' >
				
					<div class="modal-content bg-white bg-opacity-75 backdrop-blur rounded-0 border-0 shadow-none">
						<div class="modal-body d-sm-flex align-items-center justify-content-center p-5">

									<form method="GET" id="topFrm" name="topFrm" class="d-flex align-items-center  border-bottom py-2" action="../product/product_search.php" onSubmit="teSearch(); return false;">				
										<input type="text" name="ts" id="tss" class='border-0 w-100 fs-21 gmfont-m ' placeholder="검색어를 입력해주세요" value="" maxlength="50">
										<a href="#none"  onClick="teSearch()" class="d-flex searchicon gray-text">
											
											<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
											<circle cx="13.5" cy="8.75" r="7" stroke="#939393" stroke-width="3"/>
											<path d="M7.5 14.75L1.5 20.75" stroke="#939393" stroke-width="3"/>
											</svg>			
										</a>
									</form>
						</div>
					</div>
			
			    </div>	

				
				
				
				<?php include_once($kw_path.'/inc/allNavi.php'); ?>		
			</div>		
			
 </header>	

 
		
		<script type="text/javascript">
			

			function teSearch() {
				if(document.getElementById("ts").value.length<1) {
					alert('검색어를 한글자 이상 입력해주세요');
					document.getElementById("ts").focus();
					return;
				}
				document.getElementById('topFrm').submit();
			}
		</script>
		

	

		  
			
			
	

<!--상단-->



<!--컨텐츠-->
<div class="contents">