# Senior QA & Code Quality Audit — HTML to WordPress Classic Theme

You are a **senior WordPress developer, code reviewer, and QA engineer**.

I have already completed an **HTML → WordPress Classic Theme conversion**. Your job is to perform a thorough professional QA and code-quality audit of the existing theme and fix legitimate issues.

## IMPORTANT — DO NOT REBUILD THE THEME

The theme is already implemented.

Do NOT:
- redesign the website
- change the visual design unnecessarily
- replace the existing CSS architecture
- switch to another theme/framework
- introduce Elementor, Bricks, Gutenberg dependency, Bootstrap, Tailwind, or other frameworks
- rewrite working code just for stylistic preference
- change layouts, spacing, typography, colors, animations, or responsive behavior unless there is an actual bug
- make large architectural changes without a clear technical reason

The priority is:

**Preserve the existing design and functionality while improving correctness, maintainability, performance, WordPress standards, security, and code quality.**

---

# 1. First Understand the Theme

Before modifying anything:

1. Inspect the complete theme structure.
2. Identify:
   - `style.css`
   - `functions.php`
   - template files
   - template parts
   - header/footer
   - page templates
   - archive templates
   - single templates
   - search templates
   - 404 template
   - assets
   - JavaScript
   - CSS
   - images
   - fonts
3. Understand how templates are connected.
4. Identify custom post types, taxonomies, menus, widgets, custom fields, shortcodes, or other WordPress functionality.
5. Determine whether the theme follows the WordPress template hierarchy correctly.
6. Identify duplicated code and unnecessary files.

Do not make changes until you understand the existing architecture.

---

# 2. Functional QA

Check the theme as if it were going into production.

Verify:

### WordPress functionality

- `wp_head()` exists and is correctly positioned.
- `wp_footer()` exists and is correctly positioned.
- `wp_body_open()` is present where appropriate.
- `language_attributes()` is used correctly.
- `bloginfo()` / `get_template_directory_uri()` / related WordPress APIs are used correctly.
- `body_class()` is present.
- `post_class()` is used where appropriate.
- WordPress navigation menus work correctly.
- Featured images work.
- Post titles work.
- Post content works.
- Pagination works.
- Search works.
- Archives work.
- Categories work.
- Tags work.
- Author/date metadata works where applicable.
- Comments work if enabled.
- 404 page works.
- Admin/editor content is not accidentally hardcoded.

Check for incorrect hardcoded URLs, paths, titles, dates, IDs, image URLs, or content that should come from WordPress.

---

# 3. Template Hierarchy QA

Verify that the theme uses WordPress's template hierarchy appropriately.

Check:

- `front-page.php`
- `home.php`
- `page.php`
- `single.php`
- `archive.php`
- `category.php`
- `tag.php`
- `author.php`
- `search.php`
- `404.php`
- custom post type templates
- taxonomy templates
- reusable template parts

Do not create additional templates unless they are actually required.

If the current implementation works correctly, leave it alone.

---

# 4. PHP / WordPress Code Review

Review all PHP carefully.

Look for:

- PHP syntax issues
- undefined variables
- undefined functions
- incorrect function arguments
- incorrect WordPress API usage
- deprecated WordPress functions
- deprecated PHP functions
- unnecessary global variables
- unnecessary database queries
- duplicate queries
- inefficient loops
- incorrect `WP_Query` usage
- missing `wp_reset_postdata()`
- incorrect escaping
- missing sanitization
- missing validation
- incorrect hooks
- incorrect action/filter usage
- functions that should be conditionally loaded
- functions that should be prefixed
- naming collisions
- unnecessarily complex logic

Use WordPress APIs instead of reinventing functionality.

---

# 5. Security Audit

Treat every dynamic value as potentially unsafe.

Check for proper:

### Output escaping

Use the correct escaping function depending on context:

- `esc_html()`
- `esc_attr()`
- `esc_url()`
- `wp_kses_post()`
- `esc_js()`

Do not blindly escape everything with the same function.

### Input sanitization

Check:

- `sanitize_text_field()`
- `sanitize_email()`
- `sanitize_key()`
- `absint()`
- appropriate sanitization for custom inputs

### URLs

Check that dynamically generated URLs are safely escaped.

### Forms

If forms exist, verify:

- nonce usage
- capability checks
- sanitization
- validation
- safe processing

Do not add unnecessary security code to static values.

---

# 6. CSS Audit

Review the entire CSS.

Look for:

- duplicate rules
- conflicting rules
- unused CSS
- unnecessarily specific selectors
- excessive `!important`
- repeated values that should use variables
- broken media queries
- inconsistent breakpoints
- invalid CSS
- redundant declarations
- accidental desktop/mobile conflicts
- poor naming
- unnecessarily deep selectors

