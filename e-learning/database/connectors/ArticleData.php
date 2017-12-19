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
    public static function removeArticle($title){
        DB::beginTransaction();
        try{
            DB::delete('delete from article where title = ? ',[$title]);
            DB::commit();
        }catch (\Exception $exception){}
    }
    public static function getArticles(){
        try{
            return DB::select('select title,content,source,keyword,tags,status,clicknum,creationtime,updatetime from article');
        }catch (\Exception $exception){}
    }
    public static function getActiveArticles(){
        try{
            $results = DB::select('select * from article where status > 0');
            return $results;
        }catch (\Exception $exception){
            echo($exception);
        }
    }
    public static function updateArticle($id,$newtitle,$content,$source,$keyword,$tags,$status){
        if(!is_null($newtitle) && !empty($newtitle))
            self::updateTitle($id, $newtitle);
        if(!is_null($content) && !empty($content))
            self::updateContent($id,$content);
        if(!is_null($source) && !empty($source))
            self::updateSource($id,$source);
        if(!is_null($keyword) && !empty($keyword))
            self::updateKeyword($id,$keyword);
        if(!is_null($tags) && !empty($tags))
            self::updateTags($id,$tags);
        if(!is_null($status) && !empty($status))
            self::updateStatus($id,$status);
    }
    private static function updateSource($id,$source){
        DB::beginTransaction();
        try{
            DB::update('update article set source = ? where articleid = ?',[$source,$id]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
    private static function updateKeyword($id,$keyword){
        DB::beginTransaction();
        try{
            DB::update('update article set keyword = ? where articleid = ?',[$keyword,$id]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
    private static function updateTags($id,$tags){
        DB::beginTransaction();
        try{
            DB::update('update article set tags = ? where articleid = ?',[$tags,$id]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
    private static function updateStatus($id,$status){
        DB::beginTransaction();
        try{
            DB::update('update article set status = ? where articleid = ?',[$status,$id]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
    private static function updateContent($id,$content){
        DB::beginTransaction();
        try{
            DB::update('update article set content = ? where articleid = ?',[$content,$id]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
    private static function updateTitle($id,$newtitle){
        DB::beginTransaction();
        try{
            DB::update('update article set title = ? where articleid = ?',[$newtitle,$id]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
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
    public static function getArticle($id){
        try{
            $results = DB::select('select * from article where articleid = ?',[$id])[0];
            return $results;
        }catch (\Exception $exception){
            dd($exception);
        }
    }
}