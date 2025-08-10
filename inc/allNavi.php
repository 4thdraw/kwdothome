<nav id="nav_open" class="position-absolute start-0 top-100 max-width bg-white mx-auto  end-0 border-top" role="dialog" aria-modal="true" aria-label="전체 메뉴">
  <div class=" position-relative px-3 px-xl-4 py-xl-4">

    <!-- 닫기 버튼 -->
    <!-- <button type="button" onClick="toggleBodyClassFromElement(this)" data-body-cls="nav_open" class="close-button d-none position-absolute end-0 top-0 translate-top-y" aria-label="메뉴 닫기">
        <svg width="56" height="56" class='scale70' viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.25537 54.8721L55 1.12744M55 54.8721L1.25537 1.12744" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button> -->

    <ul class="nav-main fs-18 fw500 text-nowrap line-height-1 " role="menu">


      <!-- <li role="none" class='border-bottom border-dark d-none flex-xl-row flex-column flex justify-content-xl-between align-items-xl-center py-5'>
        <h2 class="menu-title fs-35 fw600 mb-3 mb-xl-0">강화카페트&amp;매트</h2>
        <ul role="menu" class='d-flex  flex-wrap flex-xl-nowrap  gap-xl-4 gap-2 ' aria-label="강화카페트 메뉴">
          <li role="menuitem"><a href="<?php //echo $kw_url; ?>/page/company.php?skey1=001&skey2=001001&board=회사소개&boarden=company">회사소개</a></li>
          <li role="menuitem"><a href="<?php //echo $kw_url; ?>/page/company.php?skey1=001&skey2=001001&board=오시는길&boarden=Directions">오시는길</a></li>
          <li role="menuitem"><a href="#">시공가이드</a></li>
          <li role="menuitem"><a href="#">시공갤러리</a></li>
         
          <li role="menuitem"><a href="<?php //echo $kw_url; ?>/page/board_write.php?skey1=001&skey2=001001&board=견적문의&boarden=Inquiries">견적문의</a></li>
        </ul>
      </li> -->

   
      <li role="none" class='pt-3 py-4'>
        <!-- <h2 class="menu-title fs-35 fw600 mb-3 mb-xl-0 d-none">제품보기</h2> -->
        <ul role="menu"  class='wide_menu' aria-label="제품보기 메뉴">
          <li role="menuitem" class='position-relative   '>
            <a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=carpet" class='border-bottom' >카페트</a>
            <ul role="menu"  class='d-flex  flex-column  gap-2 submenu  pt-3 fs-15 line-height-1' aria-label="카페트 하위 메뉴">
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=carpet&submenu=롤카페트">롤카페트</a></li>
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=carpet&submenu=타일카페트">타일카페트</a></li>
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=carpet&submenu=제작카페트">제작카페트</a></li>
            </ul>
          </li>
          <li role="menuitem" class='position-relative    '>
            <a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=003&skey2=003001&boarden=artificial_grass" class='border-bottom'>인조잔디</a>
            <ul role="menu"  class='d-flex  flex-column  gap-2 submenu  pt-3 fs-15 line-height-1'  aria-label="인조잔디 하위 메뉴">
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=003&skey2=003001&boarden=artificial_grass&submenu=실내용">실내용</a></li>
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=003&skey2=003001&boarden=carpet&submenu=실외용">실외용</a></li>
            </ul>
          </li>
          <li role="menuitem" class='position-relative      '>
            <a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=002&skey2=002001&boarden=entrance_mat" class='border-bottom'>현관매트</a>
            <ul role="menu"  class='d-flex  flex-column  gap-2 submenu  pt-3 fs-15 line-height-1' aria-label="현관매트 하위 메뉴">
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=002&skey2=002001&boarden=entrance_mat&submenu=알루미늄매트">알루미늄매트</a></li>
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=002&skey2=002001&boarden=entrance_mat&submenu=코일매트">코일매트</a></li>
            </ul>
          </li>
          <li role="menuitem" class='position-relative    '>
            <a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=010&skey2=010001&boarden=rubber_pvc" class='border-bottom'>고무/PVC</a>
            <ul role="menu"  class='d-flex  flex-column  gap-2 submenu  pt-3 fs-15 line-height-1' aria-label="고무/PVC 하위 메뉴">
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=010001&boarden=rubber_pvc&submenu=고무매트">고무매트</a></li>
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=010001&boarden=rubber_pvc&submenu=PVC타일">PVC타일</a></li>
            </ul>
          </li>
          <li role="menuitem" class='position-relative  '>
            <a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=industrial_mat" class='border-bottom'>산업용매트</a>
            <ul role="menu"  class='d-flex  flex-column  gap-2 submenu  pt-3 fs-15 line-height-1' aria-label="산업용매트 하위 메뉴">
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=industrial_mat&submenu=작업장매트">작업장매트</a></li>
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=industrial_mat&submenu=논슬립매트">논슬립매트</a></li>
            </ul>
          </li>
          <li role="menuitem" class='position-relative  '>
            <a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=phytex" class='border-bottom'>파이텍스</a>
            <ul role="menu"  class='d-flex  flex-column  gap-2 submenu  pt-3 fs-15 line-height-1' aria-label="파이텍스 하위 메뉴">
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=phytex&submenu=인테리어용">인테리어용</a></li>
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=phytex&submenu=산업용">산업용</a></li>
            </ul>
          </li>
          <li role="menuitem" class='position-relative   '>
          <a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=multipurpose_flooring" class='border-bottom'>다목적바닥재</a>
            <ul role="menu"  class='d-flex  flex-column  gap-2 submenu  pt-3 fs-15 line-height-1' aria-label="다목적바닥재 하위 메뉴">
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=multipurpose_flooring&submenu=가정용">가정용</a></li>
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=multipurpose_flooring&submenu=상업용">상업용</a></li>
            </ul>
          </li>
          <li role="menuitem" class='position-relative   '>
            <a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=accessories" class='border-bottom'>부자재</a>
            <ul role="menu"  class='d-flex  flex-column  gap-2 submenu  pt-3 fs-15 line-height-1' aria-label="부자재 하위 메뉴">
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=accessories&submenu=테이프">테이프</a></li>
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=accessories&submenu=몰딩">몰딩</a></li>
            </ul>
          </li>
          <li role="menuitem" class='position-relative   '>
            <a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=custom_order" class='border-bottom'>주문제작</a>
            <ul role="menu"  class='d-flex  flex-column  gap-2 submenu  pt-3 fs-15 line-height-1' aria-label="주문제작 하위 메뉴">
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=custom_order&submenu=디자인 매트">디자인 매트</a></li>
              <li role="menuitem"><a href="<?php echo $kw_url; ?>/page/prd_list.php?skey1=001&skey2=001001&boarden=custom_order&submenu=로고매트">로고매트</a></li>
            </ul>
          </li>
        </ul>
      </li>

      <!-- 공간별추천 (하위메뉴 없음) -->
      <!-- <li role="none"  class='border-bottom border-dark d-none flex-xl-row flex-column flex justify-content-xl-between align-items-xl-center  py-5'>
        <h2 class="menu-title fs-35 fw600  mb-3 mb-xl-0">공간별추천</h2>
        <ul role="menu"  class='d-flex flex-wrap flex-xl-nowrap  gap-xl-4 gap-2 ' aria-label="공간별추천 메뉴">
          <li role="menuitem"><a href="#">건물현관</a></li>
          <li role="menuitem"><a href="#">옥상/테라스</a></li>
          <li role="menuitem"><a href="#">공장/산업시설</a></li>
          <li role="menuitem"><a href="#">학교/유치원</a></li>
          <li role="menuitem"><a href="#">행사장</a></li>
          <li role="menuitem"><a href="#">수영장/사우나</a></li>
          <li role="menuitem"><a href="#">스포츠시설</a></li>
        </ul>
      </li> -->

    </ul>

  </div>
</nav>
