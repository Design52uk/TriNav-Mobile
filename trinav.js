/* ----------------------------------------------------------------------
   TriNav™ Mobile — Drawer Engine (Tap + Drag + Snap)
   © 2025 Mark Roberts & Design52 — All Rights Reserved.
---------------------------------------------------------------------- */

// Element references
const drawer = document.getElementById("drawer");
const backdrop = document.getElementById("backdrop");
const launcher = document.getElementById("phase0-launcher");
const headerTouch = document.getElementById("drawer-header-touch");

const arrowSVG = document.getElementById("drawerArrowsSVG");
const drawerArrowTop = document.getElementById("drawerArrowTop");
const drawerArrowBottom = document.getElementById("drawerArrowBottom");

const drawerHamburgerLines = document.querySelectorAll(".drawer-hamburger-line");

// Phase content
const p1 = document.getElementById("phase1");
const p2 = document.getElementById("phase2");
const p3 = document.getElementById("phase3");

// Active phase
let phase = 0;

// Drag state
let isDragging = false;
let dragStartY = 0;
let dragStartHeight = 0;
let dragMoved = false;

/* -------------------------------------------
   Hamburger tint helper
------------------------------------------- */
function setDrawerHamburgerTint(color, opacity) {
  drawerHamburgerLines.forEach(line => {
    line.setAttribute("stroke", color);
    line.setAttribute("stroke-opacity", opacity);
  });
}

/* -------------------------------------------
   Phase heights (px)
------------------------------------------- */
function getPhaseHeights() {
  const h0 = 0;
  const h1 = 110;
  const h2 = 380;
  const h3 = window.innerHeight * 0.82;
  return [h0, h1, h2, h3];
}

/* -------------------------------------------
   Phase handlers
------------------------------------------- */
function showPhase1() {
  const h = getPhaseHeights()[1];
  drawer.style.height = h + "px";
  backdrop.classList.add("show");

  p1.style.display = "flex";
  p2.style.display = "none";
  p3.style.display = "none";

  drawerArrowTop.setAttribute("stroke", "#777");
  drawerArrowBottom.setAttribute("stroke", "#fff");

  setDrawerHamburgerTint("#444", 0.3);

  phase = 1;
}

function showPhase2() {
  const h = getPhaseHeights()[2];
  drawer.style.height = h + "px";

  p1.style.display = "flex";
  p2.style.display = "grid";
  p3.style.display = "none";

  drawerArrowTop.setAttribute("stroke", "#fff");
  drawerArrowBottom.setAttribute("stroke", "#fff");

  setDrawerHamburgerTint("#444", 0.3);

  phase = 2;
}

function showPhase3() {
  const h = getPhaseHeights()[3];
  drawer.style.height = h + "px";

  p1.style.display = "flex";
  p2.style.display = "none";
  p3.style.display = "grid";

  drawerArrowTop.setAttribute("stroke", "#fff");
  drawerArrowBottom.setAttribute("stroke", "#fff");

  setDrawerHamburgerTint("#444", 0.3);

  phase = 3;
}

function closeDrawer() {
  drawer.style.height = "0px";
  backdrop.classList.remove("show");
  phase = 0;
}

/* -------------------------------------------
   Tap-driven progression
------------------------------------------- */
function advancePhase() {
  if (phase === 0) showPhase1();
  else if (phase === 1) showPhase2();
  else if (phase === 2) showPhase3();
  else closeDrawer();
}

/* -------------------------------------------
   Phase 0 launcher click
------------------------------------------- */
launcher.addEventListener("click", () => {
  if (phase === 0) showPhase1();
  else closeDrawer();
});

/* -------------------------------------------
   Click on arrows → advance phase
------------------------------------------- */
arrowSVG.addEventListener("click", () => {
  if (!isDragging) advancePhase();
});

/* -------------------------------------------
   Drag handling
------------------------------------------- */
function getY(e) {
  return (e.touches ? e.touches[0].clientY : e.clientY);
}

function onDragStart(e) {
  if (phase === 0) return;
  isDragging = true;
  dragMoved = false;

  dragStartY = getY(e);
  dragStartHeight = drawer.getBoundingClientRect().height;
  drawer.style.transition = "none";

  e.preventDefault();
}

function onDragMove(e) {
  if (!isDragging) return;

  const currentY = getY(e);
  const deltaY = dragStartY - currentY;

  if (Math.abs(deltaY) > 4) dragMoved = true;

  const heights = getPhaseHeights();
  let newH = dragStartHeight + deltaY;

  // boundaries
  newH = Math.max(0, Math.min(heights[3], newH));

  drawer.style.height = newH + "px";
}

function onDragEnd() {
  if (!isDragging) return;
  isDragging = false;

  drawer.style.transition = "height 0.35s ease";

  if (!dragMoved) {
    advancePhase();
    return;
  }

  // snap to nearest phase
  const heights = getPhaseHeights();
  const currentHeight = parseFloat(getComputedStyle(drawer).height);

  let nearest = 0;
  let nearestDist = Infinity;

  heights.forEach((h, idx) => {
    const d = Math.abs(currentHeight - h);
    if (d < nearestDist) {
      nearest = idx;
      nearestDist = d;
    }
  });

  if (nearest === 0) closeDrawer();
  if (nearest === 1) showPhase1();
  if (nearest === 2) showPhase2();
  if (nearest === 3) showPhase3();
}

/* -------------------------------------------
   Attach drag listeners
------------------------------------------- */
headerTouch.addEventListener("mousedown", onDragStart);
window.addEventListener("mousemove", onDragMove);
window.addEventListener("mouseup", onDragEnd);

headerTouch.addEventListener("touchstart", onDragStart, { passive: false });
window.addEventListener("touchmove", onDragMove, { passive: false });
window.addEventListener("touchend", onDragEnd);
window.addEventListener("touchcancel", onDragEnd);

/* -------------------------------------------
   Backdrop closes drawer
------------------------------------------- */
backdrop.addEventListener("click", closeDrawer);
