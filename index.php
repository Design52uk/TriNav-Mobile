<!-- ----------------------------------------------------------------------
   TriNav™ Mobile — Multi-Phase Intelligent Bottom Drawer Navigation
   © 2025 Mark Roberts & Design52 — All Rights Reserved.
   Developed with ChatGPT-assisted UI/UX engineering.

   Description:
   TriNav™ Mobile is a proprietary multi-stage vertical navigation system
   featuring:
     • Phase 0: Bottom-right floating launcher (hamburger) entry point
     • Phase 1: Compact 4-icon nav bar with dual-arrow controller
     • Phase 2: Expanded icon-grid view (4×N) with system-style sheet layout
     • Phase 3: Full expanded grid with titles (82vh adaptive height)

   Core UI/UX Behaviours:
     • Tap-based phase progression (0→1→2→3→0)
     • iOS-style drag gesture with smooth finger-tracking and snap-to-phase
     • Overlapping arrow + faint hamburger stack system (directional cueing)
     • Persistent Phase-1 nav across Phase-2/3 states
     • Dynamic arrow colouring per phase (grey/white semantic signals)
     • Intelligent auto-collapse via backdrop tap and downward swipe
     • Optional OS-style grip pill for drawer affordance

   This multi-phase navigation pattern, icon layering system, and 
   behavioural sequence constitute an original TriNav™ design.
   Protected under UK and international copyright law.
   Redistribution, reproduction, or commercial use requires permission.

   Version: TriNav™ Mobile v1.0
---------------------------------------------------------------------- -->



<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TriNAV v2</title>

<link rel="stylesheet" href="trinav.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<!-- PHASE 0 — LAUNCHER (BOTTOM-RIGHT HAMBURGER) -->
<div id="phase0-launcher">
  <!-- SVG hamburger (primary) -->
  <svg id="launchHamurger" viewBox="0 0 24 24" width="26" height="26" aria-hidden="true">
    <line x1="5" y1="8"  x2="19" y2="8"  stroke="#fff" stroke-width="2.2" stroke-linecap="round" />
    <line x1="5" y1="12" x2="19" y2="12" stroke="#fff" stroke-width="2.2" stroke-linecap="round" />
    <line x1="5" y1="16" x2="19" y2="16" stroke="#fff" stroke-width="2.2" stroke-linecap="round" />
  </svg>

  <!-- FontAwesome fallback (kept but hidden by default) 
  <i class="fa-solid fa-bars hamburger-fallback"></i>-->
</div>

<!-- BACKDROP -->
<div id="backdrop"></div>

<!-- DRAWER -->
<div id="drawer">

  <!-- FULL WIDTH TOUCH AREA (HEADER TAP) -->
  <div id="drawer-header-touch">
  <div class="drawer-grip"></div>
</div>

  <!-- Drawer Arrows + Hamburger (TOP-RIGHT) -->
  <div id="drawer-arrows" class="drawer-arrows-right">
    <svg id="drawerArrowsSVG" viewBox="0 0 24 24" width="32" height="32"> <line class="drawer-hamburger-line" x1="6" y1="7" x2="18" y2="7" stroke="#444" stroke-width="1.8" stroke-linecap="round" /> <line class="drawer-hamburger-line" x1="6" y1="11" x2="18" y2="11" stroke="#444" stroke-width="1.8" stroke-linecap="round" /> <line class="drawer-hamburger-line" x1="6" y1="15" x2="18" y2="15" stroke="#444" stroke-width="1.8" stroke-linecap="round" /> <path id="drawerArrowTop" d="M7 11 L12 7 L17 11" stroke="#777" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" /> <path id="drawerArrowBottom" d="M7 15 L12 11 L17 15" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" /> </svg>
  </div>

  <!-- PHASE 1 — Compact 4-icon Nav (always visible in 1, 2, 3) -->
  <div id="phase1" class="phase1-nav">
    <i class="fa-solid fa-house"></i>
    <i class="fa-solid fa-magnifying-glass"></i>
    <i class="fa-solid fa-layer-group"></i>
    <i class="fa-solid fa-user"></i>
  </div>

  <!-- PHASE 2 — Icons Only Grid -->
  <div id="phase2" class="grid-phase2">
    <div class="item"><i class="fa-solid fa-star"></i></div>
    <div class="item"><i class="fa-solid fa-camera"></i></div>
    <div class="item"><i class="fa-solid fa-heart"></i></div>
    <div class="item"><i class="fa-solid fa-bolt"></i></div>

    <div class="item"><i class="fa-solid fa-envelope"></i></div>
    <div class="item"><i class="fa-solid fa-gear"></i></div>
    <div class="item"><i class="fa-solid fa-chart-column"></i></div>
    <div class="item"><i class="fa-solid fa-music"></i></div>

    <div class="item"><i class="fa-solid fa-cloud"></i></div>
    <div class="item"><i class="fa-solid fa-folder"></i></div>
    <div class="item"><i class="fa-solid fa-calendar-day"></i></div>
    <div class="item"><i class="fa-solid fa-comment-dots"></i></div>
  </div>

  <!-- PHASE 3 — Grid With Labels -->
  <div id="phase3" class="grid-phase3">
    <div class="item"><i class="fa-solid fa-star"></i><span>Favorites</span></div>
    <div class="item"><i class="fa-solid fa-camera"></i><span>Camera</span></div>
    <div class="item"><i class="fa-solid fa-heart"></i><span>Likes</span></div>
    <div class="item"><i class="fa-solid fa-bolt"></i><span>Boost</span></div>

    <div class="item"><i class="fa-solid fa-envelope"></i><span>Mail</span></div>
    <div class="item"><i class="fa-solid fa-gear"></i><span>Settings</span></div>
    <div class="item"><i class="fa-solid fa-chart-column"></i><span>Stats</span></div>
    <div class="item"><i class="fa-solid fa-music"></i><span>Music</span></div>

    <div class="item"><i class="fa-solid fa-cloud"></i><span>Cloud</span></div>
    <div class="item"><i class="fa-solid fa-folder"></i><span>Files</span></div>
    <div class="item"><i class="fa-solid fa-calendar-day"></i><span>Calendar</span></div>
    <div class="item"><i class="fa-solid fa-comment-dots"></i><span>Messages</span></div>
  </div>

</div>

<script src="trinav.js"></script>
</body>
</html>
