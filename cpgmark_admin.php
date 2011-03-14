<?php
/**************************************************
  Coppermine Photo Gallery 1.4.1 CPGMark Plugin
  *************************************************
  1.2  CPGMark
  Copyright (C) 2005 Jeff Paffett <jpaffett@yahoo.co.uk>
  *************************************************                                       //
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.1
  $Source: /cvsroot/cpg-contrib/CPGMark/cpgmark_admin.php,v $
  $Revision: 1.12 $
  $Author: donnoman $
  $Date: 2006/11/30 06:34:57 $
***************************************************/

require('include/init.inc.php');

//if (!GALLERY_ADMIN_MODE) cpg_die(ERROR, $lang_errors['access_denied'], __FILE__, __LINE__);

function form_label($text)
{
        global $lang_admin_php;

        static $cmi = 0;
        static $open = false;

        if ($open){
        echo <<< EOT
                                </table>
                        </td>
                </tr>
EOT;
        }
        echo <<< EOT
                <tr>
                        <td class="tableh2" colspan="3">
                                <b>$text</b>
                        </td>
                </tr>
                <tr>
                        <td>
                                <table align="center" width="100%" cellspacing="1" cellpadding="0" class="maintable" id="section{$cmi}" border="0">
EOT;

        $open = true;
        $cmi++;
}

function form_input($text, $name, $help = '')
{
    global $CPGMARK;

    $value = $CPGMARK[$name];
    $help = cpg_display_help($help);

    $type = ($name == 'smtp_password') ? 'password' : 'text';


    echo <<<EOT
                <tr>
                        <td width="60%" class="tableb">
                                $text
                        </td>
                        <td width="50%" class="tableb" valign="top">
                            <input type="$type" class="textinput" style="width: 100%" name="$name" value="$value"/>
                        </td>
                        <td class="tableb" width="10%">
                                $help
                        </td>
        </tr>

EOT;
}

function form_yes_no($text, $name, $help = '')
{
    global $CPGMARK, $lang_yes, $lang_no;
    $help = cpg_display_help($help);

    $value = $CPGMARK[$name];
    $yes_selected = $value ? 'checked="checked"' : '';
    $no_selected = !$value ? 'checked="checked"' : '';

    echo <<<EOT
        <tr>
                        <td class="tableb" width="60%">
                                $text
                        </td>
                        <td class="tableb" valign="top" width="50%">
                                <input type="radio" id="{$name}1" name="$name" value="1" $yes_selected/><label for="{$name}1" class="clickable_option">$lang_yes</label>
                                &nbsp;&nbsp;
                                <input type="radio" id="{$name}0" name="$name" value="0" $no_selected/><label for="{$name}0" class="clickable_option">$lang_no</label>
                        </td>
                        <td class="tableb" width="10%">
                                $help
                        </td>
        </tr>

EOT;
}


function form_listbox($text, $name, $help = '', $options)
{
    global $CPGMARK;
    // I left this one in as an example

    $help = cpg_display_help($help);

    $value = $CPGMARK[$name];

    echo <<<EOT
        <tr>
            <td class="tableb" width="60%">
                        $text
        </td>
        <td class="tableb" valign="top" width="50%">
                        <select name="$name" class="listbox">

EOT;
    foreach ($options as $key => $option) {
        echo "                                <option value=\"$key\" " . ($value == $option ? 'selected="selected"' : '') . ">$option</option>\n";
    }
    echo <<<EOT
                        </select>
                </td>
                <td class="tableb" width="10%">
                $help
                </td>
        </tr>

EOT;
}


function form_number_dropdown($text, $name, $help = '')
{
   global $CPGMARK, $lang_admin_php ;
   $help = cpg_display_help($help);
   //left this one in as an example

    echo <<<EOT
        <tr>
            <td class="tableb" width="60%">
                        $text
        </td>
        <td class="tableb" valign="top" width="50%">
                        <select name="$name" class="listbox">
EOT;
        for ($i = 5; $i <= 25; $i++) {
        echo "<option value=\"".$i."\"";
        if ($i == $CPGMARK[$name]) { echo " selected=\"selected\"";}
        echo ">".$i."</option>\n";
        }
     echo <<<EOT
     </select>
                </td>
                <td class="tableb" width="10%">
                $help
                </td>
        </tr>
EOT;
}

function form_upload_image($text, $name, $help = '')
{
   global $CONFIG, $CPGMARK, $lang_admin_php;
   $help = cpg_display_help($help);
   //left this one in as an example

   $file = $CPGMARK[$name];

   echo

        '<tr>
            <td class="tableb" width="60%">
                        '.$text.'
        </td>
        <td class="tableb" valign="top" width="50%">';


	if (file_exists($CONFIG['fullpath'].'watermarks/'.$file)) {
		echo '<img alt="" src="'.$CONFIG['fullpath'].'watermarks/'.$file.'" align="left">';
	} else {
		echo $CONFIG['fullpath'].'watermarks/'.$file.' does not exist';
	}

    echo '</td>
                <td class="tableb" width="10%">
                '.$help.'
                </td>
        </tr>';

}

function create_form(&$data)
{
        global $options_to_disable, $CPGMARK;

    foreach($data as $element) {
        if ((is_array($element))) {
                $element[3] = (isset($element[3])) ? $element[3] : '';
            switch ($element[2]) {
                case 0 :
                    form_input($element[0], $element[1], $element[3]);
                    break;
                case 1 :
                    form_yes_no($element[0], $element[1], $element[3]);
                    break;
                case 3 :
                    form_listbox($element[0],$element[1], $element[3],$element[4]);
                    break;
                case 4 :
                    form_upload_image($element[0],$element[1], $element[3]);
                    break;
                default:
                    die('Invalid action');
            } // switch
        } else {
                form_label($element);
        }
    }
}

