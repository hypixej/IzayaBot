#IzayaBot

This bot is written in php and is intended to be used as a Discord bot account client. This is intended to have fun with your friends and make a bot say something in text chats. To get started, simply put the files in web directory. The bot is named after Izaya Orihara, a character in anime "Durarara!!". Because he knows all. This bot knows all.

Make sure your bot is Gateway identified or whatever. 

Hidden Features:
1. index.php?ty=messages&cid=(channel_id_here) also works with DM channels.

Update: January 24, 2018
1. No longer need a config.php for logging in, simply enter your token when it asks you and it gets stored in your browser cookies.
2. Lots of features added, too lazy to document the rest

Update: February 4, 2018
1. Added message editor

Update: February 26, 2018
1. Added baseurl variable for icons (under the hood thing)
2. Added experimental function for displaying images (under the hood thing)
3. Every category of id has it's own variable. Channel id variables are cid, guild id variables are gid and etc. This makes it easier for me to add more features. (under the hood thing)
4. Added hidden pages for getting dm channels, getting server banlist and etc (under the hood thing)
5. You can change bot username, the page is hidden though (under the hood thing)
6. You can edit messages that the bot has posted
7. Non-functioning placeholder buttons are hidden now
8. You can no longer click on category and voice channels, it's broken anyway
9. You now get a message telling you the bot has no access to that channel if it doesn't instead of an error message
10. You can now see who is mentioned in a message
11. You can now see what reactions are reacted on a message
12. You can now see what what time the message was posted
13. Slight redesign (like, avatars are larger and etc)
14. Some bugfixes

Update: March 19, 2018
1. Easier way to change username.
2. You can now Delete messages, no confirmation dialog though.
3. When you log in using the token, you now get invite link in case you need it.
4. Some Cosmetic changes.
5. Some under the hood changes

Update: March 21, 2018
1. You can now view guild members (max 1000 members atm)
2. You can now view a list of banned members in the guild.
3. Version number will now be the the date the build is released on.
4. Replaced the theme with a Dark theme, Discord color style.
5. Version number now shows up at bottom.
6. Added some under the hood things that will make my life easier later on: invite link generator function, separated some style elements into a different css file and a little function for easily creating buttons on the bottom.

Update: April 1, 2018 (not an april fools prank)
1. Added "special things" page that allows you to do various things.
2. You can now change nicknames of everyone in the guild with one click. Feature is in "special things" page.
3. Changing your username is now easily possible in the "special things" page.
4. You can now view more than 1000 members, so while I implemented that, I also decided to limit the amount of users in one page with 10.
5. You can now browse messages beyond first 100, with "next page" feature.
6. Delete message calls now open in new tab by default.
7. Fixed messages not being warped.
8. Under the hood things (constructing a json request with php functions instead of manually writing it which fixed a bug with editing messages, adding uid variable for thing to be implemented in future and etc.)

Update: April 9, 2018 
1. set max exec time to 3000 seconds. if you are getting an error, probably remove it, or do it with php.ini.
2. Embedded images now fit horizontally on message list.
3. Added some functions to generate image embed.
4. Added a function for curl requests, which makes it easier for me to implement more features.
5. Added ability to update many users at once with same settings like same roles.
6. Added ability to ban and unban a user.
7. After posting an image, you are taken back to a message list.
8. The site is slightly more mobile friendly, I guess.
9. Added experimental support for embeds in messages.
10. Other general improvements.

Update: April 11, 2018
1. The page title is now the username of the bot when logged in.
