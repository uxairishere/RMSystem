<?php 
require('stripe-master/init.php');
$publishable_key = "pk_test_51MGIynHHkkovW56KSh22cDBtjFIoYEznZJM5Oe8hadWmqOgcKICVzEnp1u6EEMkfjUBHiu628npc7PnlBqKrgF8s00yv2I3oCY";
$secret_key = "sk_test_51MGIynHHkkovW56K7A9rZX8AZB7xRmt4NQhEhUyBgSG7OqRhQkXmArnGH4PXG06ELZqzxzIBR2vkubqwgn0oSx4i00ld528GHm";
\Stripe\Stripe::setApiKey($secret_key);
?>