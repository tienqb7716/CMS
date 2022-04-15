
<?php
/**
* Plugin Name: My First Plugin
* Plugin URI: http://www.mywebsite.com/my-first-plugin
* Description: The very first plugin that I have ever created.
* Version: 1.0
* Author: Your Name
* Author URI: http://www.mywebsite.com
*/
add_action( 'the_content', 'my_thank_you_text' );
function my_thank_you_text ( $content ) {
return $content .= '<p>Thank you for reading!</p>';
}

function email_friends($post_ID) {
    $friends = 'bob@example.org,susie@example.org';
    mail($friends, "sally's blog updated", 
      'I just put something on my blog: http://blog.example.com');
    return $post_ID;
}

// class emailer {
//     static function send($post_ID)  {
//       $friends = 'bob@example.org,susie@example.org';
//       mail($friends,"sally's blog updated",'I just put something on my blog: http://blog.example.com');
//       return $post_ID;
//     }
//   }
  
//   add_action('publish_post', array('emailer', 'send'));

  class emailer {
    function send($post_ID)  {
      $friends = 'ToT@example.org,alles@example.org';
      mail($friends,"sally's blog updated",'I just put something on my blog: http://blog.example.com');
      return $post_ID;
    }
  }
  $myEmailClass = new emailer();
  add_action('publish_post', array($myEmailClass, 'send'));

  function filter_profanity( $content ) {
	$profanities = array('badword','alsobad','...');
	$content = str_ireplace( $profanities, '{censored}', $content );
	return $content;
}