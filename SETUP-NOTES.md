# Vascular Grace — WordPress Theme Setup Notes

## Prerequisites

| Plugin | Required? | Where to Get |
|---|---|---|
| **Advanced Custom Fields PRO** | ✅ Required | [advancedcustomfields.com](https://www.advancedcustomfields.com/pro/) |
| WPForms / CF7 / Gravity Forms | Recommended (for contact form) | Your choice of form plugin |
| Trustindex | Recommended (for Google reviews) | WordPress.org plugin directory |

> ACF Pro is mandatory. The free version does NOT support Options Pages or Repeater fields. Without it, all dynamic content fields will be missing from the admin.

---

## Installation

1. Go to **WordPress Admin → Appearance → Themes → Add New → Upload Theme**
2. Upload `vascular-grace.zip`
3. Click **Activate**
4. Install and activate **Advanced Custom Fields Pro**
5. After ACF Pro is active, go to **Custom Fields → Sync** — you should see all field groups listed. Click **Sync All** to import them from the `acf-json/` folder

---

## Assigning Page Templates

Create a WordPress Page for each page below, then set its **Template** in Page Attributes:

| Page Title (Suggested) | Slug | Page Template to Select |
|---|---|---|
| Home | *(set as Front Page in Settings → Reading)* | **Home** |
| About | `/about/` | **About** |
| Services | `/services/` | **Services** |
| Contact | `/contact/` | **Contact** |
| Blogs | `/blogs/` | **Blogs** |
| Testimonials | `/testimonials/` | **Testimonials** |
| Media | `/media/` | **Media** |

### Set Homepage
Go to **Settings → Reading** → select **"A static page"** → set **Homepage** to your Home page.

---

## Navigation Menus

Go to **Appearance → Menus** and create two menus:

### Header — Left Nav
Assign to location: **Header — Left Nav**
Add pages: Home, About, Services

### Header — Right Nav
Assign to location: **Header — Right Nav**
Add pages: Blogs, Testimonials, Contact

---

## Populating Global Settings (Theme Options)

Go to **Theme Settings** in the WordPress admin sidebar (added by ACF Pro Options Page).

Fill in all tabs:

### Brand & Identity tab
- Upload your **logo** (transparent PNG recommended)
- Enter **doctor name**, **credentials**, **role**
- Set **footer tagline** and **copyright text**

### Contact Details tab
- **Primary phone** (e.g. `+91 98765 43210`) — used in CTA buttons, footer, contact page
- **WhatsApp number** (digits only, no + or spaces, e.g. `919876543210`) — used for wa.me link
- **Email address**
- **Address lines** — used in footer and contact page
- **Business hours**
- **Google Maps embed** — paste the full `<iframe>` code from Google Maps (optional — auto-generates from address if left blank)

### Header & Navigation tab
- **Header CTA text** — e.g. "Book Appointment"
- **Header CTA URL** — use `#book` to open the booking popup modal, or an external booking platform URL

### Social Media tab
- Add social links via repeater (platform name + URL)

---

## Adding Services (CPT)

Go to **Services → Add New** in the WordPress admin:

1. Enter the **Title** (service name)
2. Fill in **One-liner** — short card subtitle
3. Paste **Icon SVG** from [lucide.dev](https://lucide.dev) (copy the SVG code, e.g. `<svg width="20"...>...</svg>`)
4. Set **CTA Behaviour** — leave as "Open Booking Popup" to match original site behavior
5. Set **Menu Order** (in Page Attributes box) to control display order
6. Publish

Repeat for all services. Recommended order:
1. Varicose Veins (Menu Order: 1)
2. Peripheral Artery Disease (2)
3. Diabetic Foot Care (3)
4. Deep Vein Thrombosis (4)
5. AV Fistula & Dialysis Access (5)
6. Aortic Aneurysm (EVAR) (6)
7. Carotid Artery Disease (7)
8. Acute Limb Ischemia (8)
9. (Add more as needed)

---

## Setting Up the Contact Form

1. Install and activate your preferred form plugin (WPForms, Contact Form 7, or Gravity Forms)
2. Create an appointment request form with fields: Name, Phone, Email, Concern, Preferred Date, Message
3. Copy the plugin's shortcode (e.g. `[wpforms id="1"]`)
4. Go to **Contact page (edit) → Contact Template Fields → Appointment Form Shortcode**
5. Paste the shortcode and update the page

The surrounding form wrapper and existing CSS styling is preserved — only the `<form>` internals are handed off to the plugin.

---

## Setting Up Trustindex (Google Reviews)

1. Install **Trustindex** from WordPress.org plugins directory
2. Connect it to the Google My Business profile
3. Configure the widget layout
4. Copy the generated shortcode (e.g. `[trustindex no-cache=...]`)
5. **For Home page**: Edit the Home page → **Testimonials tab** → paste shortcode into **Testimonials / Review Widget Shortcode**
6. **For Testimonials page**: Edit the Testimonials page → paste shortcode into **Trustindex / Review Widget Shortcode**

Until the shortcode is configured, static fallback testimonial cards display automatically.

---

## Editing Home Page Content

1. Go to **Pages → Home → Edit**
2. You'll see tabbed ACF field groups on the right/bottom:
   - **Hero Section** — headline, subtitle, description, images
   - **About Section** — title, description, experience badge
   - **Services Section** — section title and description (cards come from CPT)
   - **Stats Section** — repeater of number + label pairs
   - **Treatment Journey** — repeater of step title + description
   - **Testimonials** — shortcode field or static cards
   - **FAQ Section** — repeater of question + answer pairs

All fields have default values matching the original HTML, so the page looks correct before any edits.

---

## File Structure Overview

```
vascular-grace/
├── style.css                     WordPress theme header
├── functions.php                 Theme setup, CPT, ACF, menus, Walker
├── header.php                    Header with split nav (nav_left + nav_right)
├── footer.php                    Footer + appointment modal include
├── index.php                     WordPress fallback (required)
├── page.php                      Default page fallback
├── page-templates/
│   ├── template-home.php         Home page
│   ├── template-about.php        About page
│   ├── template-services.php     Services listing page (CPT-driven)
│   ├── template-contact.php      Contact page (shortcode form)
│   ├── template-blogs.php        Blog listing (native WP Posts)
│   ├── template-testimonials.php Testimonials (shortcode-driven)
│   └── template-media.php        Media / Press page
├── template-parts/
│   └── sections/
│       ├── modal-appointment.php Booking modal (on every page)
│       ├── cta-band.php          Reusable CTA section
│       └── services-grid.php     Dynamic service cards from CPT
├── acf-json/
│   ├── group_options_page.json   Theme Settings (global)
│   ├── group_service_cpt.json    Service CPT fields
│   ├── group_template_home.json  Home page fields
│   ├── group_template_contact.json Contact page fields
│   └── group_template_testimonials.json Testimonials page fields
├── inc/
│   ├── helpers.php               vg_field(), vg_option(), escaping helpers
│   └── theme-options.php         Developer reference / documentation
└── assets/
    ├── css/main.css              Original CSS (verbatim copy)
    ├── js/app.js                 Original JS (verbatim copy)
    └── images/                  logo.png, doctor image, vascular-system.png
```

---

## Design Fidelity Guarantee

- **All CSS and JS is the original code**, copied verbatim. No visual changes whatsoever.
- All HTML class names and IDs are preserved exactly.
- The booking modal, FAQ accordion, and mobile nav all work via the original `app.js`.
- Zero ACF fields filled in = pixel-identical to the original HTML files.

---

## Developer Notes

- **Text Domain**: `vascular-grace` — ready for translation via `.pot` files
- **ACF Pro Dependency**: Admin notice shown if ACF Pro is not active
- **Rewrite Rules**: Flush permalinks after activation (Settings → Permalinks → Save)
- **Service CPT slug**: `/services/` — change in `functions.php` → `vascular_grace_register_cpt()` → `'rewrite' => array( 'slug' => 'services' )`
- **Nav Walker**: Custom `Vascular_Grace_Nav_Walker` in `functions.php` outputs bare `<a>` tags matching the original nav structure (no `<li>` wrappers)
- **ACF JSON Sync**: After any field group edits in the admin, always sync back to JSON (Custom Fields → Tools → Export Field Groups) for version control
