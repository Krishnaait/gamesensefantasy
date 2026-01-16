<?php
/**
 * GameSense Fantasy - Disclaimer Page
 */

require_once '../config/config.php';

$page_title = "Disclaimer";
$page_description = "Read our Disclaimer page for important information about GameSense Fantasy and responsible gaming.";

include '../includes/header.php';
?>

<section class="disclaimer-header text-center mb-2xl animate-fadeIn">
    <div class="container">
        <h1>Disclaimer</h1>
        <p class="text-lg">Important Information About Our Platform</p>
    </div>
</section>

<section class="disclaimer-content">
    <div class="container">
        <div class="card p-2xl alert alert-warning mb-2xl">
            <h2 class="text-gold mb-lg">⚠️ Age & Responsible Gaming Disclaimer</h2>
            <p class="mb-md"><strong>IMPORTANT: This website is intended for users aged 18 years and above only.</strong></p>
            <p>By accessing and using <?php echo SITE_NAME; ?>, you confirm that you are at least 18 years of age and meet all eligibility requirements to use this platform.</p>
        </div>

        <div class="card p-2xl mb-2xl">
            <h2 class="mb-lg">1. No Real Money Gambling</h2>
            <p><?php echo SITE_NAME; ?> is a social gaming platform for entertainment purposes only. We do not offer real money gambling, betting, or any form of financial gaming. All games are played using virtual coins that have no real-world value and cannot be exchanged for money, prizes, or any items of value.</p>

            <h2 class="mb-lg mt-xl">2. Virtual Coins</h2>
            <p>Virtual coins on our platform:</p>
            <ul class="mb-lg">
                <li>Have no real monetary value</li>
                <li>Cannot be purchased with real money</li>
                <li>Cannot be exchanged for real money or prizes</li>
                <li>Cannot be transferred to other users</li>
                <li>Are provided for entertainment purposes only</li>
            </ul>

            <h2 class="mb-lg mt-xl">3. Entertainment Only</h2>
            <p><?php echo SITE_NAME; ?> is designed purely for entertainment and recreational purposes. It is not a gambling platform and should not be used as a means to earn money or generate income. If you are looking to gamble with real money, please seek licensed and regulated gambling platforms.</p>

            <h2 class="mb-lg mt-xl">4. Responsible Gaming</h2>
            <p>We are committed to promoting responsible gaming. If you feel that your gaming habits are becoming problematic, we encourage you to:</p>
            <ul class="mb-lg">
                <li>Take regular breaks from gaming</li>
                <li>Set time limits for your gaming sessions</li>
                <li>Never spend real money on virtual coins</li>
                <li>Seek help from professional resources if needed</li>
                <li>Contact us for support and guidance</li>
            </ul>

            <h2 class="mb-lg mt-xl">5. Game Fairness</h2>
            <p>All games on <?php echo SITE_NAME; ?> are designed to be fair and use certified Random Number Generators (RNG). However, like all games of chance, outcomes are unpredictable, and there is no guaranteed way to win.</p>

            <h2 class="mb-lg mt-xl">6. Limitation of Liability</h2>
            <p><?php echo COMPANY_NAME; ?> and its employees, agents, and representatives shall not be liable for any direct, indirect, incidental, special, or consequential damages arising out of or relating to your use of <?php echo SITE_NAME; ?> or any content or services provided through the website.</p>

            <h2 class="mb-lg mt-xl">7. No Warranties</h2>
            <p>The website and all content, materials, and services are provided on an "as-is" basis without any warranties, express or implied. We make no representations or warranties regarding the accuracy, completeness, or reliability of any information on the website.</p>

            <h2 class="mb-lg mt-xl">8. Prohibited Activities</h2>
            <p>Users are prohibited from:</p>
            <ul class="mb-lg">
                <li>Using the platform if they are under 18 years of age</li>
                <li>Attempting to cheat or manipulate games</li>
                <li>Gaining unauthorized access to the website or systems</li>
                <li>Harassing or abusing other users</li>
                <li>Using automated tools or bots</li>
                <li>Violating any applicable laws or regulations</li>
            </ul>

            <h2 class="mb-lg mt-xl">9. Geographical Restrictions</h2>
            <p><?php echo SITE_NAME; ?> is available to users in India. Users accessing the website from other jurisdictions do so at their own risk and are responsible for complying with local laws and regulations.</p>

            <h2 class="mb-lg mt-xl">10. Changes to Disclaimer</h2>
            <p>We reserve the right to modify this disclaimer at any time. Changes will be effective immediately upon posting to the website. Your continued use of the website constitutes your acceptance of the updated disclaimer.</p>

            <h2 class="mb-lg mt-xl">11. Responsible Gaming Resources</h2>
            <p>If you or someone you know is struggling with gaming habits, please reach out to professional resources:</p>
            <ul class="mb-lg">
                <li>National Council for Problem Gambling</li>
                <li>Gamblers Anonymous</li>
                <li>Local mental health services</li>
            </ul>

            <h2 class="mb-lg mt-xl">12. Contact Us</h2>
            <p>If you have any questions about this disclaimer, please contact us at:</p>
            <p>
                <strong><?php echo COMPANY_NAME; ?></strong><br>
                Email: <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a><br>
                Address: <?php echo COMPANY_ADDRESS; ?>
            </p>
        </div>

        <div class="alert alert-info text-center">
            <p><strong>Remember:</strong> GameSense Fantasy is for entertainment only. Play responsibly and within your means.</p>
        </div>
    </div>
</section>

<style>
.disclaimer-header {
    padding: 60px 0;
    background: linear-gradient(to bottom, rgba(124, 58, 237, 0.05), transparent);
}

ul {
    list-style-position: inside;
    padding-left: 20px;
}

ul li {
    margin-bottom: 10px;
}
</style>

<?php include '../includes/footer.php'; ?>
