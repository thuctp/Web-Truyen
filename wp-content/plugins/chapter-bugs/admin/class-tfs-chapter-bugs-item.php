<?php
if ( !class_exists('Tfs_Chapter_Bugs_Item') ) :
/**
 * Untag Me Class
 * 
 * @package Vcx User Membership
 * @version 1.0
 */

class Tfs_Chapter_Bugs_Item {

	var $mode = 'main';
	var $base_page = 'admin.php?page=chapter-bugs';
	var $id = false;

	// initiate the manage page
	function Tfs_Chapter_Bugs_Item() {
		// GET variables
		if ( isset( $_GET['id'] ) )
			$this->id  = (int) $_GET['id'];
		if ( isset($_GET['mode']) )
			$this->mode = trim ($_GET['mode']);
        // Should be only called via manage staffs overview
		if ( isset( $_POST['page'] ) && $_POST['page'] == 'chapter-bugs' )
			$this->processor_chapter_bugs_list();						
		//Look for other POST process
		if ( !empty($_POST) || !empty($_GET) )
			$this->processor();	
	}

	function controller() {			
		switch ( $this->mode ) {
			case 'edit':
				include_once (dirname (__FILE__) . '/tfs-chapter-bugs-edit.php');
				chapter_bugs_edit();
			break;
			case 'search':
				include_once (dirname (__FILE__) . '/tfs-chapter-bugs-search.php');
				chapter_bugs_search();	
			break; 
			default:
				include_once( dirname ( __FILE__ ) . '/tfs-chapter-bugs-item-overview.php');
				item_overview();
			break;
		}
	}

	function processor() {	
		global $tfscb_db;        
		//Delete a untag me
		if ($this->mode == 'del') {
			$tfscb_db->delete_chapter_bugs( $this->id );
		 	$this->mode = 'main';
		}		
	}
	
	function processor_chapter_bugs_list() {
		global $tfscb_db;
		//bulk update in a single untag me
		if (isset ($_POST['bulkaction']) && isset ($_POST['doaction']))  {			
			switch ($_POST['bulkaction']) {
				case 'no_action';
					break;
				case 'del-chapter-bugs':
					if ( is_array($_POST['doaction']) ) {
						foreach ( $_POST['doaction'] as $key => $value ) {
							$tfscb_db->delete_chapter_bugs( $value );						
						}
					}
					break;
			}
		}
	}
    
	/**
	 * Display the pagination.
	 *
	 * @since 1.8.0
     * @author taken from WP core (see includes/class-wp-list-table.php)
	 * @return string echo the html pagination bar
	 */
	function pagination( $which, $current, $total_items, $per_page ) {
        $total_pages = ($per_page > 0) ? ceil( $total_items / $per_page ) : 1;
		$output = '<span class="displaying-num">' . sprintf( _n( '1 item', '%s items', $total_items ), number_format_i18n( $total_items ) ) . '</span>';
		$current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$current_url = remove_query_arg( array( 'hotkeys_highlight_last', 'hotkeys_highlight_first' ), $current_url );
		$page_links = array();
		$disable_first = $disable_last = '';
		if ( $current == 1 )
			$disable_first = ' disabled';
		if ( $current == $total_pages )
			$disable_last = ' disabled';
		$page_links[] = sprintf( "<a class='%s' title='%s' href='%s'>%s</a>",
			'first-page' . $disable_first,
			esc_attr__( 'Go to the first page' ),
			esc_url( remove_query_arg( 'paged', $current_url ) ),
			'&laquo;'
		);
		$page_links[] = sprintf( "<a class='%s' title='%s' href='%s'>%s</a>",
			'prev-page' . $disable_first,
			esc_attr__( 'Go to the previous page' ),
			esc_url( add_query_arg( 'paged', max( 1, $current-1 ), $current_url ) ),
			'&lsaquo;'
		);		
		$html_current_page = $current;
		$html_total_pages = sprintf( "<span class='total-pages'>%s</span>", number_format_i18n( $total_pages ) );
		$page_links[] = '<span class="paging-input">' . sprintf( _x( '%1$s of %2$s', 'paging' ), $html_current_page, $html_total_pages ) . '</span>';
		$page_links[] = sprintf( "<a class='%s' title='%s' href='%s'>%s</a>",
			'next-page' . $disable_last,
			esc_attr__( 'Go to the next page' ),
			esc_url( add_query_arg( 'paged', min( $total_pages, $current+1 ), $current_url ) ),
			'&rsaquo;'
		);
		$page_links[] = sprintf( "<a class='%s' title='%s' href='%s'>%s</a>",
			'last-page' . $disable_last,
			esc_attr__( 'Go to the last page' ),
			esc_url( add_query_arg( 'paged', $total_pages, $current_url ) ),
			'&raquo;'
		);
		$output .= "\n<span class='pagination-links'>" . join( "\n", $page_links ) . '</span>';
		if ( $total_pages )
			$page_class = $total_pages < 2 ? ' one-page' : '';
		else
			$page_class = ' no-pages';
		$pagination = "<div class='tablenav-pages{$page_class}'>$output</div>";
		echo $pagination;
	}

}
endif;
?>