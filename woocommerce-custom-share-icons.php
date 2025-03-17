<?php 

function custom_woocommerce_share_icons() {
    global $product;

    // Get Product URL and Title
    $product_url   = urlencode(get_permalink($product->get_id()));
    $product_title = urlencode(get_the_title($product->get_id()));

    // Define Social Media Share Links
    $facebook_url = "https://www.facebook.com/sharer/sharer.php?u=$product_url";
    $twitter_url  = "https://twitter.com/intent/tweet?url=$product_url&text=$product_title";
    $whatsapp_url = "https://api.whatsapp.com/send?text=$product_title - $product_url";
    $telegram_url = "https://t.me/share/url?url=$product_url&text=$product_title";

    // Display Share Icons Below Categories
    echo '<div class="custom-share-icons" style="margin-top: 10px; display: flex; gap: 10px; align-items: center;">';
    echo '<span><b>Share: </b></span>';
    echo '<a href="' . esc_url($facebook_url) . '" target="_blank" style="color: #3b5998;"><i class="fab fa-facebook"></i></a>';
    echo '<a href="' . esc_url($twitter_url) . '" target="_blank" style="color: #1da1f2;"><i class="fab fa-twitter"></i></a>';
    echo '<a href="' . esc_url($whatsapp_url) . '" target="_blank" style="color: #25D366;"><i class="fab fa-whatsapp"></i></a>';
    echo '<a href="' . esc_url($telegram_url) . '" target="_blank" style="color: #0088cc;"><i class="fab fa-telegram"></i></a>';
    echo '<a href="#" onclick="copyProductLink(event)" style="color: #555;"><i class="fas fa-copy"></i></a>';
    echo '</div>';

    echo '<script>
        function copyProductLink(event) {
            event.preventDefault();
            var tempInput = document.createElement("input");
            tempInput.value = "' . esc_url(get_permalink($product->get_id())) . '";
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            alert("Product link copied to clipboard!");
        }
    </script>
	<style>
		.custom-share-icons a {
		text-decoration: none;
		font-size: 18px;
	}

	.custom-share-icons i {
		transition: 0.3s;
	}

	.custom-share-icons a:hover i {
		transform: scale(1.2);
	}
</style>';
}
add_action('woocommerce_single_product_summary', 'custom_woocommerce_share_icons', 25);
?>
