
<?php
    $_currentFile = basename($_SERVER['PHP_SELF']);
    $_pageTitle="More About Me";
    require_once "_header.php";
?>
<br />
    <h3>My childhood</h3>
        <p class="myclass">I grew up in Glenelg, Maryland.<br/>I claim it to be a small town because we don't have any grocery stores or even a walmart!<br/>
            Glenelg is located approximately 35 to 40 minutes outside of Baltimore city.<br/>I attended <a href="http://www.resstpaul.org" target="_blank">Resurrection-St. Paul School.</a><br/>
            I then proceeded to go to<a href="http://www.loyolablakefield.org" target="_blank"> Loyola Blakefield</a> for high school. <br/>Now I attend Coastal Carolina.
        </p>
    <h3 class = "test">My favorite things in no particular order</h3>
    <ol class="test">
        <li>Coffee
            <ul class="nonelist">
                <li>
                    <p>I love coffee. I am more of a fan of medium roasts than darker roasts like Expresso. <br/>My girlfriend got me a keurig last year for christmas and I use it almost everyday
                    I prefer to make my own than to go out and buy it.</p><hr>
                </li>
            </ul>
        </li>
        <li>My girlfriend
             <ul class="nonelist">
                <li><p><img src="images/mygirlfriendedited.jpg" alt="sydney" width="400" height="400"/><br/>My girlfriend's name is Sydney.</p><hr/></li>
            </ul>

        <li>Food
            <ul class="nonelist">
                <li>
                    <p>My favorite food is anything with pasta in it. I am from a very Italian family so I grew up on any kind of spaghetti you can think of.
                    I also am a huge fan of taco salads.</p><hr/>
                </li>
            </ul>
        </li>
        <li>Computers
            <ul class="nonelist">
                <li>
                    <p>I love working on and with computers. I especially like playing games on them.<br/>I currently have a Macbook that is compatible with both mac and windows software through different software.<br/>
                    For my summer job, I got to take apart different computers and put them back together with new parts<br/>
                    and it was a great learning experience and I had fun doing it while I got paid. </p><hr/>
                </li>
            </ul>
        </li>
    </ol>
<?php
    include_once "_footer.php";
?>