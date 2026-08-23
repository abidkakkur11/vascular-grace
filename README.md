# Vascular Grace — WordPress Theme

A premium, bespoke WordPress classic theme engineered for **Dr. S Srikanth Raju** (Consultant Vascular & Endovascular Surgeon). Built for speed, medical credibility, and high-conversion clinical patient bookings.

---

## 🌟 Key Highlights

- **WordPress Classic Theme Architecture**: Zero Gutenberg block bloat or heavy page builder dependencies. Clean, lightning-fast PHP templates.
- **ACF Pro Powered**: Full dynamic editing with ACF Local JSON (`acf-json/`) for seamless version control and site-wide sync.
- **Dedicated Service CPT**: Custom Post Type (`service`) with custom field groups, icon support, menu ordering, and dedicated procedure landing page templates.
- **Interactive Patient Conversion Flow**: Universal Appointment Booking Modal (`template-parts/sections/modal-appointment.php`) integrated across all pages and CTAs.
- **Google Reviews Integration**: Direct database connection to Trustindex cached reviews table with dynamic fallback cards.
- **Responsive & Accessible**: Fully accessible markup, custom Nav Walker (bare `<a>` tags matching clean CSS), responsive embeds, and mobile offcanvas navigation.

---

## 📋 System Requirements

| Requirement | Supported / Recommended |
|---|---|
| **WordPress** | 6.0+ (Tested up to 6.7) |
| **PHP** | 8.0+ (Tested on PHP 8.2 & 8.3) |
| **Plugins (Mandatory)** | **Advanced Custom Fields Pro** (for Options Pages, Local JSON & Repeaters) |
| **Plugins (Recommended)** | Trustindex (Google Reviews), WPForms / CF7 / Gravity Forms |

---

## 🚀 Quick Start & Installation

1. **Upload Theme**: Copy the `vascular-grace` folder into your `wp-content/themes/` directory, or upload the zip via **WordPress Admin → Appearance → Themes → Add New → Upload**.
2. **Activate Theme**: Click **Activate** under **Appearance → Themes**.
3. **Install ACF Pro**: Install and activate **Advanced Custom Fields Pro**.
4. **Sync Field Groups**: Navigate to **Custom Fields → Sync** and click **Sync All** to import all field definitions from the `acf-json/` directory.
5. **Set Permalinks**: Navigate to **Settings → Permalinks** and ensure **Post name** (`/%postname%/`) is selected, then click **Save Changes** to flush rewrite rules.

---

## 📄 Page Setup & Templates

Create pages in **WordPress Admin → Pages → Add New**, assigning the respective template under **Page Attributes → Template**:

| Page | Suggested Slug | Page Template |
|---|---|---|
| **Home** | `/` (Front Page) | `Home` (`template-home.php`) |
| **About** | `/about/` | `About` (`template-about.php`) |
| **Services** | `/services/` | `Services` (`template-services.php`) |
| **Blogs** | `/blogs/` (or Posts page) | `Blogs` (`template-blogs.php` or `home.php`) |
| **Testimonials** | `/testimonials/` | `Testimonials` (`template-testimonials.php`) |
| **Media** | `/media/` | `Media` (`template-media.php`) |
| **Contact** | `/contact/` | `Contact` (`template-contact.php`) |
| **Legal / Standard** | `/privacy-policy/`, `/disclaimer/` | `Standard Page` (`template-standard.php`) or `page.php` |

> Set your static homepage via **Settings → Reading → Your homepage displays → A static page (Home)**.

---

## 🧭 Navigation Menus

Go to **Appearance → Menus** and configure the two header navigation zones and footer explore menu:

- **Header - Left Nav** (`nav_left`): Home, About, Services
- **Header - Right Nav** (`nav_right`): Blogs, Testimonials, Contact
- **Footer - Explore Menu** (`footer_explore`): Quick access footer navigation

---

## ⚙️ Theme Settings (Global Options)

Global clinic data is managed under **WordPress Admin → Theme Settings**:

- **Brand & Identity**: Clinic Logo, Doctor name, credentials, specialization role, footer tagline, copyright text.
- **Contact Details**: Primary phone, WhatsApp direct number, email address, physical clinic addresses, consultation hours, Google Maps embed.
- **Header & Nav**: Header CTA button label & destination URL (e.g. `#book` for popup modal).
- **Social Media**: Dynamic repeater for social profile links.
- **Tracking & Scripts**: Google Analytics measurement ID, custom `<head>` and `<body>` scripts.

---

## 📁 File Structure

```
vascular-grace/
├── style.css                     # Theme header metadata & info
├── functions.php                 # Core setup, asset enqueuing, CPT, nav menus, walker
├── header.php                    # Header with split desktop nav & mobile offcanvas
├── footer.php                    # Multi-column footer & global modal include
├── index.php                     # Default WordPress template fallback
├── page.php                      # Default single page fallback
├── home.php                      # Native blog post archive index
├── single.php                    # Single blog article template with doctor bio & related posts
├── single-service.php            # Standalone dedicated procedure & treatment landing page
├── page-templates/               # Custom page templates
│   ├── template-home.php         # Homepage
│   ├── template-about.php        # Doctor bio & clinic overview
│   ├── template-services.php     # Comprehensive services directory
│   ├── template-blogs.php        # Blog index template
│   ├── template-testimonials.php # Video & Google review showcase
│   ├── template-media.php        # Media appearances & publications
│   ├── template-contact.php      # Appointment request & location map
│   └── template-standard.php     # Legal/terms text prose layout
├── template-parts/
│   └── sections/
│       ├── cta-band.php          # Reusable conversion CTA banner
│       ├── modal-appointment.php # Site-wide modal appointment dialog
│       ├── services-grid.php     # Dynamic service cards query
│       └── stats.php             # Clinic key statistics display
├── inc/
│   ├── helpers.php               # Data retrieval & escaping utility functions (vg_field, vg_option, etc.)
│   ├── theme-options.php         # ACF Options page field schema documentation
│   └── license.php               # Theme license handling
├── acf-json/                     # ACF Local JSON definitions (source of truth)
└── assets/
    ├── css/main.css              # Theme CSS styling
    ├── js/app.js                 # Frontend interactions (modal, drawer, accordion, counters)
    └── images/                   # Bundled clinic assets & logos
```

---

## 🔒 Security & Code Standards

- Adheres to **WordPress Coding Standards** (WPCS).
- Strict output escaping applied across all templates (`esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses()`).
- Direct SQL queries protected via `$wpdb->prepare()`.
- Safe fallbacks on all ACF dynamic field tags.

---

## 📝 License

Distributed under the **GNU General Public License v3.0 or later**. See [`LICENSE`](LICENSE) for details.
