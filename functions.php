<?php
/**
 * Adds Apple touch icon to the page head
 */
function appleTouchIcon(){
        // list of directories to check for icons
        $directories = array(
                rtrim(get_stylesheet_directory(), '/') . '/'      =>  rtrim(get_stylesheet_directory_uri(), '/') . '/',                // theme directory
                rtrim(ABSPATH, '/') . '/'       => rtrim(site_url(), '/') . '/' // web root
        );

        /**
         * Add references to any existing IOS icons
         */
        $iconName = 'apple-touch-icon%s%s.png';      // the icon name convention
        $iconSizes = array(                          // available icon sizes
                '',
                '57x57',
                '72x72',
                '114x114',
                '144x144'
        );

        foreach($iconSizes as $size){
                $hasSize = $size != ''; // check whether we actually have a size defined or if it is empty (default)

                $files = array(
                        'apple-touch-icon'                              => sprintf($iconName, $hasSize ? '-' . $size : '', ''),
                        'apple-touch-icon-precomposed'  => sprintf($iconName, $hasSize ? '-' . $size : '', '-precomposed')
                );

                foreach($directories as $dir => $url){
                        foreach($files as $rel => $file){
                                if(file_exists($dir . $file)){
                                        // we have an icon file
                                        echo '<link rel="' . $rel . '"' . ($hasSize ? ' sizes="' . $size . '"' : '') . ' href="' . $url . $file . '">' . "\n";
                                        break 2;        // break out of the file and directories loop
                                }
                        }
                }
        }
}
// add apple icon call
add_action( 'wp_head', 'appleTouchIcon');
?>