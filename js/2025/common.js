document.addEventListener('DOMContentLoaded', () => {
  enableSmoothScrollToTop();
  enableStickyNav();
  bindModalToggle(".searchicon a");

  const quickSticky = document.getElementById('quick_sticky');
  const wrapper = document.querySelector('.mainContentwrapper');

  if (!quickSticky || !wrapper) return;

  let wrapperTop = 0;
  let wrapperHeight = 0;
  let isFixed = false;
  let isAtBottom = false;

  const updateTriggerOffset = () => {
    wrapperTop = wrapper.offsetTop;
    wrapperHeight = wrapper.offsetHeight;
    console.log('[DELAYED] 퀵메뉴 위치 재계산 → top:', wrapperTop, 'height:', wrapperHeight);
  };

  const onScroll = () => {
    const scrollY = window.scrollY;
    const windowHeight = window.innerHeight;
    const quickHeight = quickSticky.offsetHeight;
    const wrapperBottom = wrapperTop + wrapperHeight;
    const quickBottom = scrollY + quickHeight + 10; // 10px 여유
  
    // fix 상태로 전환
    if (scrollY >= wrapperTop && quickBottom < wrapperBottom) {
      if (!isFixed) {
        quickSticky.classList.add('fixquick');
        quickSticky.classList.remove('bottom-position');
        isFixed = true;
        isAtBottom = false;
      }
    }
    // 하단 도달 시
    else if (quickBottom >= wrapperBottom) {
      if (!isAtBottom) {
        quickSticky.classList.remove('fixquick');
        quickSticky.classList.add('bottom-position');
        isFixed = false;
        isAtBottom = true;
      }
    }
    // 초기화
    else if (scrollY < wrapperTop) {
      quickSticky.classList.remove('fixquick');
      quickSticky.classList.remove('bottom-position');
      isFixed = false;
      isAtBottom = false;
    }
  };
  
  

  // 최초 위치 계산을 약간 지연해서 실행 (이미지 로딩 대기 목적)
  setTimeout(() => {
    updateTriggerOffset();
    onScroll(); // 현재 스크롤 위치에 맞게 즉시 적용
  }, 500); // 필요시 1000까지 조정 가능

  // 리사이즈 이벤트도 반영
  window.addEventListener('resize', () => {
    updateTriggerOffset();
    onScroll();
  });

  window.addEventListener('scroll', onScroll, { passive: true });
});


function bindModalToggle(triggerSelector) {
  const trigger = document.querySelector(triggerSelector);
  if (!trigger) return;

  trigger.addEventListener('click', (e) => {
    e.preventDefault();

    document.body.classList.remove("nav_open");
    const href = e.target.closest('a')?.getAttribute('href');
    if (!href || !href.startsWith('#')) return;

    const targetId = href.slice(1);
    const targetModal = document.getElementById(targetId);
    if (!targetModal) return;

    // 토글 show 클래스
    const isOpen = targetModal.classList.contains('show');
    targetModal.classList.toggle('show');
    trigger.classList.toggle('ok');

    if (!isOpen) {
      // 스크롤 시 자동 닫기
      const onScroll = () => {
        targetModal.classList.remove('show');
         trigger.classList.remove('ok');
        window.removeEventListener('scroll', onScroll);
      };
      window.addEventListener('scroll', onScroll, { once: true });
    }
  });
}

function enableSmoothScrollToTop() {
    const topLinks = document.querySelectorAll('a[href="#top"]');
    const scrollTarget = document.scrollingElement || document.documentElement;

    topLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            scrollTarget.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
}

function enableStickyNav() {
    const nav = document.querySelector('#hd .menu');
    if (!nav) return;

    const navTop = nav.getBoundingClientRect().top + window.scrollY;

    window.addEventListener('scroll', () => {
        const isSticky = window.scrollY >= navTop;
        nav.classList.toggle('fixed-top', isSticky);
        document.body.classList.remove("nav_open")
    });
}

// body에 클래스 적용하는 함수 

function toggleBodyClassFromElement(el) {
 // const scrollBarWidth = window.innerWidth - document.documentElement.clientWidth;
  //스크롤너비저장해두기 // 팝업없어질때 덜컹거림막음
  const className = el.getAttribute('data-body-cls');
  if (!className) return; // 속성 없으면 무시
  document.documentElement.classList.toggle(className);
  document.body.classList.toggle(className);

 document.querySelector(".searchicon a").classList.remove('ok');
 document.querySelector("#searchModal").classList.remove("show")

  // const isActive = document.body.classList.contains(className);
  // if (isActive) {
      
  //   document.body.style.paddingRight = `${scrollBarWidth}px`;
  // } else {   
  //   document.body.style.paddingRight = '';
  // }
}


