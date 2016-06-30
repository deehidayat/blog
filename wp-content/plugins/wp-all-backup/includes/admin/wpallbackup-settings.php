<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (isset($_POST['update'])) {
    if (!isset($_POST['wpallbackup_update_setting']))
        die("<br><span class='label label-danger'>Invalid form data. form request came from the somewhere else not current site! </span>");
    if (!wp_verify_nonce($_POST['wpallbackup_update_setting'], 'wpallbackup-update-setting'))
        die("<br><span class='label label-danger'>Invalid form data. form request came from the somewhere else not current site! </span>");

    if (isset($_POST['wp_all_backup_max_backups'])) {
        update_option('wp_all_backup_max_backups', sanitize_text_field($_POST['wp_all_backup_max_backups']));
    }

    if (isset($_POST['wp_all_backup_type'])) {
        update_option('wp_all_backup_type', sanitize_text_field($_POST['wp_all_backup_type']));
    }

    if (isset($_POST['wp_all_backup_exclude_dir'])) {
        update_option('wp_all_backup_exclude_dir', sanitize_text_field($_POST['wp_all_backup_exclude_dir']));
    }

    if (isset($_POST['wp_all_backup_enable_log'])) {
        update_option('wp_all_backup_enable_log', '1');
    } else {
        update_option('wp_all_backup_enable_log', '0');
    }
    ?><br><span class="label label-success"><?php _e('Setting updated!', 'wpallbkp') ?></span>
    <?php
}

function wp_db_backup_format_bytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . ' ' . $units[$pow];
}
?>

