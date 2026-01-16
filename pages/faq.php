<?php
/**
 * GameSense Fantasy - FAQ Page
 */

require_once '../config/config.php';

$page_title = "Frequently Asked Questions";
$page_description = "Find answers to common questions about GameSense Fantasy, our games, and virtual coins.";

include '../includes/header.php';
?>

<section class="faq-header text-center mb-2xl animate-fadeIn">
    <div class="container">
        <h1>Frequently Asked Questions</h1>
        <p class="text-lg">Everything you need to know about <?php echo SITE_NAME; ?>.</p>
    </div>
</section>

<section class="faq-content">
    <div class="container">
        <div class="card p-2xl">
            <div class="faq-item mb-xl">
                <h3 class="text-gold mb-sm">Is GameSense Fantasy free to play?</h3>
                <p>Yes, 100%. All games on our platform are completely free to play. We use virtual coins that have no real-world value.</p>
            </div>

            <div class="faq-item mb-xl">
                <h3 class="text-gold mb-sm">Can I win real money?</h3>
                <p>No. GameSense Fantasy is a social gaming platform for entertainment purposes only. Virtual coins cannot be exchanged for real money, prizes, or any other items of value.</p>
            </div>

            <div class="faq-item mb-xl">
                <h3 class="text-gold mb-sm">Do I need to register or login?</h3>
                <p>No registration or login is required. You can start playing any of our games instantly as an anonymous user.</p>
            </div>

            <div class="faq-item mb-xl">
                <h3 class="text-gold mb-sm">How do I get more coins?</h3>
                <p>You start with 1,000 virtual coins. You can also receive daily bonus coins just by visiting the website. If you run out of coins, your balance will be automatically topped up after a certain period.</p>
            </div>

            <div class="faq-item mb-xl">
                <h3 class="text-gold mb-sm">Are the games fair?</h3>
                <p>Absolutely. All our games use certified Random Number Generators (RNG) to ensure that every outcome is completely random and fair for all players.</p>
            </div>

            <div class="faq-item mb-xl">
                <h3 class="text-gold mb-sm">Is there an age requirement?</h3>
                <p>Yes, you must be at least 18 years old to use our platform and play our games.</p>
            </div>

            <div class="faq-item mb-xl">
                <h3 class="text-gold mb-sm">Is this gambling?</h3>
                <p>No. Since there is no real money involved, no deposits, and no possibility of winning real money or prizes, GameSense Fantasy is classified as social gaming, not gambling.</p>
            </div>

            <div class="faq-item mb-xl">
                <h3 class="text-gold mb-sm">How can I contact support?</h3>
                <p>You can reach us via email at <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a> or through our contact form. We do not provide phone support.</p>
            </div>
        </div>

        <div class="mt-2xl text-center">
            <p>Still have questions? <a href="/pages/contact.php" class="text-gold">Contact our support team</a>.</p>
        </div>
    </div>
</section>

<style>
.faq-header {
    padding: 60px 0;
    background: linear-gradient(to bottom, rgba(124, 58, 237, 0.05), transparent);
}

.faq-item {
    border-bottom: 1px solid var(--border-light);
    padding-bottom: var(--spacing-lg);
}

.faq-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
</style>

<?php include '../includes/footer.php'; ?>
