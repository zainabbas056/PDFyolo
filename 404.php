<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package PDFyolo
 */

get_header();

?>
	<header class="headBannerBlock bgCover textCenter" >
		<div class="alignHolder">
			<div class="align">
				<div class="container">
					<h1 class="textUppercase fwBlack"><?php esc_html_e( 'Nothing here', 'PDFyolo' ); ?></h1>
					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'PDFyolo' ); ?></p>
				</div>
			</div>
		</div>
	</header>
<?php
get_footer();