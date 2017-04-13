<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/13
 * Time: 09:28
 */

namespace sinri\sadame\interfaces;

interface Graph
{
    const PATH_LACK = null;
    const PATH_DIRECTED = 1;
    const PATH_UNDIRECTED = 0;
    const PATH_REVERSED = -1;

    /**
     * @return array
     */
    public function getNodes();

    /**
     * @return array
     */
    public function getPaths();

    /**
     * @param array $paths
     */
    public function addNode($node_name, $node_value = 0);

    public function addPath($first_node_name, $second_node_name, $path_value = 0, $direct = self::PATH_DIRECTED);

    public function hasNode($node_name);

    public function getNode($node_name);

    public function hasPath($first_node_name, $second_node_name);

    public function getPathListSince($node_name);
}