<div class="ref">
    <?php if ($_GET['ref']) { ?>
        <h2 class="ref__titulo">Você recebeu R$7 de uma pessoa queridíssima!</h2>
        <div class="ref__chamada">Crie agora sua conta no site e receba seu Cupom Mágico para encher sua geladeira de comida gostosa.</div>
    <?php } else { ?>
        <h2 class="ref__titulo">Indique & ganhe!</h2>
        <div class="ref__chamada">Cadastre-se em nosso site e comece agora a ganhar Descontos Mágicos!<br/>Para cada pessoa querida que utilizar o seu link e comprar online, você ganha R$ 7 em desconto no nosso site. 10 amigos compraram? Você ganha R$ 70! É chocante!</div>
    <?php } ?>
	<div class="ref__registro">
		<form method="post" class="woocommerce-form woocommerce-form-register register"
			<?php do_action( 'woocommerce_register_form_tag' ); ?>>

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

			<div class="form-group">
				<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span
						class="required">*</span></label>
				<input type="text" class="form-control woocommerce-Input woocommerce-Input--text input-text"
					name="username" id="reg_username" autocomplete="username"
					value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</div>


			<?php endif; ?>


			<div class="form-group">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span
						class="required">*</span></label>
				<input type="email" class="form-control woocommerce-Input woocommerce-Input--text input-text"
					name="email" id="reg_email" autocomplete="email"
					value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</div>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

			<p class="form-group">
				<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span
						class="required">*</span></label>
				<input type="password" class="form-control woocommerce-Input woocommerce-Input--text input-text"
					name="password" id="reg_password" autocomplete="new-password" />
			</p>

			<?php else : ?>

			<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-FormRow form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="btn btn-outline-primary btn-lg btn-block" name="register"
					value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>
	</div>
</div>
