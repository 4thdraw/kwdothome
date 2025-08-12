<?php 
define('_PLACELIST_',true);
//하단고객센터 노출관련 변수
define('_FC_', true);
include_once("../config.php");

if($_GET['skey1']==""){ $_GET['skey1']="001"; }
$skey1=$_GET['skey1'];
$skey2=$_GET['skey2'];
?>

<?php include_once($kw_path."/inc/header_2025.php"); ?>


<!-- 차장님, 공간별추천은 상품카테고리입니다. -->
<!-- 가상으로 카테고리 테이터생성해두었습니다. 
 변수명은 상품변수명과 동일하게 처리해두었습니다. -->
<?php include_once($kw_path."/inc/db/place_list.php"); ?>
<?php include_once($kw_path."/inc/top_2025.php"); ?>
<?php 
include_once($kw_path."/inc/placelist_navi.php");
?>
<div class=' position-relative content_wrapper mainContentwrapper overflow-hidden'  >
	<div data-info='퀵메뉴와 형제컨텐츠 : 페이지내의 컨텐츠 레퍼'>


	
	 <!-- 제품하위카테고리 -->
	 <div class='subMn border-bottom py-5 border-top'>
			<div class="max-width mx-auto px-3 px-xl-0 d-flex w-100 justify-content-between align-items-center ">
				<div>
					<h2 class='page_title fs-48 fw400'>
							<span >
							
							<?php 
								
								if (isset($subnavilist['items'][$skey1])) {
									echo $subnavilist['items'][$skey1]['menunm'];
								}
							?>
							
							</span>
							
							
					</h2> 
					<p class='fs-20 gray-dark mt-3'>
						
					<?php echo $subnavilist['subtilecontent']; ?>
					</p>
				</div>
					
					<ul class='d-flex gap-3 text-nowrap'>
						<li>
							<a href="<?php echo $kw_url; ?>/page/place_list.php?skey1=<?php echo substr($data['class_code'],0,3);?>" 
							class="smn rounded-pill px-3 py-2 <?php if($_GET['skey2']==""){ echo "_s"; } ?>">전체</a>
					
						</li>
						<?php

						
						// submenus 배열에서 $class_mid_arr 만들기
						$class_mid_arr = array();
