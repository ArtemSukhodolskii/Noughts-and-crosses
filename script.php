<?php
    $post = json_decode(file_get_contents('php://input'), true);
    $arr = $post["field"];

    if(find_subsequence($arr, 3, "0")){
        echo json_encode(["Winner" => "0"]);
        return;
    }
    if(find_subsequence($arr, 3, "#")){
        echo json_encode(["Winner" => "#"]);
        return;
    }

    if(!board_is_full($arr)){
        echo json_encode(["Winner" => "Draw"]);
        return;
    }
    function subsequence($y, $x, $arr, $count, $mark, $iteration = 0, $direction = "None"){
        if(count($arr) <= $y || count($arr[$y]) <= $x || $y < 0 || $x < 0) return false;
        if($arr[$y][$x] === $mark) $iteration++;
        else{
            return false;
        }

        if($iteration === $count){
            return true;
        }

        if($direction === "right"){
            return subsequence($y, $x+1, $arr, $count, $mark, $iteration, $direction);
        }
        if($direction === "down"){
            return subsequence($y+1, $x, $arr, $count, $mark, $iteration, $direction);
        }
        if($direction === "right-down"){
            return subsequence($y+1, $x+1, $arr, $count, $mark, $iteration, $direction);
        }
        if($direction === "left-down"){
            return subsequence($y+1, $x-1, $arr, $count, $mark, $iteration, $direction);
        }

        return subsequence($y, $x+1, $arr, $count, $mark, $iteration, "right") || subsequence($y+1, $x, $arr, $count, $mark, $iteration, "down") || subsequence($y+1, $x+1, $arr, $count, $mark, $iteration, "right-down") || subsequence($y+1, $x-1, $arr, $count, $mark, $iteration, "left-down");

    }

    function find_subsequence($arr, $count, $mark){
        for($i = 0; $i < count($arr); $i++){
            for($j = 0; $j < count($arr[$i]); $j++){
                if(subsequence($i, $j, $arr, $count, $mark) === true){
                    return true;
                }
            }
        }
        return false;
    }
    function board_is_full($arr){
        $field = [];
        for($i = 0; $i < count($arr); $i++){
            for($j = 0; $j < count($arr[$i]); $j++){
                if($arr[$i][$j] === " "){
                    $field[] = "r{$i}c{$j}";
                }
            }
        }
        return $field;
    }

    function check_answer($arr){
        $combination = [[1, 1], [0, 0], [0, 2], [2, 0], [2, 2], [0, 1], [1, 0], [1, 2], [2, 1]];

        $avalible_steps = [];
        foreach($combination as $v){
            if($arr[$v[0]][$v[1]] === " "){
                $avalible_steps[] = $v;
            }
        }

        foreach($avalible_steps as $v){
            $fake_board = $arr;
            $fake_board[$v[0]][$v[1]] = "0";
            if(find_subsequence($fake_board, 3, "0")){
                return $v;
            }
        }

        foreach($avalible_steps as $v){
            $fake_board = $arr;
            $fake_board[$v[0]][$v[1]] = "#";
            if(find_subsequence($fake_board, 3, "#")){
                return $v;
            }
        }

        return $avalible_steps[0];

    }

    $answer = [];

    $result = check_answer($arr);
    $answer["Win"] = $result;
    $arr[$result[0]][$result[1]] = "0";
    if(find_subsequence($arr, 3, "0")){
        $answer["Winner"] = "0";
    }
    if(find_subsequence($arr, 3, "#")){
        $answer["Winner"] = "#";
    }

    if(!board_is_full($arr)){
        $answer["Winner"] = "Draw";
    }

    echo json_encode($answer);

    <<<MARKER
    asdsd
    MARKER;
?>