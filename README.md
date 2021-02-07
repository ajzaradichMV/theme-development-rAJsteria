# theme-development-rAJsteria
Rach and AJs Child Theme for Trellis

TODO:
- Get the primary and secondary colors from Trellis into the appropriate places in the CSS. Right now I'm just using default colors that I choose but we'll want users to be able to make that choice.
- Build in a couple different default color styles for the theme.
- Create a category widget that also works with JS so we can cycle through the different categories that users want displayed within the widget. 
- Resize some of the boxes and text to make it look less cartoonish and more magazine/newspaper oriented.
- Fix homepage grid hover CSS; I decided to go a different direction here and I'll need to fix the CSS for those grid boxes and remove the HTML portions for it in the PHP files. 

UPDATE (02/7/2020):
- Added some base styles for post's pages so they looked less funky
- Added styling to the navigation links at the bottom of posts
- Removed post meta from appearing above the post and instead added a filter that hooks into the_content and outputs it at the start of the post. 
- Fixed a bug (yay my first one) that would cause an "Invalid JSON" error to occur in the post editor and Trellis menus.
- Added a sample header logo to the top of the theme
- Added hyperlinks to the news widget.

UPDATE (02/1/2020):
- Did a lot of work on the homepage to have at least something styled there to go off of.
- Got the featured post/latest post at the top of the homepage to behave correctly with 16x9 and 3x4 images in a grid layout. Resizes pretty nicely.
- Made it so that if a widget isn't in one of the widget areas it won't generate that widget area. This means that we won't have that empty space and the rest of the widgets will fill the gap.
- The main "news" widget is almost done, just need to include the code to make hyperlinks work because I was lazy and didn't do it when I had the chance.
- Thinking of ideas regarding a "trending posts" type widget to include underneath the navigation menu. I don't think I can do this with pure PHP so will probably have to utilize some JS if we can detect the widget running.
- Figured out how to pull images of certain sizes at least, that was fun.
- Next phase is probably finishing up a few of the other widgets I want to add then we can go about placing basic styles across pages and posts.
