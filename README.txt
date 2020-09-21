http://sye564.poseidon.salford.ac.uk/

Messaging System:
when visiting another users page you can add them to your contacts (if logged in).
the messaging system is fully functional, when you are loggin in and on the index page you are notified of new messages and how many there are.
when you go onto the messaging page (only if logged in) you are shown a list of contacts and how many pending messaged, if any, from each.
when user clicks on a contact they are seamlessly brought to the messaging page, their chat history is displayed and the user is automatically...
...put at the bottom of the chat history.
when receiving a message, if the user is already at the bottom of the page, their view is automatically moved down so the new message is on...
...screen.
the user can type into the textfield and press enter to send a message.
the user can select an image to send with the message, messages can be either an image, text, or both, but not neither.
input is sanitized to allow use of quotations and backspaces.
when the user gives focus to the message input their counterpart with be shown text under their own message input saying "[user] is currently...
...typing".

Infinite Scrolling:
when on the index page the user can continue to scroll down the page and have more results dynamically loaded.
the loading of new posts occurs when a certain distance off the bottom of the page.
providing a decent internet connection, user should not reach the bottom of the page before more results are loaded.
the infinite scrolling works with any combination of the filter.

Data Usage Considerations:
generally the only information exchanged between client and server is necessary, necessary data which is part of redundent data is always...
extracted before sending, more detailed examples are below.
Messaging System:
when polling the server from the chat window for new messages the ID of the latest message is sent as well, the server uses this in the...
...query to ensure ONLY messages that are not yet displayed are returned, duplicate messages are never sent back and never waste data
when pollig for notifications the server only sends back the ID of users who have sent messages and the COUNT of how many messages there are...
..., the calculations are done on the server, saving wasted data from sending messages back and doing them in the web page.
Infinite Scrolling:
like with the Messaging System the latest displayed post is recorded and sent to the server when requesting more posts to show, the server...
...uses that to ensure no duplicate posts are sent and therefor not wasting any data usage on redundant data.

file changes:
new files:
	Models:
		scripts/*
		MessagingInterface.php
	Views:
		messaging.phtml
	Model:
		messaging.php

modified files:
	css:
		my-style.css
	Views:
		index.phtml
		userPage.phtml
	Controller:
		userPage.php
		
	