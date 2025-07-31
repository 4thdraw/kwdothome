
<?php
 include_once(KW_PATH."/inc/footer_custom.php");
 ?>
<!--하단 -->
<footer id="ft">
  
    <div class='border-top border-bottom py-1'>
        <div class="max-width mx-auto d-flex justify-content-between align-items-center">
            <nav>
                <ul class='d-flex justify-content-between align-items-center gap-5 fs-18 fw500 text-nowrap'>
                    <li><a href="#">홈</a></li>
                    <li><a href="#">회사소개</a></li>
                    <li><a href="#">이용안내</a></li>
                    <li><a href="#">개인정보취급방침</a></li>
                    <li><a href="#">오시는길</a></li>
                </ul>
            </nav>
            <div class="certification d-flex justify-content-between align-items-center gap-3">
                <img src="<?php echo KW_URL.'/img/2025/mark/brand005.png'; ?>" class='ssl' alt="Alpha SSL 인증마크">
                <img src="<?php echo KW_URL.'/img/2025/mark/img_escrow_mark2.jpg'; ?>" class='kb' alt="에스크로 인증마크">
                <img src="<?php echo KW_URL.'/img/2025/mark/ct_logo.jpg'; ?>" class='ct' alt="개인정보보호 인증마크">
            </div>
        </div>
    </div>
    <div class="max-width mx-auto footer-info d-flex gap-5  py-5">
        <div class="logo ">
            <?php include(KW_PATH."/img/2025/logo/mainlogo.html"); ?>
        </div>
        <div class="company-details fs-15 d-flex flex-column justify-content-center  ">
            <div class='d-flex flex-wrap gap-3 mt-2'>
                <p><strong>주소</strong> 인천광역시 남동구 고잔동 632-7번지 상일빌딩 1층 1호 </p>
                <p><strong>TEL</strong> 1661-8849</p> 
                <p><strong>FAX</strong> 032-811-9011</p>
                <p><strong>E-Mail</strong> ghm6029@hanmail.net</p>
            </div>           
            <div class='d-flex flex-wrap gap-3 mt-1'>
                <p><strong>상호명</strong> 상화카페트&amp;매트</p>
                <p><strong>대표</strong> 안상녀</p> 
                <p><strong>사업자등록번호</strong> 131-26-99277 </p>
                <p><button type="button" class='border bg-white py-1 px-2 fs-13 border-gray'>사업자정보 조회하기</button></p>
                <p><strong>통신판매업신고</strong> 제2013-인천남동구-0047호</p>
                <p><strong>개인정보관리책임자</strong> 안상녀</p>
            </div>          
        </div>
    </div>
    <div class='active-bg text-white  py-3  d-flex fw500 fs-16 line-height-1  justify-content-center align-items-center gap-2 
    '>
        <p class='mb-0'>Copyright ⓒ GHMAT. all rights reserved</p> 
        <a href="" class='active-text bg-white admin_a d-flex align-items-center justify-content-center'>
            A
            <span class='visually-hidden'>관라자페이지</span>
        </a>    

    </div>
</footer>




</body>
</html>

