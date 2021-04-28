<?php
// *** show main untag me list
function item_overview() {
	global $tfscb, $tfscb_db, $menu;

	//Build the pagination for more than 10 staffs
    $_GET['paged'] = isset( $_GET['paged'] ) && ( $_GET['paged'] > 0 ) ? absint( $_GET['paged'] ) : 1;
    $items_per_page = 10;
	$start = ( $_GET['paged'] - 1 ) * $items_per_page;
    $order = ( isset ( $_GET['order'] ) && $_GET['order'] == 'desc' ) ? 'ASC' : 'DESC';
    $orderby = ( isset ( $_GET['orderby'] ) && ( in_array( $_GET['orderby'], array( 'user_id' ) )) ) ? $_GET['orderby'] : 'id';
	$item_list = $tfscb_db->find_all_item( $orderby, $order, $items_per_page, $start );
	$wp_list_table = new Tfs_Chapter_Bugs_List_Table('item-overview');

	?>
	<script type="text/javascript">
		function check_all( form ) {
			for (i = 0, n = form.elements.length; i < n; i++) {
				if(form.elements[i].type == "checkbox") {
					if(form.elements[i].name == "doaction[]") {
						if(form.elements[i].checked == true)
							form.elements[i].checked = false;
						else
							form.elements[i].checked = true;
					}
				}
			}
		}

		function get_number_checked(form) {
			var num = 0;
			for (i = 0, n = form.elements.length; i < n; i++) {
				if(form.elements[i].type == "checkbox") {
					if(form.elements[i].name == "doaction[]")
						if(form.elements[i].checked == true)
							num++;
				}
			}
			return num;
		}

		// this function check for a the number of selected staffs, sumbmit false when no one selected
		function check_selected() {
	        if (typeof document.activeElement == "undefined" && document.addEventListener) {
	        	document.addEventListener("focus", function (e) {
	        		document.activeElement = e.target;
	        	}, true);
	        }
	        if ( document.activeElement.name == 'post_paged' )
	            return true;
			var numchecked = get_number_checked(document.getElementById('edit-chapter-bugs'));
			if(numchecked < 1) {
				alert('No chapter bugs selected');
				return false;
			}
			actionId = jQuery('#bulkaction').val();
			switch (actionId) {
				case "del-chapter-bugs":
					return confirm('Are you sure delete chapter-bugs?');
					break;	
			}
		}
	</script>
	<div class="wrap">
		<h2><?php _e('Chapter Bugs') ?></h2>

		<!-- <form class="search-form" action="<?php echo $tfscb->tfscb_chapter_bugs->base_page . '&amp;paged=' . $_GET['paged'] . '&amp;mode=search'; ?>" method="POST">
		<p class="search-box">
			<label class="hidden" for="media-search-input"><?php _e( 'Search Chapter Bugs' ); ?>:</label>
			<input type="hidden" name="page" value="tfs-chapter-bugs" />
			<input type="text" id="media-search-input" name="s" value="<?php the_search_query(); ?>" />
			<input type="submit" name="search-chapter-bugs" value="<?php _e( 'Search Chapter Bugs' ); ?>" class="button" />
		</p>
		</form> -->

		<form id="list-chapter-bugs" class="tfs-chapter-bugs-form" method="POST" action="<?php echo $tfscb->tfscb_chapter_bugs->base_page . '&amp;paged=' . $_GET['paged']; ?>" accept-charset="utf-8">
			<input type="hidden" name="page" value="chapter-bugs" />
			<div class="tablenav top">
				<div class="alignleft actions">			
					<?php //if ( function_exists('json_encode') ) : ?>
					<select name="bulkaction" id="bulkaction">
						<option value="no_action" ><?php _e("Bulk actions"); ?></option>
						<option value="del-chapter-bugs" ><?php _e("Delete"); ?></option>                    
					</select>
					<input name="showThickbox" class="button-secondary" type="submit" value="<?php _e('Apply'); ?>" onclick="if ( !check_selected() ) return false;" />
					<?php //endif; ?>				
				</div>
	        	<?php $tfscb->tfscb_chapter_bugs->pagination( 'top', $_GET['paged'], $tfscb_db->paged['total_objects'], $tfscb_db->paged['objects_per_page']  ); ?>
			</div>
			<table class="wp-list-table widefat fixed" cellspacing="0">
				<thead>
					<tr>
						<?php $wp_list_table->print_column_headers(true); ?>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<?php $wp_list_table->print_column_headers(false); ?>
					</tr>
				</tfoot>
				<tbody id="the-list">
				<?php
					if($item_list) {
					    //get the columns
						$chapter_bugs_columns 	= $wp_list_table->get_columns();
						$hidden_columns  	= get_hidden_columns('tfs-chapter-bugs');
						$num_columns     	= count($chapter_bugs_columns) - count($hidden_columns);

						foreach($item_list as $item) {
							$alternate 			= ( !isset($alternate) || $alternate == 'class="alternate"' ) ? '' : 'class="alternate"';
							$id 				= $item->id;
							$user_id 			= $item->user_id;
							$error_link 		= $item->error_link;
							$comment 			= $item->comment;
							$status 			= $item->status;
					?>
							<tr id="chapter-bugs-<?php echo $id ?>" <?php echo $alternate; ?> >
							<?php
							foreach($chapter_bugs_columns as $chapter_bugs_column_key => $column_display_name) {
								$class = "class=\"$chapter_bugs_column_key column-$chapter_bugs_column_key\"";
								$style = '';
								if ( in_array($chapter_bugs_column_key, $hidden_columns) )
									$style = ' style="display:none;"';
								$attributes = "$class$style";			
								switch ($chapter_bugs_column_key) {
									case 'cb' :
										?>
					        			<th scope="row" class="column-cb check-column">
					        				<input name="doaction[]" type="checkbox" value="<?php echo $id ?>" />
					        			</th>
					        			<?php
					    			break;
					    			case 'user_id' :
					    			    ?>
										<td <?php echo $attributes ?>>
											<?php
												$user_info = get_userdata( $user_id );										    
											?>
											<a href="<?php echo $tfscb->tfscb_chapter_bugs->base_page . '&amp;mode=edit&amp;id=' . $id; ?>"><?php echo $user_info->user_login; ?></a>
											<?php		
												$actions = array();
												$actions['edit']   = '<a class="submitedit" href="' . $tfscb->tfscb_chapter_bugs->base_page . '&amp;mode=edit&amp;id=' . $id . '">' . __('Edit') . '</a>';	
												$actions['delete'] = '<a class="submitdelete" href="' . $tfscb->tfscb_chapter_bugs->base_page . '&amp;mode=del&amp;id=' . $id . '" onclick="javascript:check=confirm( \'' . esc_attr(sprintf(__('Delete "%s" ?'), $user_info->user_login)). '\');if(check==false) return false;">' . __('Delete') . '</a>';
												$action_count = count($actions);
												$i = 0;
											?>
					                        <div class="row-actions">
											<?php
												foreach ( $actions as $action => $link ) {
													++$i;
													( $i == $action_count ) ? $sep = '' : $sep = ' | ';
													echo "<span class='$action'>$link$sep</span>";
												}
											?>
											</div>
										</td>
										<?php
					    			break;
					    			case 'error_link' :
					    			    ?>
					        			<td <?php echo $attributes ?>>
											<?php echo $error_link; ?>
					        			</td>
					        			<?php
					    			break;
					    			case 'comment' :
					    			    ?>
										<td <?php echo $attributes ?>>
											<?php echo $comment; ?>
										</td>
										<?php
					    			break;
									case 'status' :
					    			    ?>
										<td <?php echo $attributes ?>>
											<?php if ( $status == 0 ) {
												echo 'In Progress';
											} else {
												echo 'Completed';
											} ?>
										</td>
										<?php
					    			break;
									}
						        } ?>
							</tr>
						<?php
						}
					}
				?>
				</tbody>
			</table>
	        <div class="tablenav bottom">
			<?php $tfscb->tfscb_chapter_bugs->pagination( 'bottom', $_GET['paged'], $tfscb_db->paged['total_objects'], $tfscb_db->paged['objects_per_page']  ); ?>
	        </div>
		</form>
	</div>
<?php
}

