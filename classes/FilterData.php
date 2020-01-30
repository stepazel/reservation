<?php


class FilterData {
    private $filterName;
    private $filterEmail;
    private $filterEventDateFrom;
    private $filterEventDateTo;
    private $filterPlace;
    private $filterCreatedDateFrom;
    private $filterCreatedDateTo;
    private $filterApproved;

    public function __construct() {
        if ($_POST) {
            $this->filterName = $_POST['filterName'];
            $this->filterEmail = $_POST['filterEmail'];
            $this->filterEventDateFrom = $_POST['filterEventDateFrom'];
            $this->filterEventDateTo = $_POST['filterEventDateTo'];
            $this->filterPlace = $_POST['filterPlace'];
            $this->filterCreatedDateFrom = $_POST['filterCreatedDateFrom'];
            $this->filterCreatedDateTo = $_POST['filterCreatedDateTo'];
            $this->filterApproved = $_POST['filterApproved'];
        }
    }

    public function getFilterName() {
        return $this->filterName;
    }

    public function getFilterEmail() {
        return $this->filterEmail;
    }

    public function getFilterEventDateFrom() {
        return $this->filterEventDateFrom;
    }

    public function getFilterEventDateTo() {
        return $this->filterEventDateTo;
    }

    public function getFilterPlace() {
        return $this->filterPlace;
    }

    public function getFilterCreatedDateFrom() {
        return $this->filterCreatedDateFrom;
    }

    public function getFilterCreatedDateTo() {
        return $this->filterCreatedDateTo;
    }

    public function getFilterApproved() {
        return $this->filterApproved;
    }
}