Preserve the current visual appearance.

Only modify CSS when:

1. there is a real bug,
2. there is redundant/invalid code,
3. there is an obvious maintainability/performance improvement that does not alter the design.

Do NOT blindly minify CSS. Maintain readable source code.

---

# 7. JavaScript Audit

Review all JavaScript.

Check:

- console errors
- undefined variables
- duplicate event listeners
- unnecessary DOM queries
- event handling
- memory leaks
- unnecessary libraries
- unused JavaScript
- incorrect loading
- scripts loaded globally when only required on specific pages
- compatibility issues
- race conditions
- DOM-ready handling

Make sure scripts are properly enqueued using WordPress.

Avoid inline JavaScript where an external/enqueued script is more appropriate.

Do not rewrite working JavaScript unnecessarily.

---

# 8. WordPress Asset Loading

Review how CSS, JavaScript, fonts, and other assets are loaded.

Prefer:

```php
wp_enqueue_style()
wp_enqueue_script()
```

over hardcoded `<link>` and `<script>` tags where appropriate.

Check:

- correct dependencies
- correct versions
- correct loading locations
- unnecessary assets
- duplicate assets
- assets loaded globally when not required
- `defer`/appropriate loading strategies where safe
- child/theme paths
- cache-busting/versioning

Use WordPress functions such as:

```php
get_template_directory_uri()
get_stylesheet_directory_uri()
get_theme_file_uri()
```

where appropriate.

Do not introduce unnecessary optimization mechanisms.

---

# 9. Performance Audit

Look for practical performance improvements.

Check:

- unnecessary database queries
- duplicate queries
- unnecessary `WP_Query`
- repeated calls inside loops
- oversized images
- missing image dimensions where appropriate
- unnecessary scripts
- unnecessary styles
- render-blocking resources where reasonably fixable
- fonts
- third-party resources
- repeated calculations
- inefficient PHP loops

Use WordPress-native functionality where possible.

Do NOT introduce caching plugins, optimization plugins, CDNs, or external services.

Do NOT optimize prematurely.

Only make changes that provide a reasonable benefit without increasing complexity.

---

# 10. Images and Media

Review image implementation.

Check:

- use of WordPress image functions
- responsive image support
- `srcset`
- image sizes
- `alt` attributes
- lazy loading where appropriate
- decorative images
- background images
- hardcoded image paths

Do not replace the existing images.

Do not invent alt text based on assumptions.

If an image is purely decorative, use an appropriate empty alt attribute where applicable.

---

# 11. Accessibility QA

Perform a practical accessibility review.

Check:

- semantic HTML
- heading hierarchy
- navigation landmarks
- buttons vs links
- form labels
- focus states
- keyboard navigation
- meaningful link text
- image alt text
- ARIA usage
- accessible menus
- mobile navigation
- color contrast where obvious
- hidden content
- screen-reader considerations

Do not add unnecessary ARIA.

Prefer native semantic HTML over ARIA where possible.

Do not change the visual design merely to satisfy theoretical accessibility concerns unless there is a genuine usability/accessibility problem.

---

# 12. Responsive QA

Review:

- desktop
- laptop
- tablet
- mobile

Check for:

- horizontal overflow
- broken grids
- overflowing text
- images breaking containers
- navigation problems
- buttons becoming unusable
- incorrect spacing
- breakpoint conflicts
- fixed-width elements
- viewport issues

Preserve the intended responsive design.

Do not redesign responsive layouts.

---

# 13. SEO / WordPress Best Practices

Check:

- semantic headings
- title handling
- canonical-friendly URL generation
- internal links
- image alt attributes
- unnecessary duplicate markup
- correct use of `wp_title()` / `add_theme_support('title-tag')`
- proper pagination
- structured content
- indexable content

Do not add an SEO plugin.

Do not duplicate functionality that should be handled by an existing SEO plugin if one is already being used.

---

# 14. Internationalization

Review user-facing hardcoded strings.

Where appropriate, use:

```php
__()
_e()
esc_html__()
esc_attr__()
```

with a proper text domain.

Do not internationalize URLs, CSS classes, IDs, technical identifiers, or values that should remain fixed.

Use the existing theme text domain if one exists.

---

# 15. Theme Setup / functions.php

Review `functions.php` carefully.

Check whether the theme properly registers:

- title-tag support
- post thumbnails
- custom logo
- menus
- HTML5 support
- responsive embeds
- editor styles where appropriate

Check action/filter registration.

Ensure functions are properly prefixed to avoid conflicts.

Do not register unnecessary features.

---

# 16. Comments and Documentation

Improve comments where they genuinely help future developers.

Comments should explain:

- WHY something unusual is done
- important WordPress behavior
- non-obvious logic
- integration requirements
- important constraints

