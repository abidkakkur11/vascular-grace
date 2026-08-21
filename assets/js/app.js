/**
 * Vascular Grace - Interactivity & Components
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Navigation Toggle & Offcanvas
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileNav = document.getElementById('mobile-nav');
    const mobileBackdrop = document.getElementById('mobile-backdrop');
    
    const closeMobileNav = () => {
        if (mobileNav) mobileNav.classList.remove('open');
        if (mobileBackdrop) mobileBackdrop.classList.remove('open');
        if (mobileMenuBtn) {
            mobileMenuBtn.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>';
        }
        document.body.style.overflow = '';
    };

    const openMobileNav = () => {
        if (mobileNav) mobileNav.classList.add('open');
        if (mobileBackdrop) mobileBackdrop.classList.add('open');
        if (mobileMenuBtn) {
            mobileMenuBtn.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';
        }
        document.body.style.overflow = 'hidden';
    };

    if (mobileMenuBtn && mobileNav) {
        mobileMenuBtn.addEventListener('click', () => {
            const isOpen = mobileNav.classList.contains('open');
            if (isOpen) {
                closeMobileNav();
            } else {
                openMobileNav();
            }
        });
        
        if (mobileBackdrop) {
            mobileBackdrop.addEventListener('click', closeMobileNav);
        }
        
        // Close mobile nav when clicking any link inside
        const mobileLinks = mobileNav.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', closeMobileNav);
        });
    }

    // 2. Header Scroll Effect
    const header = document.getElementById('header');
    
    const handleScroll = () => {
        if (!header) return;
        if (window.scrollY > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    };
    
    handleScroll();
    window.addEventListener('scroll', handleScroll, { passive: true });

    // 3. FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const questionBtn = item.querySelector('.faq-question');
        if (!questionBtn) return;
        
        questionBtn.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            // Close all items
            faqItems.forEach(faq => {
                faq.classList.remove('active');
                const btn = faq.querySelector('.faq-question');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            });
            
            // Toggle clicked item
            if (!isActive) {
                item.classList.add('active');
                questionBtn.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // 4. Smooth Scrolling for Anchor Links (excluding popup modal triggers)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            
            if (targetId === '#' || targetId === '#book' || targetId === '#consult') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                const headerHeight = header ? header.offsetHeight : 80;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.scrollY - headerHeight;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // 5. Contact & Appointment Popup Modal Functionality
    const appointmentModal = document.getElementById('appointment-modal');
    const modalBackdrop = appointmentModal ? appointmentModal.querySelector('.modal-backdrop') : null;
    const modalCloseBtns = appointmentModal ? appointmentModal.querySelectorAll('.modal-close-btn, .modal-close-trigger') : [];
    const appointmentForm = document.getElementById('appointment-modal-form');
    const modalSuccessState = document.getElementById('modal-success-state');
    const modalServiceSelect = document.getElementById('modal-service-select');

    const openAppointmentModal = (serviceName = '') => {
        if (!appointmentModal) return;
        
        // Reset form and states
        if (appointmentForm) {
            appointmentForm.style.display = 'block';
        }
        if (modalSuccessState) {
            modalSuccessState.classList.remove('active');
        }

        // Pre-select service if provided
        if (modalServiceSelect && serviceName) {
            const raw = serviceName.toLowerCase();
            const options = Array.from(modalServiceSelect.options);
            
            // Direct or substring match
            let matchingOption = options.find(opt => 
                opt.text.toLowerCase().includes(raw) || 
                opt.value.toLowerCase().includes(raw) ||
                raw.includes(opt.value.toLowerCase()) ||
                raw.includes(opt.text.toLowerCase())
            );

            // Keyword-based fallback matching
            if (!matchingOption) {
                if (raw.includes('varicose') || raw.includes('rfa') || raw.includes('laser') || raw.includes('glue')) {
                    matchingOption = options.find(opt => opt.value === 'Varicose Veins');
                } else if (raw.includes('dvt') || raw.includes('thrombosis') || raw.includes('thrombolysis')) {
                    matchingOption = options.find(opt => opt.value === 'Deep Vein Thrombosis');
                } else if (raw.includes('arterial') || raw.includes('artery') || raw.includes('pad') || raw.includes('claudication') || raw.includes('ischemi')) {
                    matchingOption = options.find(opt => opt.value === 'Peripheral Artery Disease');
                } else if (raw.includes('diabetic') || raw.includes('foot') || raw.includes('ulcer') || raw.includes('wound')) {
                    matchingOption = options.find(opt => opt.value === 'Diabetic Foot Care');
                } else if (raw.includes('fistula') || raw.includes('dialysis') || raw.includes('graft') || raw.includes('av ')) {
                    matchingOption = options.find(opt => opt.value === 'AV Fistula & Dialysis Access');
                } else if (raw.includes('carotid') || raw.includes('stroke') || raw.includes('endarterectomy')) {
                    matchingOption = options.find(opt => opt.value === 'Carotid Artery Disease');
                } else if (raw.includes('aneurysm') || raw.includes('aortic') || raw.includes('evar') || raw.includes('tevar')) {
                    matchingOption = options.find(opt => opt.value === 'Aortic Aneurysm');
                }
            }

            if (matchingOption) {
                modalServiceSelect.value = matchingOption.value;
            }
        }

        appointmentModal.classList.add('active');
        appointmentModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        // Auto-focus first input
        const firstInput = appointmentModal.querySelector('input[type="text"]');
        if (firstInput) {
            setTimeout(() => firstInput.focus(), 150);
        }
    };

    const closeAppointmentModal = () => {
        if (!appointmentModal) return;
        appointmentModal.classList.remove('active');
        appointmentModal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    };

    // Attach click listeners to all modal close triggers
    modalCloseBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            closeAppointmentModal();
        });
    });

    if (modalBackdrop) {
        modalBackdrop.addEventListener('click', closeAppointmentModal);
    }

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && appointmentModal && appointmentModal.classList.contains('active')) {
            closeAppointmentModal();
        }
    });

    // Wire up all CTA buttons and links to open the popup modal
    // 1) Explicit modal triggers
    document.querySelectorAll('[data-open-modal="appointment"], [data-open-modal="contact"]').forEach(el => {
        el.addEventListener('click', (e) => {
            e.preventDefault();
            const service = el.getAttribute('data-service') || '';
            openAppointmentModal(service);
        });
    });

    // 2) Book Appointment buttons and nav CTA buttons
    document.querySelectorAll('a[href="#book"], a[href="index.html#book"], .nav-btn, .mobile-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openAppointmentModal();
        });
    });

    // 3) Service "Learn more" and "Discuss with the doctor" cards/links
    document.querySelectorAll('.service-card, .service-link, .service-discuss-link').forEach(serviceEl => {
        serviceEl.addEventListener('click', function(e) {
            // Find service title
            let serviceTitle = '';
            const parentCard = this.closest('.service-card') || this.closest('.service-listing-card') || this;
            const titleEl = parentCard.querySelector('.service-title, .service-card-title, h3, h2');
            if (titleEl) {
                serviceTitle = titleEl.textContent.trim();
            }
            e.preventDefault();
            openAppointmentModal(serviceTitle);
        });
    });

    // 4) Consultation CTA buttons
    document.querySelectorAll('a[href="#consult"], a[href="index.html#consult"]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            openAppointmentModal('General Vascular Consultation');
        });
    });

    // Modal Form Submission
    if (appointmentForm) {
        appointmentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Visual feedback
            const submitBtn = appointmentForm.querySelector('.modal-submit-btn');
            const originalBtnHtml = submitBtn.innerHTML;
            submitBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="spin" style="animation: spin 1s linear infinite;"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle><path d="M12 2a10 10 0 0 1 10 10"></path></svg> Processing...';
            submitBtn.disabled = true;

            setTimeout(() => {
                appointmentForm.style.display = 'none';
                if (modalSuccessState) {
                    modalSuccessState.classList.add('active');
                }
                submitBtn.innerHTML = originalBtnHtml;
                submitBtn.disabled = false;
                appointmentForm.reset();
            }, 800);
        });
    }

    // On-Page Contact Form Submission (contact.html)
    const contactPageForm = document.getElementById('contact-page-form');
    if (contactPageForm) {
        contactPageForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const submitBtn = contactPageForm.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
            if (submitBtn) {
                submitBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="spin" style="animation: spin 1s linear infinite;"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle><path d="M12 2a10 10 0 0 1 10 10"></path></svg> Sending Request...';
                submitBtn.disabled = true;
            }

            setTimeout(() => {
                contactPageForm.innerHTML = `
                    <div style="text-align: center; padding: 2.5rem 1.5rem;">
                        <div style="width: 56px; height: 56px; margin: 0 auto 1.25rem; border-radius: 50%; background: rgba(34, 197, 94, 0.12); border: 2px solid rgba(34, 197, 94, 0.3); color: #16a34a; display: flex; align-items: center; justify-content: center;">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <h3 style="font-family: var(--font-display); font-size: 1.4rem; color: #0f172a; margin-bottom: 0.5rem;">Appointment Request Sent!</h3>
                        <p style="font-size: 0.95rem; color: #64748b; line-height: 1.6;">Thank you. Dr. S Srikanth Raju's clinic coordinator will call you on your provided phone number to confirm your preferred consultation time.</p>
                    </div>
                `;
            }, 800);
        });
    }

    // 6. Modern Entrance & Scroll Reveal Animations
    const initScrollReveal = () => {
        // Skip or immediately reveal if reduced motion preferred
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // Select all key elements across pages
        const revealSelectors = [
            '.section-title',
            '.section-description',
            '.section-label',
            '.about-pill',
            '.cta-pill',
            '.service-card',
            '.service-listing-card',
            '.feature-card',
            '.stat-item',
            '.stat-card',
            '.journey-card',
            '.review-card',
            '.testimonial-card',
            '.blog-card',
            '.media-card',
            '.faq-item',
            '.contact-info-card',
            '.contact-form-column',
            '.about-image-column',
            '.about-content',
            '.cta-box',
            '.publication-card'
        ];

        // Apply reveal-init class to matched elements
        const elementsToReveal = document.querySelectorAll(revealSelectors.join(', '));
        
        // Auto-assign stagger classes to grid & group children
        const gridContainers = document.querySelectorAll('.services-grid, .features-grid, .stats-grid, .journey-grid, .reviews-grid, .media-grid, .blogs-grid, .contact-layout-grid, .publication-cards-list');
        gridContainers.forEach(grid => {
            const children = Array.from(grid.children).filter(child => !child.classList.contains('journey-arrow'));
            children.forEach((child, index) => {
                const staggerClass = `stagger-${Math.min(index + 1, 8)}`;
                child.classList.add(staggerClass);
            });
        });

        elementsToReveal.forEach(el => {
            if (!el.classList.contains('reveal-init') && !el.classList.contains('revealed')) {
                el.classList.add('reveal-init');
            }
        });

        if (prefersReducedMotion) {
            elementsToReveal.forEach(el => el.classList.add('revealed'));
            return;
        }

        // IntersectionObserver for smooth entrance when scrolled into view
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.08,
            rootMargin: '0px 0px -40px 0px'
        });

        elementsToReveal.forEach(el => {
            // If already in viewport on load, reveal immediately or with tiny delay
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                setTimeout(() => el.classList.add('revealed'), 60);
            } else {
                revealObserver.observe(el);
            }
        });

        // Trigger hero entrance elements immediately
        const heroElements = document.querySelectorAll('.hero-content, .hero-image-wrapper, .about-hero-content, .service-hero-content');
        heroElements.forEach((el, index) => {
            el.classList.add('reveal-init');
            setTimeout(() => {
                el.classList.add('revealed');
            }, 50 + index * 100);
        });
    };

    initScrollReveal();

    // 7. Dynamic Counter Animation for Stats Section
    const initStatsCounterAnimation = () => {
        const statNumbers = document.querySelectorAll('.stat-number, [data-counter]');
        if (!statNumbers.length) return;

        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        const animateCounter = (el) => {
            const rawText = el.getAttribute('data-counter-orig') || el.textContent.trim();
            el.setAttribute('data-counter-orig', rawText);

            if (prefersReducedMotion) {
                el.textContent = rawText;
                return;
            }

            // Extract prefix, numeric part, and suffix (e.g., "10,000+", "98%", "16+")
            const match = rawText.match(/^([^\d]*)([\d,.]+)([^\d]*)$/);
            if (!match) return;

            const prefix = match[1] || '';
            const rawNumStr = match[2];
            const suffix = match[3] || '';
            const hasComma = rawNumStr.includes(',');
            const isDecimal = rawNumStr.includes('.');
            const targetValue = parseFloat(rawNumStr.replace(/,/g, ''));

            if (isNaN(targetValue)) return;

            const parentCard = el.closest('.stat-item, .stat-card');
            if (parentCard) parentCard.classList.add('counting');

            const duration = 1600; // 1.6s
            let startTime = null;

            const step = (timestamp) => {
                if (!startTime) startTime = timestamp;
                const elapsed = timestamp - startTime;
                const progress = Math.min(elapsed / duration, 1);

                // Ease-out cubic curve: fast start, soft deceleration
                const ease = 1 - Math.pow(1 - progress, 3);
                const currentVal = targetValue * ease;

                let formattedNum = '';
                if (isDecimal) {
                    formattedNum = currentVal.toFixed(1);
                } else if (hasComma) {
                    formattedNum = Math.floor(currentVal).toLocaleString('en-US');
                } else {
                    formattedNum = Math.floor(currentVal).toString();
                }

                el.textContent = `${prefix}${formattedNum}${suffix}`;

                if (progress < 1) {
                    requestAnimationFrame(step);
                } else {
                    el.textContent = rawText; // Final exact formatted string
                    if (parentCard) parentCard.classList.remove('counting');
                }
            };

            requestAnimationFrame(step);
        };

        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    animateCounter(el);
                    observer.unobserve(el);
                }
            });
        }, {
            threshold: 0.2,
            rootMargin: '0px 0px -20px 0px'
        });

        statNumbers.forEach(statEl => {
            counterObserver.observe(statEl);
        });
    };

    initStatsCounterAnimation();
});
