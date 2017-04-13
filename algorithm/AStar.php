<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/13
 * Time: 09:57
 */

namespace sinri\sadame\algorithm;


use sinri\sadame\bin\MatrixGraph;

class AStar
{
    public $graph;

    public function __construct()
    {
        $this->graph = new MatrixGraph();
    }

    public function search($start, $goal)
    {
        $closed_set = [];//computed nodes
        $open_set = [];//initial nodes to compute
        $came_from = [];//mapping
        $G = [];
        $H = [];
        $F = [];

        foreach ($this->graph->getNodes() as $node) {
            $open_set[$node->getName()] = $node;
        }

        $G[$start] = 0;
        $H[$start] = $this->computeHeuristicEstimateOfDistance($start, $goal);
        $F[$start] = $H[$start];
        while (!empty($open_set)) {
            $x = $this->getOpenNodeWithLowestF($open_set, $F);//min_F_node_name
            if ($x === null) throw new \Exception("Get null node from open set!");
            if ($x == $goal) {
                return $this->reconstructPath($came_from, $goal);
            }
            unset($open_set[$x]);
            $closed_set[$x] = $x;
            foreach ($this->graph->getPathListSince($x) as $path) {
                $y = $path->getTo();
                if (isset($closed_set[$y])) continue;
                $tentative_g_score = $G[$x] + $this->getDistanceOfPath($path);
                if (!isset($open_set[$y])) {
                    $open_set[$y] = $this->graph->getNode($y);
                    $tentative_is_better = true;
                } elseif (!isset($G[$y]) || $tentative_g_score < $G[$y]) {
                    $tentative_is_better = true;
                } else {
                    $tentative_is_better = false;
                }
                if ($tentative_is_better) {
                    $came_from[$y] = $x;
                    $G[$y] = $tentative_g_score;
                    $H[$y] = $this->computeHeuristicEstimateOfDistance($y, $goal);
                    $F[$y] = $G[$y] + $H[$y];
                }
            }
        }
        return false;
    }

    /**
     * H(start,goal) 表示任意顶点n到目标顶点的估算距离（根据所采用的评估函数的不同而变化）
     * @param $start
     * @param $goal
     * @return int
     */
    protected function computeHeuristicEstimateOfDistance($start, $goal)
    {
        $p1 = $this->graph->getNode($start)->getValue();
        $p2 = $this->graph->getNode($goal)->getValue();
        $dx = $p1['x'] - $p2['x'];
        $dy = $p1['y'] - $p2['y'];
        return $dx * $dx + $dy * $dy;
    }

    protected function getOpenNodeWithLowestF($open_set, $F)
    {
        $min_node_name = null;
        $min_value = PHP_INT_MAX;
        foreach ($open_set as $name => $node) {
            if (isset($F[$name])) {
                if ($F[$name] <= $min_value) {
                    $min_node_name = $name;
                    $min_value = $F[$name];
                }
            }
        }
        if ($min_node_name === null && !empty($open_set)) {
            foreach ($open_set as $name => $node) {
                return $name;
            }
        }
        return $min_node_name;
    }

    protected function reconstructPath($came_from, $current_node)
    {
        if (isset($came_from[$current_node])) {
            $p = $this->reconstructPath($came_from, $came_from[$current_node]);
            return array_merge($p, [$current_node]);
        }
        return [$current_node];
    }

    /**
     * Distance Defined from path->from to path->to
     * @param $path
     * @return mixed
     */
    protected function getDistanceOfPath($path)
    {
        return $path->value;//or inside field of this->value
    }
}

/*
在此算法中，如果以
    g(n)表示从起点到任意顶点n的实际距离，
    h(n)表示任意顶点n到目标顶点的估算距离（根据所采用的评估函数的不同而变化），
那么 A*算法的估算函数为：f(n)=g(n)+h(n)
 *
function A*(start,goal)
     closedset := the empty set                 //已经被估算的节点集合
     openset := set containing the initial node //将要被估算的节点集合
     came_from := empty map
     g_score[start] := 0                        //g(n)
     h_score[start] := heuristic_estimate_of_distance(start, goal)    //h(n)
     f_score[start] := h_score[start]            //f(n)=h(n)+g(n)，由于g(n)=0，所以……
     while openset is not empty                 //当将被估算的节点存在时，执行
         x := the node in openset having the lowest f_score[] value   //取x为将被估算的节点中f(x)最小的
         if x = goal            //若x为终点，执行
             return reconstruct_path(came_from,goal)   //返回到x的最佳路径
         remove x from openset      //将x节点从将被估算的节点中删除
         add x to closedset      //将x节点插入已经被估算的节点
         foreach y in neighbor_nodes(x)  //对于节点x附近的任意节点y，执行
             if y in closedset           //若y已被估值，跳过
                 continue
             tentative_g_score := g_score[x] + dist_between(x,y)    //从起点到节点y的距离

             if y not in openset          //若y不是将被估算的节点
                 add y to openset         //将y插入将被估算的节点中
                 tentative_is_better := true
             elseif tentative_g_score < g_score[y]         //如果y的估值小于y的实际距离
                 tentative_is_better := true         //暂时判断为更好
             else
                 tentative_is_better := false           //否则判断为更差
             if tentative_is_better = true            //如果判断为更好
                 came_from[y] := x                  //将y设为x的子节点
                 g_score[y] := tentative_g_score
                 h_score[y] := heuristic_estimate_of_distance(y, goal)
                 f_score[y] := g_score[y] + h_score[y]
     return failure

 function reconstruct_path(came_from,current_node)
     if came_from[current_node] is set
         p = reconstruct_path(came_from,came_from[current_node])
         return (p + current_node)
     else
         return current_node
 */