<section id="designGallery" class='py-lg-5 overflow-x-hidden vw-100'>
	<div class="max-width mx-auto py-lg-4 py-3 ">
		<h2 class='fw400 fs-33 line-height-1 px-3 px-lg-4 mb-lg-4 mb-4 d-flex flex-wrap gap-2 align-items-center  justify-content-center justify-content-lg-start letter-spacing-0-5'>
			<strong class='active-color fs-37 fw700 col-12 text-center text-lg-start col-lg-auto'>
				시공갤러리
			</strong>
			20년 시공노하우로 완성한 공간들
		</h2>
		<div class="swiper overflow-visible">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div class="imgThumb">
						<a href="" class='d-block'><img src="<?php echo $kw_url.'/img/2025/product/gallery0.jpg'; ?>" alt=""></a>
						<a href="" class='d-flex flex-column  align-items-center gap-2 my-3 line-height-1'>
							<span class='fs-20 fw500 pb-1 gray-text'>현관매트</span>
							<span class='fs-16 fw600  pb-1 active-color'>로고매트, 브러쉬 조립매트</span>
							<span class='fs-16 fw600'>서울삼각산초등학교 각 출입구</span>
						</a>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="imgThumb">
						<a href="" class='d-block'><img src="<?php echo $kw_url.'/img/2025/product/gallery1.jpg'; ?>" alt=""></a>
						<a href="" class='d-flex flex-column  align-items-center gap-2 my-3 line-height-1'>
							<span class='fs-20 fw500 pb-1 gray-text'>현관매트</span>
							<span class='fs-16 fw600  pb-1 active-color'>로고매트, 브러쉬 조립매트</span>
							<span class='fs-16 fw600'>서울삼각산초등학교 각 출입구</span>
						</a>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="imgThumb">
						<a href="" class='d-block'><img src="<?php echo $kw_url.'/img/2025/product/gallery2.jpg'; ?>" alt=""></a>
						<a href="" class='d-flex flex-column  align-items-center gap-2 my-3 line-height-1'>
							<span class='fs-20 fw500 pb-1 gray-text'>현관매트</span>
							<span class='fs-16 fw600  pb-1 active-color'>로고매트, 브러쉬 조립매트</span>
							<span class='fs-16 fw600'>서울삼각산초등학교 각 출입구</span>
						</a>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="imgThumb">
						<a href="" class='d-block'><img src="<?php echo $kw_url.'/img/2025/product/gallery3.jpg'; ?>" alt=""></a>
						<a href="" class='d-flex flex-column  align-items-center gap-2 my-3 line-height-1'>
							<span class='fs-20 fw500 pb-1 gray-text'>현관매트</span>
							<span class='fs-16 fw600  pb-1 active-color'>로고매트, 브러쉬 조립매트</span>
							<span class='fs-16 fw600'>서울삼각산초등학교 각 출입구</span>
						</a>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="imgThumb">
						<a href="" class='d-block'><img src="<?php echo $kw_url.'/img/2025/product/gallery4.jpg'; ?>" alt=""></a>
						<a href="" class='d-flex flex-column  align-items-center gap-2 my-3 line-height-1'>
							<span class='fs-20 fw500 pb-1 gray-text'>현관매트</span>
							<span class='fs-16 fw600  pb-1 active-color'>로고매트, 브러쉬 조립매트</span>
							<span class='fs-16 fw600'>서울삼각산초등학교 각 출입구</span>
						</a>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="imgThumb">
						<a href="" class='d-block'><img src="<?php echo $kw_url.'/img/2025/product/gallery5.jpg'; ?>" alt=""></a>
						<a href="" class='d-flex flex-column  align-items-center gap-2 my-3 line-height-1'>
							<span class='fs-20 fw500 pb-1 gray-text'>현관매트</span>
							<span class='fs-16 fw600  pb-1 active-color'>로고매트, 브러쉬 조립매트</span>
							<span class='fs-16 fw600'>서울삼각산초등학교 각 출입구</span>
						</a>
					</div>
				</div>
				
			</div>
		</div>
		<div class="d-flex justify-content-center py-lg-4 py-3">
			<a href="" class="border border-dark px-5 py-2 fs-18 fw500  text-center rounded-5 mt-3">시공사례 전체보기</a>
		</div>

	</div>
	<script>

	// const kw_main_swiper_gallery = new Swiper('#designGallery .swiper', {
	// 	loop: true,
	// 	slidesPerView: 4,
	// 	spaceBetween: 25,
	// 	loopedSlides: 6,
	// 	autoplay: {
	// 		delay: 5000,
	// 		disableOnInteraction: false,
	// 	},

	// 	watchSlidesProgress: true,
	// 	watchSlidesVisibility: true,
	// 	on: {
	// 		slideChangeTransitionEnd() {
	// 			this.slides.forEach(slide => {
	// 				slide.classList.toggle('dimmed', !slide.classList.contains('swiper-slide-visible'));
	// 			});
	// 		}
	// 	}
		
	// });

	const kw_main_swiper_gallery = new Swiper('#designGallery .swiper', {
    loop: true,
    slidesPerView: 4,       // 기본값 (1300px 이상)
    spaceBetween: 25,       // 기본 간격
    loopedSlides: 6,
    // autoplay: {
    //     delay: 5000,
    //     disableOnInteraction: false,
    // },
    watchSlidesProgress: true,
    watchSlidesVisibility: true,

    breakpoints: {
        1300: { // 1300px 이상
            slidesPerView: 4,
            spaceBetween: 25,
            centeredSlides: false
        },
        1080: { // 1080px 이상 ~ 1299px
            slidesPerView: 3,
            spaceBetween: 16,
            centeredSlides: true
        },
        768: {  // 768px 이상 ~ 1079px
            slidesPerView: 1,
            spaceBetween: 16,
            centeredSlides: true
        },
        0: { // 0px 이상 ~ 767px
            slidesPerView: 1,
            spaceBetween: 16,
            centeredSlides: true
        }
    },

    on: {
    //    slideChangeTransitionEnd() {
    //     updateDimmed(this);
	// 	},
	// 	breakpoint() { // 브레이크포인트 바뀔 때도 호출
	// 		updateDimmed(this);
	// 	}
    }
});

// function updateDimmed(swiper) {
//     swiper.slides.forEach(slide => {
//         slide.classList.toggle(
//             'dimmed',
//             !slide.classList.contains('swiper-slide-visible')
//         );
//     });
// }


</script>
	
</section>