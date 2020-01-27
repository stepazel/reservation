<?php


class filter {
    private $filterName;
    private $filterEmail;
    private $filterEventDateFrom;
    private $filterEventDateTo;
    private $filterPlace;
    private $filterCreatedDateFrom;
    private $filterCreatedDateTo;
    private $filterApproved;

    public function __construct() {
        $this->filterName = $_POST['filterName'];
        $this->filterEmail = $_POST['filterEmail'];
        $this->filterEventDateFrom = $_POST['filterEventDateFrom'];
        $this->filterEventDateTo = $_POST['filterEventDateTo'];
        $this->filterPlace = $_POST['filterPlace'];
        $this->filterCreatedDateFrom = $_POST['filterCreatedDateFrom'];
        $this->filterCreatedDateTo = $_POST['filterCreatedDateTo'];
        $this->filterApproved = $_POST['filterApproved'];
    }

    public function getFilterName () {
        return $this->filterName;
    }

    public function getFilterEmail () {
        return $this->filterEmail;
    }

    public function getFilterEventDateFrom () {
        return $this->filterEventDateFrom;
    }

    public function getFilterEventDateTo () {
        return $this->filterEventDateTo;
    }

    public function getFilterPlace () {
        return $this->filterPlace;
    }

    public function getFilterCreatedDateFrom () {
        return $this->filterCreatedDateFrom;
    }

    public function getFilterCreatedDateTo () {
        return $this->filterCreatedDateTo;
    }

    public function getFilterApproved () {
        return $this->filterApproved;
    }

    public function getFilterData () {
        $data = database::query('SELECT * FROM reservationinfo WHERE name LIKE ? AND email LIKE ? AND datetime BETWEEN ? AND ?
                AND place LIKE ? AND approved LIKE ? AND created BETWEEN ? AND ?',
            array('%'.$this->getFilterName().'%', '%'.$this->getFilterEmail().'%', '%'.$this->getFilterEventDateFrom().'%',
                '%'.$this->getFilterEventDateTo().'%', '%'.$this->getFilterPlace().'%', '%'.$this->getFilterApproved().'%',
                '%'.$this->getFilterCreatedDateFrom().'%', '%'.$this->getFilterCreatedDateTo().'%'))->fetchAll();
        return $data;
    }


}

