<?php
/**
 * Footer Include File
 * Displayed on all pages
 */
?>
    </main>

    <!-- Footer Section -->
    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <!-- Company Info -->
                <div class="footer-section">
                    <h3><?php echo BRAND_NAME; ?></h3>
                    <p class="company-info">
                        <strong><?php echo COMPANY_NAME; ?></strong><br>
                        CIN: <?php echo COMPANY_CIN; ?><br>
                        GST: <?php echo COMPANY_GST; ?><br>
                        PAN: <?php echo COMPANY_PAN; ?>
                    </p>
                    <p class="company-info">
                        <?php echo COMPANY_ADDRESS; ?>
                    </p>
                    <p class="company-info">
                        Email: <a href="mailto:<?php echo COMPANY_EMAIL; ?>"><?php echo COMPANY_EMAIL; ?></a>
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/pages/games.php">All Games</a></li>
                        <li><a href="/pages/about.php">About Us</a></li>
                        <li><a href="/pages/contact.php">Contact Us</a></li>
                        <li><a href="/pages/faq.php">FAQ</a></li>
                    </ul>
                </div>

                <!-- Legal Pages -->
                <div class="footer-section">
                    <h3>Legal & Policies</h3>
                    <ul>
                        <li><a href="/pages/terms.php">Terms of Use</a></li>
                        <li><a href="/pages/privacy.php">Privacy Policy</a></li>
                        <li><a href="/pages/disclaimer.php">Disclaimer</a></li>
                        <li><a href="/pages/community-rules.php">Community Rules</a></li>
                        <li><a href="/pages/fair-play.php">Fair Play Policy</a></li>
                        <li><a href="/pages/responsible-gaming.php">Responsible Gaming</a></li>
                    </ul>
                </div>

                <!-- Social & Trust -->
                <div class="footer-section">
                    <h3>Trust & Safety</h3>
                    <p class="company-info">
                        100% Free to Play Social Gaming Platform. No real money involved.
                    </p>
                    <p class="company-info">
                        Must be 18+ years of age to play.
                    </p>
                    <div class="trust-badges">
                        <!-- Add trust badges here if needed -->
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p>&copy; <?php echo getCurrentYear(); ?> <?php echo COMPANY_NAME; ?>. All rights reserved.</p>
                <p>Last Updated: <?php echo getLastUpdated(); ?></p>
            </div>
        </div>
    </footer>

    <!-- Global Scripts -->
    <script src="<?php echo ASSETS_URL; ?>/js/main.js"></script>
    <?php if (isset($page_js)): ?>
        <script src="<?php echo ASSETS_URL; ?>/js/<?php echo htmlspecialchars($page_js); ?>"></script>
    <?php endif; ?>
</body>
</html>
