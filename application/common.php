<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
* 分页工具
*/
function multi($num,$perpage,$curpage,$mpurl) {
     
    $multipage = '';
    
    //首先商品数必需要大于一页的商品数才会显示分页
    if($num > $perpage){
    
        $page = 7; // 临界值
        $offset = 4; // 偏移
        $pages = @ceil($num / $perpage);//总页数
        //如果页数在临界值范围内 页数就全部显示
        if($page >=$pages) { // 当总页数小于临界值7页
            for($i = 1;$i <= $pages;$i++) {
                $multipage .= $i == $curpage?'<span class="current">'.$i.'</span>':'<a href="'.$mpurl.'&p='.$i.'">'.$i.'</a>';
            }
            //return $multipage;
        }else {
            //最小偏移数
            $st_os = $offset+1;
            //最大偏移数
            $ed_os = $pages - $offset;
            //如果当前所选页数在最小偏移数内就输出类似 1 2 3 4 5 …… 10 (这个10是最后的页数页码)
            if($curpage<$st_os){
                for($i = 1;$i <=$st_os;$i++) {
                    $multipage .= $i == $curpage?'<span class="current">'.$i.'</span>':'<a href="'.$mpurl.'&p='.$i.'">'.$i.'</a>';
                }
                $multipage = $multipage.'<i>...</i>'.'<a href="'.$mpurl.'&p='.$pages.'">'.$pages.'</a>';
                //return $multipage;
            //如果超出或等于最小偏移数
            }else{
                //如果当前页面大于或等于最大偏移数就输出类似于 1 …… 6 7 8 9 10 (这个10是最后的页数页码)
                if($curpage>$ed_os){
                    $multipage =  '<a href="'.$mpurl.'&p=1">1</a><i>...</i>';
                    for($i=$ed_os;$i<=$pages;$i++){
                       $multipage .= $i == $curpage?'<span class="current">'.$i.'</span>':'<a href="'.$mpurl.'&p='.$i.'">'.$i.'</a>';
                    }  
                //否则输出类似于 1 …… 4 5 6 …… 10 (这个5是当前页码 这个10是最后的页数页码)
                }else{
                    $multipage =  '<a href="'.$mpurl.'&p=1">1</a>'.'<i>...</i>'.'<a href="'.$mpurl.'&p='.($curpage-1).'">'.($curpage-1).'</a><span class="current">'.$curpage.'</span><a href="'.$mpurl.'&p='.($curpage+1).'">'.($curpage+1).'</a><i>...</i>'.'<a href="'.$mpurl.'&p='.$pages.'">'.$pages.'</a>';
                }
                //return $multipage;
            }
        }
        
        $prev = $curpage==1?'<span class="pg-end">上一页</span>':'<a href="'.$mpurl.'&p='.($curpage-1).'">上一页</a>';
        $next = $curpage==$pages?'<span class="pg-end">下一页</span>':'<a href="'.$mpurl.'&p='.($curpage+1).'">下一页</a>';
        
        return $prev.$multipage.$next." 共".$num."条";
    
    }
    
    return $multipage;
 
 }
