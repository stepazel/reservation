<?php
mb_internal_encoding('UTF-8');

function loadClass($class) {
    require('classes/'.$class.'.php');
}

spl_autoload_register('loadClass');
database::connect(database::selectHost(), database::selectUser(), database::selectPassword(), database::selectDatabase());


class paginator extends admin {
    private $resultsPerPage;
    public $pageID;

    public function __construct(int $resultsPerPage) {
        $this->resultsPerPage = $resultsPerPage;
    }


    public function displayLinks () {
        $numberOfResults = database::query('SELECT COUNT(*) FROM reservationinfo')->fetchAll();
        $numberOfLinks = ceil(intval($numberOfResults['0']['COUNT(*)']) / $this->resultsPerPage);
        for ($this->pageID = 1; $this->pageID <= $numberOfLinks; $this->pageID++) {
            echo '<a href="adminPage.php?pageID='.$this->pageID.'">' .$this->pageID. '</a> ';
        }
    }

    public function displayResults () {
        if (isset($_GET['pageID'])) {
            $table = database::query("SELECT * FROM reservationinfo LIMIT " . ($_GET['pageID'] - 1) * $this->resultsPerPage . '
            , ' . $this->resultsPerPage)->fetchAll(PDO::FETCH_NAMED);
            foreach ($table as $array => $value) {
                echo '<tr><td>' . $value['name'] . '</td><td>' . $value['email'] . '</td><td>' . $value['datetime'] . '</td>
                    <td>' . $value['place'] . '</td><td>' . $value['created'] . '</td><td>' . $value['approved'] . '</td>
                    <td><a href="adminPage.php?id=' . $value['id'] . '&app=1&pageID=' . $_GET['pageID'] . '">Schválit</a> / 
                    <a href="adminPage.php?id=' . $value['id'] . '&app=0&pageID=' . $_GET['pageID'] . '">Zamítnout</a></td></tr>';
            }
            echo '</tbody></table></div>';
        }
    }



}
