#IzayaBot

This bot is written in php and is intended to be used as a Discord bot account client. This is intended to have fun with your friends and make a bot say something in text chats. To get started, simply put the files in web directory. The bot is named after Izaya Orihara, a character in anime "Durarara!!". Because he knows all. This bot knows all.

Make sure your bot is Gateway identified or whatever. 

Hidden Features:
1. To change username, you do index.php?ty=changeusername&nv=New_Username_Goes_Here
2. index.php?ty=messages&cid=(channel_id_here) also works with DM channels.

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