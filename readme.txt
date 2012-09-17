Thank you for downloading and installing the [b]Birthday Posts[/b] modification by JBlaze!

[b]Current Version:[/b] 0.12.1 Beta

If you ever need support, please visit http://thelulz.com/community and sign up for a free account and recieve free support!

Regards,
JBlaze

[hr]

[b]Legend:[/b]
! = Bugfix
- = Removed
+ = New Feature
o = Update
> = New Language
^ = Initial/New Release

[tt]1/1/10 - v.0.12.1 Beta
! Fixed throwing posts for all users without dates on 1st January (sorry, stupid bug)
! Fixed installer not always creating new column

12/28/09 - v0.12 Beta (the "Arantor had fun" build)
! Fixed smileys not being recognized; smileys are enabled on all new birthday posts now
! Fixed typo in English/English British regarding an apostrophe
! Fixed hard-coded text string to reuse existing language string
! Fixed extra menu item in Security menu
! Fixed undefined index bp_settings_title
! Fixed PM support entirely :)
! Fixed {link} support for PMs to link back to posts
+ Added {forumname} for PM templates, as well as default PM templates
+ Added protection for duplicating posts; checks for minimum 2 days between posting for a given user
+ Must be active within last days support
+ Minimum time registered on forum support
+ Post to existing topic (must be in the listed board!!)
+ Post all birthdays together (in a comma list, {membername} becomes "person1, person2, person3")
+ Uninstall also tidies up scheduled task run log (since the items never get displayed, they're just phantom data)
+ Made posting/sending to banned users optional (default off)
o Fixed indentation in the main area
o Fixed up installer to use proper installer semantics (db_insert, <database>)
o Removed unneeded $member_name variable when {membername} literal string would be more appropriate
> English-British support added
- License notes removed from installer script (old URL etc). Any reuse/license questions, please direct to [url=http://www.simplemachines.org/community/index.php?topic=328059.0]the mod's thread[/url].
- Removed Turkish translation as needs retranslating for extra features

NB: Future versions probably should split Turkish into separate UTF-8 and ISO-8859-9 (?) files.

10/16/09 - v0.11.2 Beta
! Fixed undefined error for $txt['bp_settings_title']
! Fixed problem with not sending PM's or making posts
> Russian translation added

10/15/09 - v0.11.1 Beta
! Fixed parse error on install.php
! Fixed bug in package-info.xml

10/14/09 - v0.11 Beta
! Fixed sendPM error
! Fixed database errors
o Rewrote messy code
+ Added support for SMF 2.0 RC2

8/05/09 - v0.10.1 Beta, v0.10.2 Beta
! Fixed parse error when running scheduled task
> New language: Turkish

7/27/09 - v0.10 Beta
! Small bug fixed in query.
+ Added feature to send notification via PM.

7/25/09 - v0.9.1 Beta
! Fixed a small bug in ScheduledTasks.php
o Updated settings.

7/24/09 - v0.9 Beta
^ Initial release.[/tt]