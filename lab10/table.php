
<?php
    $_currentFile = basename($_SERVER['PHP_SELF']);
    $_pageTitle="My Favorite Movies";
    require_once "_header.php";
?>
    <br />
    <br />
    <table>
        <tr>
          <th>Genre</th>
            <th>Action</th>
            <th>Rom. Com.</th>
            <th>SciFi</th>
            <th>Comedy</th>
            <th>Animated</th>

        </tr>
        <tr>
            <th>No. 1</th>
            <td>Lord of the Rings</td>
            <td>Friends with Benefits</td>
            <td>Any Star Wars movie</td>
            <td>White chicks</td>
            <td>Lion King</td>

        </tr>
        <tr>
            <th>No. 2</th>
            <td>The Dark Knight</td>
            <td>The Last Five Years</td>
            <td>The Martian</td>
            <td>Monty Python</td>
            <td>Lego Movie</td>

        </tr>
        <tr>
            <th>No.3 </th>
            <td>Mad Max</td>
            <td>50 First Dates</td>
            <td>Guardians of the Galaxy</td>
            <td>Old School</td>
            <td>Toy Story</td>

        </tr>
        <tr>
            <th colspan="6">Honorable Mentions</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td>The Bourne Movies</td>
            <td>27 dresses</td>
            <td>District 9</td>
            <td>Anchorman</td>
            <td>Any disney or Pixar movie</td>
        </tr>
    </table>
    <br />
    <br />
    <br />
<?php
require_once "_footer.php"
?>