if (count($_POST) > 0) {
    if (isset($_POST['update_config'])) {
        $need_to_be_positive = array();

    	if (!file_exists($CONFIG['fullpath']."watermarks")) {
    		mkdir($CONFIG['fullpath']."watermarks",0777);
		}

        if ($CPGMARK['user_watermark']==1) {
            $result = cpg_db_query("SELECT user_id FROM {$CONFIG['TABLE_PREFIX']}mark_users WHERE user_id = ".USER_ID);
            if (mysql_num_rows($result) == 0) {
            	cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}mark_users SET user_id = ".USER_ID);
            	mkdir($CONFIG['fullpath']."watermarks/".USER_ID,0777);
        	}
        }

        foreach ($need_to_be_positive as $parameter)
        $_POST[$parameter] = max(1, (int)$_POST[$parameter]);

        foreach($lang_cpgmark_admin as $element) {
            if ((is_array($element))) {
                if (!isset($_POST[$element[1]])) /*cpg_die(CRITICAL_ERROR, "Missing admin value for '{$element[1]}'", __FILE__, __LINE__);*/ continue;
                $value = addslashes($_POST[$element[1]]);
                if ($CPGMARK['user_watermark']==1) {
                    cpg_db_query("UPDATE {$CONFIG['TABLE_PREFIX']}mark_users SET {$element[1]} = '$value' WHERE user_id = ".USER_ID);
                } else {
                    cpg_db_query("UPDATE {$CONFIG['TABLE_PREFIX']}mark_config SET value = '$value' WHERE name = '{$element[1]}'");
                }
                $CPGMARK[$element[1]]=$value;
           }

        }

    }

    	pageheader($lang_cpgmark['cpgmark']);

        if ($CPGMARK['user_watermark'] == 1) {
            $CPGMARK=cpgmark_merge_user_settings(USER_ID);
            $preview_path=$CONFIG['fullpath'].$CPGMARK['watermark_path'].USER_ID."/preview.jpg";
        } else {
            $preview_path=$CONFIG['fullpath'].$CPGMARK['watermark_path']."/preview.jpg";
        }

        if (!file_exists($preview_path)) {
           $preview_path = "plugins/CPGMark/include/preview.jpg";
        }
    	$image_str = "plugins/CPGMark/watermark.php?image=$preview_path";

    	if ($CPGMARK['use_watermark_img'] == 1)
    		{
   			$image_str .= '&img_watermark='.$CONFIG['fullpath'].$CPGMARK['watermark_path'].$CPGMARK['small_watermark_image'];
        	$image_str .= '&img_watermark_Valing='.$CPGMARK['img_vpos'];
        	$image_str .= '&img_watermark_Haling='.$CPGMARK['img_hpos'];
        	}

        if ($CPGMARK['use_watermark_txt'] == 1)
        	{
        	$image_str .= '&txt_watermark='.urlencode($CPGMARK['watermark_text']);
        	$image_str .= '&txt_watermark_color='.$CPGMARK['watermark_text_color'];
        	$image_str .= '&txt_watermark_font='.$CPGMARK['watermark_text_size'];
        	$image_str .= '&txt_watermark_Valing='.$CPGMARK['txt_vpos'];
        	$image_str .= '&txt_watermark_Haling='.$CPGMARK['txt_hpos'];
        	}

        msg_box($lang_cpgmark['cpgmark'], $lang_cpgmark['page_success']."<br /><br /><img src=\"$image_str\">", $lang_continue, 'index.php');

        pagefooter();
        exit;
}

pageheader($lang_cpgmark['cpgmark']);

if ($CPGMARK['user_watermark'] == 1) {
    $CPGMARK=cpgmark_merge_user_settings(USER_ID);
}

$signature = 'Coppermine Photo Gallery ' . COPPERMINE_VERSION . ' ('. COPPERMINE_VERSION_STATUS . ')';

?>
<!-- script type="text/javascript">
        onload = hideall;
</script -->
<?php
starttable('100%', "{$lang_cpgmark['cpgmark']} - $signature", 3);
create_form($lang_cpgmark_images);

/*form_label('Preview');

//createsample();

echo '<tr><td align="center">';

echo '<img src="'.$CONFIG['fullpath'].$CPGMARK['watermark_path'].USER_ID.'/preview_saved.jpg'.'">';

echo '</td></tr>';*/

//echo "<form action=\"$PHP_SELF\" method=\"post\">";
echo "<form action=\"".$_SERVER['PHP_SELF'].'?file=CPGMark/cpgmark_admin'."\" method=\"post\">";

echo <<<EOT
    <tr>
        <!-- td class="tableh2" colspan="3">
            <a href="javascript:expand();" class="admin_menu">{$lang_cpgmark['expand_all']}&nbsp;&nbsp;<img src="images/descending.gif" width="9" height="9" border="0" alt="" title="{$lang_cpgmark['expand_all']}" /></a>
        </td -->
    </tr>
EOT;

create_form($lang_cpgmark_admin);

echo '</table></td></tr>';

echo <<<EOT
                <tr>
                        <td align="left" class="tablef">
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <!-- td width="33%">
                                        <a href="javascript:expand();" class="admin_menu">{$lang_minicms['expand_all']}<img src="images/ascending.gif" width="9" height="9" border="0" alt="" title="{$lang_minicms['expand_all']}" /></a>
                                    </td-->
                                    <td width="67%" align="center">
                                        <input type="submit" class="button" name="update_config" value="{$lang_continue}" />
                                &nbsp;&nbsp;
                                    </td>
                                </tr>
                            </table>
                        </td>
                </tr>
EOT;
endtable();
echo '</form>';
pagefooter();
ob_end_flush();
?>
