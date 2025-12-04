\# TriNav™ Mobile — Technical Specification



Version: \*\*TriNav Mobile v1.0\*\*  

Author: \*\*Mark Roberts (Design52)\*\*  



---



\## 1. Overview



TriNav™ Mobile is a multi-phase bottom drawer navigation system with:



\- A floating launcher (hamburger button)

\- A progressive drawer that moves through 4 distinct phases

\- Tap and gesture-based control

\- Intelligent snapping and visual signalling



The system is implemented with:



\- \*\*HTML\*\* – `index.html`

\- \*\*CSS\*\* – `trinav.css`

\- \*\*JavaScript\*\* – `trinav.js`



---



\## 2. Phase Definitions



\### Phase 0 — Closed / Launcher



\- Drawer height: `0px`

\- Visible UI: bottom-right circular launcher with white hamburger SVG

\- Behaviour:

&nbsp; - Tap launcher → transition to \*\*Phase 1\*\*

&nbsp; - Backdrop is not visible



---



\### Phase 1 — Compact Nav



\- Drawer height: \*\*110px\*\*

\- Visible:

&nbsp; - Top header zone with grip pill and arrows

&nbsp; - 4-icon horizontal nav bar (home, search, groups, user)

\- Behaviour:

&nbsp; - Tap header or arrow block:

&nbsp;   - If Phase 1 → go to \*\*Phase 2\*\*

&nbsp; - Drag:

&nbsp;   - Upwards → towards Phase 2 / Phase 3

&nbsp;   - Downwards → towards Phase 0

&nbsp; - Backdrop is active and closes drawer on tap



---



\### Phase 2 — Icon Grid



\- Drawer height: \*\*380px\*\*

\- Visible:

&nbsp; - Phase 1 nav (remains visible)

&nbsp; - 4×N grid of icons (icon-only)

\- Behaviour:

&nbsp; - Tap header/arrows:

&nbsp;   - If Phase 2 → go to \*\*Phase 3\*\*

&nbsp; - Drag:

&nbsp;   - Upwards → towards Phase 3

&nbsp;   - Downwards → towards Phase 1 / Phase 0

&nbsp; - Backdrop tap → close to Phase 0



---



\### Phase 3 — Full Grid with Labels



\- Drawer height: \*\*82vh\*\* (calculated in JS as `window.innerHeight \* 0.82`)

\- Visible:

&nbsp; - Phase 1 nav (still visible)

&nbsp; - 4×N grid of icons \*\*with labels\*\*

\- Behaviour:

&nbsp; - Tap header/arrows:

&nbsp;   - If Phase 3 → close to Phase 0

&nbsp; - Drag:

&nbsp;   - Downwards → snap to nearest phase (2, 1, or 0)

&nbsp; - Backdrop tap → close to Phase 0



---



\## 3. Gesture \& Drag Behaviour



\### 3.1 Drag Configuration



\- Drag starts only when the current phase is ≥ 1.

\- Drag start:

&nbsp; - Captures `startY` and `startHeight` of drawer.

&nbsp; - Removes height transition for smooth following.

\- Drag move:

&nbsp; - Drawer height is dynamically updated as `startHeight + (startY - currentY)`.

&nbsp; - Clamped between `0` and `maxHeight (phase 3)`.

\- Drag end:

&nbsp; - Restores height transition.

&nbsp; - If drag distance is negligible → treat as tap (advance phase).

&nbsp; - Otherwise → snap to nearest phase by comparing to each height.



\### 3.2 Snap Heights



Defined in `trinav.js`:



