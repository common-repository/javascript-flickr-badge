<?php
/*
Plugin Name: Javascript Flickr Badge
Plugin URI: http://blog.jyst.us/javascript-flickr-badge?utm_source=Wordpress&utm_medium=Plugin%2BAdmin&utm_campaign=Javascript%2BFlickr%2BBadge
Description: Displays photos from Flickr, with optional tag filtering, with client-side javascript. Several eye-catching effects available.
Version: 2.3
Author: Jyst
Author URI: http://jyst.us/
*/

function javascript_flickr_badge_header() {
	$options = get_option('javascript_flickr_badge');
  if($options['flickrId']) {
  ?>
  <script type="text/javascript" src="<?php echo get_settings('siteurl'); ?>/wp-content/plugins/javascript-flickr-badge/javascript-flickr-badge.min.js"></script>
  <?php
  }
}

function javascript_flickr_badge_footer() {
	$options = get_option('javascript_flickr_badge');
  if($options['flickrId']) {
    if($options["tags"]) {
			$tagString = "'".join('\',\'',$options['tags'])."'";
    }
    else {
      $tagString = "";
    }
  ?>
  <script type="text/javascript">
    jsFlickrBadge(document.getElementById("jsFlickrBadge"), {
      flickrId: "<?php echo $options["flickrId"] ? $options["flickrId"] : "40969270@N00"; ?>",
      feed: "<?php echo $options["feed"] ? $options["feed"] : "group"; ?>",
      tags: [<?php echo $tagString; ?>],
      rows: <?php echo $options["rows"] ? $options["rows"] : 3; ?>,
      columns: <?php echo $options["columns"] ? $options["columns"] : 3; ?>,
      size: <?php echo $options["size"] ? $options["size"] : 75; ?>,
      animation: "<?php echo $options["animation"] ? $options["animation"] : "none"; ?>",
      animationSpeed: <?php echo $options["animationSpeed"] ? $options["animationSpeed"] : "1"; ?>,
      animationPause: <?php echo $options["animationPause"] ? $options["animationPause"] : "2"; ?>
    });
  </script>
  <?php
  }
}

function javascript_flickr_badge($args) {
	extract($args);
	$options = get_option('javascript_flickr_badge');
	$title = $options['title'] ? $options['title'] : 'Flickr';
	$credit = $options['credit'] ? $options['credit'] : 'yes';
  if(! $options['flickrId']) {
    echo $before_widget . $before_title . '<a href="http://blog.jyst.us/javascript-flickr-badge?utm_source=Wordpress&utm_medium=Plugin&utm_campaign=Javascript%2BFlickr%2BBadge">Javascript Flickr Badge</a>' . $after_title;
    echo '<div style="padding:10px;font-weight:bold;text-align:center;">' . __('No Flickr ID provided.', 'javascript-flickr-badge') . '</div>';
    echo $after_widget;
  }
 else {
		$tags = join('+', $options['tags']);
		$photostream = 'http://www.flickr.com/photos/' . $options['flickrId'] . '/';
		$rows = $options['rows'] ? $options['rows'] : 3;
		$size = $options['size'] ? $options['size'] : 75;
		echo '<!-- Javascript Flickr Badge (http://blog.jyst.us/javascript-flickr-badge) v2.3 -->';
		echo $before_widget . $before_title . '<a id="jsFlickrBadgeTitle" href="' . $photostream . '">' . $title . '</a>' . $after_title;
		echo '<div id="jsFlickrBadge" style="position:relative;height:'.($rows * $size).'px;"><div style="padding:10px;"><a href="http://blog.jyst.us/javascript-flickr-badge?utm_source=Wordpress&utm_medium=Plugin&utm_campaign=Javascript%2BFlickr%2BBadge">Javascript Flickr Badge</a>, by <a href="http://jyst.us/" title="Social Media Aggregator">Jyst</a>, a <a href="http://jyst.us/" title="Social Media Aggregator">Social Media Aggregator</a>, requires javascript.</div></div>';
		if($credit == 'yes')
			echo '<div style="font-size:0.8em;padding:5px;text-align:right;"><a href="http://blog.jyst.us/javascript-flickr-badge?utm_source=Wordpress&utm_medium=Plugin&utm_campaign=Javascript%2BFlickr%2BBadge">Widget</a> by <a href="http://jyst.us/?utm_source=Wordpress&utm_medium=Plugin&utm_campaign=Javascript%2BFlickr%2BBadge" title="Social Media Aggregator">Jyst</a></div>';
		echo $after_widget;
	}
}

