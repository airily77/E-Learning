<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 28.11.2017
 * Time: 11.56
 */

namespace database\connectors;

use Illuminate\Support\Facades\DB;

class ArticleData{
    public static function insertArticle($title,$content,$articleclass,$thumbimage,$source,$keyword,$tags,$status){
        DB::beginTransaction();
        try{
            DB::insert('insert into article (title,content,article_class,thumbimage,source,keyword,tags,status,clicknum,creationtime,updatetime) VALUES 
            (?,?,?,?,?,?,?,?,1,now(),now())',[$title,$content,$articleclass,$thumbimage,$source,$keyword,$tags,$status]);
            DB::commit();
        }catch (\Exception $exception){
            echo($exception);
            DB::rollBack();
        }
    }
    public static function getActiveArticles(){
        try{
            $results = DB::select('select * from article where status > 0');
            return $results;
        }catch (\Exception $exception){
            echo($exception);
        }
    }
    public static function insertArticleAttachments($articleidortitle,$savepath,$savename,$filename,$filesize,$ext){
        DB::beginTransaction();
        try{
            $articleid = self::titleOrId($articleidortitle);
            echo($articleid);
            echo('article id was <=====');
            DB::insert('insert into article_attach (article_id,savepath,savename,filename,filesize,ext,downloadnum,creationtime,updatetime) values 
            (?,?,?,?,?,?,1,now(),now())',[$articleid,$savepath,$savename,$filename,$filesize,$ext]);
            DB::commit();
        }catch (\Exception $exception){
            echo($exception);
            DB::rollBack();
        }
    }
    public static function getArticleAttachments($articleidortitle){
        try{
            $articleid = self::titleOrId($articleidortitle);
            return DB::select('select * from article_attch where article_id = ?',[$articleid]);
        }catch (\Exception $exception){
        }
    }
    public static function getArticleId($title){
        try{
            return DB::select('select articleid from article where title = ?',[$title])[0]->articleid;
        }catch (\Exception $exception){
            echo $exception;
        }
    }
    private static function titleOrId($titleorid){
        if (is_string($titleorid)) return self::getArticleId($titleorid);
        if (is_numeric($titleorid)) return $titleorid;
    }
}