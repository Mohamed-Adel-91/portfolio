(function () {
    'use strict';

    function onReady() {
        var items = Array.isArray(window.PORTFOLIO_ITEMS) ? window.PORTFOLIO_ITEMS : [];
        var swiperEl = document.querySelector('.portfolio-swiper');
        var wrapperEl = swiperEl ? swiperEl.querySelector('.swiper-wrapper') : null;
        var emptyEl = document.querySelector('.portfolio-empty');
        var nextEl = swiperEl ? swiperEl.querySelector('.swiper-button-next') : null;
        var prevEl = swiperEl ? swiperEl.querySelector('.swiper-button-prev') : null;
        var paginationEl = swiperEl ? swiperEl.querySelector('.swiper-pagination') : null;
        var swiperInstance = null;
        var isAnimating = false;
        var animationDuration = 500;
        var activeFilterEl = document.querySelector('.portfolio-filter-menu li.active');

        if (!swiperEl || !wrapperEl) {
            return;
        }

        wrapperEl.classList.add('portfolio-grid-3d');
        wrapperEl.classList.remove('portfolio-animating-out', 'portfolio-animating-in');

        function escapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }

        function getEmptyMessage() {
            if (emptyEl && emptyEl.textContent) {
                return emptyEl.textContent.trim();
            }
            return 'No portfolio items yet.';
        }

        function chunk(array, size) {
            var chunks = [];
            for (var i = 0; i < array.length; i += size) {
                chunks.push(array.slice(i, i + size));
            }
            return chunks;
        }

        function buildEmptySlide() {
            return (
                '<div class="swiper-slide">' +
                '<div class="row no-gutters">' +
                '<div class="col-12">' +
                '<p class="text-center text-muted">' +
                escapeHtml(getEmptyMessage()) +
                '</p>' +
                '</div>' +
                '</div>' +
                '</div>'
            );
        }

        function buildCard(item) {
            if (!item || !item.image) {
                return '';
            }

            var category = item.category !== undefined && item.category !== null ? String(item.category) : '';
            var title = item.title ? String(item.title) : '';
            var subtitle = item.subtitle ? String(item.subtitle) : '';
            var badge = item.badge ? String(item.badge) : '';
            var link = item.link ? String(item.link) : '#';
            var image = String(item.image);
            var cardClass = category === '2' ? 'event-portfolio-card' : 'portfolio-card';
            var badgeHtml = badge
                ? '<span class="badge badge-warning ml-2">' + escapeHtml(badge) + '</span>'
                : '';

            return (
                '<div class="col-md-4 col-sm-6 col-xs-12 mb-4 filtr-item" data-category="' +
                escapeHtml(category) +
                '">' +
                '<div class="content-image ' +
                cardClass +
                ' portfolio-card">' +
                '<a href="' +
                escapeHtml(link) +
                '" class="portfolio-popup portfolio-card-inner">' +
                '<img src="' +
                escapeHtml(image) +
                '" alt="' +
                escapeHtml(title) +
                '">' +
                '<div class="image-overlay"></div>' +
                '<div class="portfolio-caption">' +
                '<div class="title">' +
                '<h4>' +
                escapeHtml(title) +
                '</h4>' +
                '</div>' +
                '<div class="subtitle d-flex align-items-center">' +
                '<span>' +
                escapeHtml(subtitle) +
                '</span>' +
                badgeHtml +
                '</div>' +
                '</div>' +
                '</a>' +
                '</div>' +
                '</div>'
            );
        }

        function buildSlides(data) {
            var slides = chunk(data, 9);
            var html = '';

            slides.forEach(function (slideItems) {
                var itemsHtml = slideItems.map(buildCard).join('');
                html +=
                    '<div class="swiper-slide">' +
                    '<div class="row no-gutters">' +
                    itemsHtml +
                    '</div>' +
                    '</div>';
            });

            return html;
        }

        function destroySwiper() {
            if (swiperInstance) {
                swiperInstance.destroy(true, true);
                swiperInstance = null;
            }
        }

        function initSwiper() {
            if (typeof Swiper !== 'function') {
                return;
            }

            swiperInstance = new Swiper(swiperEl, {
                slidesPerView: 1,
                spaceBetween: 24,
                autoHeight: true,
                watchOverflow: true,
                navigation: {
                    nextEl: nextEl,
                    prevEl: prevEl
                },
                pagination: {
                    el: paginationEl,
                    clickable: true
                }
            });
        }

        function render(data) {
            var filtered = data.filter(function (item) {
                return item && item.image;
            });

            destroySwiper();

            if (!filtered.length) {
                wrapperEl.innerHTML = buildEmptySlide();
                if (emptyEl) {
                    emptyEl.classList.add('d-none');
                }
                swiperEl.classList.remove('d-none');
                initSwiper();
                return;
            }

            if (emptyEl) {
                emptyEl.classList.add('d-none');
            }
            swiperEl.classList.remove('d-none');
            wrapperEl.innerHTML = buildSlides(filtered);
            initSwiper();
        }

        function normalizeFilter(filterId) {
            if (!filterId || filterId === 'all' || filterId === '0') {
                return 'all';
            }
            return String(filterId);
        }

        function filterItems(filterId) {
            if (filterId === 'all') {
                return items.slice();
            }

            return items.filter(function (item) {
                return item && String(item.category) === filterId;
            });
        }

        function setActive(target) {
            if (!target) {
                return;
            }

            document.querySelectorAll('.portfolio-filter-menu li').forEach(function (item) {
                item.classList.remove('active');
            });
            target.classList.add('active');
            activeFilterEl = target;
        }

        function animateAndRebuild(filterId) {
            isAnimating = true;
            wrapperEl.classList.remove('portfolio-animating-in');
            wrapperEl.classList.add('portfolio-animating-out');

            window.setTimeout(function () {
                render(filterItems(filterId));
                wrapperEl.classList.remove('portfolio-animating-out');
                wrapperEl.classList.add('portfolio-animating-in');
                isAnimating = false;
            }, animationDuration);
        }

        document.querySelectorAll('.portfolio-filter-menu li').forEach(function (item) {
            item.addEventListener('click', function (event) {
                if (isAnimating) {
                    if (activeFilterEl) {
                        setActive(activeFilterEl);
                    }
                    return;
                }

                var target = event.currentTarget;
                var filterId = normalizeFilter(target.getAttribute('data-filter'));
                setActive(target);
                animateAndRebuild(filterId);
            });
        });

        if (items.length === 0) {
            render(items);
            return;
        }

        if (emptyEl) {
            emptyEl.classList.add('d-none');
        }
        initSwiper();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', onReady);
    } else {
        onReady();
    }
})();