<div class="panel panel-success">
    <div class="panel-heading">
        <div class="panel-title"><h3><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <?php _e('Setting', 'wpallbkp') ?></h3></div>
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php _e('Backup Setting', 'wpallbkp') ?></a></li>
            <li role="presentation"><a href="#schedule" aria-controls="schedule" role="tab" data-toggle="tab"><?php _e('Schedule Setting', 'wpallbkp') ?></a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php _e('Default Setting', 'wpallbkp') ?></a></li>
            <li role="presentation"><a href="#system" aria-controls="system" role="tab" data-toggle="tab"><?php _e('System Check', 'wpallbkp') ?></a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <form action="" method="post">

                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <span class=" glyphicon glyphicon-question-sign" aria-hidden="true"></span><?php _e('Backup Type', 'wpallbkp') ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <label>
                                        <?php _e('Backup', 'wpallbkp'); ?>
                                        <select name="wp_all_backup_type" id="wp_all_backup_type">
                                            <option <?php selected(get_option('wp_all_backup_type'), 'Complete'); ?> value="complete"><?php _e('Both Database &amp; files', 'wpallbkp'); ?></option>
                                            <option <?php selected(get_option('wp_all_backup_type'), 'File'); ?> value="File"><?php _e('Files only', 'wpallbkp'); ?></option>
                                            <option <?php selected(get_option('wp_all_backup_type'), 'Database'); ?> value="Database"><?php _e('Database only', 'wpallbkp'); ?></option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        <span class=" glyphicon glyphicon-question-sign" aria-hidden="true"></span> <?php _e('Number of backups', 'wpallbkp'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse in">
                                <div class="panel-body">

                                    <label>
                                        <?php _e('Number of backups to store on this server', 'wpallbkp'); ?>
                                        <input name="wp_all_backup_max_backups" step="1" value="<?php echo get_option('wp_all_backup_max_backups') ?>" type="number">

                                        <p class="description"><?php _e('Past this limit older backups will be deleted automatically.', 'wpallbkp'); ?></p>
                                        <p class="description"><?php _e('The minimum number of Local Backups that should be kept, regardless of their size.</br>Leave blank for keep unlimited backups.', 'wpallbkp'); ?></p>

                                    </label>

                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading"  id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                        <span class=" glyphicon glyphicon-question-sign" aria-hidden="true"></span><?php _e('Exclude Setting', 'wpallbkp'); ?>

                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">

                                            <label>
                                                <?php _e('Exclude Folders and Files', 'wpallbkp'); ?>
                                                <input name="wp_all_backup_exclude_dir" min value="<?php echo get_option('wp_all_backup_exclude_dir') ?>" type="text">
                                                <p class="description"><?php _e('Enter new exclude rules as a Pipe (|) separated list, e.g. .git|uploads|.zip', 'wpallbkp'); ?></p>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" id="headingFive">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                        <span class=" glyphicon glyphicon-question-sign" aria-hidden="true"></span><?php _e('Log Setting', 'wpallbkp'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label>    		
                                                <label>
                                                    <input type="checkbox" <?php checked(get_option('wp_all_backup_enable_log'), '1'); ?>  name="wp_all_backup_enable_log"> <?php _e('Enable Backup Log', 'wpallbkp'); ?>  
                                                    </div>

                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>

                                                    </div>
                                                    <input type="submit" class="button-primary" name="update" value="<?php _e('Update', 'wpallbkp'); ?>">
                                                    <input name="wpallbackup_update_setting" type="hidden" value="<?php echo wp_create_nonce('wpallbackup-update-setting'); ?>" />
                                                    </form>

                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="schedule">
                                                        <form method="post" action="options.php" name="wp_auto_commenter_form">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <?php
                                                                    $settings = get_option('wp_all_backup_options');
                                                                    echo '<input type="checkbox" name="wp_all_backup_options[enable_autobackups]" value="1" ' . @checked(1, $settings['enable_autobackups'], false) . '/>';
                                                                    ?>
                                                                    <?php _e('Enable Auto Backups', 'wpallbkp'); ?>
                                                                </label>
                                                            </div>
                                                            <label>
                                                                <?php
                                                                settings_fields('wp_all_backup_options');
                                                                _e('Auto Backup Frequency', 'wpallbkp');
                                                                ?>
                                                                <select name="wp_all_backup_options[autobackup_frequency]" id="wp_all_backup_schedule_reoccurrence">    		               
                                                                    <option <?php echo selected('hourly', $settings['autobackup_frequency'], false) ?> value="hourly"><?php _e('Once Hourly', 'wpallbkp'); ?></option>                
                                                                    <option <?php echo selected('twicedaily', $settings['autobackup_frequency'], false); ?> value="twice daily"><?php _e('Twice Daily', 'wpallbkp'); ?></option>                
                                                                    <option <?php echo selected('daily', $settings['autobackup_frequency'], false) ?> value="daily"><?php _e('Once Daily', 'wpallbkp'); ?></option>                
                                                                    <option <?php echo selected('weekly', $settings['autobackup_frequency'], false); ?> value="weekly"><?php _e('Once Weekly', 'wpallbkp'); ?></option>                     
                                                                    <option <?php echo selected('monthly', $settings['autobackup_frequency'], false); ?> value="monthly"><?php _e('Once Monthly', 'wpallbkp'); ?></option>                
                                                                </select>			
                                                            </label>
                                                            <p class="submit">
                                                                <input type="submit" name="Submit" class="button-primary" value="Save Settings" />
                                                            </p>
                                                        </form>

                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="profile">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsedb">
                                                                        <?php _e('Database Information', 'wpallbkp') ?>

                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapsedb" class="panel-collapse collapse in">
                                                                <div class="panel-body">
                                                                    <table class="table table-condensed">
                                                                        <tr class="success">
                                                                            <th><?php _e('Setting', 'wpallbkp') ?></th>
                                                                            <th><?php _e('Value', 'wpallbkp') ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><?php _e('Database Host', 'wpallbkp') ?></td><td><?php echo DB_HOST; ?></td>
                                                                        </tr>
                                                                        <tr class="default">
                                                                            <td><?php _e('Database Name', 'wpallbkp') ?></td><td> <?php echo DB_NAME; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><?php _e('Database User', 'wpallbkp') ?></td><td><?php echo DB_USER; ?></td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><?php _e('Database Type', 'wpallbkp') ?></td><td>MYSQL</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <?php
                                                                            // Get MYSQL Version
                                                                            global $wpdb;
                                                                            $mysqlversion = $wpdb->get_var("SELECT VERSION() AS version");
                                                                            ?>
                                                                            <td><?php _e('Database Version', 'wpallbkp') ?></td><td>v<?php echo $mysqlversion; ?></td>
                                                                        </tr>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsedbtable">
                                                                        <?php _e('Tables Information', 'wpallbkp') ?>

                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapsedbtable" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <table class="table table-condensed">
                                                                        <tr class="success">                                        
                                                                            <th><?php _e('No.', 'wpallbkp') ?></th>
                                                                            <th><?php _e('Tables', 'wpallbkp') ?></th>
                                                                            <th><?php _e('Records', 'wpallbkp') ?></th>

                                                                        </tr>                                 
                                                                        <?php
                                                                        $no = 0;
                                                                        $row_usage = 0;
                                                                        $data_usage = 0;
                                                                        $tablesstatus = $wpdb->get_results("SHOW TABLE STATUS");
                                                                        foreach ($tablesstatus as $tablestatus) {
                                                                            if ($no % 2 == 0) {
                                                                                $style = '';
                                                                            } else {
                                                                                $style = ' class="alternate"';
                                                                            }
                                                                            $no++;
                                                                            echo "<tr$style>\n";
                                                                            echo '<td>' . number_format_i18n($no) . '</td>' . "\n";
                                                                            echo "<td>$tablestatus->Name</td>\n";
                                                                            echo '<td>' . number_format_i18n($tablestatus->Rows) . '</td>' . "\n";

                                                                            $row_usage += $tablestatus->Rows;


                                                                            echo '</tr>' . "\n";
                                                                        }
                                                                        echo '<tr class="thead">' . "\n";
                                                                        echo '<th>' . __('Total:', 'wp-dbmanager') . '</th>' . "\n";
                                                                        echo '<th>' . sprintf(_n('%s Table', '%s Tables', $no, 'wp-dbmanager'), number_format_i18n($no)) . '</th>' . "\n";
                                                                        echo '<th>' . sprintf(_n('%s Record', '%s Records', $row_usage, 'wp-dbmanager'), number_format_i18n($row_usage)) . '</th>' . "\n";

                                                                        echo '</tr>';
                                                                        ?>


                                                                    </table>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsewp">
                                                                        <?php _e('WordPress Information', 'wpallbkp') ?>

                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapsewp" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <table class="table table-condensed">
                                                                        <tr class="success">                                        
                                                                            <th><?php _e('Setting', 'wpallbkp') ?></th>
                                                                            <th><?php _e('Value', 'wpallbkp') ?></th>

                                                                        </tr>     
                                                                        <tr>
                                                                            <td><?php _e('WordPress Version', 'wpallbkp') ?></td>
                                                                            <td><?php bloginfo('version'); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><?php _e('Home URL', 'wpallbkp') ?></td>
                                                                            <td> <?php echo home_url(); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><?php _e('Site URL', 'wpallbkp') ?></td>
                                                                            <td><?php echo site_url(); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><?php _e('Upload directory URL', 'wpallbkp') ?></td>
                                                                            <td><?php $upload_dir = wp_upload_dir(); ?>
                                                                                <?php echo $upload_dir['baseurl']; ?></td>
                                                                        </tr>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsewpsetting">
                                                                        <?php _e('WordPress Settings', 'wpallbkp') ?>

                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapsewpsetting" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <table class="table table-condensed">
                                                                        <tr class="success">                                        
                                                                            <th><?php _e('Plugin Name', 'wpallbkp') ?></th>
                                                                            <th><?php _e('Version', 'wpallbkp') ?></th>           
                                                                        </tr> 
                                                                        <?php
                                                                        $plugins = get_plugins();
                                                                        foreach ($plugins as $plugin) {
                                                                            echo "<tr>
                                                                    <td>" . $plugin['Name'] . "</td>
                                                                    <td>" . $plugin['Version'] . "</td>                                         
                                                                 </tr>";
                                                                        }
                                                                        ?>                                    
                                                                    </table>    

                                                                    <div class="row">
                                                                        <button class="btn btn-primary" type="button">
                                                                            <?php _e('Drafts Post Count', 'wpallbkp') ?> <span class="badge"><?php
                                                                            $count_posts = wp_count_posts();
                                                                            echo $count_posts->draft;
                                                                            ?></span>
                                                                        </button>
                                                                        <button class="btn btn-primary" type="button">
                                                                            <?php _e('Publish Post Count', 'wpallbkp') ?> <span class="badge"><?php
                                                                            ;
                                                                            echo $count_posts->publish;
                                                                            ?></span>
                                                                        </button>
                                                                        <button class="btn btn-primary" type="button">
                                                                            <?php _e('Drafts Pages Count', 'wpallbkp') ?> <span class="badge"><?php
                                                                            $count_pages = wp_count_posts('page');
                                                                            echo $count_pages->draft;
                                                                            ?></span>
                                                                        </button>
                                                                        <button class="btn btn-primary" type="button"><?php _e('Publish Pages Count', 'wpallbkp') ?> <span class="badge"><?php echo $count_pages->publish; ?></span>
                                                                        </button>
                                                                        <button class="btn btn-primary" type="button"><?php _e('Approved Comments Count', 'wpallbkp') ?> <span class="badge"><?php $comments_count = wp_count_comments();
                                                                            echo $comments_count->approved; ?></span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="system">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsedb"><?php _e('System Information', 'wpallbkp') ?>

                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapsedb" class="panel-collapse collapse in">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <?php
                                                                        /* get disk space free (in bytes) */
                                                                        $df = disk_free_space(WPDB_ROOTPATH);
                                                                        /* and get disk space total (in bytes)  */
                                                                        $dt = disk_total_space(WPDB_ROOTPATH);
                                                                        /* now we calculate the disk space used (in bytes) */
                                                                        $du = $dt - $df;
                                                                        /* percentage of disk used - this will be used to also set the width % of the progress bar */
                                                                        $dp = sprintf('%.2f', ($du / $dt) * 100);

                                                                        /* and we formate the size from bytes to MB, GB, etc. */
                                                                        $df = wp_db_backup_format_bytes($df);
                                                                        $du = wp_db_backup_format_bytes($du);
                                                                        $dt = wp_db_backup_format_bytes($dt);
                                                                        ?>
                                                                        <div class="col-md-1"><a href="" target="_blank" title="Help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></div>
                                                                        <div class="col-md-3">Disk Space</div>
                                                                        <div class="col-md-5">
                                                                            <div class="progress">
                                                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo trim($dp) ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo trim($dp) ?>%"><?php echo $dp ?>%
                                                                                </div>
                                                                            </div>   
                                                                        </div>
                                                                        <div class="col-md-1"></div>
                                                                        <div class="col-md-4"></div>
                                                                        <div class="col-md-5">
                                                                            <div class='prginfo'>
                                                                                <p><?php echo "$du of $dt used"; ?></p>
                                                                                <p><?php echo "$df of $dt free"; ?></p>
                                                                                <p><small><?php _e("Note: This value is the physical servers hard-drive allocation.", 'wpdbbkp'); ?> <br/><?php _e("On shared hosts check your control panel for the 'TRUE' disk space quota value.", 'wpdbbkp'); ?>
                                                                                    </small>
                                                                                </p>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-1"><a href="" target="_blank" title="Help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></div>
                                                                        <div class="col-md-3"><?php _e('Upload directory URL', 'wpallbkp') ?></div>
                                                                        <div class="col-md-5"><?php $upload_dir = wp_upload_dir();
                                                                        echo $upload_dir['baseurl'] ?></div>
                                                                        <div class="col-md-3"></div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-1"><a href="" target="_blank" title="Help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></div>
                                                                        <div class="col-md-3"><?php _e('Upload directory', 'wpallbkp') ?></div>
                                                                        <div class="col-md-5"><?php echo $upload_dir['basedir']; ?></div>
                                                                        <div class="col-md-1"><?php echo substr(sprintf('%o', fileperms($upload_dir['basedir'])), -4); ?>
                                                                        </div><div class="col-md-2"><?php echo (!is_writable($upload_dir['basedir'])) ? '<p class="text-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Not writable </p>' : '<p class="text-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> writable</p>'; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-1"><a href="" target="_blank" title="Help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></div>
                                                                        <div class="col-md-3"><?php _e('Max Execution Time', 'wpallbkp') ?></div>
                                                                        <div class="col-md-5"> <?php echo ini_get('max_execution_time'); ?></div>
                                                                        <div class="col-md-1"></div>
                                                                        <div class="col-md-2"><?php echo ini_get('max_execution_time') < 60 ? '<p class="text-danger"  data-toggle="tooltip" data-placement="left" title="For large site set high"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Low </p>' : '' ?></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-1"><a href="" target="_blank" title="Help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></div>
                                                                        <div class="col-md-3"><?php _e('Backup directory', 'wpallbkp') ?></div>
                                                                        <div class="col-md-5"> <?php _e($upload_dir['basedir'] . '/' . WPALLBK_BACKUPS_DIR, 'wpallbkp'); ?></div>
                                                                        <div class="col-md-1"><?php echo substr(sprintf('%o', fileperms($upload_dir['basedir'] . '/' . WPALLBK_BACKUPS_DIR)), -4); ?>
                                                                        </div><div class="col-md-2"><?php echo (!is_writable($upload_dir['basedir'] . '/' . WPALLBK_BACKUPS_DIR)) ? '<p class="text-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Not writable </p>' : '<p class="text-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> writable</p>'; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-1"><a href="" target="_blank" title="Help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></div>
                                                                        <div class="col-md-3">Root Path</div>
                                                                        <div class="col-md-5"><?php echo $_SERVER['DOCUMENT_ROOT'] ?></div>                           
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-1"><a href="" target="_blank" title="Help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></div>
                                                                        <div class="col-md-3">ABSPATH</div>
                                                                        <div class="col-md-5"><?php echo ABSPATH ?></div>                           
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-1"><a href="" target="_blank" title="Help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></div>
                                                                        <div class="col-md-3">Loaded PHP INI</div>
                                                                        <div class="col-md-5"><?php echo php_ini_loaded_file(); ?></div>                           
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-1"><a href="" target="_blank" title="Help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></div>
                                                                        <div class="col-md-3">Memory Limit</div>
                                                                        <div class="col-md-5"><?php
                                                                        echo WP_MEMORY_LIMIT;
                                                                        echo '(Max &nbsp;' . WP_MAX_MEMORY_LIMIT;?>)</div>                           
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-1"><a href="" target="_blank" title="Help"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a></div>
                                                                        <div class="col-md-3"><?php _e('Class ZipArchive Present : ', 'wpallbkp') ?></div>
                                                                        <div class="col-md-5"> <?php echo (class_exists('ZipArchive')) ? 'Yes </p>' : '<p class="">No</p>'; ?></div>
                                                                        <div class="col-md-3"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="panel-footer"><h4>Get Flat 35% off on <a target="_blank" href="http://www.wpseeds.com/product/wp-all-backup/">WP All Backup Plus Plugin.</a> Use Coupon code 'WPSEEDS35'</h4></div>
                                                    </div>
