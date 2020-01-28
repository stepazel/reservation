<?php


class Filter {

    private $filterData;
    private $query;

    public function __construct(FilterData $filterData) {
        $this->filterData = $filterData;
    }

    private function getQuery () {
        $this->query = 'SELECT * FROM reservationinfo WHERE';
        if ($this->filterData->getFilterName() != '') {
            $this->query = $this->query . 'name LIKE %' .$this->filterData->getFilterName() . '% AND';
        }
        if ($this->filterData->getFilterEmail() != '') {
            $this->query = $this->query . 'email LIKE %' . $this->filterData->getFilterEmail() . '% AND';
        }
        if ($this->filterData->getFilterEventDateFrom() != '' and $this->filterData->getFilterEventDateTo() != '') {
            $this->query = $this->query . 'datetime BETWEEN '. $this->filterData->getFilterEventDateFrom() .'
            AND ' . $this->filterData->getFilterEventDateTo();
        }
        if ($this->filterData->getFilterCreatedDateFrom() != '' and $this->filterData->getFilterCreatedDateTo() != '') {
            $this->query = $this->query . 'created BETWEEN ' . $this->filterData->getFilterCreatedDateFrom() .' 
            AND ' . $this->filterData->getFilterCreatedDateTo();
        }
        if ($this->filterData->getFilterApproved() != '') {
            $this->query = $this->query . 'approved = ' . $this->filterData->getFilterApproved();
        }
        if (!$this->filterData->getFilterPlace()) {
            $this->query = $this->query . 'place LIKE %' . $this->filterData->getFilterPlace() . '%';
        }
        if (substr($this->query, -5) == 'WHERE') {
            $this->query = 'SELECT * FROM reservationinfo';
        }
    }

}