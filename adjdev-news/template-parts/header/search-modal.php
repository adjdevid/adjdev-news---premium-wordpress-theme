<?php
/**
 * Search Modal Component
 *
 * @package ADJDEV_News
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="adjdev-search-modal" class="adjdev-search-modal" aria-hidden="true" role="dialog">
	<div class="search-modal-backdrop search-modal-close"></div>
	<div class="search-modal-dialog">
		<button type="button" class="search-modal-close search-close-btn" aria-label="<?php esc_attr_e( 'Close search', 'adjdev-news' ); ?>">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
		</button>
		
		<div class="search-modal-content">
			<h3 class="search-modal-title"><?php esc_html_e( 'Search Articles, Topics & News', 'adjdev-news' ); ?></h3>
			<form role="search" method="get" class="search-form modal-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="modal-input-group">
					<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
					<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Type your search query...', 'adjdev-news' ); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
					<button type="submit" class="search-submit"><?php esc_html_e( 'Search', 'adjdev-news' ); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>

<style>
.adjdev-search-modal {
  position: fixed;
  inset: 0;
  z-index: 99999;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  visibility: hidden;
  transition: all 0.25s ease;
}
.adjdev-search-modal.is-active {
  opacity: 1;
  visibility: visible;
}
.search-modal-backdrop {
  position: absolute;
  inset: 0;
  background: rgba(15, 23, 42, 0.85);
  backdrop-filter: blur(4px);
}
.search-modal-dialog {
  position: relative;
  z-index: 2;
  width: 90%;
  max-width: 640px;
  background: var(--adjdev-surface-card);
  border-radius: var(--adjdev-radius-lg);
  padding: 36px 30px;
  box-shadow: var(--adjdev-shadow-lg);
  border: 1px solid var(--adjdev-border);
}
.search-close-btn {
  position: absolute;
  top: 16px;
  right: 16px;
  background: transparent;
  border: none;
  cursor: pointer;
  color: var(--adjdev-text-muted);
}
.search-modal-title {
  font-size: 1.3rem;
  margin-bottom: 20px;
  text-align: center;
}
.modal-input-group {
  display: flex;
  align-items: center;
  border: 2px solid var(--adjdev-border);
  border-radius: var(--adjdev-radius);
  padding: 8px 14px;
  gap: 12px;
}
.modal-input-group input {
  flex-grow: 1;
  border: none;
  outline: none;
  background: transparent;
  font-size: 1.1rem;
  color: var(--adjdev-text);
}
.modal-input-group button {
  background: var(--adjdev-primary);
  color: #fff;
  border: none;
  padding: 8px 18px;
  border-radius: var(--adjdev-radius-sm);
  font-weight: 600;
  cursor: pointer;
}
</style>
