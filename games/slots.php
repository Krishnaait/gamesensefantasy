<?php
require_once '../config/config.php';
$page_title = "Slots Game";
$page_js = "slots.js";
include '../includes/header.php';
?>
<div class="game-container"><div class="game-wrapper">
<div class="game-area"><h2 class="game-title">🎰 SLOTS 🎰</h2>
<div class="slot-machine"><div class="slot-display">
<div class="reel" id="reel1"><div class="symbol">🍒</div></div>
<div class="reel" id="reel2"><div class="symbol">🍒</div></div>
<div class="reel" id="reel3"><div class="symbol">🍒</div></div>
</div></div>
<div class="payout-table mt-lg"><h3>💰 Payouts</h3>
<div>🍒🍒🍒=5x | 🍋🍋🍋=10x | 🍊🍊🍊=15x | 🍇🍇🍇=20x | 💎💎💎=50x | ⭐⭐⭐=100x | 7️⃣7️⃣7️⃣=500x</div>
</div></div>
<div class="control-panel"><h2>Controls</h2>
<div class="control-section mb-xl"><label>Bet Amount</label>
<input type="number" id="betAmount" value="10" min="1">
<div class="quick-bet-buttons mt-md">
<button class="btn btn-sm quick-bet" data-amount="10">10</button>
<button class="btn btn-sm quick-bet" data-amount="50">50</button>
<button class="btn btn-sm quick-bet" data-amount="100">100</button>
<button class="btn btn-sm quick-bet" data-amount="max">MAX</button>
</div></div>
<div class="control-section mb-xl"><label>Credits</label><div id="credits">1000</div></div>
<div class="control-section mb-xl"><label>Last Win</label><div id="lastWin">0</div></div>
<button class="btn btn-primary btn-block" id="spinButton">🎰 SPIN 🎰</button>
</div></div></div>
<style>
.slot-machine{background:linear-gradient(135deg,#1e1b4b,#312e81);border:4px solid gold;border-radius:20px;padding:30px;margin:30px auto;max-width:600px}
.slot-display{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;background:rgba(0,0,0,0.5);padding:30px;border-radius:15px}
.reel{background:linear-gradient(135deg,#fff,#f0f0f0);border:3px solid gold;border-radius:10px;padding:30px;min-height:120px;display:flex;align-items:center;justify-content:center}
.symbol{font-size:64px}
.reel.spinning .symbol{animation:spin 0.1s linear infinite}
@keyframes spin{0%{transform:translateY(0)}100%{transform:translateY(-100%)}}
.payout-table{background:rgba(255,255,255,0.05);border-radius:15px;padding:20px;text-align:center}
</style>
<?php include '../includes/footer.php'; ?>