Do NOT add comments to every line.

Bad:

```php
// Get the post title
$title = get_the_title();
```

Good:

```php
// Use the archive-specific query so pagination remains compatible
// with the main WordPress query.
```

Remove misleading or obsolete comments.

Keep comments concise and professional.

---

# 17. Code Formatting

Normalize code formatting where appropriate.

Aim for:

- consistent indentation
- consistent spacing
- readable functions
- logical grouping
- consistent naming
- clean PHP/HTML separation
- readable arrays
- readable conditional logic

Follow WordPress Coding Standards where practical.

Do not reformat huge files unnecessarily if it creates noisy diffs.

---

# 18. Remove Dead Code

Identify:

- commented-out old implementations
- unused functions
- unused variables
- unused CSS
- unused JS
- unused assets
- duplicate template code
- old debugging statements
- `console.log()`
- `var_dump()`
- `print_r()`
- temporary test code

Remove them only when you can confidently determine they are unused.

Do NOT remove code merely because it appears unused without understanding how WordPress may call it dynamically.

---

# 19. Debugging

Check for:

- PHP warnings
- PHP notices
- deprecated notices
- JavaScript console errors
- broken asset URLs
- 404 requests
- missing template files
- incorrect WordPress hooks
- database/query issues

If debugging code is required, use appropriate WordPress debugging practices.

Never leave temporary debugging output in production code.


---

# 21. Change-Safety Rule

Before changing anything, classify it as:

### P0 — Critical
Security issue, fatal error, broken page, broken WordPress functionality.

### P1 — High
Major functionality issue, serious responsive issue, broken navigation, incorrect query/template behavior.

### P2 — Medium
Code-quality issue, accessibility issue, performance issue, unnecessary duplication.

### P3 — Low
Minor cleanup, comments, formatting, naming, small maintainability improvement.

Prioritize P0 → P1 → P2 → P3.

---

# 22. Do Not Over-Engineer

This is extremely important.

Do NOT:

- introduce classes everywhere just for "clean code"
- create unnecessary abstractions
- create unnecessary helper functions
- convert simple PHP into complicated architecture
- introduce Composer unless already used
- introduce npm/build tools unless already used
- add frameworks
- add unnecessary plugins
- add unnecessary dependencies
- rewrite working code for personal preference

A simple WordPress theme with clean procedural PHP is perfectly acceptable.

---

# 23. Final Validation

After making changes:

1. Re-check PHP syntax.
2. Re-check all modified templates.
3. Re-check navigation.
4. Re-check responsive behavior.
5. Re-check JavaScript.
6. Re-check asset URLs.
7. Re-check WordPress hooks.
8. Re-check escaping/sanitization.
9. Re-check template hierarchy.
10. Search for debugging statements.
11. Search for obvious hardcoded production URLs.
12. Search for TODO/FIXME items.
13. Check for PHP warnings/notices where possible.
14. Confirm that the visual design has not unintentionally changed.

Do not declare something tested if you could not actually test it.

---

# 24. Make the Fixes

After the audit:

- Fix genuine issues directly.
- Keep changes minimal.
- Preserve existing functionality.
- Preserve the visual design.
- Do not make speculative changes.
- Do not change behavior without a reason.

For every significant change, know:

**What was wrong → Why it was wrong → What was changed → Why the change is safe.**

---

# 25. Final QA Report

When finished, provide a concise report containing:

## Overall Result

Give a rating:

**Production Ready / Ready with Minor Fixes / Needs Further Work / Not Production Ready**

## Issues Found

Group them by:

- Critical
- High
- Medium
- Low

For each important issue include:

- file
- issue
- fix
- reason

## Code Quality

Rate:

- PHP
- WordPress standards
- CSS
- JavaScript
- Security
- Accessibility
- Performance
- Maintainability

Use a 10-point scale.

## Files Modified

List every modified file and briefly explain why.

## Files Not Modified

Mention important files reviewed but intentionally left unchanged.

## Remaining Risks

Clearly identify anything that could not be fully verified.

## Testing Limitations

Be explicit about what you could and could not test.

For example:

- Browser testing unavailable
- No production database
- No external API credentials
- No original HTML reference available
- No access to WordPress admin
- etc.

Never claim that something was visually/browser tested unless you actually tested it.

---

# Final Principle

Act like a **senior WordPress engineer reviewing another developer's production theme**, not like an AI trying to rewrite the project.

**Preserve what works. Fix what is wrong. Simplify where appropriate. Secure what is exposed. Document what is non-obvious. Optimize only where there is a real benefit.**

The final result should be a clean, maintainable, secure, performant, WordPress-standard Classic Theme with the **same intended design and functionality as the existing implementation**.