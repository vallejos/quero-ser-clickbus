<?php

namespace AppBundle\Controller;

use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GroupIntervalController extends Controller {
    /**
     * @Route("/results")
     */
    public function indexAction(Request $request) {
        // get parameters
        $range = $request->request->get('range');
        $set = explode(',', preg_replace('/[\[\]]/', '', $request->request->get('set')));

        if (empty($range) || empty($set)) {
            return new JsonResponse([]);
        }

        if (!is_numeric($range) || $range<0) {
            throw new InvalidArgumentException("Invalid Range parameter");
        }

        if (!is_array($set)) {
            throw new InvalidArgumentException("Invalid Set parameter");
        }

        switch (count($set)) {
            case 0:
                $data = array();
                break;
            case 1:
                $data = $set;
                break;
            default:
                $this->filterArray($set);
                $data = $this->groupIntervals($range, $this->sortArray($set));
        }

        return new JsonResponse($data);
    }

    private function filterArray(&$array) {
        array_walk($array, array($this, 'sanitize'));
    }

    // check if the array is valid and convert values to integers
    private function sanitize(&$e) {
        $e = trim($e);
        if (!is_numeric($e)) {
            throw new InvalidArgumentException("Invalid Integer value: '".$e."'");
        }
        $e = intval($e);
    }

    // Sort/Filter the array, based on Quick Sort algorithm
    private function sortArray($array) {
        $left = $right = array();
        if (count($array) < 2) {
            return $array;
        }
        $pivot_key = key($array);
        $pivot = array_shift($array);

        foreach ($array as $val) {
            if ($val <= $pivot) {
                $left[] = $val;
            } else {
                $right[] = $val;
            }
        }
        return array_merge($this->sortArray($left), array($pivot_key=>$pivot), $this->sortArray($right));
    }

    // group by intervals
    // $range > 0, $set must be sorted
    private function groupIntervals($range, $set) {
        $result = array();
        $sub = array();
        $max = count($set);

        if ($max>=1) $sub[] = $set[0];

        for($k=1; $k<=$max-1; $k++) {
            if ($set[$k] - $sub[0] <= $range) {
                $sub[] = $set[$k];
            } else {
                $result[] = $sub;
                $sub = array();
                $sub[] = $set[$k];
            }
        }
        if (count($sub)>0) $result[] = $sub;

        return $result;
    }

}
