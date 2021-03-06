<h2>Objective</h2>
Generate web app to view, add and edit data in any MySQL table or Query in just 4 lines of code, with pagination auto generated as well, as are the media queries, to build a truly responsive app that is mobile friendly  and works accross all platforms and screen sizes.
<br><br>
There are in fact 2 main functions, sqlEdit and sqlBrowse. As explained. sqlEdit has the ability ot add.modify data, however sqlBrowse can only generate view only apps.
<h2>Quick Deploy and Use:</h2>
<h4>Deploy and use in under 2 minutes. Easy as 1-2-3:</h4>
<div>
<br>1. Download to root or sub root folder using GIT or ZIP archive (ZIP will require unzipping) and navigate to 'sqlEdit' folder
<br>2. Enter database credentials in settings.ini
<br>3. Enter database and table name in sampleCode.php
</div>
<h2>Practical Applications</h2>
<h4>1.0 Rapid Development</h4>
<h4>2.0 Ancillary Capacity to Primary Applications, such as:</h4>
<div>
<br>2.1. Basic customer data management and admin tool
<br>2.2. Fronted self help content editing tool for clients
<br>2.3. Backend rporting tool for clients
<br>2.4. Display daily billing summary
<br>2.5. Display daily signup and customer traffic
<br>..and so on...
<h4>
<h2>Requirements and Dependencies</h2>
<h3>PHP Classes</h3>
<ul>
    <li><b>sql.class.php</b><div>MySQLi Database abstraction and helper class, required in order for forms.class.php to work</div></li>
    <li><b>forms.class.php</b><div>Main class that implements all the functionality. Dependent on sql.class.php</div></li>
</ul>

<h3>Server Operating Systen</h3>
<ul>
    <li>CentOS 7 64 Bit Server OS</li>
    <li>Windows Server, Windows XP, Windows 7, Windows 8, Windows 10 OS</li> 
    <li>MacOS</li>
    <li>MySQL sercer, MariaDB</li>
</ul>

<h3>Server Operating Environment</h3>
<ul>
    <li>PHP > Ver 7.0
    <li>MySQL
    <li>GD</li>
</ul>

<h3>Development Languages</h3>
PHP, MySQL

<h1>Features</h1>
<h2>1.0 Data Manipulation</h2>
<div>View, Browse, Edit, Add or Delete data from any MySQL table in an elegant and clean HTML table format</div>
<h4>1.1 Browse MySQL Data</h4>
<div>Display data in any MySQL table in an elegant and clean HTML table format</div>
<h4>1.2 Edit MySQL table in browser</h4>
<div>Ajax edit data in any MySQL table in an elegant and clean HTML table Grid format</div>
<h4>1.3 Add New Row</h4>
<div>Add a new record to MySQL table that you are currently editing</div>
<h4>1.4 Delete Row</h4>
<div>Delete record from MySQL table that you are currently editing</div>
<h2>2.0 Data Presentation</h2>
<div>Provides multiple options, for best user experience</div>
<h4>2.1 Auto detect mobile - 100% responsive</h4>
<h4>2.2 Select View Mode:</h4>
<div>Switch easily between 2 display modes</div>
<ul>
    <li>Boxed format</li>
    <li>Full width format</li>
 </ul>
<h4>2.3 Select Data Presentation Format</h4>
<div>Switch easily between 2 data formats</div>
<ul>
    <li>Grid View</li>
    <li>Single record form mode</li>
 </ul>
 
<h2>3.0 Pagination</h2>
The automatic pagination uses a truly unique approach to seemless handle datasets ranging from 10 rows to 2 million rows, all without any complicated juggling of page numbers or special case handling code - and what resulys is one of the cleanest pagination implementations that you will see, that handles 10 pages the same way it handles 2,000,000. See examples or screenshots for examples.

Pagination may be turned off or on at any time by seeting the config values in the settings.ini file.

<h2>4.0 Auto Data Format</h2>
Easily switch back and forth between the 2 available views - Boxed layout or full width layout, used in order to ease cluttering and conjestion when working on tables with a large nuber of colums or fieldsets.

