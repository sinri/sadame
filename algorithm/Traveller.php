<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 14:11
 */

namespace sinri\sadame\algorithm;


use sinri\sadame\bin\MatrixGraph;

abstract class Traveller
{
    protected $graph = null;//the graph map
    protected $walked = [];//travelled record
    protected $currentNode = null;//current node name
    protected $target = null;//target node name
    protected $note = null;//traveller's note

    public function __construct()
    {
        $this->graph = new MatrixGraph();
        $this->walked = [];
        $this->currentNode = null;
        $this->target = null;
        $this->note = null;
    }

    public function ready($graph, $current_node, $target_node, $note)
    {
        $this->graph = $graph;
        $this->currentNode = $current_node;
        $this->note = $note;
        $this->target = $target_node;
        $this->walked = [];

        $this->walked[] = $current_node;
    }

    public function next()
    {
        // seek out a path to go, or keep staying
        $paths = $this->graph->getPathListSince($this->currentNode);
        if (empty($paths)) {
            return false;//stay
        }
        foreach ($paths as $path) {
            if ($this->determinePath($path)) {
                $this->walk($path);
                $is_arrived = ($this->currentNode == $this->target);
                $this->onMoved($is_arrived);
                return $this->currentNode;
            }
        }
        //stay
        return false;
    }

    protected function walk($path)
    {
        $this->currentNode = $path->to;
        $this->walked[] = $this->currentNode;
    }

    // those should be overrode if needed

    abstract protected function onMoved($is_arrived = false);

    abstract protected function determinePath($path);


}