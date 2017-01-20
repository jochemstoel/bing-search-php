<img src="https://66.media.tumblr.com/db0a3c7d780758c323f737abab420124/tumblr_inline_ocgoil6FFi1ro1ben_1280.jpg">

### Update: safe mode support 
Thanks to the question of user <a href="https://github.com/novaidea">Novaidea</a> there is now the option for a strict search. (see end of document)

# Bing Search
This PHP class will retrieve search results from Bing by reading its RSS feed. It will automatically cache results to the <i>Cache</i> folder. Make sure that it is writeable.
## Use 
```php 
require('Bing.php');
$bing = new Bing('cool stuff');
print_r($bing->data);
```
## Result:
```

Array
(
    [0] => Array
        (
            [title] => CoolThings.com | Cool Stuff, Cool Gadgets, Cool Gifts & Things
            [link] => http://www.coolthings.com/
            [description] => Cool Things curates the latest in gadgets, gizmos, gear, gifts for men and women, tools, toys, cars, inventions, furniture and awesome stuff you can buy.
            [pubDate] => ma, 22 aug 2016 01:17:00 GMT
        )

    [1] => Array
        (
            [title] => Cool Stuff | cool things and cool gadgets to buy
            [link] => http://www.acoolstuff.com/
            [description] => we find the best cool stuff,cool things, cool gadgets, awesome stuff for you to buy online,You can find some pretty cool ideas here too!
            [pubDate] => ma, 22 aug 2016 07:30:00 GMT
        )

    [2] => Array
        (
            [title] => Fun gifts and gadgets on CoolStuff
            [link] => http://www.coolstuff.com/
            [description] => Lots of unusual and fun gadgets and gifts that you never knew existed! We have all the latest and coolest stuff! Fast delivery and low cost shipping.
            [pubDate] => zo, 21 aug 2016 21:57:00 GMT
        )

    [3] => Array
        (
            [title] => Cool Stuff Inc.
            [link] => http://www.coolstuffinc.com/
            [description] => Offering collector cards sets and supplies, miniatures, vs system, and board games.
            [pubDate] => ma, 22 aug 2016 04:59:00 GMT
        )

    [4] => Array
        (
            [title] => CoolThings Cool Gadgets - Cool Stuff, Cool Gadgets, Cool ...
            [link] => http://www.coolthings.com/tag/cool-gadgets/
            [description] => Button pins with graphic prints haven’t exactly been in high demand since the 80s. Sure, they’re still around, but you won’t see people wearing th...
            [pubDate] => ma, 22 aug 2016 03:05:00 GMT
        )

    [5] => Array
        (
            [title] => Awesome Stuff to Buy - Find Cool Things to Buy
            [link] => https://awesomestufftobuy.com/
            [description] => Ever expanding list of awesome stuff to buy online, so if you're looking for cool things to buy this is for you, not for the faint of wallet.
            [pubDate] => ma, 22 aug 2016 04:59:00 GMT
        )

...

```
## Safe search (disabled by default)
Keep in mind that Bing is not perfect like me and it is possible (but very rare) that sometimes it accidentially includes a non-safe result.

#### Example 1 | safe mode disabled (default!)

```js
$search = new Bing('teen', false); // false means no safe mode
print_r($search->data);
```

#### Example 2 | safe mode enabled (true)

```js
$search = new Bing('teen', true); 
print_r($search->data); // this will not have teen sex results :(
```


Like always, if you like it then send me a million dollars.