function javascript_flickr_badge_control() {
	$options = get_option('javascript_flickr_badge');
	if (!is_array($options))
		$options = array('title'=>'', 'tags'=>array());
  if ( $_POST['javascript_flickr_badge-submit'] ) {
    $options['title'] = strip_tags(stripslashes($_POST['javascript_flickr_badge-title']));
    $options['flickrId'] = strip_tags(stripslashes($_POST['javascript_flickr_badge-flickrId']));
    $options['tags'] = array_map(trim, preg_split('/\s*,\s*/', strip_tags(stripslashes($_POST['javascript_flickr_badge-tags'])), -1, PREG_SPLIT_NO_EMPTY));
    $options['rows'] = strip_tags(stripslashes($_POST['javascript_flickr_badge-rows']));
    $options['columns'] = strip_tags(stripslashes($_POST['javascript_flickr_badge-columns']));
    $options['size'] = strip_tags(stripslashes($_POST['javascript_flickr_badge-size']));
    $options['feed'] = strip_tags(stripslashes($_POST['javascript_flickr_badge-feed']));
    $options['animation'] = strip_tags(stripslashes($_POST['javascript_flickr_badge-animation']));
    $options['animationSpeed'] = strip_tags(stripslashes($_POST['javascript_flickr_badge-animationSpeed']));
    $options['animationPause'] = strip_tags(stripslashes($_POST['javascript_flickr_badge-animationPause']));
    $options['credit'] = strip_tags(stripslashes($_POST['javascript_flickr_badge-credit']));
    update_option('javascript_flickr_badge', $options);
  }
  $title = htmlspecialchars($options['title'], ENT_QUOTES);
  $flickrId = htmlspecialchars($options['flickrId'], ENT_QUOTES);
  $tags = htmlspecialchars(join(', ', $options['tags']), ENT_QUOTES);
  $rows = htmlspecialchars($options['rows'] ? $options['rows'] : '3', ENT_QUOTES);
  $columns = htmlspecialchars($options['columns'] ? $options['columns'] : '3', ENT_QUOTES);
  $size = htmlspecialchars($options['size'] ? $options['size'] : '75', ENT_QUOTES);
  $feed = htmlspecialchars($options['feed'] ? $options['feed'] : 'user', ENT_QUOTES);
  $animation = htmlspecialchars($options['animation'] ? $options['animation'] : 'none', ENT_QUOTES);
  $animationSpeed = htmlspecialchars($options['animationSpeed'] ? $options['animationSpeed'] : '1', ENT_QUOTES);
  $animationPause = htmlspecialchars($options['animationPause'] ? $options['animationPause'] : '2', ENT_QUOTES);
  $credit = htmlspecialchars($options['credit'] ? $options['credit'] : 'yes', ENT_QUOTES);
	?>
  <img style="float:right;margin-left:5px;" src="<?php echo get_settings('siteurl'); ?>/wp-content/plugins/javascript-flickr-badge/logo.png" width="75" height="75" alt="Logo"/></script>
	<label for="javascript_flickr_badge-title" style="margin-top:10px;display:block;"><?php _e('Title', 'javascript-flickr-badge'); ?></label>
  <input style="width: 200px;" id="javascript_flickr_badge-title" name="javascript_flickr_badge-title" type="text" value="<?php echo $title; ?>" />
  <label for="javascript_flickr_badge-feed" style="margin-top:10px;display:block;"><?php _e('Feed', 'javascript-flickr-badge'); ?></label>
  <select style="width: 200px;" id="javascript_flickr_badge-feed" name="javascript_flickr_badge-feed" type="text">
    <option value="user"<?php echo $feed == 'user' ? ' selected' : '' ?>><?php _e('User', 'javascript-flickr-badge'); ?></option>
    <option value="group"<?php echo $feed == 'group' ? ' selected' : '' ?>><?php _e('Group', 'javascript-flickr-badge'); ?></option>
    <option value="favorites"<?php echo $feed == 'favorites' ? ' selected' : '' ?>><?php _e('Favorites', 'javascript-flickr-badge'); ?></option>
    <option value="contacts"<?php echo $feed == 'contacts' ? ' selected' : '' ?>><?php _e('Contacts (One Photo Each)', 'javascript-flickr-badge'); ?></option>
    <option value="contactsAll"<?php echo $feed == 'contactsAll' ? ' selected' : '' ?>><?php _e('Contacts (All Photos)', 'javascript-flickr-badge'); ?></option>
    <option value="friends"<?php echo $feed == 'friends' ? ' selected' : '' ?>><?php _e('Friends & Family (One Photo Each)', 'javascript-flickr-badge'); ?></option>
    <option value="friendsAll"<?php echo $feed == 'friendsAll' ? ' selected' : '' ?>><?php _e('Friends & Family (All Photos)', 'javascript-flickr-badge'); ?></option>
  </select>
  <label for="javascript_flickr_badge-flickrId" style="margin-top:10px;display:block;">
    <?php _e('Flickr ID', 'javascript-flickr-badge'); ?> 
    (<a href="http://idgettr.com/" target="_blank"><?php _e('Find it here', 'javascript-flickr-badge'); ?></a>)</label>
  <input style="width: 200px;" id="javascript_flickr_badge-flickrId" name="javascript_flickr_badge-flickrId" type="text" value="<?php echo $flickrId; ?>" />
	<label for="javascript_flickr_badge-tags" style="margin-top:10px;display:block;"><?php _e('Tags (separated by commas, only used with User feed)', 'javascript-flickr-badge'); ?></label>
  <input style="width: 200px;" id="javascript_flickr_badge-tags" name="javascript_flickr_badge-tags" type="text" value="<?php echo $tags; ?>" />
	<label for="javascript_flickr_badge-rows" style="margin-top:10px;display:block;"><?php _e('Rows', 'javascript-flickr-badge'); ?></label>
  <input style="width: 200px;" id="javascript_flickr_badge-rows" name="javascript_flickr_badge-rows" type="text" value="<?php echo $rows; ?>" />
	<label for="javascript_flickr_badge-columns" style="margin-top:10px;display:block;"><?php _e('Columns', 'javascript-flickr-badge'); ?></label>
  <input style="width: 200px;" id="javascript_flickr_badge-columns" name="javascript_flickr_badge-columns" type="text" value="<?php echo $columns; ?>" />
	<label for="javascript_flickr_badge-size" style="margin-top:10px;display:block;"><?php _e('Thumbnail Size', 'javascript-flickr-badge'); ?></label>
  <input style="width: 200px;" id="javascript_flickr_badge-size" name="javascript_flickr_badge-size" type="text" value="<?php echo $size; ?>" />
  <label for="javascript_flickr_badge-animation" style="margin-top:10px;display:block;"><?php _e('Animation', 'javascript-flickr-badge'); ?></label>
  <select style="width: 200px;" id="javascript_flickr_badge-animation" name="javascript_flickr_badge-animation" type="text">
    <option value="none"<?php echo $animation == 'none' ? ' selected' : '' ?>><?php _e('[none]', 'javascript-flickr-badge'); ?></option>
    <option value="random"<?php echo $animation == 'random' ? ' selected' : '' ?>><?php _e('Random', 'javascript-flickr-badge'); ?></option>
    <option value="shuffle"<?php echo $animation == 'shuffle' ? ' selected' : '' ?>><?php _e('Shuffle', 'javascript-flickr-badge'); ?></option>
    <option value="zoom"<?php echo $animation == 'zoom' ? ' selected' : '' ?>><?php _e('Zoom', 'javascript-flickr-badge'); ?></option>
    <option value="vscroll"<?php echo $animation == 'vscroll' ? ' selected' : '' ?>><?php _e('Vertical Scroll', 'javascript-flickr-badge'); ?></option>
    <option value="flipY"<?php echo $animation == 'flipY' ? ' selected' : '' ?>><?php _e('Flip Horizontal', 'javascript-flickr-badge'); ?></option>
    <option value="flipX"<?php echo $animation == 'flipX' ? ' selected' : '' ?>><?php _e('Flip Vertical', 'javascript-flickr-badge'); ?></option>
  </select>
  <label for="javascript_flickr_badge-animationSpeed" style="margin-top:10px;display:block;"><?php _e('Animation Speed (in seconds)', 'javascript-flickr-badge'); ?></label>
  <input style="width: 200px;" id="javascript_flickr_badge-animationSpeed" name="javascript_flickr_badge-animationSpeed" type="text" value="<?php echo $animationSpeed; ?>" />
  <label for="javascript_flickr_badge-animationPause" style="margin-top:10px;display:block;"><?php _e('Animation Pause (in seconds)', 'javascript-flickr-badge'); ?></label>
  <input style="width: 200px;" id="javascript_flickr_badge-animationPause" name="javascript_flickr_badge-animationPause" type="text" value="<?php echo $animationPause; ?>" />
  <label for="javascript_flickr_badge-credit" style="margin-top:10px;display:block;"><?php _e('Give Widget Author Credit?', 'javascript-flickr-badge'); ?></label>
  <select style="width: 200px;" id="javascript_flickr_badge-credit" name="javascript_flickr_badge-credit" type="text">
    <option value="yes"<?php echo $credit == 'yes' ? ' selected' : '' ?>><?php _e('Yes', 'javascript-flickr-badge'); ?> :-)</option>
    <option value="no"<?php echo $credit == 'no' ? ' selected' : '' ?>><?php _e('No', 'javascript-flickr-badge'); ?> :-(</option>
	</select>
	<input type="hidden" id="javascript_flickr_badge-submit" name="javascript_flickr_badge-submit" value="1" />
	<?php
}

function javascript_flickr_badge_init() {
	if (!function_exists('register_sidebar'))
		return;
  load_plugin_textdomain( 'javascript-flickr-badge', 'wp-content/plugins/javascript-flickr-badge' );
	register_sidebar_widget(__('Javascript Flickr Badge', 'javascript_flickr_badge'), 'javascript_flickr_badge');
	register_widget_control(__('Javascript Flickr Badge', 'javascript_flickr_badge'), 'javascript_flickr_badge_control', 300, 160);
	if (is_active_widget('javascript_flickr_badge'))
	{
		add_action('wp_head', 'javascript_flickr_badge_header');
		add_action('wp_footer', 'javascript_flickr_badge_footer');
	}
}

add_action('init', 'javascript_flickr_badge_init');
