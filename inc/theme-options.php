<?php
/**
 * Vascular Grace — inc/theme-options.php
 *
 * ACF field group registration for the Theme Settings Options Page
 * (global header/footer data). Field groups for individual page
 * templates and the Service CPT are stored in acf-json/ as local JSON.
 *
 * NOTE: Because we use ACF Local JSON, this file is kept minimal.
 * The JSON files in acf-json/ are the source of truth for all field groups.
 * This file only documents what the Options Page fields contain, for
 * developer reference.
 *
 * @package VascularGrace
 */

defined( 'ABSPATH' ) || exit;

/*
 * ACF Options Page Fields Reference — stored in acf-json/group_options.json
 * ─────────────────────────────────────────────────────────────────────────
 *
 * GROUP: Theme Settings (location: options page = theme-settings)
 *
 * Tab: Brand & Identity
 *   site_logo          → Image (return array) — header + footer logo
 *   site_name          → Text — e.g. "Dr. S Srikanth Raju"
 *   site_tagline       → Text — e.g. "Vascular & Endovascular Surgeon"
 *   doctor_name_full   → Text — e.g. "Dr. S Srikanth Raju"
 *   doctor_credentials → Text — e.g. "MBBS · MS (Gen. Surgery) · DNB (Vascular)"
 *   doctor_role        → Text — e.g. "Sr. Consultant Vascular & Endovascular Surgeon"
 *   footer_tagline     → Textarea — footer brand blurb
 *   footer_rating      → Text — e.g. "4.9"
 *   footer_review_count → Text — e.g. "499 Google reviews"
 *   copyright_text     → Text — e.g. "© 2026 Dr. S Srikanth Raju · Med Reg No. TSMC 67043"
 *   privacy_policy_url → URL
 *   disclaimer_url     → URL
 *
 * Tab: Contact Details
 *   phone_primary      → Text — e.g. "+91 98765 43210"
 *   whatsapp_number    → Text — e.g. "919876543210" (no + for wa.me)
 *   email_primary      → Email — e.g. "contact@drsrikanthraju.com"
 *   address_line1      → Text — "Yashoda Hospitals, Hitec City"
 *   address_line2      → Text — "Hyderabad, Telangana 500081"
 *   business_hours     → Text — "Mon–Sat · 9:00 AM – 5:00 PM"
 *   business_hours_sub → Text — "Sunday · by appointment"
 *   google_maps_embed  → Textarea — full <iframe> embed code from Google Maps
 *
 * Tab: Header & Nav
 *   header_cta_text    → Text — e.g. "Book Appointment"
 *   header_cta_url     → URL — e.g. "#book" or absolute booking URL
 *
 * Tab: Social Media
 *   social_links       → Repeater
 *     ↳ platform       → Text — e.g. "Facebook"
 *     ↳ url            → URL
 *
 * Tab: Tracking / Scripts
 *   google_analytics_id → Text — GA4 Measurement ID (G-XXXXXXX)
 *   head_scripts        → Textarea — any custom <script> or <meta> for <head>
 *   body_scripts        → Textarea — any custom scripts before </body>
 */