```js

function getPhaseHeights() {

&nbsp; return \[

&nbsp;   0,                            // Phase 0

&nbsp;   110,                          // Phase 1

&nbsp;   380,                          // Phase 2

&nbsp;   window.innerHeight \* 0.82     // Phase 3

&nbsp; ];

}

4. Visual & Icon Behaviour
4.1 Arrow + Hamburger Stack

In the header arrow cluster:

3 faint hamburger lines (.drawer-hamburger-line)

2 up-arrow chevrons (#drawerArrowTop, #drawerArrowBottom)

Colour rules:

Phase 1:

Top arrow: grey #777

Bottom arrow: white #fff

Phase 2:

Both arrows: white #fff

Phase 3:

Both arrows: white #fff

Embedded hamburger tint:

Dark grey #444 with opacity ~0.3

The effect is a subtle “stacked layers” control that reads as:

“menu” + “more above” + “drawer”

5. Code Integration
CSS Files

trinav.css – contains all layout and styling for:

launcher, backdrop, drawer, header, arrows, grip, and grids.

JS Engine

trinav.js – controls:

phase lifecycle

tap-based transitions

drag handling and snapping

arrow + hamburger colour/tint updates

HTML Markup

index.html contains:

Phase-0 launcher div

Drawer + inner sections (phase1, phase2, phase3)

Inline SVG for the arrow cluster

6. Extensibility

Icons can be wired to route changes, content switching, or SPA state.

Phase 2/3 grids can be populated dynamically using JS.

Heights, animation durations, and easing can be tuned in CSS/JS.

Desktop/Tablet variants can reuse the same logic with different layout.

7. Known Constraints

Designed for mobile viewport (portrait preferred).

On very small heights, Phase 3 (82vh) may need adjustment.

Assumes availability of Font Awesome for icon classes.


---

## ✅ 9. `docs/brand-guidelines.md`

```markdown
# TriNav™ Brand Guidelines

Version: Brand v1.0  
Owner: Mark Roberts (Design52)

---

## 1. Brand Essence

TriNav™ represents:

- Motion-first navigation
- Layered, intelligent UI states
- Simplified, minimal visual forms
- Cross-device adaptability (mobile + desktop)
- Premium, OS-level interaction quality

Keywords:

> TriNav • Design52 • layered navigation • bottom drawer  
> swipe UI • multi-phase • intelligent arrows • app grid

---

## 2. Logo & Naming

### Name
- **TriNav™**
- “T” and “N” may be emphasised in logo wordmark.
- Optional subtitle: **Multi-Phase Navigation System**

### Trademark
- Always include the “™” symbol on first or prominent usage:
  - TriNav™ Mobile
  - TriNav™ Desktop

### Attribution
- “TriNav™ by Design52”

---

## 3. Colour Palette

Suggested core colours (can be tuned per project):

- Background:
  - `#0F0F0F` (main app background)
  - `#181818` (drawer background)
- Accents:
  - Arrow grey: `#777777`
  - Icon white: `#FFFFFF`
  - Hamburger tint: `#444444`
- Optional highlight:
  - Electric accent: `#4C7DFF` or similar for active items

---

## 4. Typography

- Primary font: `system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif`
- Font usage:
  - Icon labels: `12px–13px`
  - Small nav text / supporting labels: `12px–14px`
  - Avoid heavy decorative fonts to keep OS-like feel.

---

## 5. Iconography

- Use **simple, bold line icons** (e.g. Font Awesome Solid).
- Icons should be:
  - High contrast against dark backgrounds.
  - Simple geometry (no ultra-detailed shapes).
- Core icon examples:
  - Home, search, grid, user, heart, star, gear, etc.

---

## 6. Motion & Interactions

- Motion should be:
  - Smooth
  - Subtle
  - Predictable
- Timing:
  - Drawer transitions: ~0.25–0.35s
  - Easing: `ease`, `ease-out`, or cubic-bezier for “soft start, soft end”
- Avoid:
  - Overly bouncy or cartoonish animations.
  - Excess rotation or large translations on icons.

---

## 7. Layout Rules

- Mobile first:
  - Drawer anchored at bottom center.
  - Launcher in bottom-right “thumb zone”.
- The drawer:
  - Has rounded top corners.
  - Uses a centered grip pill for discoverability.
- Arrows and embedded hamburger:
  - Aligned top-right inside drawer.
  - Anchored area reserved for control; avoid placing other buttons here.

---

## 8. Usage & Attribution

When used in:

- Public products:
  - Include acknowledgment, e.g.
    > “Navigation powered by TriNav™ (Design52).”
- Portfolio / demo content:
  - The TriNav name and design should remain intact.

You **must not**:
- Rebrand TriNav as another navigation framework.
- Package TriNav as a generic UI kit for sale without permission.

---

## 9. Tone & Positioning

TriNav™ should be presented as:

- Premium
- Modern
- Clean
- Minimal
- Technically sophisticated but visually simple

It pairs well with:

- SaaS dashboards
- Mobile web apps
- Progressive web apps (PWA)
- Hybrid app shells

---

End of TriNav™ Brand Guidelines v1.0
