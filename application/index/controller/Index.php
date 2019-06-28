<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {	

    	$total = Db::name('posts')->where('post_status',"publish")->count();
    	//print_r($pcount);

    	$page = input('p')?input('p'):1;
    	$page_size = 10;

        $pagecount=ceil($total/$page_size);
        $pagecount = $pagecount<=0?1:$pagecount;

        if($page>$pagecount){
            $page = $pagecount;
        }elseif($page<=0){
            $page = 1;
        }

        $firstRow = $page_size*($page-1);
    	$posts = Db::name('posts')->where('post_status',"publish")->limit($firstRow,$page_size)->select();

    	$preurl = "/?act=post";
    	$pageStr = multi($total,$page_size,$page,$preurl);

    	$this->assign('pageStr',$pageStr);
    	$this->assign('posts', $posts);
        return $this->fetch();
    }

    public function post(){
    	if(input('id')==null){
    		echo "<script>location.href='/';</script>";exit;
    	}
    	$post = Db::name('posts')->where(['post_status'=>"publish","id"=>input('id')])->find();
    	if(!$post){
    		echo "<script>location.href='/';</script>";exit;
    	}
    	//print_r($post);
    	$this->assign('post', $post);
    	return $this->fetch();
    }

}
