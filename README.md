## Telegram Mentioner Bot

## Adding
Just invite the bot to your chat https://t.me/team_mentioner_bot (@team_mentioner_bot)

## Usage

You can create groups, add users to this group and mention them by @group_name

```
/creategroup <groupname>
/addmembertogroup <groupname> <@username1> <@username2>...
/mention <groupname>

Result:
Bot reply your message with tagging of everyone, who attached to a group
```

## Commands

## Mentioning
```
/mention <groupname>

eg. /mention @backend
eg2. /mention backend
```

Also you can call: /mention all or /mention everyone to tag anyone who is in any group 

(Notice: If the user does not belong to at least one bot group, then he will not be tagged) 

## Actions with groups

### Create a group
```
/creategroup <groupname>
```

### Delete a group
```
/deletegroup <groupname>
```

## Actions with group members
### Add member to a group
```
/addmembertogroup <groupname> <@username1> <@username2>
```

### Remove member from a group
```
/removememberfromgroup <groupname> <@username1> <@username2>
```
