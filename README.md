##Project 4: Dynamic Web Applications##
Hosted <a href="http://harvardp4-harvardp3.rhcloud.com">Here</a>

For this project, I created a cloud-based system for storing code snippets called "SnipSafe". Users access it by signing up and logging in. From the main screen, they can create, edit, and move their snippets.

Resources used:
<ol>
	<li>Laravel (duh)</li>
	<li>Polymer</li>
	<li>CodeMirror</li>
	<li>JQuery</li>
</ol>

Most of the project uses AJAX (via JQuery) to fetch and send data.

###How it works###

<b>1. User signs up</b>
The email is checked for validity. If it passes, an Ajax request is sent, and a new user is added to the <code>user</code> database, using Laravel's <code>Auth</code> methods.

An "ok" message is returned if everything goes well. The user is also logged in. A directory under the <code>store</code> folder is created to store all of the user's snippets.

<b>2. User logs in</b>
<code>Auth</code> is used again. The username and password are sent via Ajax, and then checked. If the user with that email exists, and has the same password as the specified one, they are logged in.

<b>3. Changing password</b>
An ajax request is sent, and password of that <code>User</code> instance is changed. If the user is not logged in, he is first redirected to the signin page.

<b>4. Adding snippets</b>
An ajax request is sent. A php script creates a new <code>.txt</code> file in the user's directory <code>store/{email}</code>. It is named like <code>{unique_id}.txt</code> to avoid any overlap. This text file is initialized with default text.

<pre>
Title
Language (javascript, html, php, etc.)
Tags
Start of body
</pre>

The path for editing this file is returned, and the user is redirected to the editor. A row is added to the <code>snip</code> table, which specifies the path of the snippet, and it's owner's email.

<b>5. Displaying snippets</b>
A php script sifts through all rows of the <code>snip</code> table, and displays the information of all those whose email matches the user's email. The body text is retrieved by using the path.

<b>6. Deleting a snippet</b>
An ajax request is sent with the unique path of the snippet. It is deleted.

<b>7. Editing a snippet</b>
The user is shown an editor for the title, tags, and body. These are retrieved by reading the stored file using its path.

If the user cancels the operation, nothing happens. If they confirm it, a Ajax request is sent, along with the new title, tags, and body. The table and file are changed accordingly.

<b>8. Downloading a snippet (regular)</b>
The text of the file is read, put into a local file, then downloaded.

<b>9. Downloading a file (PDF)</b>
The text is retrieved using the path. A new pdf document is created using JsPDF. The lines of the text file are inserted, one by one, into the pdf file, which is downloaded.

<b>10. Uploading a file</b>
User submits files (via drag and drop) into a <code>div</code>. The contents of these files are read, and have default titles and tags added. The final content, in the format:
<code><pre>Line1: Title
Line2: Language
Line 3: tag1,tag2,tag3,etc...
Lines 4+: Actual content</pre></code>
Is submited to <code>uploadFile</code>, and new snippets are created and added.