There exists a trigger point, beyond which, if exceeded, the number of colums is exceeded, the display format switches automatically from the default 'grid view' to the row based 'fieldlist' mode, and each field is displayed on a new page row, and showing only one table record at a time. Subsequent rows are fetched upon the user requesting pages higher in number, using generated page links in the pagination area or by manipulating the page selctoe widget at the bottom of the screen.

<h2>5.0 Custom CSS</h2>
User has full athority of look and feel etc and may set their own styles and class at the desgnated sections that handless css rules.

<h2>6.0 Flexibility and ease of Configuration</h2>
Even though it is ridiculously simple to use, we still need to tell it where to find your databse/tables etc. This is done through the configuration file ('settings.ini'). It also has a bunch of other optional parameters, which if not set by you, have little impact on the proper functioning of the object.

<h2>7.0 User Experience.</h2>
Data is, without exception, loaded using the jquery ajax library, and as a rtesult, the user is never put through the experience of being constantly interrupted, while waiting for pages reloading over and over, and circumventing the creation of unnecessay high amount of stress externally in the network, and internally on the webserver filesystem i/o operations.

<h2>Installation</h2>
<div>2 step process. Get files, and configure. Done. You can get the source files in 2 ways. GIT or download a zip.</div>

<h3>Step 1 </h3>
<h4>OPTION 1</h4>
<pre><code>
git clone https://github.com/aviator001/sqlEdit.git
</code></pre>

<h4>OPTION 2</h4>
<h4>Download from link below:></h4>
<pre><code>
https://gangsterforms.com/sqlEdit.zip
</code></pre>

<div>Once downloaded, unzip archive anywhere.

<h3>Step 2 </h3>
<h4>Configure settings.ini</h4>

<div>Both options, GIT and Zip file download it will create a folder call sqlEdit. As part of the next an final step, you will configure your settings, by modifying the settings.ini file that is in the sqlEdit folder.</div>
<br>
<div>Configure your settings.ini file with the information below and you  mare done with configuration.</div>
<div>Here is a full last of parameters  that you can set in the settings.ini file.:</div>
<br>
<ul>
<li>Database Server IP</li>
<li>Database Username</li>
<li>Database Password</li>
<li>Database Name</li>
</ul>
<div>And this is what settings.ini looks like</div>
<pre><code>
<b><i>#Database user name</i></b>
db_user=
<b><i>#Database password</i></b>
db_pass=
<b><i>#Name of the database trying to connect to</i></b>
db_name=
<b><i>#Database Server IP Address without any quotes</i></b>
db_server=
<b><i>#Max number of items to be displayed per page</i></b>
items_per_page=5
<b><i>#Max number of items to be displayed per page</i></b>
pagination=on
</pre></code>

<h2>Running sqlEdit</h2>
<h3>Step 1</h3>
<h4>Edit sampleCode.php</h4>
<div>Once settings.ini is configured, open up the sample code php file - and enter in values fro the database and table (first 2 lines  as shown below.)</div>

<h3>Step 2</h3>
<h4>Run sampleCode.php</h4>
<div>Open sampleCode.php in your browser, and you will be presented with the data from the table that you specified in editable format.</div>

<h2>Real World Code Samples</h2>
<pre><code>
 /*******************************************************************************
  * Modify first 2 lines only! 
  * $table:  Enter the MySQL table that you want to edit data for, and,
  * $db_name: Enter the MySQL Database Name that has the table you want to edit
  *****************************************************************************/
  
    $db_name="Enter database name";
    $table="Enter name of table you want to edit";
    parse_str(http_build_query($_GET));
    include "class/utils.class.php";
    $c=new utils;
    $c->connect(DB_SERVER,DB_USER,DB_PASS,$db_name);
    echo $c->SQLEdit($db_name,$table);
    include "paginate.php";
</code></pre>
<h2>Quick User Guide</h2>
<h2>Screenshots</h2>
 
