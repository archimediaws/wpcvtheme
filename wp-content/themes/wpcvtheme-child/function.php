<?php // Balise d'ouverture PHP - il ne doit rien avoir avant cela même pas un espace

// Fonction personnalisée à inclure
function favicon_link() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />' . "\n";
}
add_action( 'wp_head', 'favicon_link' );