if (isset($subnavilist['items'][$skey1]['submenus'])) {
    foreach ($subnavilist['items'][$skey1]['submenus'] as $code => $menu) {
        $class_mid_arr[] = array(
            'class_code' => $code,
            'class_name' => $menu['menunm']
        );
    }
}


						// 출력
						if (count($class_mid_arr) > 0) {
							foreach ($class_mid_arr as $data) {
								
						?>
						<li>
							
							<a href="<?php echo $kw_url; ?>/page/place_list.php?skey1=<?php echo $skey1; ?>&skey2=<?php echo $data['class_code']; ?>"
							class="smn rounded-pill px-3 py-2 <?php  echo ($skey2 == $data['class_code']) ? 'active-bg text-white' : ''; ?>">
							<?php echo $data['class_name']; ?>
							</a>
						</li>
						<?php 
						} 
							}
						?>
					</ul>
			</div>
	 </div>

	<!-- 상품리스트 -->
	<div class='border-bottom'>	  
		<div class='kw_wrap d-flex flex-column align-items-center max-width mx-auto px-3 px-xl-0 py-5 '>		
		 	<!--목록 리스트-->
			<div class="contents max-width mx-auto px-3 px-xl-0">		
			
				<div class="subList row row-cols-2 row-cols-md-4 w-100 pt-5">			
					
			
										
							<div class="proBox3 mt-4 d-flex flex-column align-items-stretch justify-content-between">
								<p class="border flex-grow-1">						
									<a href="https://ghmat.com/document/page/gallery_view.php?tc=construction&amp;id=548&amp;pronm=prd_all" class="d-block h-100">
										<img src="https://ghmat.com/document/inc/parseImage_s.php?id=2474" class="img-fluid w-100">
									</a>
								</p>
								<h5 class="text-center fs-18 mt-2">현관매트</h5>
								<span class="stxt text-center fs-16 ">삼각산초 로고매트 및 브러쉬조립매트 설치</span>							
							</div>
						
											
							<div class="proBox3 mt-4 d-flex flex-column align-items-stretch justify-content-between">
								<p class="border flex-grow-1">						
								
																<a href="https://ghmat.com/document/page/gallery_view.php?tc=construction&amp;id=547&amp;pronm=prd_all" class="d-block h-100">
																							<img src="https://ghmat.com/document/inc/parseImage_s.php?id=2469" class="img-fluid w-100">
																</a>
								
								</p><h5 class="text-center fs-18 mt-2">스포츠매트</h5>
								<span class="stxt text-center fs-16 ">한국폴리텍 다솜고등학교 네오플렉스 시공</span>
								
								<p></p>				
						
							</div>
						
											
							<div class="proBox3 mt-4 d-flex flex-column align-items-stretch justify-content-between">
								<p class="border flex-grow-1">						
								
																<a href="https://ghmat.com/document/page/gallery_view.php?tc=construction&amp;id=546&amp;pronm=prd_all" class="d-block h-100">
																							<img src="https://ghmat.com/document/inc/parseImage_s.php?id=2464" class="img-fluid w-100">
																</a>
								
								</p><h5 class="text-center fs-18 mt-2">로고매트</h5>
								<span class="stxt text-center fs-16 ">부산 JK스크린골프 출입구 로고매트 제작</span>
								
								<p></p>				
						
							</div>
						
											
							<div class="proBox3 mt-4 d-flex flex-column align-items-stretch justify-content-between">
								<p class="border flex-grow-1">						
								
																<a href="https://ghmat.com/document/page/gallery_view.php?tc=construction&amp;id=545&amp;pronm=prd_all" class="d-block h-100">
																							<img src="https://ghmat.com/document/inc/parseImage_s.php?id=2458" class="img-fluid w-100">
																</a>
								
								</p><h5 class="text-center fs-18 mt-2">카페트</h5>
								<span class="stxt text-center fs-16 ">원규스튜디오 롤카페트 시공</span>
								
								<p></p>				
						
							</div>
						
											
							<div class="proBox3 mt-4 d-flex flex-column align-items-stretch justify-content-between">
								<p class="border flex-grow-1">						
								
																<a href="https://ghmat.com/document/page/gallery_view.php?tc=construction&amp;id=544&amp;pronm=prd_all" class="d-block h-100">
																							<img src="https://ghmat.com/document/inc/parseImage_s.php?id=2453" class="img-fluid w-100">
																</a>
								
								</p><h5 class="text-center fs-18 mt-2">카페트</h5>
								<span class="stxt text-center fs-16 ">용인 FENDA 가구 롤카페트 시공</span>
								
								<p></p>				
						
							</div>
						
											
							<div class="proBox3 mt-4 d-flex flex-column align-items-stretch justify-content-between">
								<p class="border flex-grow-1">						
								
																<a href="https://ghmat.com/document/page/gallery_view.php?tc=construction&amp;id=543&amp;pronm=prd_all" class="d-block h-100">
																							<img src="https://ghmat.com/document/inc/parseImage_s.php?id=2448" class="img-fluid w-100">
																</a>
								
								</p><h5 class="text-center fs-18 mt-2">인조잔디</h5>
								<span class="stxt text-center fs-16 ">원주 고산초등학교 인조잔디 시공</span>
								
								<p></p>				
						
							</div>
						
											
							<div class="proBox3 mt-4 d-flex flex-column align-items-stretch justify-content-between">
								<p class="border flex-grow-1">						
								
																<a href="https://ghmat.com/document/page/gallery_view.php?tc=construction&amp;id=542&amp;pronm=prd_all" class="d-block h-100">
																							<img src="https://ghmat.com/document/inc/parseImage_s.php?id=2442" class="img-fluid w-100">
																</a>
								
								</p><h5 class="text-center fs-18 mt-2">부직포&amp;파이텍스</h5>
								<span class="stxt text-center fs-16 ">인천계양체육관 파이텍스 시공</span>
								
								<p></p>				
						
							</div>
						
											
							<div class="proBox3 mt-4 d-flex flex-column align-items-stretch justify-content-between">
								<p class="border flex-grow-1">						
								
																<a href="https://ghmat.com/document/page/gallery_view.php?tc=construction&amp;id=541&amp;pronm=prd_all" class="d-block h-100">
																							<img src="https://ghmat.com/document/inc/parseImage_s.php?id=2422" class="img-fluid w-100">
																</a>
								
								</p><h5 class="text-center fs-18 mt-2">카페트</h5>
								<span class="stxt text-center fs-16 ">미벤트 송파점 롤카페트 시공</span>
								
								<p></p>				
						
							</div>
						
											
							<div class="proBox3 mt-4 d-flex flex-column align-items-stretch justify-content-between">
								<p class="border flex-grow-1">						
								
																<a href="https://ghmat.com/document/page/gallery_view.php?tc=construction&amp;id=540&amp;pronm=prd_all" class="d-block h-100">
																							<img src="https://ghmat.com/document/inc/parseImage_s.php?id=2416" class="img-fluid w-100">
																</a>
								
								</p><h5 class="text-center fs-18 mt-2">인조잔디</h5>
								<span class="stxt text-center fs-16 ">빌라드마리 인조잔디 시공</span>
								
							
						
							</div>
				</div>		
		
				
				<div class="paging pt-5 pb-5 mb-4 d-flex justify-content-center gap-4 align-items-center">
						<!-- 이전 -->
						<span class="prev_arrow d-flex flex-column justify-content-center px-2">
							<svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1.11469 7.50024L6.90094 13.2872C7.01094 13.3972 7.06544 13.5292 7.06444 13.6832C7.06344 13.8372 7.00744 13.9695 6.89644 14.08C6.78544 14.1905 6.65319 14.2457 6.49969 14.2457C6.34619 14.2457 6.21394 14.1905 6.10294 14.08L0.372188 8.35299C0.251188 8.23149 0.162687 8.09649 0.106687 7.94799C0.0511875 7.79849 0.0234375 7.64924 0.0234375 7.50024C0.0234375 7.35124 0.0511875 7.20224 0.106687 7.05324C0.162687 6.90424 0.251188 6.76924 0.372188 6.64824L6.10219 0.915239C6.21269 0.804739 6.34569 0.750239 6.50119 0.751739C6.65619 0.753239 6.78919 0.809239 6.90019 0.919739C7.01019 1.03024 7.06519 1.16249 7.06519 1.31649C7.06519 1.47049 7.01019 1.60274 6.90019 1.71324L1.11469 7.50024Z" fill="black"></path>
							</svg>
						</span>

						<span class='pagelist d-flex gap-4'>
							<a  href='/document/page/gallery_list.php?pronm=prd_all&amp;cpage=1' class="page fw700 px-2">1</a>
							<a  href='/document/page/gallery_list.php?pronm=prd_all&amp;cpage=1' class="page  px-2">2</a>
							<a  href='/document/page/gallery_list.php?pronm=prd_all&amp;cpage=1' class="page  px-2">3</a>
							<a  href='/document/page/gallery_list.php?pronm=prd_all&amp;cpage=1' class="page  px-2">4</a>
							<a  href='/document/page/gallery_list.php?pronm=prd_all&amp;cpage=1' class="page  px-2">5</a>
						</span>					
						
						<!-- 다음 -->
						<span class="next_arrow d-flex flex-column justify-content-center px-2">
							<svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6.88531 7.50025L1.09906 1.71325C0.989062 1.60325 0.934562 1.47125 0.935562 1.31725C0.936562 1.16325 0.992562 1.031 1.10356 0.9205C1.21456 0.81 1.34681 0.754751 1.50031 0.754751C1.65381 0.754751 1.78606 0.81 1.89706 0.9205L7.62781 6.6475C7.74881 6.769 7.83731 6.904 7.89331 7.0525C7.94881 7.202 7.97656 7.35125 7.97656 7.50025C7.97656 7.64925 7.94881 7.79825 7.89331 7.94725C7.83731 8.09625 7.74881 8.23125 7.62781 8.35225L1.89781 14.0852C1.78731 14.1957 1.65431 14.2502 1.49881 14.2487C1.34381 14.2472 1.21081 14.1912 1.09981 14.0807C0.989811 13.9702 0.934812 13.838 0.934812 13.684C0.934812 13.53 0.989811 13.3977 1.09981 13.2872L6.88531 7.50025Z" fill="black"></path>
							</svg>
						</span>
				</div>
			</div>
		</div>
	</div>	

	<script>
//   const kwwrap = document.querySelector('.kw_wrap .contents .subList');
//   const subMn = document.querySelector('.subMn');
//   if (kwwrap) {
//       const kwHeight = kwwrap.offsetHeight;
//       kwwrap.setAttribute('data-height', kwHeight);
//     }

//     if (subMn) {
//       const subHeight = subMn.offsetHeight;
//       subMn.setAttribute('data-height', subHeight);
//     }
    

	window.addEventListener('load', () => {
  const subList = document.querySelector('.subList');
  if (subList) {
    const height = subList.offsetHeight;
    subList.setAttribute('data-height', height);
    console.log('이미지 로드 후 subList 높이:', height);
  }
});
 


		</script>


			
		
					
				
		
		
			<!--//리스트-->
	</div>
	<?php include $kw_path."/inc/quick_sticky.php"; ?>
</div>

<?php include_once($kw_path."/inc/footer_2025.php"); ?>