<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 13:43
 */

namespace sinri\sadame\bin;


class Graph
{
    const PATH_LACK = null;
    const PATH_DIRECTED = 1;
    const PATH_UNDIRECTED = 0;
    const PATH_REVERSED = -1;
    protected $nodes = [];
    protected $paths = [];

    public function __construct()
    {
        $this->nodes = [];
        $this->paths = [];
    }

    /**
     * @return array
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * @param array $nodes
     */
//    public function setNodes($nodes)
//    {
//        $this->nodes = $nodes;
//    }

    /**
     * @return array
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * @param array $paths
     */
//    public function setPaths($paths)
//    {
//        $this->paths = $paths;
//    }

    public function addNode($node_name, $node_value = 0)
    {
        $this->nodes[$node_name] = new Node($node_name, $node_value);
    }

    public function addPath($first_node_name, $second_node_name, $path_value = 0, $direct = self::PATH_DIRECTED)
    {
        if (!$this->hasNode($first_node_name)) {
            throw new \Exception("Node not exists: " . $first_node_name);
        }
        if (!$this->hasNode($second_node_name)) {
            throw new \Exception("Node not exists: " . $second_node_name);
        }
        if ($direct === self::PATH_DIRECTED || $direct === self::PATH_UNDIRECTED) {
            $path = new Path(
                $first_node_name,
                $second_node_name,
                $path_value
            );
            Helper::setMatrixCell($this->paths, $first_node_name, $second_node_name, $path);
        }
        if ($direct === self::PATH_REVERSED || $direct === self::PATH_UNDIRECTED) {
            $path = new Path(
                $second_node_name,
                $first_node_name,
                $path_value
            );
            Helper::setMatrixCell($this->paths, $second_node_name, $first_node_name, $path);
        }
    }

    public function hasNode($node_name)
    {
        if ($this->nodes && isset($this->nodes[$node_name])) {
            return true;
        }
        return false;
    }

    public function getNode($node_name)
    {
        if ($this->nodes && isset($this->nodes[$node_name])) {
            return $this->nodes[$node_name];
        }
        return null;
    }

    public function hasPath($first_node_name, $second_node_name)
    {
        if (!isset($this->paths)) {
            return self::PATH_LACK;
        }
        $path = Helper::getMatrixCell($this->paths, $first_node_name, $second_node_name);
        return $path;
    }

    public function getPathListSince($node_name)
    {
        if (isset($this->paths) && isset($this->paths[$node_name])) {
            return $this->paths[$node_name];
        }
        return [];
    }
}