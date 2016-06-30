=== WP All Backup ===
Contributors: walkeprashant
Donate link: http://www.wpseeds.com/product/wp-all-backup/
Tags: back up, backup, backups, database, zip, db, files, archive, dropbox,email,restore, Database backup,db backup ,backup, WordPress Database Backup, Duplicator, Duplicate, clone, move, WP db backup,wp database backup,wp backup, wordpress backup, mysql backup,automatically database backup,website backup,website database backup,restore backup
Requires at least: 3.3.3
Tested up to: 4.5

Create Backup and Restore Backup easily on single click.Manual or Automated Backups with Dropbox,FTP integration.

== Description ==

<p>WP All Backup plugin helps you to create Backup and Restore Backup easily on single click.Manual or Automated Backups And also store backup on safe place- dropbox,FTP.</p>

<p>Creates a Backup of your entire website: that's your Database, current WP Core, all your Themes, Plugins and Uploads.</p>

= Get Pro 'WP All Backup' Plugin =

* http://www.wpseeds.com/product/wp-all-backup/

= Features =
<ul>
<li>Create Database Backup easily on single click. </li>
<li><strong>Autobackup </strong>Backup automatically on a repeating schedule</li> 
<li>Backup Listing : Pagination.</li>
<li>Manual backup</li> 
<li>Multisite compatible</li> 
<li>Backup entire site</li>
<li>Exclude specific folders and files</li> 
<li>Downloadable log files</li> 
<li>Simple one-click <strong>restore</strong></li> 
<li>Set number of backups to store</li>
<li>Automatically remove oldest backup</li>
<li><strong>FTP integration</strong></li>
<li><strong>Dropbox integration</strong></li> 
<li><strong>Email Notification</strong></li>
<li>ZipArchive</li>
<li>Backup zip labeled with the site name(Help when backing up multiple sites).</li>
<li>Select Backup Type: Only Database,Only Files, Complete Backup</li>
<li>Inline Help</li>
<li>Search backup from list(Date/Size)</li>
<li>Sort backup list (Date/Size)</li>
<li>Easy To Install(Very easy to use)</li>
<li>Simple to configure(very less configuration).</li>
<li>System Check (i.e backup folder permission, execution time etc)</li>
</ul>
= Pro Features =
<ul>
<li><strong>Support</strong></li>
<li>Updates</li>
<li>PclZip</li>
<li><strong>Amazon S3 integration</strong></li>
<li><strong>Google Drive integration</strong></li>
<li><strong>Clone Site</strong></li>
<li><strong>Move Site</strong></li>
<li>Change Backup folder name</li>
<li>Uses zip and mysqldump for faster back ups if they are available.</li>
<li>Exclude Tables from your back ups.</li>
<li>And More....</li>
</ul>

== Installation ==
1. Download the plugin file, unzip and place it in your wp-content/plugins/ folder. You can alternatively upload it via the WordPress plugin backend.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. WP ALL Backup menu will appear in Dashboard->WP ALL Backup. Click on it & get started to use.

= Refer bellow link for more information =

* http://www.wpseeds.com/wp-all-backup/

== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png
3. screenshot-3.png
4. screenshot-4.png
5. screenshot-5.png

= Refer bellow link for more information =

* http://www.wpseeds.com/wp-all-backup/

== Changelog ==

= 1.6 = 
* Released on : 28-06-2016
* Fixed Vulnerability for prevent direct download 

= 1.5 = 
* Released on : 27-05-2016
* Resolved issue : The website is built under a directory i.e. http://www.xyz.com/demo

= 1.4 = 
* Released on : 03-05-2016
* Add : System Check (i.e backup folder permission, execution time etc)

= 1.3 = 
* Released on : 14-04-2016
* Compatible wordpress version 4.5 : Depricated function : mysql_real_escape_string. use _real_escape insted mysql_real_escape_string
* Resolved issue : PHP Strict Standards:  mktime(). use the time() function instead mktime().

= 1.2 = 
* Released on : 16-11-2015
* Backup zip labeled with the site name(Help when backing up multiple sites).

= 1.1 = 
* Released on : 17-07-2015
* Update exclude files and folders rule.

= 1.0.0 = 
*Plugin Created

== Frequently Asked Questions ==

 Q-How to  create database Backup?
 <br>Follow the steps listed below to Create Backup

 <br>Create Backup:
  <br>1) Click on Create New Backup
  <br>2) Download Database Backup file.
  
 Q-How to restore database backup?
  <br>Restore Backup:
  <br>Click on Restore  
   
 Q-Always get an empty (0 bits) backup file?
 <br>Ans-This is generally caused by an access denied problem.
 <br>You don't have permission to write in the wp-content/uploads. 
 <br>Please check if you have the read write permission on the folder.

Q.Only database backup works
<br>Go to WP ALL Bacup > Setting > Exclude setting in the admin dashboard.
<br>make exclude file setting as empty.(remove all exclude rule)
<br>Let us know in case any issues.
 
Q.On Click Create New Backup it goes to blank page.
<br>Ans: if the site is very large, it takes time to create the backup. And if the server execution time is set to low value, you get go to blank page.
There may be chance your server max execution time is 30 second. Please check debug log file.
You will need to ask your hosting services to increase the execution time and the plugin will work fine for large data.
You can also try to increase execution time. Please make below changes – Add below line

php.ini

max_execution_time = 180 ;

Also Please make sure that you have write permission to Backup folder and also check your log file.
 

 Q.want more feature?
 If you want more feature then
 Drop Mail :walke.prashant28@gmail.com
  
== Upgrade Notice ==
= 1.6 = 
* Fixed Vulnerability for prevent direct download 

== Official Site ==
* http://www.wpseeds.com/wp-all-backup/
* http://www.wpseeds.com/product/wp-all-backup/
* http://walkeprashant.wordpress.com/wp-all-backup/
* walke.prashant28@gmail.com

