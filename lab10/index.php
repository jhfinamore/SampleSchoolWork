
<?php
    $_currentFile = basename($_SERVER['PHP_SELF']);
    $_pageTitle="About me";
    require_once "_header.php";
?>
<p class="myclass">I am from Maryland. I am currently 19 years old. I love crabs as every typical Marylander does.<br />
    I am majoring in Information Systems with a minor in Intelligence studies.<br /> I am hoping to do CyberSecurity in the future.
    I've been an IT intern for the past few summers and have learned a lot.</p>
<h2>My Family</h2>
<p class="myclass">My family has 6 people in it including me. I have an older sister who is a teacher out in Indiana.<br />
I have an older brother who is an tax acccountant out of Baltimore. <br />I am the third child, and I have a younger sister
who attends Salisbury University in Maryland.<br /> My dad is a lawyer and my mom is an advancement director. </p>
<h2>My Hobbies</h2>
<p class = "myclass"> I enjoy cooking with my girlfriend, Sydney. I like to play my old Xbox 360.<br />
    My hobbies including playing video games, such as League of Legends.<br />
<a href="http://na.leagueoflegends.com/" target = "_blank">Link to League of Legends Website</a>,<br/>
    I enjoy watching action and fantasy movies. My favorite movies are the Lord of the Rings movies.<br /></p>
<p class="myclass"><a href="http://www.lordoftherings.net/" target = "_blank" ><img src="images/aragorn.jpeg" alt="Picture of Aragorn"/></a><br />Here is a picture of my favorite character Aragorn.</p>
<h3>A list of interesting things involving me and my family</h3>
<ol>
    <li>My Summer IT Job
        <ul class="unordered">
            <li><a href="http://www.nilesbarton.com" target="_blank">Niles Barton & Wilmer Law Firm</a></li>
        </ul>
    </li>
    <li>University's my families attended
        <ul class="unordered">
            <li><a href="http://www.coastal.edu" target="_blank">Coastal Carolina University</a></li>
            <li><a href="http://www.umd.edu" target="_blank">University of Maryland</a></li>
            <li><a href="http://www.salisbury.edu" target="_blank">Salisbury University</a></li>
            <li><a href="http://www.saintmarys.edu" target="_blank">Saint Mary's University</a><br/></li>
        </ul>
    </li>
    <li>Various cooking Websites I use
        <ul class="unordered">
            <li><a href="http://www.foodnetwork.com" target="_blank">Food Network</a><br/></li>
            <li><a href="http://www.allrecipes.com" target="_blank">All recipes</a><br/></li>
            <li> These are my favorite websites that I always use to look up new recipes.</li>
        </ul>
    </li>
</ol>
<?php
require_once "_footer.php"
?>