/**
 * Construtor class to create the table layout
 *
 * @package WordPress
 * @subpackage List_Table
 * @since 1.8.0
 * @access private
 */
class Tfs_Chapter_Bugs_List_Table extends WP_List_Table {
	var $_screen;
	var $_columns;

	function Tfs_Chapter_Bugs_List_Table( $screen ) {
		if ( is_string( $screen ) )
			$screen = convert_to_screen( $screen );
		$this->_screen 	= $screen;
		$this->_columns = array();
		add_filter( 'manage_' . $screen->id . '_columns', array( &$this, 'get_columns' ), 0 );
	}

	function get_column_info() {
		$columns 	= get_column_headers( $this->_screen );
		$hidden 	= get_hidden_columns( $this->_screen );
		$_sortable 	= $this->get_sortable_columns();
		foreach ( $_sortable as $id => $data ) {
			if ( empty( $data ) )
				continue;
			$data = (array) $data;
			if ( !isset( $data[1] ) )
				$data[1] = false;
			$sortable[$id] = $data;
		}
		return array( $columns, $hidden, $sortable );
	}

    // define the columns to display, the syntax is 'internal name' => 'display name'
	function get_columns() {
    	$columns = array();
    	$columns['cb'] 			= '<input name="checkall" type="checkbox" onclick="check_all(document.getElementById(\'edit-item\'));" />';
    	$columns['user_id'] 	= __('User Id');
    	$columns['error_link'] 	= __('Error Link');
    	$columns['comment'] 	= __('Comment');
    	$columns['status'] 		= __('Status');
    	$columns = apply_filters('tfs_chapter_bugs_item_columns', $columns);
    	return $columns;
	}

	function get_sortable_columns() {
		return array(
			'user_id'    => array( 'user_id', true )
		);
	}
}
?>