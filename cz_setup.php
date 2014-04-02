<?php
function set_messages($lvl, $msg)
{
    if (isset($GLOBALS['aAdmin_msgs'])) {
        $new_msgs = $GLOBALS['aAdmin_msgs'];
        $msg_add = array(
            'lvl' => $lvl,
            'msg' => $msg
        );
        array_push($new_msgs, $msg_add);
        $GLOBALS['aAdmin_msgs'] = $new_msgs;

    }

}

function admin_message()
{
    if (isset($GLOBALS['aAdmin_msgs'])) {
        $aDisplay_msgs = $GLOBALS['aAdmin_msgs'];
        foreach ($aDisplay_msgs as $messages) {
            ?>
            <div class="<?php echo $messages['lvl']; ?>">
                <p><?php _e($messages['msg'], $GLOBALS['sThemeTextDomain']); ?></p>
            </div>
        <?php
        }
    }

}

function do_includes($sTheme_DIR)
{
    $results['success'] = false;
    $aStructure = scandir($sTheme_DIR);
    foreach ($aStructure as $dir) {
        $sPath = $sTheme_DIR . '/' . $dir;
        if (is_dir($sPath)) {
            if ($dir == 'admin' || $dir == 'includes') {
                $aFiles = scandir($sPath);
                foreach ($aFiles as $includes) {
                    $sFpath = $sPath . '/' . $includes;
                    if (!is_dir($sFpath) && pathinfo($sFpath, PATHINFO_EXTENSION) == 'php') {
                        if ($includes != 'cz_setup.php') {
                            if (!@include_once $sPath . '/' . $includes) {
                                $results['files'][$includes] = false;
                            } else {
                                $results['files'][$includes] = true;
                                $results['success'] = true;
                            }
                        }
                    }
                }
            }
        }
    }
    return $results;
}

function theme_features($sTheme_DIR)
{
    $aFeatures = array(
        'post-thumbnails',
        'menus'
    );
    foreach ($aFeatures as $key => $value) {
        if (is_array($value)) {
            add_theme_support($key, $value);
        } else {
            add_theme_support($value);
        }
    }
    load_theme_textdomain($GLOBALS['sThemeTextDomain'], $sTheme_DIR . '/language');
}