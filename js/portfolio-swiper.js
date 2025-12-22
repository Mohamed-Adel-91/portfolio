(function () {
    'use strict';

    var items = Array.isArray(window.PORTFOLIO_ITEMS) ? window.PORTFOLIO_ITEMS : [];
    var swiperEl = document.querySelector('.portfolio-swiper');
    var wrapperEl = swiperEl ? swiperEl.querySelector('.swiper-wrapper') : null;
    var emptyEl = document.querySelector('.portfolio-empty');
    var nextEl = swiperEl ? swiperEl.querySelector('.swiper-button-next') : null;
    var prevEl = swiperEl ? swiperEl.querySelector('.swiper-button-prev') : null;
    var paginationEl = swiperEl ? swiperEl.querySelector('.swiper-pagination') : null;
    var swiperInstance = null;

    if (!swiperEl || !wrapperEl) {
        return;
    }

    function escapeHtml(value) {
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function chunk(array, size) {
        var chunks = [];
        for (var i = 0; i < array.length; i += size) {
            chunks.push(array.slice(i, i + size));
        }
        return chunks;
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

    function toggleEmpty(show) {
        if (emptyEl) {
            emptyEl.classList.toggle('d-none', !show);
        }
        swiperEl.classList.toggle('d-none', show);
    }

    function render(data) {
        var filtered = data.filter(function (item) {
            return item && item.image;
        });

        destroySwiper();
        if (!filtered.length) {
            wrapperEl.innerHTML = '';
            toggleEmpty(true);
            return;
        }

        toggleEmpty(false);
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
        document.querySelectorAll('.portfolio-filter-menu li').forEach(function (item) {
            item.classList.remove('active');
        });
        target.classList.add('active');
    }

    document.querySelectorAll('.portfolio-filter-menu li').forEach(function (item) {
        item.addEventListener('click', function () {
            var filterId = normalizeFilter(item.getAttribute('data-filter'));
            setActive(item);
            render(filterItems(filterId));
        });
    });

    if (items.length === 0) {
        toggleEmpty(true);
        return;
    }

    initSwiper();
})();
