document.addEventListener('DOMContentLoaded', () => {

    enableSmoothScrollToTop();
    enableStickyNav();

    // 퀵메뉴 상단  fix 로 인한 sticky  불가
    const quickSticky = document.getElementById('quick_sticky');
    const wrapper = document.querySelector('.mainContentwrapper');
   
    // 실행
    bindModalToggle(".searchicon a");

    

    
   if (!quickSticky || !wrapper) return;

    // 기준 위치 계산
    let wrapperTop = wrapper.offsetTop;
    let wrapperHeight = wrapper.offsetHeight;

    let isFixed = false;
    let isAtBottom = false;

    const updateTriggerOffset = () => {
      wrapperTop = wrapper.offsetTop;
      wrapperHeight = wrapper.offsetHeight;
    };

    const onScroll = () => {
    const scrollY = window.scrollY;
    const scrollBottom = scrollY + window.innerHeight;
    const wrapperBottom = wrapperTop + wrapperHeight;
    // const quickHeight = quickSticky.offsetHeight;

    // 상태 1: fix 상태
    if (scrollY >= wrapperTop && scrollBottom < wrapperBottom) {
      if (!isFixed) {
        quickSticky.classList.add('fixquick');        
        quickSticky.classList.remove('bottom-position')
        isFixed = true;
        isAtBottom = false;
      }
    }
    // 상태 2: wrapper 하단 도달 → fix 해제하고 absolute bottom 처리
    else if (scrollBottom >= wrapperBottom) {
      if (!isAtBottom) {
        quickSticky.classList.remove('fixquick');       
        quickSticky.classList.add('bottom-position')
        isAtBottom = true;
        isFixed = false;
      }
    }
    // 상태 3: 위로 올라감 → 초기화
    else if (scrollY < wrapperTop) {
      quickSticky.classList.remove('fixquick');     
      quickSticky.classList.remove('bottom-position')
      isFixed = false;
      isAtBottom = false;
    }
  };

    window.addEventListener('scroll', onScroll, { passive: true });
      window.addEventListener('resize', () => {
        updateTriggerOffset();
        onScroll(); // 리사이즈 후 즉시 위치 반영
      });
   

  
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


