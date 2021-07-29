<?php

foreach ($result as $value){
    if($value['article_node'] == 0){
        $article[$value['article_id']] = $value;
    }

    $child = self::article($value['article_doc_id'], $value['article_version'], $value['article_id'], $template);
    if(!empty($child)){

        foreach($child as $item){
            if($item['article_node'] == 0){
                $article[$item['article_id']] = $item;
            }

        }
    }
}


