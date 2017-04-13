<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 16:57
 */

namespace sinri\sadame\algorithm;


use sinri\sadame\bin\MatrixGraph;
use sinri\sadame\interfaces\Node;

class Dijkstra
{
    public $graph;

    public function __construct()
    {
        $this->graph = new MatrixGraph();
    }

    public function go($s, $t)
    {
        $D = [];//Distance mapping
        $P = [];//Previous mapping
        $K = [];//Nodes known
        $U = [];//Nodes unknown

        //0-1: set distance, s as 0, others as -1
        //0-2: create Unknown set
        foreach ($this->graph->getNodes() as $node) {
            $D[$node->getName()] = PHP_INT_MAX;
            $U[$node->getName()] = $node->getName();
        }
        $D[$s] = 0;

        //1.take out the min D item from U
        while (!empty($U)) {
            $min_node_name = $this->findMinInPaths($U, $D);
            $K[$min_node_name] = $min_node_name;
            unset($U[$min_node_name]);
            $paths = $this->graph->getPathListSince($min_node_name);
            if (!empty($paths)) {
                foreach ($paths as $path) {
                    if ($D[$path->getTo()] - $path->getValue() > $D[$min_node_name]) {
                        $D[$path->getTo()] = $path->getValue() + $D[$min_node_name];
                        $P[$path->getTo()] = $min_node_name;
                    }
                }
            }
        }

        //2.revert
        $ptr = $t;
        $route = [];
        while (null !== $ptr) {
            $route[] = $ptr;
            if (isset($P[$ptr])) {
                $ptr = $P[$ptr];
            } else {
                $ptr = null;
            }
        }
        return [
            "route" => array_reverse($route),
            "count" => $D[$t],
        ];
    }

    private function findMinInPaths($U, $D)
    {
        $min_key = null;
        $min_value = -1;
        foreach ($U as $name) {
            if ($min_value < 0 || $D[$name] < $min_value) {
                $min_key = $name;
                $min_value = $D[$name];
            }
        }
        return $min_key;
    }
}

// algorithm

//        1  function Dijkstra(G, w, s)
//        2     for each vertex v in V[G]        // 初始化
//        3           d[v] := infinity           // 將各點的已知最短距離先設成無窮大
//        4           previous[v] := undefined   // 各点的已知最短路径上的前趋都未知
//        5     d[s] := 0                        // 因为出发点到出发点间不需移动任何距离，所以可以直接将s到s的最小距离设为0
//        6     S := empty set
//        7     Q := set of all vertices
//        8     while Q is not an empty set      // Dijkstra演算法主體
//        9           u := Extract_Min(Q)
//                        if u=t then end;
//        10           S.append(u)
//        11           for each edge outgoing from u as (u,v)
//        12                  if d[v] > d[u] + w(u,v)             // 拓展边（u,v）。w(u,v)为从u到v的路径长度。
//        13                        d[v] := d[u] + w(u,v)         // 更新路径长度到更小的那个和值。
//        14                        previous[v] := u              // 紀錄前趨頂點


