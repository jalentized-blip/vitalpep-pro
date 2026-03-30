/**
 * VitalPep Pro Pharmaceuticals - Main JavaScript
 *
 * @package VitalPep_Pro
 * @version 1.0.0
 */

(function () {
    'use strict';

    // =========================================
    // HEADER SCROLL EFFECT
    // =========================================
    const header = document.getElementById('siteHeader');
    let lastScroll = 0;

    function handleScroll() {
        const currentScroll = window.pageYOffset;
        if (header) {
            if (currentScroll > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
        lastScroll = currentScroll;
    }

    window.addEventListener('scroll', handleScroll, { passive: true });

    // =========================================
    // MOBILE MENU
    // =========================================
    const mobileToggle = document.getElementById('mobileMenuToggle');
    const mainNav = document.getElementById('mainNav');

    if (mobileToggle && mainNav) {
        mobileToggle.addEventListener('click', function () {
            mainNav.classList.toggle('active');
            const isOpen = mainNav.classList.contains('active');
            mobileToggle.setAttribute('aria-expanded', isOpen);

            // Animate hamburger to X
            const spans = mobileToggle.querySelectorAll('span');
            if (isOpen) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
            } else {
                spans[0].style.transform = '';
                spans[1].style.opacity = '';
                spans[2].style.transform = '';
            }
        });

        // Close menu when clicking a link
        mainNav.querySelectorAll('.main-nav__link').forEach(function (link) {
            link.addEventListener('click', function () {
                mainNav.classList.remove('active');
                mobileToggle.setAttribute('aria-expanded', 'false');
                const spans = mobileToggle.querySelectorAll('span');
                spans[0].style.transform = '';
                spans[1].style.opacity = '';
                spans[2].style.transform = '';
            });
        });
    }

    // =========================================
    // FAQ ACCORDION
    // =========================================
    document.querySelectorAll('.faq-item__question').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const item = this.closest('.faq-item');
            const wasActive = item.classList.contains('active');

            // Close all items in this FAQ list
            const faqList = item.closest('.faq-list');
            if (faqList) {
                faqList.querySelectorAll('.faq-item').forEach(function (i) {
                    i.classList.remove('active');
                });
            }

            // Toggle clicked item
            if (!wasActive) {
                item.classList.add('active');
            }
        });
    });

    // =========================================
    // PRODUCT FILTER PILLS
    // =========================================
    document.querySelectorAll('.filter-pill').forEach(function (pill) {
        pill.addEventListener('click', function () {
            // Update active state
            document.querySelectorAll('.filter-pill').forEach(function (p) {
                p.classList.remove('filter-pill--active');
            });
            this.classList.add('filter-pill--active');

            const filter = this.getAttribute('data-filter');

            // Filter product cards
            document.querySelectorAll('.product-card').forEach(function (card) {
                if (filter === 'all') {
                    card.style.display = '';
                    return;
                }

                const category = card.querySelector('.product-card__category');
                if (category) {
                    const text = category.textContent.toLowerCase();
                    if (text.includes(filter)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });

    // =========================================
    // SCROLL ANIMATIONS (Intersection Observer)
    // =========================================
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -60px 0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(function (el) {
        observer.observe(el);
    });

    // =========================================
    // INQUIRY FORM HANDLING
    // =========================================
    const inquiryForm = document.getElementById('inquiryForm');

    if (inquiryForm) {
        inquiryForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append('action', 'vitalpep_inquiry');

            // Check if WordPress AJAX is available
            if (typeof vitalPep !== 'undefined' && vitalPep.ajaxUrl) {
                formData.append('nonce', vitalPep.nonce);

                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<svg class="btn-icon" style="animation: spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Processing...';
                submitBtn.disabled = true;

                fetch(vitalPep.ajaxUrl, {
                    method: 'POST',
                    body: formData,
                })
                    .then(function (response) { return response.json(); })
                    .then(function (data) {
                        if (data.success) {
                            inquiryForm.style.display = 'none';
                            document.getElementById('inquirySuccess').style.display = 'block';
                        } else {
                            alert(data.data.message || 'An error occurred. Please try again.');
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }
                    })
                    .catch(function () {
                        // Fallback: show success anyway for demo/static mode
                        inquiryForm.style.display = 'none';
                        document.getElementById('inquirySuccess').style.display = 'block';
                    });
            } else {
                // Static mode - just show success
                inquiryForm.style.display = 'none';
                document.getElementById('inquirySuccess').style.display = 'block';
            }
        });

        // Pre-select product from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const productParam = urlParams.get('product');
        if (productParam) {
            const productSelect = document.getElementById('inquiry_product');
            if (productSelect) {
                // Try exact match first
                for (let i = 0; i < productSelect.options.length; i++) {
                    if (productSelect.options[i].value === productParam) {
                        productSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        }
    }

    // =========================================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // =========================================
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                const headerHeight = header ? header.offsetHeight : 0;
                const top = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    });

    // =========================================
    // COUNTER ANIMATION (Stats)
    // =========================================
    function animateCounter(el, target, suffix) {
        let current = 0;
        const increment = target / 40;
        const timer = setInterval(function () {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            el.textContent = Math.floor(current) + (suffix || '');
        }, 30);
    }

    // Observe stat numbers for counter animation
    document.querySelectorAll('.about-stat__number').forEach(function (el) {
        const statObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const text = entry.target.textContent.trim();
                    const match = text.match(/^(\d+)/);
                    if (match) {
                        const num = parseInt(match[1]);
                        const suffix = text.replace(match[1], '');
                        animateCounter(entry.target, num, suffix);
                    }
                    statObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        statObserver.observe(el);
    });

    // =========================================
    // ADD SPIN ANIMATION KEYFRAMES
    // =========================================
    const style = document.createElement('style');
    style.textContent = '@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }';
    document.head.appendChild(style);

    // =========================================
    // PRODUCT REEL — HORIZONTAL SCROLL SHOWCASE
    // =========================================
    (function initProductReel() {
        const track      = document.getElementById('reelTrack');
        const prevBtn    = document.getElementById('reelPrev');
        const nextBtn    = document.getElementById('reelNext');
        const dotsWrap   = document.getElementById('reelDots');
        const counter    = document.getElementById('reelCounter');
        const progressBar = document.getElementById('reelProgressBar');

        if (!track) return;

        const slides    = Array.from(track.querySelectorAll('.reel-slide'));
        const dots      = dotsWrap ? Array.from(dotsWrap.querySelectorAll('.reel-dot')) : [];
        const total     = slides.length;
        let current     = 0;
        let isDown      = false;
        let startX      = 0;
        let scrollLeft  = 0;

        function pad(n) { return String(n).padStart(2, '0'); }

        function goTo(index, smooth) {
            current = Math.max(0, Math.min(index, total - 1));

            // Scroll
            const slideW = track.clientWidth;
            if (smooth === false) {
                track.style.scrollBehavior = 'auto';
            } else {
                track.style.scrollBehavior = 'smooth';
            }
            track.scrollLeft = current * slideW;

            // Dots
            dots.forEach(function(d, i) {
                d.classList.toggle('is-active', i === current);
                d.setAttribute('aria-selected', i === current ? 'true' : 'false');
            });

            // Counter
            if (counter) counter.textContent = pad(current + 1) + ' / ' + pad(total);

            // Progress bar
            if (progressBar) {
                progressBar.style.width = ((current + 1) / total * 100) + '%';
            }

            // Prev/Next buttons
            if (prevBtn) prevBtn.disabled = current === 0;
            if (nextBtn) nextBtn.disabled = current === total - 1;
        }

        // Button clicks
        if (prevBtn) prevBtn.addEventListener('click', function() { goTo(current - 1); });
        if (nextBtn) nextBtn.addEventListener('click', function() { goTo(current + 1); });

        // Dot clicks
        dots.forEach(function(dot) {
            dot.addEventListener('click', function() {
                goTo(parseInt(this.getAttribute('data-index'), 10));
            });
        });

        // Keyboard navigation when reel is focused
        track.setAttribute('tabindex', '0');
        track.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowRight') { e.preventDefault(); goTo(current + 1); }
            if (e.key === 'ArrowLeft')  { e.preventDefault(); goTo(current - 1); }
        });

        // Drag / mouse scroll
        track.addEventListener('mousedown', function(e) {
            isDown = true;
            startX = e.pageX - track.offsetLeft;
            scrollLeft = track.scrollLeft;
            track.classList.add('is-dragging');
            track.style.scrollBehavior = 'auto';
        });

        document.addEventListener('mouseup', function() {
            if (!isDown) return;
            isDown = false;
            track.classList.remove('is-dragging');
            // Snap to nearest slide
            const slideW = track.clientWidth;
            const nearest = Math.round(track.scrollLeft / slideW);
            goTo(nearest);
        });

        track.addEventListener('mousemove', function(e) {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - track.offsetLeft;
            const walk = (x - startX) * 1.5;
            track.scrollLeft = scrollLeft - walk;
        });

        // Touch swipe
        let touchStartX = 0;
        track.addEventListener('touchstart', function(e) {
            touchStartX = e.touches[0].clientX;
        }, { passive: true });

        track.addEventListener('touchend', function(e) {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) {
                goTo(diff > 0 ? current + 1 : current - 1);
            }
        }, { passive: true });

        // Scroll-based sync (for native scroll-snap)
        let scrollTimer;
        track.addEventListener('scroll', function() {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(function() {
                const slideW = track.clientWidth;
                const nearest = Math.round(track.scrollLeft / slideW);
                if (nearest !== current) {
                    current = nearest;
                    dots.forEach(function(d, i) {
                        d.classList.toggle('is-active', i === current);
                    });
                    if (counter) counter.textContent = pad(current + 1) + ' / ' + pad(total);
                    if (progressBar) progressBar.style.width = ((current + 1) / total * 100) + '%';
                    if (prevBtn) prevBtn.disabled = current === 0;
                    if (nextBtn) nextBtn.disabled = current === total - 1;
                }
            }, 80);
        }, { passive: true });

        // Auto-advance every 8s (pauses on hover/focus)
        let autoTimer = setInterval(function() {
            if (current < total - 1) {
                goTo(current + 1);
            } else {
                goTo(0);
            }
        }, 8000);

        const reelSection = document.getElementById('productReel');
        if (reelSection) {
            reelSection.addEventListener('mouseenter', function() { clearInterval(autoTimer); });
            reelSection.addEventListener('focusin',    function() { clearInterval(autoTimer); });
            reelSection.addEventListener('mouseleave', function() {
                autoTimer = setInterval(function() {
                    goTo(current < total - 1 ? current + 1 : 0);
                }, 8000);
            });
        }

        // Init
        goTo(0, false);
    })();

})();


