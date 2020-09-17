<div class="container">
	<div class="row">
		<div class="col-lg-10 mx-auto my-3">
			<?php if (is_user_logged_in()) {
                    get_template_part( 'components/referral-home');
                } else {
                    get_template_part( 'components/referral-newcustomer');
                } ?>
		</div>
	</div>
</div>
