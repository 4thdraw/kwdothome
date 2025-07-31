
	
<?php
   define('KW_PATH',$_SERVER['DOCUMENT_ROOT']);
    // 웹 브라우저용 URL 경로
	$host = $_SERVER['HTTP_HOST'];
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
	define('KW_URL', $protocol . $host);
?>
<div id="wrap" >
<!--상단-->


 <header id="hd">
        <div class="ad d-flex justify-content-center active-bg text-white fw400 fs-13  line-height-1 py-2">
            <p class="py-1 d-flex gap-2">
                Since 2004 <span class="bar bg-white"></span> 
                누적시공 4500건 이상 <span class="bar bg-white"></span> 
                <strong class="fw500">바닥재 판매 · 시공전문 </strong>
            </p>
        </div>
         <div class="max-width mx-auto d-flex justify-content-between align-items-center gnbwrap"> 
            <h1 class="w-0"><a href="/index_2025.html">                   
               
			<?php include(KW_PATH."/img/2025/logo/mainlogo.html"); ?>
				
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
	
			<div class="menu  border-top border-bottom  py-1 ">
                <ul class="mx-auto max-width py-2 navilist fw600 fs-20 d-flex justify-content-between align-items-center">
                      <li id="allmenu" class="navili">
						<a href="#allNavi" class="d-flex flex-column align-items-center" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="allNavi">
							
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<line x1="3" y1="12" x2="21" y2="12"></line>
								<line x1="3" y1="6" x2="21" y2="6"></line>
								<line x1="3" y1="18" x2="21" y2="18"></line>
							</svg>
								<span class="visually-hidden">전체메뉴</span>
							
						</a>
					  </li>
                      <li class="navili"><a href="">제품보기</a></li>
                      <li class="navili"><a href="">공간별추천</a></li>
                      <li class="navili"><a href="">시공갤러리</a></li>
                      <li class="navili"><a href="">시공가이드</a></li>
                      <li class="navili"><a href="">주문제작</a></li>
                      <li class="navili"><a href="" class="orange-color">견적문의</a></li>
                </ul>
				
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