// =========================================
// HERO FLEXPEN — Particles + Mouse Parallax
// =========================================
(function initHeroPen() {
    // Particle generator
    var container = document.getElementById('heroParticles');
    if (container) {
        var colours = [
            'rgba(46,139,192,0.8)',
            'rgba(0,180,216,0.7)',
            'rgba(124,58,237,0.6)',
            'rgba(255,255,255,0.5)'
        ];
        for (var i = 0; i < 22; i++) {
            (function (index) {
                var p = document.createElement('div');
                p.className = 'hero-particle';
                var size  = Math.random() * 4 + 2;
                var left  = Math.random() * 100;
                var delay = Math.random() * 6;
                var dur   = Math.random() * 5 + 4;
                var drift = (Math.random() - 0.5) * 80;
                p.style.cssText = [
                    'width:' + size + 'px',
                    'height:' + size + 'px',
                    'left:' + left + '%',
                    'bottom:' + (Math.random() * 30) + '%',
                    'background:' + colours[index % colours.length],
                    'animation-duration:' + dur + 's',
                    'animation-delay:' + delay + 's',
                    '--px-drift:' + drift + 'px',
                    'box-shadow:0 0 ' + (size * 2) + 'px ' + colours[index % colours.length]
                ].join(';');
                container.appendChild(p);
            })(i);
        }
    }

    // Mouse parallax
    var stage = document.getElementById('heroStage');
    var pen   = document.getElementById('heroPen');
    if (stage && pen) {
        var mx = 0, my = 0, cx = 0, cy = 0;

        stage.addEventListener('mousemove', function (e) {
            var r = stage.getBoundingClientRect();
            mx = ((e.clientX - r.left) / r.width  - 0.5) * 2;
            my = ((e.clientY - r.top)  / r.height - 0.5) * 2;
        });
        stage.addEventListener('mouseleave', function () { mx = 0; my = 0; });

        (function tick() {
            cx += (mx - cx) * 0.06;
            cy += (my - cy) * 0.06;
            pen.style.transform =
                'translateY(' + (cy * -18) + 'px) translateX(' + (cx * 14) + 'px) rotate(-15deg)';
            var orbs = stage.querySelectorAll('.hero-glow, .hero-orbit');
            orbs.forEach(function (el, i) {
                var factor = (i % 2 === 0) ? 0.4 : 0.25;
                el.style.marginLeft = (cx * 10 * factor) + 'px';
                el.style.marginTop  = (cy * 8  * factor) + 'px';
            });
            requestAnimationFrame(tick);
        })();

        stage.addEventListener('mouseenter', function () { pen.style.animation = 'none'; });
        stage.addEventListener('mouseleave', function () {
            pen.style.animation = '';
            pen.style.transform = '';
        });
    }

    // ── Hero Pen Carousel ──
    var carousel = document.getElementById('heroCarousel');
    if (carousel) {
        var slides   = carousel.querySelectorAll('.hero-carousel__slide');
        var dots     = document.querySelectorAll('.hero-carousel__dot');
        var label    = document.getElementById('heroCarouselLabel');
        var current  = 0;
        var total    = slides.length;
        var autoTimer;

        function goToSlide(idx, direction) {
            if (idx === current || total < 2) return;
            var dir = typeof direction === 'number' ? direction : (idx > current ? 1 : -1);

            // Exit current slide
            slides[current].classList.remove('active');

            // Clean up after transition
            var prev = current;
            setTimeout(function () {
                slides[prev].classList.remove('exit-left');
            }, 650);

            // Enter new slide
            slides[idx].classList.add('active');

            // Update dots
            dots[current].classList.remove('active');
            dots[idx].classList.add('active');

            // Update label
            if (label) {
                label.style.opacity = '0';
                setTimeout(function () {
                    label.textContent = slides[idx].getAttribute('data-label');
                    label.style.opacity = '1';
                }, 200);
            }

            current = idx;
            resetAuto();
        }

        function nextSlide() { goToSlide((current + 1) % total, 1); }
        function prevSlide() { goToSlide((current - 1 + total) % total, -1); }

        function resetAuto() {
            clearInterval(autoTimer);
            autoTimer = setInterval(nextSlide, 4000);
        }

        // Dot click handlers
        dots.forEach(function (dot) {
            dot.addEventListener('click', function () {
                goToSlide(parseInt(this.getAttribute('data-index'), 10));
            });
        });

        // Touch/swipe support
        var touchStartX = 0, touchEndX = 0;
        var penWrap = document.getElementById('heroPen');
        if (penWrap) {
            penWrap.addEventListener('touchstart', function (e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });
            penWrap.addEventListener('touchend', function (e) {
                touchEndX = e.changedTouches[0].screenX;
                var diff = touchStartX - touchEndX;
                if (Math.abs(diff) > 40) {
                    if (diff > 0) nextSlide();
                    else prevSlide();
                }
            }, { passive: true });
        }

        // Entrance animation for first slide
        slides[0].classList.remove('active');
        setTimeout(function () {
            slides[0].classList.add('active');
        }, 300);

        // Start auto-rotation
        resetAuto();
    }
})();
