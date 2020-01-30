<?php
mb_internal_encoding('UTF-8');

function loadClass($class) {
    require('classes/'.$class.'.php');
}

spl_autoload_register('loadClass');
database::connect(database::selectHost(), database::selectUser(), database::selectPassword(), database::selectDatabase());


class paginator {
    public $pageID;
    const resultsPerPage = 3;

    public function displayLinks () {
        $filterData = new FilterData();
        $filterLinks = new Filter($filterData);
        $numberOfResults = database::query(str_replace('*', 'COUNT(*)', $_SESSION['filterQuery']))->fetch();
        $numberOfLinks = ceil($numberOfResults['0'] / paginator::resultsPerPage);
        for ($this->pageID = 1; $this->pageID <= $numberOfLinks; $this->pageID++) {
            echo '<a href="adminPage.php?pageID='.$this->pageID.'">' .$this->pageID. '</a> ';
        }
    }

    public function displayResults () {
        $filterData = new FilterData();
        $filterResults = new Filter($filterData);
        if (isset($_GET['pageID'])) {
            return $table = database::query( $_SESSION['filterQuery'] ." LIMIT " . ($_GET['pageID'] - 1) * paginator::resultsPerPage . '
            , ' . paginator::resultsPerPage)->fetchAll(PDO::FETCH_NAMED);
        }
        return false;
    }
}
