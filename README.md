# Twitter-like application

This application is a result of my PHP OOP and MySQL workshops.

App works mostly on server side and was written in PHP. Only small piece of code 
was written in Java Script (counter of inserted characters in text area).


User can post new entries, comment himself's entries or entries of others users. 
There is also possibility of sending messages between users.

Users:

All data(email, password, full name and "active" status) of users are hold in MySQL database. E-mails 
are unique values and passwords are hashed. User can edit his data and delete his
account (user is deactivated). Only logged in and active user can use full functionalities
of application. Deactivated users and logged out users can access only login page or registration site. 
Individual user's page can be accessed by clicking user's name. There are small differences
between user's page of logged in user and others users. Site of user has functionalities of
editing or deleting user, also there is impossible to send a message to ourselves. On the other hand
you cannot delete or edit others users, but you can send them a message. 

Entries:

User can post an entry (max 140 char length). Entries are visible on main page and
personal user's page. Every entry can by commented (max 60 char length). User can access
entry page by clicking id of entry (hash followed by number). Every user's entries are
visible for others users (comments as fallow). You cannot make an entry on others users pages
but you are always welcome to leave a comment. 

Messages:

Users can send messages between each other. Message is vary similar to common e-mail.
You can set title and write a text. Clicking on "Post box" you can see your all sand and delivered 
messages. Unread messages's title are <b> bold </b>. When you opened a message it will be marked as
read.   

Database:

Database has tables for users, comments, messages and tweets. All have some testing records.

