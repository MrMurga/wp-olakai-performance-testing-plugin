<?php

class Wp_Olakai_Performance_Testing_Plugin_Admin_Page_Columns {
	const LIGHTHOUSE_SCORE_COLUMN = 'olakai_performance_score';
	private $action_lighthouse_run;

	public function __construct($pluginName, $pluginVersion) {

		$this->action_lighthouse_run = sprintf("page-%s-run", $pluginName);

		$this->addPostTableQuickAction();
	}

	private function addPostTableQuickAction() {
		add_filter('manage_page_posts_columns', function($columns) {
			return array_merge($columns, [self::LIGHTHOUSE_SCORE_COLUMN => __('Performance Score', 'textdomain')]);
		});
		 
		add_action('manage_page_posts_custom_column', function($column_key, $post_id) {
			if ($column_key != self::LIGHTHOUSE_SCORE_COLUMN) {
				return ;
			}

			$lhValue = get_post_meta($post_id, self::LIGHTHOUSE_SCORE_COLUMN, true);
			if (!$lhValue) {
				echo '<span style="color:red;">'; _e('N/A', 'textdomain'); echo '</span>';
				return ;
			}

			$lhValue = intval($lhValue);

			if ($lhValue < 40) {
				echo '<span style="color:red;">'; echo ($lhValue); echo '</span>';
			} else if ($lhValue < 70) {
				echo '<span style="color:yellow;">'; echo ($lhValue); echo '</span>';
			} else {
				echo '<span style="color:green;">'; echo ($lhValue); echo '</span>';
			}
		}, 10, 2);

		add_filter('page_row_actions', function ($actions, $post) {
			// Build your links URL.
			$url = admin_url( 'admin.php?page=' . $this->action_lighthouse_run .'&post_id=' . $post->ID );
			
			// You can check if the current user has some custom rights.
			//if ( current_user_can( 'edit_my_cpt', $post->ID ) ) {
			//}
	 
			// Include a nonce in this link
			$copy_link = wp_nonce_url( add_query_arg( array( 'action' => $this->action_lighthouse_run ), $url ), 'edit_my_cpt_nonce' );
	
			// Add the new Copy quick link.
			$actions = array_merge( $actions, array(
			'olakai_performance' => sprintf( '<a href="%1$s">%2$s</a>',
				esc_url( $copy_link ), 
				__('Run performance test')
			) 
			) );

			return $actions;
		}, 10, 2);
	}
}
