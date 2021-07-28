<?php

/**
 * Sanitize the DB on database clone, switch between Drupal and WordPress.
 */

// Don't ever sanitize the database on the live environment. Doing so would
// destroy the canonical version of the data.
if (defined('PANTHEON_ENVIRONMENT') && (PANTHEON_ENVIRONMENT !== 'live')) {
    echo "Sanitizing the database...\n\n";

    // Switch between frameworks.
    switch($_ENV['FRAMEWORK']) {
        case 'drupal':
        case 'drupal8':
            passthru('drush sql-sanitize -y');
            break;
        case 'wordpress':
        case 'wordpress_network':
            $query = "UPDATE wp_users SET user_email = CONCAT(user_login, '@localhost'), user_pass = MD5(CONCAT('MILDSECRET', user_login)), user_activation_key = '';";
            passthru("wp db query $query");
            break;
        default:
            echo "No compatible framework found.";
            break;
    }

    echo "Database sanitization complete.\n";
}
