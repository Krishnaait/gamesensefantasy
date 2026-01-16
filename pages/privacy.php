<?php
/**
 * GameSense Fantasy - Privacy Policy Page
 */

require_once '../config/config.php';

$page_title = "Privacy Policy";
$page_description = "Read our Privacy Policy to understand how we handle your information on GameSense Fantasy.";

include '../includes/header.php';
?>

<section class="privacy-header text-center mb-2xl animate-fadeIn">
    <div class="container">
        <h1>Privacy Policy</h1>
        <p class="text-lg">Last Updated: <?php echo getLastUpdated(); ?></p>
    </div>
</section>

<section class="privacy-content">
    <div class="container">
        <div class="card p-2xl">
            <h2 class="mb-lg">1. Introduction</h2>
            <p><?php echo COMPANY_NAME; ?> ("we", "us", "our", or "Company") operates the <?php echo SITE_NAME; ?> website. This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our website and the choices you have associated with that data.</p>

            <h2 class="mb-lg mt-xl">2. Information Collection and Use</h2>
            <p><?php echo SITE_NAME; ?> is designed to operate without requiring user registration or login. We collect minimal information:</p>
            <ul class="mb-lg">
                <li><strong>Browser Information:</strong> We may collect information about your browser type, IP address, and pages visited through cookies and similar technologies</li>
                <li><strong>Contact Information:</strong> If you contact us via email or contact form, we collect the information you provide</li>
                <li><strong>Game Data:</strong> We track your game activity and virtual coin balance for gameplay purposes only</li>
            </ul>

            <h2 class="mb-lg mt-xl">3. Use of Data</h2>
            <p><?php echo SITE_NAME; ?> uses the collected data for various purposes:</p>
            <ul class="mb-lg">
                <li>To provide and maintain our website and services</li>
                <li>To notify you about changes to our website or services</li>
                <li>To provide customer support</li>
                <li>To gather analysis or valuable information so that we can improve our website</li>
                <li>To monitor the usage of our website</li>
                <li>To detect, prevent and address technical issues and fraud</li>
            </ul>

            <h2 class="mb-lg mt-xl">4. Security of Data</h2>
            <p>The security of your data is important to us, but remember that no method of transmission over the Internet or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your personal data, we cannot guarantee its absolute security.</p>

            <h2 class="mb-lg mt-xl">5. Cookies</h2>
            <p>We use cookies to enhance your experience on our website. Cookies are small files stored on your device that help us remember your preferences and track your gameplay. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.</p>

            <h2 class="mb-lg mt-xl">6. Third-Party Links</h2>
            <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of these external sites. We encourage you to review the privacy policy of any website before providing your personal information.</p>

            <h2 class="mb-lg mt-xl">7. Children's Privacy</h2>
            <p>Our website is not intended for children under the age of 18. We do not knowingly collect personal information from children under 18. If we become aware that a child under 18 has provided us with personal data, we will delete such information immediately.</p>

            <h2 class="mb-lg mt-xl">8. Changes to This Privacy Policy</h2>
            <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last Updated" date at the top of this page.</p>

            <h2 class="mb-lg mt-xl">9. Your Rights</h2>
            <p>You have the right to:</p>
            <ul class="mb-lg">
                <li>Access the personal data we hold about you</li>
                <li>Request correction of inaccurate data</li>
                <li>Request deletion of your data</li>
                <li>Opt-out of certain data collection practices</li>
            </ul>

            <h2 class="mb-lg mt-xl">10. Contact Us</h2>
            <p>If you have any questions about this Privacy Policy, please contact us at:</p>
            <p>
                <strong><?php echo COMPANY_NAME; ?></strong><br>
                Email: <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a><br>
                Address: <?php echo COMPANY_ADDRESS; ?>
            </p>

            <h2 class="mb-lg mt-xl">11. Data Protection</h2>
            <p>We comply with applicable data protection laws and regulations. Your personal data is protected and processed in accordance with privacy principles and applicable laws.</p>
        </div>
    </div>
</section>

<style>
.privacy-header {
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
